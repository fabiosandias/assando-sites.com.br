<?php
/**
 * Model de newsletter
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Model
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

	
	/**
	 * Depois de cadastrar um novo inscrito
	 *
	 * 1 - Envia os dados pro MailChimp
	 */
	public function afterSave($created = false) {
		if ($created) {
			App::uses('MCAPI', 'Vendor');

			$key = Configure::read('MailChimp.key');
			$list_id = Configure::read('MailChimp.list');

			$merge_vars = array(
				'FNAME'=> $this->data[$this->alias]['name'],
				'OPTIN_IP' => getenv('REMOTE_ADDR'),
				'OPTIN_TIME' => date('Y-m-d H:i:s')
			);
			
			$api = new MCAPI($key);
			$api->listSubscribe($list_id, $this->data[$this->alias]['email'], $merge_vars, 'html', false);
		}

		return parent::afterSave($created);
	}
	
}