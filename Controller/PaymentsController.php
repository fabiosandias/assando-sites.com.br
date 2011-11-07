<?php
/**
 * Controller de pagamentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller de pagamentos
 */
class PaymentsController extends AppController {
	
	/**
	 * Antes de filtrar (non-PHPdoc)
	 * 
	 * @see AppController::beforeFilter()
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		# $this->Security->requirePost('PagSeguro');
		$this->Security->csrfCheck = false;
	}
	
	/**
	 * Recebe as notificações do PagSeguro
	 */
	public function PagSeguro() {	
		// Se não houver o "notificationType" ou o "notificationCode" ou (notificationType != transaction)
		if (!isset($this->request->data['notificationType']) || !isset($this->request->data['notificationCode']) ||
			($this->request->data['notificationType'] != 'transaction')) {
			$this->log('IP [' . getenv('REMOTE_ADDR') . '] POST: ' . "\r\n" . serialize($this->request->data), 'PagSeguro');
			exit;
		}
					
		// Importa o vendor PagSeguroLibrary
		App::import('Vendor', 'PagSeguro', array('file' => 'PagSeguroLibrary' . DS . 'PagSeguroLibrary.php'));
		
		// Objeto de credenciais
		$AccountCredentials = new AccountCredentials(Configure::read('PagSeguro.email'), Configure::read('PagSeguro.token'));
		
		// Verifica a transação
		$Transaction = NotificationService::checkTransaction($AccountCredentials, $this->request->data['notificationCode']);
		
		// Loga a transação
		$this->log('TRANSACTION: ' . "\r\n" . serialize($Transaction), 'PagSeguro');
		
		if (empty($Transaction))
			exit;
		
		// Tenta encontrar o aluno pelo email ou pelo nome
		$Student = $this->Payment->Student->find('first', array(
			'conditions' => array(
				'OR' => array(
					'Student.email' => $transaction->getSender()->getEmail(),
					'Student.name' => $transaction->getSender()->getName(),
					'Student.fullname' => $transaction->getSender()->getName(),
				)
			)
		));
		
		// Tenta encontrar o Payment
		$Payment = $this->Payment->findByReference($Transaction->getReference());
		
		// Tenta salvar o pagamento
		$this->Payment->save(array(
			'id' => !empty($Payment) ? $Payment['Payment']['id'] : null,
			'student_id' => !empty($Student) ? $Student['Student']['id'] : 0,
		
			'code' => $Transaction->getCode(),
			'reference' => $Transaction->getReference(),
		
			'value' => $Transaction->getGrossAmount(),
			'datetime' => $Transaction->getDate(),
		
			'payment_gateway_id' => PAYMENT_GATEWAY_PAGSEGURO,
			'payment_method_id' => $Transaction->getPaymentMethod()->getValue(),
		
			/**
			 * $Transaction->getStatus()->getValue() => entre 0 e 7
			 * 
			 * Payment.status_id => entre 11 e 17
			 */
			'status_id' => max(11, 10 + $Transaction->getStatus()->getValue()),
		));
		
		exit;
	}
	
	/**
	 * Lista de alunos
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('Student', 'Status', 'PaymentMethod', 'PaymentGateway'),
			'order' => array('Payment.created' => 'DESC')
		);
		
		$this->set(array(
			'title_for_layout' => 'Pagamentos',
		
			'data' => $this->paginate('Payment')
		));
	}
	
}