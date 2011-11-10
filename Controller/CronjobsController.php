<?php
/**
 * Controller de cronjobs
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

/**
 * Controller de cronjobs
 */
class CronjobsController extends AppController {
	
	/**
	 * Não utiliza nenhum Model
	 * 
	 * @var array
	 */
	public $uses = array();
	
	/**
	 * Lista de componentes à utilizar
	 * 
	 * @var array
	 */
	public $components = array('EmailQueue');
	
	/**
	 * Antes de filtrar
	 * 
	 * Verifica se a requisição vem de um endereço local
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		if (!in_array(getenv('REMOTE_ADDR'), array('127.0.0.1', 'localhost', '66.228.61.47'))) {
			$this->log('Tentativa de acesso à CronJob [' . $this->action . '] do IP [' . getenv('REMOTE_ADDR') . ']', 'debug');
			throw new NotFoundException();
		}
	}
	
	/**
	 * Processa a fila de emails
	 */
	public function emailQueue() {
		$this->EmailQueue->processQueue(); exit;
	}
	
	/**
	 * Atualiza os pagamentos do PagSeguro
	 */
	public function syncPagSeguro() {
		$this->loadModel('Payment');
		
		// Importa o vendor PagSeguroLibrary
		App::import('Vendor', 'PagSeguro', array('file' => 'PagSeguroLibrary' . DS . 'PagSeguroLibrary.php'));
		
		// Objeto de credenciais
		$AccountCredentials = new AccountCredentials(Configure::read('PagSeguro.API.email'), Configure::read('PagSeguro.API.token'));
		
		$initialDate = date('c', strtotime('-1 month'));
		$finalDate = date('c');
		
		$pageNumber = 1;
		$maxPageResults = 30;
		
		$Transactions = TransactionSearchService::searchByDate($AccountCredentials, $initialDate, $finalDate, $pageNumber, $maxPageResults);
		
		foreach ($Transactions->getTransactions() AS $Transaction) {
			$reference = $Transaction->getReference();
			
			// Se não tem referência, pula
			if (empty($reference))
				continue;
			
			// Encontra o aluno
			$Student = $this->Payment->Student->field('id', array('SHA1(Student.email)' => $reference));
			
			// Se não tem aluno, pula
			if (empty($Student))
				continue;
			
			// Enconta o pagamento pelo código e pelo ID do aluno (que corresponde ao reference)
			$Payment = $this->Payment->find('first', array(
				'fields' => array('id', 'updated'),
				'conditions' => array(
					'code' => $Transaction->getCode(),
					'student_id' => $Student
				)
			));
			
			// Se encontrou o pagamento e ele está atualizado
			if (!empty($Payment) && (strtotime($Payment['Payment']['updated']) == strtotime($Transaction->getLastEventDate())))
				continue;
			
			
			// Dados à serem salvos
			$data = array(
				'id' => !empty($Payment) ? $Payment['Payment']['id'] : null,
				'student_id' => !empty($Student) ? $Student : 0,
	
				'code' => $Transaction->getCode(),
				'reference' => !empty($reference) ? $reference : '',
	
				'value' => $Transaction->getGrossAmount(),
				'datetime' => $Transaction->getDate(),
	
				'payment_gateway_id' => PAYMENT_GATEWAY_PAGSEGURO,
				'payment_method_id' => $Transaction->getPaymentMethod()->getType()->getValue(),
				
				'status_id' => max(11, 10 + $Transaction->getStatus()->getValue()),
				
				'updated' => $Transaction->getLastEventDate()
			);
			
			// Salva ou atualiza os dados do pagamento
			$this->Payment->save($data);
		}
		
		exit;
	}
	
}
