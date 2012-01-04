<?php
$this->set(array(
	'body_class' => 'page cakephp',
	'title_for_layout' => 'CakePHP'
))
?>
		<section class="conteudo grid_9">
			<h2>O CakePHP</h2>
			
			<p>O <a rel="reference external" href="http://www.cakephp.org/">CakePHP</a>&trade; é um
			<a rel="reference external" href="http://pt.wikipedia.org/wiki/Framework"><em>framework</em></a> de
			<a rel="reference external" href="http://pt.wikipedia.org/wiki/Rapid_Application_Development">desenvolvimento rápido</a>
			para <a rel="reference external" href="http://www.php.net/">PHP</a>, <a rel="reference external" href="http://pt.wikipedia.org/wiki/Licença_MIT">livre</a>
			e de
			<a rel="reference external" href="http://pt.wikipedia.org/wiki/Código_aberto">código aberto</a>. Seu principal
			objetivo é permitir que você trabalhe de forma estruturada e rápida sem perder a
			flexibilidade.</p>
			
			<p>O CakePHP tira a monotonia do desenvolvimento web. Ele fornece todas as
			ferramentas que você precisa para começar programando o que realmente deseja: a
			lógica específica da sua aplicação. Em vez de reinventar a roda a cada vez que
			se constrói um novo projeto, pegue uma cópia do CakePHP e comece com o interior
			de sua aplicação.</p>
			
			<p>O CakePHP possui uma <a rel="reference external" href="http://cakephp.lighthouseapp.com/contributors">equipe de desenvolvedores</a> ativa e uma grande comunidade,
			trazendo grande valor ao projeto. Além de manter você fora da reinvenção da roda,
			usar o CakePHP significa que o núcleo da sua aplicação é bem testado e está em
			constante aperfeiçoamento.</p>
			
			<p>Abaixo segue uma pequena lista dos recursos que você poder desfrutar no CakePHP:</p>
			
			<ul>
				<li><a rel="reference external" href="http://cakephp.org/feeds">Comunidade</a> ativa e amigável</li>
				<li><a rel="reference external" href="http://pt.wikipedia.org/wiki/Licença_MIT">Licença</a> flexível</li>
				<li>Compatível com o PHP 5.2.9 e superior</li>
				<li><a rel="reference external" href="http://pt.wikipedia.org/wiki/CRUD">CRUD</a>
				integrado para interação com o banco de dados</li>
				<li><a rel="reference external" href="http://en.wikipedia.org/wiki/Scaffold_(programming)">Scaffolding</a>
				para criar protótipos</li>
				<li>Geração de código</li>
				<li>Arquitetura <a rel="reference external" href="http://pt.wikipedia.org/wiki/MVC">MVC</a></li>
				<li>Requisições feitas com clareza, URLs e rotas customizáveis</li>
				<li><a rel="reference external" href="http://en.wikipedia.org/wiki/Data_validation">Validações</a> embutidas</li>
				<li><a rel="reference external" href="http://en.wikipedia.org/wiki/Web_template_system">Templates</a> rápidos e
				flexíveis (Sintaxe PHP, com <cite>helpers</cite>)</li>
				<li><cite>Helpers</cite> para AJAX, JavaScript, formulários HTML e outros</li>
				<li>Componentes de Email, Cookie, Segurança, Sessão, e Tratamento de Requisições</li>
				<li><a rel="reference external" href="http://pt.wikipedia.org/wiki/Access_Control_List">Controle de Acessos</a>
				flexível</li>
				<li>Limpeza dos dados</li>
				<li>Sistema de <a rel="reference external" href="http://en.wikipedia.org/wiki/Web_cache">Cache</a> flexível</li>
				<li>Localização</li>
				<li>Funciona a partir de qualquer diretório do website, com pouca ou nenhuma
				configuração do Apache</li>
			</ul>
			
			<p>Texto original: <?php echo $this->Html->link('http://book.cakephp.org/2.0/pt/cakephp-overview/what-is-cakephp-why-use-it.html', null, array('rel' => 'external')) ?></p>
			
			<h2 style="margin-top: 50px">Exemplo de código &ndash; MVC</h2>
			<p>Veja a seguir o exemplo de um <strong>Controller</strong> de Notícias, onde usamos o <strong>Model</strong> de Notícia para buscar - no banco de dados - as últimas 5 notícias publicadas e enviamos os dados para exibição na <strong>View</strong>:</p>
			<script src="https://gist.github.com/1323060.js"> </script>
			<p>Com o CakePHP é assim: você não se preocupa com conexão à banco de dados, consultas SQL complicadas, includes ou requires... você vai direto ao ponto, focando na parte mais importante da sua aplicação.</p>
		
			<p>Gostou? Então <?php echo $this->Html->link('inscreva-se', array('controller' => 'my_classes', 'action' => 'index')) ?> na próxima turma!</p>
		
		</section>

		<section class="grid_3 sidebar vantagens">

			<?php echo $this->element('advantages') ?>
			
		</section>
	
		<section class="widgets">
			<?php echo $this->element('widgets/author') ?>

			<?php echo $this->element('widgets/sign-up', array('class' => 'widget inscricao grid_6 omega')) ?>
		</section>

		<script>mpq.track("Sobre o CakePHP");</script>