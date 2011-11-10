<?php
/**
 * Component de emails enfileirados
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Component
 */

App::uses('CakeEmail', 'Network/Email');

/**
 * Component de emails enfileirados
 */
class EmailQueueComponent extends Component {
	
	/**
	 * Configurações padrões
	 * 
	 * @var array
	 */
	public $settings = array(
		'to' => array(),
		'cc' => array(),
		'bcc' => array(),
		'from' => array(),
		'replyto' => array(),
	
		'subject' => '',
		'view' => '',
		'layout' => 'default',
		'data' => array()
	);
	
	/**
	 * Construtor
	 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings['from'] = Configure::read('Email.from');
		$this->settings['replyto'] = Configure::read('Email.from');
		$this->settings['send'] = time();
		
		parent::__construct($collection, array_merge($this->settings, $settings));
	}
	
	/**
	 * Inicializador (non-PHPdoc)
	 * @see Component::initialize()
	 */
	public function initialize($controller) {
		$this->Controller = $controller;
		$this->Controller->loadModel('Email');
	}
	
	/**
	 * Definição maǵica de atributos
	 */
	public function __set($name, $value) {
		if (isset($this->settings[$name]))
			$this->settings[$name] = $value;
		else
			$this->$name = $value;
	}
	
	/**
	 * Define uma configuração
	 * 
	 * @param string $name
	 * @param string $value
	 */
	public function set($name, $value) {
		$this->settings['data'][$name] = $value;
	}
	
	/**
	 * Renderiza a view do email
	 * 
	 * @param boolean $plain
	 * 
	 * @return string
	 */
	private function render($plain = false) {
		$view = '/Email/' . ($plain ? 'text' : 'html') . '/' . $this->settings['view'];
		$layout = 'email/' . ($plain ? 'text' : 'html') . '/' . $this->settings['layout'];
		
		$View = new View('Email');
		$View->viewVars = $this->settings['data'];
		
		return $View->render($view, $layout); 
	}
	
	/**
	 * Enfileira o email
	 */
	public function queue() {		
		$this->settings['html'] = $this->render();	
		$this->settings['plain'] = $this->render(true);
		
		$this->settings['send'] = date(DATE_ISO8601, $this->settings['send']);
		
		$this->Controller->Email->save($this->settings);
	}
	
	/**
	 * Processa a fila de emails
	 */
	public function processQueue() {
		$emails = $this->Controller->Email->unsetEmails();
		
		foreach ($emails AS $email) {	
			$email = $email['Email'];
					
			$CakeEmail = new CakeEmail('smtp');
			
			$CakeEmail->to($email['to'])
					  ->cc($email['cc'])
					  ->bcc($email['bcc'])
					  ->from($email['from'])
					  ->replyTo($email['replyto'])
					  ->subject($email['subject'])
					  ->emailFormat('html');
					  
			if ($CakeEmail->send($email['html'])) {
				$this->Controller->Email->id = $email['id'];
				$this->Controller->Email->saveField('sent', true);
			}			
		}
	}
	
	/**
	 * Enfileira e envia um email
	 * 
	 * @see EmailQueueComponent::queue()
	 * @see EmailQueueComponent::processQueue()
	 */
	public function send() {		
		$this->queue();		
		$this->processQueue();
	}
	
}