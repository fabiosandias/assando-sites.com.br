<!doctype html>
<html lang="pt-BR"
	itemscope itemtype="http://schema.org/Organization"
	xmlns:og="http://ogp.me/ns#"
	xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
	<meta charset="<?php echo Configure::read('App.encoding') ?>" />
	<title><?php echo empty($title_for_layout) ? Configure::read('Meta.title') : $title_for_layout . ' &ndash; ' . Configure::read('Meta.title') ?></title>
	
	<?php echo $this->Html->meta('description', Configure::read('Meta.description')) . PHP_EOL ?>
	<?php echo $this->Html->meta('keywords', Configure::read('Meta.keywords')) . PHP_EOL ?>
	
	<?php if (Configure::read('debug') || $isPainelAluno) echo $this->Html->meta(array('name' => 'robots', 'content' => 'noindex,nofollow')); ?>	
	
	<?php echo $this->Html->meta('icon') ?><link rel="apple-touch-icon" href="<?php echo $this->Html->url('/apple-touch-icon.png') ?>" />
	
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Delius|Rosario') ?>
<?php if (Configure::read('debug')) { ?>	
	<?php echo $this->Html->css(array('reset.css', '960.css', 'animate-custom.css')) ?>

	<link rel="stylesheet/less" type="text/css" href="<?php echo $this->Html->url('/css/style.less') ?>" />
	<?php if ($isPainelAluno) { ?><link rel="stylesheet/less" type="text/css" href="<?php echo $this->Html->url('/css/aluno.less') ?>" /><?php } ?>
		
	
	<?php echo $this->Html->script('libs/less.min.js') . PHP_EOL ?>
<?php } else { ?>
	<?php echo $this->Html->css('http://assando-sites.s3.amazonaws.com/assets/css/style-' . md5_file(CSS . DS . 'style.min.css') . '.min.css') ?>
	<?php if ($isPainelAluno) echo $this->Html->css('aluno') ?>
<?php } ?>
	
	<!-- Author -->
	<?php
	foreach (Configure::read('Google.webmasters') AS $code)
		echo $this->Html->meta(array('name' => 'google-site-verification', 'content' => $code));

	echo $this->Html->meta(array('name' => 'y_key', 'content' => 'd3b849455e35d7da'));
	echo $this->Html->meta(array('name' => 'msvalidate.01', 'content' => '500081F68DAE77855425F1E768F88AC0'));
	?>

	<link href="https://plus.google.com/108724422355747527461" rel="author" />
	<link href="https://plus.google.com/107977856765116714804" rel="publisher" />

	<!-- Facebook -->
	<?php 
	echo $this->Html->meta(array('property' => 'og:title', 'content' => empty($title_for_layout) ? Configure::read('Meta.title') : $title_for_layout . ' &ndash; ' . Configure::read('Meta.title')));
	echo $this->Html->meta(array('property' => 'og:url', 'content' => $this->Html->url($this->here, true)));
	echo $this->Html->meta(array('property' => 'og:description', 'content' => Configure::read('Meta.description')));
	echo $this->Html->meta(array('property' => 'og:image', 'content' => $this->Html->url('/apple-touch-icon.png', true)));
	echo '<link rel="image_src" href="'. $this->Html->url('/apple-touch-icon.png', true) .'" />';
	echo $this->Html->meta(array('property' => 'og:type', 'content' => 'website'));
	echo $this->Html->meta(array('property' => 'og:site_name', 'content' => 'Assando Sites'));
	echo $this->Html->meta(array('property' => 'fb:admins', 'content' => '1480410295'));
	echo $this->Html->meta(array('property' => 'fb:app_id', 'content' => '196764077041865')) . PHP_EOL;
	?>
</head>
<body class="<?php if (isset($body_class)) echo $body_class ?>">
	<header id="topo">
		<div class="container_12">
			
			<?php if (!$isPainelAluno) { ?>
			
			<?php echo $this->element('social-share') ?>
			
			<nav id="menu" class="grid_6">
				<?php echo $this->element('menu') ?>
			</nav>

			<div class="titulo grid_6 suffix_6">
				<h1 itemprop="name">Assando Sites</h1>
				<h2><a href="<?php echo $this->Html->url('/') ?>" itemprop="url">Desenvolver com <strong>CakePHP</strong> é tão fácil quanto assar um bolo</a></h2>
				<p itemprop="description"><strong>Assando Sites</strong> é um curso prático de <?php echo $this->Html->link('CakePHP', array('controller' => 'pages', 'action' => 'display', 'cakephp')) ?> onde você vai aprender a desenvolver sites e portais de forma rápida e eficiente.</p>
				<p>As aulas são <strong>on-line</strong>, através de uma ferramenta com áudio, vídeo, chat e apresentação de slides... Você aprende sem sair de casa!</p>
			</div>
			
			<?php echo $this->element('widgets/sign-up', array('class' => 'inscricao grid_6'), array('cache' => array('key' => 'signup_header'))) ?>
			
			<?php } else { ?>
			
			<nav id="menu" class="grid_6 prefix_6">
				<?php echo $this->element('aluno/menu') ?>
			</nav>

			<div class="perfil">Seja bem-vindo(a), <strong><?php echo AuthComponent::user('name') ?></strong>! <?php echo $this->Html->image(gravatar(AuthComponent::user('email'), 32), array('class' => 'avatar', 'width' => 32, 'height' => 32)) ?></div>
			
			<div class="titulo grid_6 suffix_2">
				<h1><?php echo $this->Html->link('Painel do Aluno', '/aluno') ?></h1>
			</div>
			
			<?php } ?>

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
				<?php echo $this->Html->image('layout/opcoes-pagamento.png', array('alt' => 'Formas de Pagamento', 'width' => 386, 'height' => 100)) ?>
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
	
	<?php echo $this->Html->script(array('https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', Configure::read('debug') ? 'scripts.js' : 'http://assando-sites.s3.amazonaws.com/assets/js/scripts-' . md5_file(JS . DS . 'scripts.min.js') . '.min.js')) ?>
	
	<script type="text/javascript">
	$(window).load(function() {
		loadAssync('//apis.google.com/js/plusone.js');
		loadAssync('//platform.twitter.com/widgets.js');
		loadAssync('//connect.facebook.net/pt_BR/all.js#xfbml=1');
	});
	
<?php if (!Configure::read('debug')) { ?>
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo Configure::read('Google.analytics') ?>']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
<?php } ?>
	</script>
</body>
</html>