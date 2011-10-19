<?php
/**
 * Bootstrap Helper (Twitter)
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * @link			http://twitter.github.com/bootstrap/
 * 
 * @package		AssandoSites
 * @subpackage		Helper
 */
App::uses('AppHelper', 'View/Helper');

/**
 * Bootstrap Helper
 */
class BootstrapHelper extends AppHelper {
	
	/**
	 * Helpers utilizados
	 * 
	 * @var array
	 */
	public $helpers = array('Html');
	
	/**
	 * Salva os itens do breadcrumbs
	 * @var unknown_type
	 */
	protected $_breadcrumbs = array();
	
	public function addCrumb($title, $link = null) {
		$this->_breadcrumbs[] = array('title' => $title, 'link' => $link);		
	}
	
	public function getCrumbs($separator = '/', $title = 'Home', $link = '/') {
		array_unshift($this->_breadcrumbs, array('title' => $title, 'link' => $link));
		
		$output = '';
		
		$last = end($this->_breadcrumbs);		
		$separator = $this->Html->tag('span', $separator, array('class' => 'divider'));
		
		foreach ($this->_breadcrumbs AS $crumb) {
			extract($crumb);
			
			if (!empty($link))
				$title = $this->Html->link($title, $link);
				
			if ($crumb == $last)
				$separator = '';
				
			$output .= $this->Html->tag('li', $title . $separator, array(
				'class' => ($crumb == $last) ? 'active' : '',
				'escape' => false
			));
		}
		
		echo $this->Html->tag('ul', $output, array('class' => 'breadcrumb', 'escape' => false));
	}
	
}