<?php
/**
 * Controller de aulas
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller de aulas
 */
class LessonsController extends AppController {
	
	/**
	 * Lista de aulas
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('MyClass')
		);
		
		$this->set(array(
			'title_for_layout' => 'Aulas',
		
			'data' => $this->paginate('Lesson')
		));
	}
	
	/**
	 * Cadastro de aula
	 */
	public function admin_add() {
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->Lesson->saveAll($this->data)) {
				$this->Session->setFlash('Aula criada com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}

		$this->set(array(
			'title_for_layout' => 'Criar nova aula',
		
			'MyClass' => $this->Lesson->MyClass->find('list'),
		));
		
		$this->render('admin_edit');

	}
	
	/**
	 * Cadastro de aula
	 */
	public function admin_edit($id) {
		$this->Lesson->id = $id;
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->Lesson->saveAll($this->data)) {
				$this->Session->setFlash('Aula atualizada com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}
		
		$this->data = $this->Lesson->read();
		
		// Registro não encontrado
		if (empty($this->data)) {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));			
		}

		$this->set(array(
			'title_for_layout' => 'Editar aula',
			'subtitle_for_layout' => $this->data['Lesson']['title'],
		
			'MyClass' => $this->Lesson->MyClass->find('list'),
		));
		
		$this->render('admin_edit');

	}
	
}