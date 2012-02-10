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
App::uses('CakeEmail', 'Network/Email');

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

		// PagSeguroLibrary
		App::import('Vendor', 'PagSeguro', array('file' => 'PagSeguroLibrary' . DS . 'PagSeguroLibrary.php'));

		// Login
		$AccountCredentials = new AccountCredentials(Configure::read('PagSeguro.API.email'), Configure::read('PagSeguro.API.token'));

		# $this->log('POST: ' . serialize($_POST), 'PagSeguro');
		# $this->log('Data: ' . serialize($this->request->data), 'PagSeguro');

		$transactionType = $this->request->data['notificationType'];
		$transactionCode = $this->request->data['notificationCode']; 

		if ($transactionType === 'transaction') {  

			$Transaction = PagSeguroNotificationService::checkTransaction(  
				$AccountCredentials,  
				$transactionCode
			);

			$body = var_export($Transaction, true);

			$CakeEmail = new CakeEmail('smtp');
			$CakeEmail->to('contato@thiagobelem.net')
					  ->from('contato@thiagobelem.net')
					  ->subject('[PagSeguro] - Transaction: ' . $transactionCode)
					  ->emailFormat('text')
					  ->send($body);

			$this->log('Transaction Object: ' . serialize($Transaction), 'PagSeguro');

		}

	}
	
}