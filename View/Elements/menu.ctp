<ul>
	<li><?php echo $this->Html->link('Início', array('controller' => 'pages', 'action' => 'display', 'home', 'aluno' => false), array('class' => 'home')) ?></li>
	<li><?php echo $this->Html->link('Sobre o curso', array('controller' => 'pages', 'action' => 'display', 'about', 'aluno' => false), array('class' => 'sobre')) ?></li>
	<li><?php echo $this->Html->link('CakePHP', array('controller' => 'pages', 'action' => 'display', 'cakephp', 'aluno' => false), array('class' => 'cakephp')) ?></li>
	<li><?php echo $this->Html->link('Inscreva-se!', array('controller' => 'my_classes', 'action' => 'index', 'aluno' => false), array('class' => 'inscricao')) ?></li>
</ul>