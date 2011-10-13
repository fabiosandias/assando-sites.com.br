<?php
/**
 * Controller de turmas
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller de turmas
 */
class MyClassesController extends AppController {
	
	/**
	 * Lista de turmas
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('Status', 'Student')
		);
		
		$this->set(array(
			'title_for_layout' => 'Turmas',
		
			'data' => $this->paginate('MyClass')
		));
	}
	
	/**
	 * Cadastro de turmas
	 */
	public function admin_add() {
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->MyClass->saveAll($this->data)) {
				$this->Session->setFlash('Turma criada com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}

		$this->set(array(
			'title_for_layout' => 'Criar nova turma',
		
			'Status' => $this->MyClass->Status->find('list', array('conditions' => array('Status.type' => 'Class'))),
		));
		
		$this->render('admin_edit');
		
	}
	
}