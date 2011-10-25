<?php
/**
 * Model de alunos
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Model
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
	
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'O nome não pode ser vazio',	
				'required' => true
			),
		),
		'surname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'O sobrenome não pode ser vazio',	
				'required' => true
			),
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'O email precisa ser válido',	
				'required' => true
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
				'message' => 'Digite uma senha',	
				'required' => true,
				'on' => 'create'
			),	
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'Digite uma senha com mais de 5 caracteres'
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
		
		return true;
	}
	
}