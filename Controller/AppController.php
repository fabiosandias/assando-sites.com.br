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
	public $components = array('Session', 'RequestHandler', 'Auth', 'Security');
	
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
						
		$this->Auth->authError = 'Área restrita';
		$this->Auth->authorize = array('Controller');		
		$this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display', 'home', 'aluno' => false, 'admin' => false);
			
		$this->Auth->flash = array_merge($this->Auth->flash, array(
			'element' => 'admin/alerts/inline',
			'params' => array('class' => 'error')
		));
			
		// Painel de Controle
		if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			$this->layout = 'admin';
			
			// Configuração do AuthComponent
			$this->Auth->sessionKey = 'Auth.Admin';
			$this->Auth->authenticate = array('Form' => array(
				'fields' => array('username' => 'email'),
				'scope' => array('User.status_id' => STATUS_ATIVO)
			));

						
		// Painel do Aluno
		} elseif (isset($this->params['prefix']) && $this->params['prefix'] == 'aluno') {
			
			// Configuração do AuthComponent
			$this->Auth->loginAction = array('controller' => 'students', 'action' => 'login', 'aluno' => true);
			$this->Auth->sessionKey = 'Auth.Student';
			$this->Auth->authenticate = array('Form' => array(
				'userModel' => 'Student',
				'fields' => array('username' => 'email'),
				'scope' => array('Student.status_id' => STATUS_STUDENT_INSCRICAO_CONFIRMADA)
			));

		// Site externo (fora dos painéis de controle)
		} else {
			$this->Auth->allow('*');
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
	
	/**
	 * Define se um usuário pode acessar uma página
	 * 
	 * @param array $user
	 */
	function isAuthorized($user) {
		return $this->Session->check($this->Auth->sessionKey);
    }
	
}
