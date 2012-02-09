<?php
/**
 * Controller de pagamentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

App::uses('AppController', 'Controller');

/**
 * Controller de pagamentos
 */
class PaymentsController extends AppController {
		
	/**
	 * Antes de filtar
	 */
	public function beforeFilter() {
		if ($this->action == 'syncPayment_PagSeguro')
			$this->Components->disable('Security');
			
		return parent::beforeFilter();
	}
		
	/**
	 * Lista de pagamentos
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
		
	/**
	 * Sincroniza os dados de pagamento do PagSeguro
	 */
	public function syncPayment_PagSeguro() {
		if (!$this->request->is('post'))
			exit;

		App::import('Vendor', 'PagSeguro', array('file' => 'PagSeguroLibrary' . DS . 'PagSeguroLibrary.php'));

		$AccountCredentials = new AccountCredentials(Configure::read('PagSeguro.API.email'), Configure::read('PagSeguro.API.token'));

		$this->log('POST:' . serialize($_POST), 'PagSeguro');
		$this->log('Data:' . serialize($this->request->data), 'PagSeguro');

		/* Tipo de notificação recebida */  
		$type = $_POST['notificationType'];  

		/* Código da notificação recebida */  
		$code = $_POST['notificationCode'];  


		/* Verificando tipo de notificação recebida */  
		if ($type === 'transaction') {  

			/* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */  
			$transaction = PagSeguroNotificationService::checkTransaction(  
				$AccountCredentials,  
				$code // código de notificação  
			); 

			$this->log('Transaction:' . serialize($transaction), 'PagSeguro');

		}

	}
	
}