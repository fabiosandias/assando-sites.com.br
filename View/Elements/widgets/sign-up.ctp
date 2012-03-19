<?php
$classes = $this->requestAction(array('controller' => 'my_classes', 'action' => 'index'));

if (!empty($classes)) {
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

<?php } else { ?>

<div class="<?php echo $class ?> grid_5" style="background: #F5F0B9; border-radius: 6px; padding: 15px 20px; text-align: center; float: left">
	<a href="<?php echo $this->Html->url('/') ?>#novas-turmas" style="font-size: 1.2em; color: #CB001A">Inscrições encerradas!<span style="font-size: .8em; display: block; margin-top: 10px; color: #777">Quer ser avisado quando a próxima turma abrir?</span></a>
</div>

<?php } ?>