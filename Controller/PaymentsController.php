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
		$AccountCredentials = new PagSeguroAccountCredentials(Configure::read('PagSeguro.API.email'), Configure::read('PagSeguro.API.token'));

		# $this->log('POST: ' . serialize($_POST), 'PagSeguro');
		# $this->log('Data: ' . serialize($this->request->data), 'PagSeguro');

		$transactionType = $this->request->data['notificationType'];
		$transactionCode = $this->request->data['notificationCode']; 

		if ($transactionType === 'transaction') {  

			$Transaction = PagSeguroNotificationService::checkTransaction(  
				$AccountCredentials,  
				$transactionCode
			);
			
			if (empty($Transaction)) {
				$this->log('Transação não encontrada: ' . $transactionCode, 'PagSeguro');
				exit;
			} else {
				$this->log('Atualizando status da transação: ' . $transactionCode, 'PagSeguro');				
			}

			$reference = $Transaction->getReference();
			
			// Se não tem referência, pula
			if (empty($reference))
				exit;
			
			// Encontra o aluno
			$Student = $this->Payment->Student->field('id', array('SHA1(Student.email)' => $reference));
			
			// Se não tem aluno, pula
			if (empty($Student))
				exit;
			
			// Enconta o pagamento pelo código e pelo ID do aluno (que corresponde ao reference)
			$Payment = $this->Payment->find('first', array(
				'fields' => array('id', 'updated', 'status_id'),
				'conditions' => array(
					'code' => $Transaction->getCode(),
					'student_id' => $Student
				)
			));
			
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
			if ($this->Payment->save($data)) {

				$newPayment = (bool)empty($Payment);
				$oldStatus = !empty($Payment) ? (int)$Payment['Payment']['status_id'] : false;
				$newStatus = (int)$data['status_id'];

				// Se o status foi alterado pra PAGO
				if (($newStatus == STATUS_PAYMENT_PAGO) && ($newPayment || ($oldStatus != $newStatus))) {
					// Atualiza o status do aluno
					$this->Payment->Student->id = (int)$Student;
					if ($this->Payment->Student->saveField('status_id', STATUS_STUDENT_INSCRICAO_CONFIRMADA)) {
						// Envia o email de confirmação
						$this->__confirmPayment($this->Payment->id);
					}
				}
			}

		}

	}
	
	/**
	 * Confirma o pagamento de um aluno
	 */
	protected function __confirmPayment($payment_id) {
		$this->log('Confirmando pagamento #' . $payment_id, 'payments');

		// Encontra os dados do pagamento, do aluno e das turmas
		$PaymentObject = $this->Payment->find('first', array(
			'conditions' => array('Payment.id' => $payment_id),
			'contain' => array(
				'PaymentGateway',
				'Student' => array('MyClass')
			)
		));

		extract($PaymentObject);

		if (empty($Payment) OR empty($Student['id'])) {
			$this->log('Pagamento #' . $payment_id . ' não encontrado', 'payments');
			exit;
		}
		
		$Payment['PaymentGateway'] = $PaymentGateway;
		
		$this->EmailQueue->to = array($Student['fullname'] => $Student['email']);
		$this->EmailQueue->bcc = Configure::read('Email.from');
		
		$this->EmailQueue->subject = 'Assando Sites - Sua vaga está garantida!';
		
		$this->EmailQueue->view = 'payment_confirmation';
		$this->EmailQueue->set('Student', $Student);
		$this->EmailQueue->set('Payment', $Payment);
		
		$this->EmailQueue->queue(); exit;
	}
	
}