<?php
/**
 * Controller de alunos
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

App::import('Sanitize');

/**
 * Controller de alunos
 */
class StudentsController extends AppController {
	
	public function admin_dashboard() {
		
	}
	
	/**
	 * Lista de alunos
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('Status', 'MyClass'),
			'conditions' => array()
		);
		
		// Manda o parâmetro pra URL
		if (!empty($this->data))
			$this->redirect($this->data['Student']);
			
		// Busca aluno por nome/email
		if (isset($this->params['named']['search'])) {
			$search = Sanitize::clean($this->params['named']['search']);
			
			$this->paginate['conditions'] += array(
				'OR' => array(
					'Student.name LIKE' => "%{$search}%",
					'Student.surname LIKE' => "%{$search}%",
					'Student.email LIKE' => "%{$search}%"			
				)
			);
		}
		
		$this->set(array(
			'title_for_layout' => 'Alunos cadastrados',
		
			'data' => $this->paginate('Student')
		));
	}
	
	/**
	 * Editar aluno
	 * 
	 * @param integer $id
	 */
	public function admin_edit($id) {
		$this->Student->id = $id;
		$this->Student->contain('Information', 'MyClass');
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->Student->saveAll($this->data)) {
				$this->Session->setFlash('Aluno atualizado com sucesso', 'admin/alerts/inline', array('class' => 'success'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}
		
		$this->data = $this->Student->read();
		
		// Registro não encontrado
		if (empty($this->data)) {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));			
		}
		
		$this->set(array(
			'title_for_layout' => 'Editando aluno',
			'subtitle_for_layout' => $this->data['Student']['fullname'],
		
			'Status' => $this->Student->Status->find('list', array('conditions' => array('Status.type' => 'Student'))),
			'MyClass' => $this->Student->MyClass->find('list', array('fields' => 'shortname')),
		));
	}
	
	/**
	 * Deletar aluno
	 * 
	 * @param integer $id
	 */
	public function admin_delete($id) {
				
		// Deleta o aluno
		if ($this->Student->delete((int)$id)) {
			$this->Session->setFlash('Aluno deletado com sucesso', 'admin/alerts/inline', array('class' => 'success'));
		} else {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));				
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
}