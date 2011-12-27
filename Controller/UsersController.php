<?php
/**
 * Controller de usuários (admins)
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

App::uses('AppController', 'Controller');

/**
 * Controller de usuários (admins)
 */
class UsersController extends AppController {
	
	/**
	 * Login de usuários (admins)
	 */
	public function admin_login() {
		$this->layout = 'login';
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->write($this->Auth->sessionKey, $this->Auth->user());
				
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Dados incorretos', 'admin/alerts/inline', array('class' => 'error'), 'auth');
	        }
	    }
		
		$this->set(array(
			'title_for_layout' => 'Painel de Controle'
		));
	}
	
	/**
	 * Logout de usuários (admin)
	 */
	public function admin_logout() {
		$this->Session->delete($this->Auth->sessionKey);
		
		$this->redirect($this->Auth->logout());
	}
	
}