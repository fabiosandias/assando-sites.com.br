<!doctype html>
<html>
<head>
	<meta charset="<?php echo Configure::read('App.encoding') ?>" />
	<title><?php echo $title_for_layout ?></title>
	
	<?php echo $this->Html->css(array('http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css', 'admin/style.css')) . PHP_EOL ?>
		
	<!--[if lt IE 9]><?php echo $this->Html->script('http://html5shim.googlecode.com/svn/trunk/html5.js') ?><![endif]-->
	
	<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js') . PHP_EOL ?>
	
	<meta name="robots" content="noindex, nofollow" />
</head>
<body class="login">
	
	<div class="container">
		<div class="content">
			<div class="page-header">
				<h1><?php echo $title_for_layout ?> <?php if (isset($subtitle_for_layout) && !empty($subtitle_for_layout)) echo $this->Html->tag('small', $subtitle_for_layout) ?></h1>
			</div>
			
			<?php echo $this->Session->flash() ?>
			<?php echo $this->Session->flash('auth') ?>
			
			<?php echo $this->fetch('content') ?>
		</div>
	</div>
	
	<?php echo $this->Html->script(array('http://twitter.github.com/bootstrap/1.3.0/bootstrap-dropdown.js', 'admin/script.js')) ?>

</body>
</html>
