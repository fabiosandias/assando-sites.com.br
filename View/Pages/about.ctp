<?php
$this->set(array(
	'body_class' => 'page sobre',
	'title_for_layout' => 'Sobre o curso'
))
?>
		<section class="conteudo grid_9">
			<h2>Objetivos do curso</h2>
			<p>Ensinar tudo que você precisa para criar um site de forma <strong>rápida</strong> e <strong>segura</strong>:</p>
			
			<h4>1. Introdução e conceitos gerais</h4>
			<ul>
				<li>História do PHP</li>
				<li>O que são <em>Frameworks</em></li>
				<li>Por que usar <em>Frameworks</em></li>
				<li>O que é o <strong>MVC</strong> (Model - View - Controller)</li>
			</ul>
	
			<h4>2. Instalação e configuração</h4>
			<ul>
				<li>Download e instalação do ambiente de desenvolvimento</li>
				<li>Download e instalação do <strong>CakePHP</strong></li>
				<li>Estrutura de pastas</li>
				<li>Configuração inicial do <strong>CakePHP</strong></li>
				<li>Conexão ao banco de dados</li>
				<li>Configurações de segurança</li>
			</ul>
	
			<h4>3. Páginas estáticas e rotas</h4>
			<ul>
				<li>Criação de páginas estáticas</li>
				<li>Conceito de URLs amigáveis</li>
				<li>Criação de URLs amigáveis customizadas</li>
			</ul>
	
			<h4>4. Models</h4>
			<ul>
				<li>Conceito de <em>models</em> (camada M)</li>
				<li>Convenção de nomeclatura dos <em>models</em> e tabelas</li>
				<li>Criando e configurando <em>models</em></li>
				<li><em>Datasources</em> (Twitter, Facebook e etc.)</li>
				<li><em>Behaviors</em></li>
				<li>Validação de dados</li>
			</ul>
	
			<h4>5. Controllers</h4>
			<ul>
				<li>Conceito de <em>controllers</em> (camada C)</li>
				<li>Convenção de nomeclatura dos <em>controllers</em></li>
				<li>Criando e configurando <em>controllers</em></li>
				<li><em>Components</em> (Session, Email, Cookies e etc.)</li>
			</ul>
	
			<h4>6. Views</h4>
			<ul>
				<li>Conceito de <em>views</em> (camada V)</li>
				<li>Convenção de nomeclatura das <em>views</em></li>
				<li>Criando e carregando <em>views</em></li>
				<li>Criando e utilizando <em>Layouts</em> e <em>Elements</em></li>
				<li><em>Helpers</em> (HTML, Form e etc.)</li>
			</ul>
	
			<h4>7. Painel de controle</h4>
			<ul>
				<li>Criando um painel de controle seguro</li>
				<li>Controle de acesso</li>
			</ul>
	
	
			<h4>8. Publicação e versionamento</h4>
			<ul>
				<li>Publicação via <strong>FTP</strong></li>
				<li>Versionamento de arquivos utilizndo <strong>Git</strong></li>
				<li>Deploy automatizado utiliznado <strong>Git Hooks</strong></li>
			</ul>
	
			<p>Gostou? Então <a href="/inscreva-se">inscreva-se</a> na próxima turma!</p>
		
		</section>

		<section class="vantagens grid_3">

			<?php echo $this->element('advantages') ?>
			
		</section>
	
		<section class="widgets">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>