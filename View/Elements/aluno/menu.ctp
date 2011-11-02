<ul>
	<li><?php echo $this->Html->link('Início', array('controller' => 'students', 'action' => 'dashboard'), array('class' => 'dashboard')) ?></li>
	<li><?php echo $this->Html->link('Meus dados', array('controller' => 'students', 'action' => 'profile'), array('class' => 'perfil')) ?></li>
	<li><?php echo $this->Html->link('Arquivos', array('controller' => 'my_files', 'action' => 'index'), array('class' => 'arquivos')) ?></li>
</ul>