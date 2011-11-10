<?php
/**
 * Controller de newsletter
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

/**
 * Controller de newsletter
 */
class NewslettersController extends AppController {
	
	/**
	 * Antes de filtrar (non-PHPdoc)
	 * 
	 * @see AppController::beforeFilter()
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Security->requirePost('signup');
	}
	
	/**
	 * Cadastro na newsletter
	 */
	public function signup() {		
		$this->Newsletter->create();		
		if ($this->Newsletter->save($this->data)) {
			$message = 'Inscrição efetuada com sucesso';
			$errors = false;
		} else {
			$message = 'Verifique os dados inseridos';
			$errors =  array_keys($this->Newsletter->invalidFields());
		}
		
		if ($this->request->is('ajax')) {
			$response = array('message' => $message, 'errors' => $errors);
			echo json_encode($response); exit;
		} else {
			$this->flash($message, $this->referer());
		}
	}
	
}	