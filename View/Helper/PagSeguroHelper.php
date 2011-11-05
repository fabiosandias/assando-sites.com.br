<?php
/**
 * PagSeguro Helper
 * 
 * @author			Thiago Belem <contato@thiagobelem.net>
 * @link			http://twitter.github.com/bootstrap/
 * 
 * @package		AssandoSites
 * @subpackage		Helper
 */
#App::uses('AppHelper', 'View/Helper');

/**
 * PagSeguro Helper
 */
class PagSeguroHelper extends AppHelper {
	
	/**
	 * Helpers utilizados
	 * 
	 * @var array
	 */
	public $helpers = array('Html', 'Form');
	
	public function checkoutButton($data = array()) {
		$data = array_merge(array(
			'email' => Configure::read('PagSeguro.email'),
			
			'moeda' => 'BRL',
			'encoding' => 'UTF-8',
		
			'desconto' => 0,
			'reference' => uniqid()
		), $data);
		
		$content = $this->Form->create(null, array('url' => 'https://pagseguro.uol.com.br/v2/checkout/payment.html', 'class' => 'pagseguro', 'target' => 'pagseguro'));
		
		// Dados gerais
		$content .= $this->Form->hidden('receiverEmail', array('name' => 'receiverEmail', 'value' => $data['email'])) . PHP_EOL;
		$content .= $this->Form->hidden('currency', array('name' => 'currency', 'value' => $data['moeda'])) . PHP_EOL;
		$content .= $this->Form->hidden('encoding', array('name' => 'encoding', 'value' => $data['encoding'])) . PHP_EOL;
		$content .= $this->Form->hidden('reference', array('name' => 'reference', 'value' => $data['reference'])) . PHP_EOL;
		
		// Produtos
		$i = 1;
		foreach ($data['produtos'] AS $produto) {
			$content .= $this->Form->hidden('itemId' . $i, array('name' => 'itemId' . $i, 'value' => $produto['id'])) . PHP_EOL;
			$content .= $this->Form->hidden('itemDescription' . $i, array('name' => 'itemDescription' . $i, 'value' => $produto['descricao'])) . PHP_EOL;
			$content .= $this->Form->hidden('itemQuantity' . $i, array('name' => 'itemQuantity' . $i, 'value' => (int)$produto['quantidade'])) . PHP_EOL;
			$content .= $this->Form->hidden('itemAmount' . $i, array('name' => 'itemAmount' . $i, 'value' => sprintf('%.2f', (float)$produto['valor']))) . PHP_EOL;
			
			$i++;
		}
		
		// Desconto
		$content .= $this->Form->hidden('extraAmount', array('name' => 'extraAmount', 'value' => sprintf('-%.2f', (float)$data['desconto']))) . PHP_EOL;
				
		// Cliente
		if (isset($data['cliente']) && !empty($data['cliente'])) {
			$content .= $this->Form->hidden('senderName', array('name' => 'senderName', 'value' => $data['cliente']['nome'])) . PHP_EOL;
			$content .= $this->Form->hidden('senderEmail', array('name' => 'senderEmail', 'value' => $data['cliente']['email'])) . PHP_EOL;
		}
		
		// Submit
		$content .= $this->Form->submit('https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/205x30-pagar.gif', array('div' => false, 'class' => 'submit')) . PHP_EOL;
		
		$content .- $this->Form->end();
		
		return $content;
	}
	
}