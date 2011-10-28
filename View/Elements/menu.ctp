<ul>
	<li><?php echo $this->Html->link('Início', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'home')) ?></li>
	<li><?php echo $this->Html->link('Sobre o curso', array('controller' => 'pages', 'action' => 'display', 'about'), array('class' => 'sobre')) ?></li>
	<li><?php echo $this->Html->link('CakePHP', array('controller' => 'pages', 'action' => 'display', 'cakephp'), array('class' => 'cakephp')) ?></li>
	<li><?php echo $this->Html->link('Inscreva-se!', array('controller' => 'my_classes', 'action' => 'index'), array('class' => 'inscricao')) ?></li>
</ul>