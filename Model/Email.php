<?php
/**
 * Model de emails
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Model
 */

/**
 * Model de emails
 */
class Email extends AppModel {
	
	/**
	 * Retorna os emails que ainda não foram enviados
	 * 
	 * @return array
	 */
	public function unsetEmails() {
		return $this->find('all', array(
			'conditions' => array(
				'Email.send <=' => date(DATE_ISO8601), 
				'Email.sent' => false,
			),			
			'order' => array('Email.send' =>  'ASC'),			
			'limit' => 25
		));
	}
	
	/**
	 * Antes de salvar o registro
	 * 
	 * 1 - Converte arrays para serialize
	 * 
	 * @see Model::beforeSave()
	 */
	public function beforeSave() {
		foreach ($this->data[$this->alias] AS $field => $value) {
			if (is_array($value))
				$this->data[$this->alias][$field] = serialize($value);
		}
		
		return true;
	}
	
	/**
	 * Após encontrar um registro
	 * 
	 * 1 - Converte serialize para array
	 * 
	 * @see Model::afterFind()
	 */
	public function afterFind($data) {
		
		foreach ($data as &$row) {
			foreach ($row[$this->alias] AS $field => $value) {
				if (in_array($field, array('to', 'cc', 'bcc', 'from', 'replyto')))
					$row[$this->alias][$field] = array_flip(unserialize($value));
			}
		}
		
		return $data;
	}
	
}