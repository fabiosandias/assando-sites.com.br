<?php
$this->set(array(
	'body_class' => 'home',
	'title_for_layout' => false
))
?>
		<section class="container_12 vantagens">
			<?php echo $this->element('advantages') ?>			
		</section>
		
		<section class="container_12 depoimentos">
			<?php echo $this->element('testmonials') ?>			
		</section>

		<section class="container_12">
			<?php echo $this->Form->create('Newsletter', array('action' => 'signup', 'class' => 'faixa verde grid_12')) ?>
				<h4 class="grid_5 suffix_1">Quer ser avisado sobre as promoções e novas turmas do Assando Sites?</h4>

				<?php echo $this->Form->input('name', array('label' => 'Nome', 'placeholder' => 'digite seu nome', 'div' => false)) ?>
				<?php echo $this->Form->input('email', array('label' => 'Email', 'placeholder' => 'digite seu email', 'type' => 'email', 'div' => false)) ?>
				
				<?php echo $this->Form->submit('OK', array('class' => 'botao verde', 'div' => false)) ?>				
				<?php echo $this->Html->image('icons/loading-green.gif', array('alt' => 'Carregando...', 'class' => 'loading')) ?>
			<?php echo $this->Form->end() ?>
		</section>

		<section class="container_12">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>