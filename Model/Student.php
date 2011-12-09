<?php
/**
 * Model de alunos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Model
 */

App::uses('AuthComponent', 'Controller/Component');

/**
 * Model de alunos
 */
class Student extends AppModel {
	
	/**
	 * Campo título
	 * 
	 * @var string
	 */
	public $displayField = 'name';
	
	/**
	 * Ordem padrão
	 * 
	 * @var array
	 */
	public $order = array('Student.name' => 'ASC');
	
	/**
	 * Campos virtuais
	 * 
	 * @var array
	 */
	public $virtualFields = array(
		'fullname' => "CONCAT(Student.name, ' ', Student.surname)"
	);
	
	/**
	 * Alunos contém um...
	 * 
	 * @var array
	 */
	public $hasOne = array(
		'Information' => array(
			'dependent' => true
		)
	);
	
	/**
	 * Alunos pertencem à...
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'Status' => array(
			'conditions' => array('Status.type' => 'Student')
		)
	);
	
	/**
	 * Alunos contém muitos...
	 * 
	 * @var array
	 */
	public $hasMany = array('Payment');
	
	/**
	 * Alunos contém e pertencem à muitos...
	 * 
	 * @var array
	 */
	public $hasAndBelongsToMany = array('MyClass', 'Lesson');
	
	/**
	 * Validação de dados
	 * 
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório',	
				'required' => true
			),
		),
		'surname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório',	
				'required' => true
			),
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório',	
				'required' => true
			),
			'email' => array(
				'rule' => array('email', true),
				'message' => 'O email precisa ser válido'
			),
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'O email digitado é muito pequeno'
			),	
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Este email já está cadastrado',	
				'on' => 'create'
			),	
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório',	
				'required' => true,
				'on' => 'create'
			),	
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Digite uma senha com mais de 5 caracteres'
			),
		),
		'password_verify' => array(
			'equalToField' => array(
				'rule' => array('equalToField', 'password'),
				'message' => 'As senhas não conferem',	
				'required' => true,
				'on' => 'create'
			),
		),
	);
	
	/**
	 * Antes de salvar o registro
	 * 
	 * 1 - Encripta a senha
	 * 
	 * @see Model::beforeSave()
	 */
	public function beforeSave() {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		return parent::beforeSave();
	}
	
	/**
	 * Depois de salvar o registro
	 * 
	 * @see Model::afterSave()
	 */
	public function afterSave($created) {
		$this->syncHighRise($created);

		return parent::afterSave($created);
	}
	
	/**
	 * Busca as turmas de um aluno
	 * 
	 * @return array
	 */
	public function getClasses($params = array()) {
		$this->id = AuthComponent::user('id');
		
		// Bind on the fly (HABTM)
		$this->MyClass->bindModel(array('hasOne' => array('ClassesStudent')));
		
		// Parâmetros de busca
		$params = array_merge(array(
			'conditions' => array(
				'ClassesStudent.student_id' => $this->id,
				'MyClass.status_id !=' => STATUS_CLASS_PENDENTE,
				#'MyClass.status_id' => array(STATUS_CLASS_INSCRICOES_FECHADAS, STATUS_CLASS_ENCERRADA)
			),
			'order' => array('MyClass.start' => 'DESC'),
			'contain' => array('ClassesStudent', 'Lesson')
		), $params);
		
		return $this->MyClass->find('all', $params);
	}

	protected function syncHighrise($created) {
		App::import('Vendor', 'HighriseAPI', array('file' => 'Highrise' . DS . 'lib' . DS . 'HighriseAPI.class.php'));

		$Highrise = new HighriseAPI();
		$Highrise->setAccount(Configure::read('Highrise.account'));
		$Highrise->setToken(Configure::read('Highrise.token'));

		$this->contain('Information', 'MyClass');
		$Student = $this->read();

		$Person = new HighrisePerson($Highrise);

		// Se já existe no banco de dados
		if (!empty($Student['Information']['highrise_person_id']))
			$Person->setId($Student['Information']['highrise_person_id']);
		else if ($HighrisePerson = $Highrise->findPeopleByEmail($Student['Student']['email']))
			$Person->setId($HighrisePerson[0]->getId());
		
		// Define o nome do aluno
		$Person->setFirstName($Student['Student']['name']);
		$Person->setLastName($Student['Student']['surname']);

		// Adiciona o email para novos alunos
		if ($created || !$Person->getId())
			$Person->addEmailAddress($Student['Student']['email']);

		// Salva o Highrise Person ID do aluno
		if ($Person->save()) {
			$this->Information->updateAll(
				array('Information.highrise_person_id' => $Person->getId()),
				array('Information.student_id' => $this->id));

			// Adiciona uma nota pra novos alunos
			if ($created) {
				$Note = new HighriseNote($Highrise);
				$Note->setBody('Se inscreveu na turma ' . $Student['MyClass'][0]['code']);
				$Note->setSubjectType('Party');
				$Note->setSubjectId($Person->getId());
				$Note->save();
			}
		}
	}
	
}