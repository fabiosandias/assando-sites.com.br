<!doctype html>
<html>
<head>
	<meta charset="<?php echo Configure::read('App.encoding') ?>" />
	<title><?php echo empty($title_for_layout) ? Configure::read('Meta.title') : $title_for_layout . ' &ndash; ' . Configure::read('Meta.title') ?></title>
	
	<?php echo $this->Html->meta('description', Configure::read('Meta.description')) . PHP_EOL ?>
	<?php echo $this->Html->meta('keywords', Configure::read('Meta.keywords')) . PHP_EOL ?>
	
	<?php if (Configure::read('debug')) echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex,nofollow')); ?>	
	
	<?php echo $this->Html->meta('icon') ?><link rel="apple-touch-icon" href="<?php echo $this->Html->url('/apple-touch-icon.png') ?>" />


	<!-- CSS --><?php echo $this->Html->css(array('reset.css', '960.css', 'animate-custom.css', 'http://fonts.googleapis.com/css?family=Delius|Rosario')) ?>	
	<link rel="stylesheet/less" type="text/css" href="<?php echo $this->Html->url('/css/style.less') ?>" />
		
	<!-- JS -->
	<?php echo $this->Html->script('libs/less.min.js') . PHP_EOL ?>

		
	<?php foreach (Configure::read('Google.webmasters') AS $code) echo $this->Html->meta(array('name' => 'google-site-verification', 'content' => $code)); ?>
</head>
<body class="<?php if (isset($body_class)) echo $body_class ?>">
	<header id="topo">
		<div class="container_12">
			<?php echo $this->element('social-share') ?>
			
			<nav id="menu" class="grid_6">
				<?php echo $this->element('menu') ?>
			</nav>			

			<div class="titulo grid_6 suffix_6">
				<h1>Desenvolver com <strong>CakePHP</strong> é tão fácil quanto assar um bolo</h1>
				<p><strong>Assando Sites</strong> é um curso prático de <?php echo $this->Html->link('CakePHP', array('controller' => 'pages', 'action' => 'display', 'cakephp')) ?> onde você vai aprender a desenvolver sites e portais de forma rápida e eficiente.</p>
				<p>As aulas são <strong>on-line</strong>, através de uma ferramenta com áudio, vídeo, chat e apresentação de slides... Você aprende sem sair de casa!</p>
			</div>
			
			<?php echo $this->element('widgets/sign-up', array('class' => 'inscricao grid_6')) ?>

		</div>
	</header>

	<div id="conteudo">
		<div class="container_12">
			<?php echo $content_for_layout ?>
			
			<div class="gnomo-aponta"><!--  --></div>		
		</div>
	</div>

	<footer id="rodape">
		<div class="container_12">

			<div class="pagamento grid_6">
				<h5>Formas de pagamento, via PagSeguro</h5>
				<p>Você pode pagar com Visa, MasterCard, Diners, American Express, Hipercard, Aura, Bradesco, Itaú, Banco do Brasil, Banrisul, Oi Paggo, saldo em conta PagSeguro ou boleto bancário</p>
				<?php echo $this->Html->image('layout/opcoes-pagamento.png', array('alt' => 'Formas de Pagamento')) ?>
			</div>

			<div class="creditos grid_5 prefix_1">
				<nav>
					<?php echo $this->element('menu') ?>
				</nav>

				<p class="cakephp">O <a href="http://cakephp.org/" rel="external">CakePHP</a>&trade; é de propriedade da <a href="http://cakefoundation.org/" rel="external"><abbr title="CakePHP Software Foundation">CSF</abbr></a>&reg; e a mesma não tem relação com este curso ou seu conteúdo</p>
				
				<p>Design por <?php echo $this->Html->link('Bernard De Luna', 'http://bernarddeluna.com/', array('rel' => 'external')) ?> e ilustrações por <?php echo $this->Html->link('Eddie Souza', 'http://eddiesouza.com.br/', array('rel' => 'external')) ?></p>
			</div>
		</div>
	</footer>

	<?php if (Configure::read('debug') == 2) echo $this->element('sql_dump') ?>
	
	<?php echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', 'scripts.js', 'https://apis.google.com/js/plusone.js', 'http://platform.twitter.com/widgets.js')) ?>
	
	<?php if (!Configure::read('debug')) echo $this->element('google-analytics', array('account' => Configure::read('Google.analytics')))	?>
	
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>