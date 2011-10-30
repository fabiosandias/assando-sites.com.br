<?php
/**
 * Model de newsletter
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Model
 */

/**
 * Model de newsletter
 */
class Newsletter extends AppModel {
	
	/**
	 * Campo título
	 * 
	 * @var string
	 */
	public $displayField = 'email';
	
	/**
	 * Nome da tabela
	 * 
	 * @var string
	 */
	public $useTable = 'newsletter';
	
	/**
	 * Ordem padrão
	 * 
	 * @var array
	 */
	public $order = array('Newsletter.created' => 'DESC');
	
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
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Este email já está cadastrado',	
				'on' => 'create'
			),	
		)
	);
	
}