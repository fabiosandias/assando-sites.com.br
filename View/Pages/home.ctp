<?php
$this->set(array(
	'body_class' => 'home',
	'title_for_layout' => false
))
?>
		<section class="container_12 vantagens">
			<h2 class="grid_12">Veja as vantagens do curso</h2>

			<?php echo $this->element('advantages') ?>
			
		</section>

		<section class="container_12">
			<form class="faixa verde grid_12">
				<h4 class="grid_5 suffix_1">Saiba sobre promoções e novas turmas para o curso de CakePHP</h4>

				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="digite seu email" />

				<input type="submit" value="OK" class="botao verde" />
			</form>
		</section>

		<section class="container_12">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>