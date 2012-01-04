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

			<h4>1. ACL &ndash; <em>Access Control List</em></h4>
			<ul>
				<li>Conceito de <strong>ACO</strong>s</li>
				<li>Conceito de <strong>ARO</strong>s</li>
				<li>Configurando o ACL</li>
				<li>Definindo os <strong>grupos de acesso</strong> (administradores, usuários e etc.)</li>
				<li>Protegendo a sua aplicação com <strong>AuthComponent</strong> &plus; <strong>ACL</strong></li>
			</ul>
			
			<h4>2. Plugins</h4>
			<ul>
				<li>Conceito de Plugins</li>
				<li>Exemplos de Plugins (<em>Cake pt-BR</em> e <em>Migrations</em>)</li>
				<li>Instalando Plugins</li>
			</ul>
			
			<h4>3. Components</h4>
			<ul>
				<li>Conceito de <span lang="en" title="Componentes">Components</span></li>
				<li>Exemplos de <span lang="en" title="Componentes">Components</span> (<em>Security</em>, <em>Request Handling</em> e <em>Pagination</em>)</li>
				<li>Criando <span lang="en" title="Componentes">Components</span></li>
			</ul>
			
			<h4>4. Behaviors</h4>
			<ul>
				<li>Conceito de <span lang="en" title="Comportamentos">Behaviors</span></li>
				<li>Exemplos de <span lang="en" title="Comportamentos">Behaviors</span> (<em>Sluggable</em> e <em>Containable</em>)</li>
				<li>Criando <span lang="en" title="Comportamentos">Behaviors</span></li>
				<li>AutoUpload <span lang="en" title="Comportamentos">Behavior</span></li>
			</ul>
			
			<h4>5. Otimização</h4>
			<ul>
				<li>Configuração do Cache (<em>FileSystem</em> e <em>Memcached</em>)</li>
				<li>Compressão de CSS</li>
				<li>Compressão de Javascript</li>
				<li>Plugin <em>Asset Compress</em></li>
			</ul>
			
			<h4>6. Deploy automatizado</h4>
			<ul>
				<li>Integração via SSH</li>
				<li>Git Hooks</li>
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

		<script>mpq.track("Sobre o curso avançado");</script>