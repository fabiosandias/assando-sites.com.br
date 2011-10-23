<!doctype html>
<html>
<head>
	<meta charset="<?php echo Configure::read('App.encoding') ?>" />
	<title>Assando Sites</title>

	<?php echo $this->Html->css(array('reset.css', '960.css', 'http://fonts.googleapis.com/css?family=Delius|Rosario')) ?>
	
	<link rel="stylesheet/less" type="text/css" href="<?php echo $this->Html->url('/css/style.less') ?>" />	
	<?php echo $this->Html->script('libs/less.min.js') . PHP_EOL ?>
</head>
<body class="<?php if (isset($body_class)) echo $body_class ?>">
	<header id="topo">
		<div class="container_12">
			<?php echo $this->element('social-share') ?>
			
			<nav id="menu" class="grid_6">
				<?php echo $this->element('menu') ?>
			</nav>			

			<div class="titulo grid_6 suffix_6">
				<h1>Desenvolver com <strong>CakePHP</strong> é tão fácil como assar um bolo</h1>
				<p><strong>Assando Sites</strong> é um curso prático onde você vai aprender a desenvolver sites e portais de forma rápida e eficiente.</p>
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
				<h5>Formas de pagamento</h5>
				<p>Você pode pagar com Visa, MasterCard, Diners, American Express, Hipercard, Aura, Bradesco, Itaú, Banco do Brasil, Banrisul, Oi Paggo, saldo em conta PagSeguro e boleto</p>
				<?php echo $this->Html->image('icons/opcoes-pagamento-pagseguro.png', array('alt' => 'Formas de Pagamento')) ?>
			</div>

			<div class="creditos grid_5 prefix_1">
				<nav>
					<?php echo $this->element('menu') ?>
				</nav>

				<p>O <a href="http://cakephp.org/" target="_blank">CakePHP</a>&trade; é de propriedade da <a href="http://cakefoundation.org/" target="_blank"><abbr title="CakePHP Software Foundation">CSF</abbr></a>&reg; e a mesma não tem relação com este curso ou seu conteúdo</p>
			</div>
		</div>
	</footer>
		
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
	{lang: 'pt-BR'}
	</script>
	<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
</body>
</html>