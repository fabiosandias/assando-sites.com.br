<?php
$this->set(array(
	'body_class' => 'page sobre',
	'title_for_layout' => 'Sobre o curso avançado'
))
?>
		<section class="conteudo grid_9">
			<h2>Objetivos do curso avançado</h2>
			<p>Ensinar os detalhes e recursos que vão tornar o seu trabalho mais <strong>avançado</strong> e <strong>profissional</strong>:</p>
			
			<div class="atencao">Este é o conteúdo do <strong>Curso Avançado</strong> de CakePHP!<br />Se você está aprendendo o CakePHP, veja <?php echo $this->Html->link('conteúdo do curso', array('controller' => 'pages', 'action' => 'display', 'about', 'aluno' => false)) ?> para iniciantes</div>

			<h4>1. Em breve</h4>
			<ul>
				<li>Em breve</li>
				<li>Em breve</li>
				<li>Em breve</li>
			</ul>
			
			<h4>2. Em breve</h4>
			<ul>
				<li>Em breve</li>
				<li>Em breve</li>
				<li>Em breve</li>
			</ul>
	
			<p>Gostou? Então <?php echo $this->Html->link('inscreva-se', array('controller' => 'my_classes', 'action' => 'index')) ?> na próxima turma!</p>
		
		</section>

		<section class="grid_3 sidebar vantagens">

			<?php echo $this->element('advantages') ?>
			
		</section>
	
		<section class="widgets">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>