<?php
/**
 * Controller de dpoimentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

App::uses('AppController', 'Controller');

/**
 * Controller de depoimentos
 */
class TestmonialsController extends AppController {	

	/**
	 * Lista de depoimentos
	 */
	public function index() {
		$testmonials = $this->Testmonial->random();

		if (isset($this->params['requested']))
			return $testmonials;
		
		$this->set('testmonials', $testmonials);
	}

}