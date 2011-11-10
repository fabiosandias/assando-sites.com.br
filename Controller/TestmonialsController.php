<?php
/**
 * Controller de dpoimentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Controller
 */

/**
 * Controller de depoimentos
 */
class TestmonialsController extends AppController {	

	/**
	 * Lista de depoimentos
	 */
	public function index() {
		$data = $this->Testmonial->random();
		
		if (isset($this->request->params['requested']) && $this->request->params['requested'])
			return $data;
	}

}