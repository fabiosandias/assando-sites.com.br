<?php
/**
 * Controller de alunos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Controller
 */

App::import('Sanitize');

/**
 * Controller de alunos
 */
class StudentsController extends AppController {
	
	public $components = array('EmailQueue');
	
	/**
	 * Inscrição de aluno
	 */
	public function signup() {		
		// Veio da selação de turma
		if (isset($this->data['MyClass']['id'])) {
			$this->Session->write('Student.MyClass.id', (int)$this->data['MyClass']['id']);
			
		// Salva os dados do aluno
		} else if (isset($this->data['Student'])) {
			
			// Inclui a classe e status padrão
			$this->request->data['MyClass'] = array('id' => (int)$this->Session->read('Student.MyClass.id'));
			$this->request->data['Student']['status_id'] = STATUS_STUDENT_INSCRICAO_PENDENTE;
			
			$this->Student->create();
			if ($this->Student->saveAll($this->data)) {
				// Envia o email e redireciona pra tela de pagamento
				$this->__emailSignup($this->Student->id);
				
				// Redireciona o aluno pra tela de pagamento
				$token = sha1($this->data['Student']['name'] . $this->data['Student']['email']);
				$this->redirect(array('action' => 'payment', 'token' => $token));
			}
		}
			
		$this->set(array(
			'title_for_layout' => 'Inscrição: cadastro de aluno',
			'body_class' => 'page inscricao aluno',
		
			'MyClass' => $this->Student->MyClass->findById($this->Session->read('Student.MyClass.id'))
		));
	}
	
	/**
	 * Confirmação de cadastro e botão de pagamento
	 */
	public function payment() {
		
		// Adiciona o helper
		$this->helpers[] = 'PagSeguro';
		
		// Dados do aluno e turma
		$Student = $this->Student->find('first', array(
			'conditions' => array(
				'SHA1(CONCAT(Student.name, Student.email))' => $this->params['token']
			),
			'contain' => array('MyClass')
		));
		$MyClass = array_pop($Student['MyClass']);
			
		$this->set(array(
			'title_for_layout' => 'Inscrição: pagamento',
			'body_class' => 'page inscricao pagamento',
		
			'Student' => $Student,
			'MyClass' => $MyClass
		));

	}
	
	/**
	 * Dashboard do painel do aluno
	 */
	public function aluno_dashboard() {
		$MyClasses = $this->Student->getClasses();
					
		$this->set(array(
			'title_for_layout' => 'Painel do Aluno',
			'body_class' => 'painel-aluno dashboard',
		
			'MyClasses' => $MyClasses
		));
	}
	
	/**
	 * Dashboard do painel de controle
	 */
	public function admin_dashboard() {
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Lista de alunos
	 */
	public function admin_index() {
		$this->paginate = array(
			'contain' => array('Status', 'MyClass'),
			'conditions' => array(),
			'order' => array('Student.created' => 'DESC')
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
	
	public function __emailSignup($student_id) {
		
		$Student = $this->Student->find('first', array(
			'conditions' => array('Student.id' => (int)$student_id),
			'contain' => array('MyClass')
		));
		extract($Student);
		
		$this->EmailQueue->to = array($Student['fullname'] => $Student['email']);
		$this->EmailQueue->bcc = Configure::read('Email.from');
		
		$this->EmailQueue->subject = 'Assando Sites - Confirmação de Inscrição';
		
		$this->EmailQueue->view = 'signup';
		$this->EmailQueue->set('Student', $Student);
		$this->EmailQueue->set('MyClass', $MyClass[0]);
		$this->EmailQueue->set('token', sha1($Student['name'] . $Student['email']));
		
		$this->EmailQueue->queue();
	}
	
}
