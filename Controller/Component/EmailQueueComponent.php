<?php
/**
 * Component de emails enfileirados
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage		Component
 */

App::uses('CakeEmail', 'Network/Email');

/**
 * Component de emails enfileirados
 */
class EmailQueueComponent extends Component {
	
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
	
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings['from'] = Configure::read('Email.from');
		$this->settings['replyto'] = Configure::read('Email.from');
		$this->settings['send'] = time();
		
		parent::__construct($collection, array_merge($this->settings, $settings));
	}
	
	public function initialize($controller) {
		$this->Controller = $controller;
		$this->Controller->loadModel('Email');
	}
	
	public function __set($name, $value) {
		if (isset($this->settings[$name]))
			$this->settings[$name] = $value;
		else
			$this->$name = $value;
	}
	
	public function set($name, $value) {
		$this->settings['data'][$name] = $value;
	}
	
	private function render($plain = false) {
		$view = '/Email/' . ($plain ? 'text' : 'html') . '/' . $this->settings['view'];
		$layout = 'email/' . ($plain ? 'text' : 'html') . '/' . $this->settings['layout'];
		
		$View = new View('Email');
		$View->viewVars = $this->settings['data'];
		
		return $View->render($view, $layout); 
	}
	
	public function queue() {		
		$this->settings['html'] = $this->render();	
		$this->settings['plain'] = $this->render(true);
		
		$this->settings['send'] = date(DATE_ISO8601, $this->settings['send']);
		
		$this->Controller->Email->save($this->settings);
	}
	
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
	
}