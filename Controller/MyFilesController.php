<?php
/**
 * Controller de arquivos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

/**
 * Controller de arquivos
 */
class MyFilesController extends AppController {
	
	/**
	 * Download de arquivo
	 */
	public function aluno_download() {
		$ids = array();
		
		$MyClasses = $this->Student->getClasses(array('contain' => array('ClassesStudent')));
		foreach ($MyClasses AS $class)
			$ids[] = $class['MyClass']['id'];
		
		$arquivo = $this->MyFile->find('first', array(
			'conditions' => array(
				'MyFile.class_id' => $ids,
				'MyFile.status_id' => STATUS_ATIVO,
				'SHA1(MyFile.location)' => $this->params['token']
			)
		));
		
		if (empty($arquivo))
			throw new NotFoundException('Arquivo não encontrado');
		
		// Redireciona o aluno pro download
		$this->redirect($arquivo['MyFile']['location'], 302);
	}
	
	/**
	 * Lista de aulas
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('MyClass')
		);
		
		$this->set(array(
			'title_for_layout' => 'Arquivos',
		
			'data' => $this->paginate('MyFile')
		));
	}

	/**
	 * Cadastro de arquivos
	 */
	public function admin_add() {
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->MyFile->saveAll($this->data)) {
				$this->Session->setFlash('Arquivo criado com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}

		$this->set(array(
			'title_for_layout' => 'Enviar novo arquivo',
		
			'MyClass' => $this->MyFile->MyClass->find('list', array('fields' => 'shortname')),
			'Status' => $this->MyFile->Status->find('list', array('conditions' => array('Status.type' => null))),
		));
		
		$this->render('admin_edit');
		
	}
	
	/**
	 * Edição de arquivo
	 */
	public function admin_edit($id) {
		$this->MyFile->id = $id;
				
		// Houve submit
		if (!empty($this->data)) {
			// Salva os dados
			if ($this->MyFile->saveAll($this->data)) {
				$this->Session->setFlash('Arquivo atualizado com sucesso', 'admin/alerts/inline', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Verifique os dados', 'admin/alerts/inline', array('class' => 'error'));				
			}
		}
		
		$this->data = $this->MyFile->read();
		
		// Registro não encontrado
		if (empty($this->data)) {
			$this->Session->setFlash('Registro não encontrado', 'admin/alerts/inline', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));			
		}

		$this->set(array(
			'title_for_layout' => 'Editar arquivo',
			'subtitle_for_layout' => $this->data['MyFile']['title'],
		
			'MyClass' => $this->MyFile->MyClass->find('list', array('fields' => 'shortname')),
			'Status' => $this->MyFile->Status->find('list', array('conditions' => array('Status.type' => null))),
		));

	}
}
