<?php
/**
 * Controller da aplicação
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller da aplicação
 */
class AppController extends Controller {
	
	/**
	 * Components da aplicação
	 * 
	 * @var array
	 */
	public $components = array('Session', 'RequestHandler'/*, 'Security'*/);
	
	/**
	 * Helpers da aplicação
	 * 
	 * @var array
	 */
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text', 'Number', 'Bootstrap');
	
	/**
	 * Antes de filtrar as actions da aplicação
	 * 
	 * Troca o layout do admin 
	 */
	public function beforeFilter() {
		parent::beforeFilter();
						
		// Troca o layout das telas de admin
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			$this->layout = 'admin';
		}
	}
	
	/**
	 * Antes de renderizar as actions da aplicação
	 */
	public function beforeRender() {
		parent::beforeRender();
		
		$this->set('isPainelAdmin', isset($this->params['prefix']) && $this->params['prefix'] == 'admin');
		$this->set('isPainelAluno', isset($this->params['prefix']) && $this->params['prefix'] == 'aluno');
	}
	
}
