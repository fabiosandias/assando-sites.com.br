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
	
}
