<?php
/**
 * Model de informações
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Model
 */

/**
 * Model de informações
 */
class Information extends AppModel {
	
	/**
	 * Informações pertencem à...
	 * 
	 * @var array
	 */
	public $belongsTo = array('Student');
	
	/**
	 * Validação de dados
	 * 
	 * @var array
	 */
	public $validate = array(
		'cpf' => array(
			'format' => array(
				'rule' => '/^[\d]{3}\.[\d]{3}\.[\d]{3}\-[\d]{2}$/i',
				'message' => 'Digite um CPF válido',
				'allowEmpty' => true,	
				'required' => false
			),
		),
		'twitter' => array(
			'format' => array(
				'rule' => '/^@?[a-z0-9_]{2,}$/i',
				'message' => 'Perfil inválido',
				'allowEmpty' => true,	
				'required' => false
			),
		),
		'city' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'A cidade não pode ser vazia',	
				'required' => true
			),
		),
		'phone' => array(
			'format' => array(
				'rule' => '/^\(?0?[0-9]{2}\)?\s?[0-9]{4}-?[0-9]{4}$/i',
				'message' => 'Telefone inválido',
				'allowEmpty' => false,	
				'required' => true
			),
		),
		'state' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Digite o estado',	
				'required' => true
			),
			'estadoBrasil' => array(
				'rule' => 'estadoBrasil',
				'message' => ''
			),
		),
	);
	
	/**
	 * Antes de salvar o registro
	 * 
	 * 1 - Remove o @ do Twitter
	 * 2 - Ajusta o formato do telefone
	 * 
	 * @see Model::beforeSave()
	 */
	public function beforeSave() {
		if (isset($this->data[$this->alias]['twitter']))
			$this->data[$this->alias]['twitter'] = trim($this->data[$this->alias]['twitter'], '@');

		if (isset($this->data[$this->alias]['phone']))
			$this->data[$this->alias]['phone'] = $this->formatPhone($this->data[$this->alias]['phone']);

		return parent::beforeSave();
	}
}