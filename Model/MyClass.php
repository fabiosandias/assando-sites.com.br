<?php
/**
 * Model de turmas
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Model
 */

/**
 * Model de turmas
 */
class MyClass extends AppModel {
	
	/**
	 * Nome da tabela
	 * 
	 * @var string
	 */
	public $useTable = 'classes';
	
	/**
	 * Campo título
	 * 
	 * @var string
	 */
	public $displayField = 'title';
	
	/**
	 * Ordem padrão
	 * 
	 * @var array
	 */
	public $order = array('MyClass.start' => 'DESC');
	
	/**
	 * Campos virtuais
	 * 
	 * @var array
	 */
	public $virtualFields = array(
		'shortname' => "CONCAT(MyClass.title, ' (', DATE_FORMAT(MyClass.start, '%d/%m'), ')')"
	);
	
	/**
	 * Turmas pertencem à...
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'Status' => array(
			'conditions' => array('Status.type' => 'Class')
		)
	);
	
	/**
	 * Turmas contém muitos...
	 * 
	 * @var array
	 */
	public $hasMany = array(
		'Lesson' => array(
			'order' => array('Lesson.datetime' => 'ASC'),
			'dependent' => true
		),
		'MyFile' => array(
			'dependent' => true,
			'order' => array('MyFile.created' => 'DESC')
		)
	);
	
	/**
	 * Turmas contém e pertencem à muitos...
	 * 
	 * @var array
	 */
	public $hasAndBelongsToMany = array('Student');
	
	/**
	 * Encontra turmas com inscrições abertas
	 * 
	 * @return array
	 */
	public function openSignup($type = 'all', $params = array()) {
		App::import('Model', 'Status');
		
		$params = array_merge(array(
			'conditions' => array(
				// Até 1 dia antes do início das aulas
				'MyClass.start >=' => date('Y-m-d', strtotime('-1 day')),
		
				// Status => Inscrições abertas
				'MyClass.status_id' => STATUS_CLASS_INSCRICOES_ABERTAS
			),
			'order' => array(
				'MyClass.start' => 'ASC'
			)
		), $params);
		
		return $this->find($type, $params);		
	}
	
	/**
	 * Adiciona o preço atual de cada turma após o find
	 * 
	 * @see Model::afterFind()
	 * 
	 * @return array
	 */
	public function afterFind($results, $primary) {
				
		foreach ($results AS &$result) {
			
			if ($primary)
				$data = &$result[$this->alias];
			else
				$data = &$result;
			
			if (!isset($data) || !isset($data['id']))
				continue;
				
			$this->id = $data['id']; 
			$data['price_discount'] = $this->calculatePrice();
			
			if (isset($data['start']))
				$data['signup_limit'] = strtotime('-1 week', strtotime($data['start']));
				
			if (empty($data['description']) && isset($data['start']) && isset($data['end']))
				$data['description'] = sprintf('Aulas de <strong>%s</strong> até <strong>%s</strong>',
					date('d/m', strtotime($data['start'])), date('d/m', strtotime($data['end'])));
		}
		
		return $results;
	}
	
	/**
	 * Calcula o preço atual de turma
	 * 
	 * @return float
	 */
	public function calculatePrice() {
		$data = $this->read(array('price', 'start'));
		$data['MyClass']['price_discount'] = $data['MyClass']['price'];
		
		$data['MyClass']['start'] = strtotime($data['MyClass']['start'] . ' 00:00:00');
		$now = time();
		
		foreach (Configure::read('Inscricao.Desconto') AS $desconto) {
			$limit = strtotime($desconto['limite'], $data['MyClass']['start']);
			
			if ($now <= $limit) {
				$data['MyClass']['price_discount'] = $data['MyClass']['price'] * ((100 - $desconto['porcentagem']) / 100);
				break;		
			}
		}		
		
		return ceil($data['MyClass']['price_discount']);
	}
	
}