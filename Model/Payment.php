<?php
/**
 * Model de pagamentos
 * 
 * @author		Thiago Belem <contato@thiagobelem.net>
 * 
 * @package		AssandoSites
 * @subpackage	Model
 */

/**
 * Model de pagamentos
 */
class Payment extends AppModel {
	
	/**
	 * Campo título
	 * 
	 * @var string
	 */
	public $displayField = 'code';
	
	/**
	 * Ordem padrão
	 * 
	 * @var array
	 */
	public $order = array('Payment.updated' => 'DESC');
	
	/**
	 * Pagamentos pertencem à...
	 * 
	 * @var array
	 */
	public $belongsTo = array(
		'Student',
		'Status' => array(
			'conditions' => array('Status.type' => 'Payment')
		),
		'PaymentMethod',
		'PaymentGateway'
	);
	
}