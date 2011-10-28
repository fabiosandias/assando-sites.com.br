<?php
$classes = $this->requestAction(array('controller' => 'my_classes', 'action' => 'index'));
$data = array_pop($classes);
?>
<div class="<?php echo $class ?>">
	<?php echo $this->Html->link('Inscreva-se já!', array('controller' => 'my_classes', 'action' => 'index'), array('class' => 'botao vermelho animated bounceIn')) ?>
	<p>Inscrições abertas até <strong><?php echo $this->Time->format('d/m', $data['MyClass']['signup_limit']) ?></strong></p>
</div>