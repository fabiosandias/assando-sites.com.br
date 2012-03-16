<?php
/**
 * Controller de cronjobs
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

App::uses('AppController', 'Controller');

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
	 * Remove usuários deletados a mais de uma semana
	 */
	public function removeDeletedStudents() {
		$this->loadModel('Student');

		$conditions = array(
			'Student.status_id' => STATUS_STUDENT_DELETADO,
			'Student.updated <=' => date('Y-m-d', strtotime('-1 week'))
		);

		$this->Student->deleteAll($conditions); exit;
	}
	
	/**
	 * Envia emails pra alunos que ainda não pagaram (após 1 semana)
	 */
	public function alertPendingStudents() {
		$this->loadModel('Student');

		// Procura alunos inscritos à uma semana
		$timestamp = strtotime('-1 week');

		// Condições de busca
		$params = array(
			'conditions' => array(
				'Student.status_id' => STATUS_STUDENT_INSCRICAO_PENDENTE,
				'DAY(Student.created)' => (int)date('j', $timestamp),
				'MONTH(Student.created)' => (int)date('n', $timestamp)
			),
			'contain' => array('MyClass', 'Payment')
		);

		$Students = $this->Student->find('all', $params);

		foreach ($Students AS $Student) {

			// Não envia pra alunos que já pagaram
			foreach ($Student['Payment'] AS $Payment) {
				if (in_array($Payment['status_id'], array(STATUS_PAYMENT_PAGO, STATUS_PAYMENT_DISPONIVEL)))
					continue 2; // pula Payment + Student
			}

			$this->__emailAlertPendingPayment($Student);
		}

		exit;
	}

	protected function __emailAlertPendingPayment($Student) {
		extract($Student);
		
		$this->EmailQueue->to = array($Student['fullname'] => $Student['email']);
		$this->EmailQueue->bcc = Configure::read('Email.from');
		
		$this->EmailQueue->subject = 'Assando Sites - Pagamento Pendente';
		
		$this->EmailQueue->view = 'pending_payment';
		$this->EmailQueue->set('Student', $Student);
		$this->EmailQueue->set('MyClass', $MyClass[0]);
		$this->EmailQueue->set('token', sha1($Student['name'] . $Student['email']));
		
		$limit = strtotime('+2 weeks', strtotime($Student['created']));
		$limit = min($limit, $MyClass[0]['signup_limit']);
		
		$this->EmailQueue->set('limit', $limit);
		
		$this->EmailQueue->queue();
	}
	
}
