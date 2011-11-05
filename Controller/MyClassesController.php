<?php
/**
 * Controller de turmas
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller de turmas
 */
class MyClassesController extends AppController {
	
	/**
	 * Lista de turmas pro aluno se inscrever
	 */
	public function index() {
		$data = $this->MyClass->openSignup();
		
		if (isset($this->request->params['requested']) && $this->request->params['requested'])
			return $data;
		
		$this->set(array(
			'title_for_layout' => 'Inscrição: seleção de turma',
			'body_class' => 'page inscricao turmas',
		
			'data' => $data,
			'ids' => $this->MyClass->openSignup('list')
		));
	}
	
	/**
	 * Lista de turmas
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array(
				'Status',
				'Student' => array(
					'fields' => array('Student.id'),
					'conditions' => array('Student.class_id' => STATUS_STUDENT_INSCRICAO_CONFIRMADA)
				)
			)
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
	
	/**
	 * Editar turma
	 * 
	 * @param integer $id
	 */
	public function admin_edit($id) {
		$this->MyClass->id = $id;
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->MyClass->saveAll($this->data)) {
				$this->Session->setFlash('Turma atualizada com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}
		
		$this->data = $this->MyClass->read();
		
		// Registro não encontrado
		if (empty($this->data)) {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));			
		}
		
		$this->set(array(
			'title_for_layout' => 'Editando turma',
			'subtitle_for_layout' => $this->data['MyClass']['shortname'],
		
			'Status' => $this->MyClass->Status->find('list', array('conditions' => array('Status.type' => 'Class'))),
		));		
	}
	
	/**
	 * Deletar turma
	 * 
	 * @param integer $id
	 */
	public function admin_delete($id) {
				
		// Deleta o aluno
		if ($this->MyClass->delete((int)$id)) {
			$this->Session->setFlash('Turma deletada com sucesso', 'admin/alerts/inline', array('class' => 'success'));
		} else {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));				
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
}
