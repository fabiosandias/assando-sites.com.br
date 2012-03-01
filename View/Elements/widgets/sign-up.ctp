<?php
$classes = $this->requestAction(array('controller' => 'my_classes', 'action' => 'index'));
$data = array_shift($classes);

$discount = false;

if ($data['MyClass']['price_discount'] < (float)$data['MyClass']['price']) {
	$discount = ceil(100 - (($data['MyClass']['price_discount'] * 100) / $data['MyClass']['price']));
}

$link = array('controller' => 'my_classes', 'action' => 'index');

?>
<div class="<?php echo $class ?>">
	<?php if ($discount) { echo $this->Html->link($this->Html->tag('strong', $discount . $this->Html->tag('span', '%')) . ' de desconto', $link, array('class' => 'desconto', 'escape' => false)); } ?>
	<?php echo $this->Html->link('Inscreva-se já!', $link, array('class' => 'botao vermelho')) ?>
	<p>Inscrições abertas até <strong><?php echo $this->Time->format('d/m', $data['MyClass']['signup_limit']) ?></strong></p>
</div>