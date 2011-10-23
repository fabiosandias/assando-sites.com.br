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
			<form class="faixa verde grid_12">
				<h4 class="grid_5 suffix_1">Quer ser avisado sobre as promoções e novas turmas do Assando Sites?</h4>

				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="digite seu email" />

				<input type="submit" value="OK" class="botao verde" />
			</form>
		</section>

		<section class="container_12">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>