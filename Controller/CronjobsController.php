<?php
/**
 * Controller de cronjobs
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
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
		
		if (getenv('REMOTE_ADDR') != '127.0.0.1') {
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
	
}
