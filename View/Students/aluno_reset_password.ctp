<?php echo $this->Form->create('Student', array('inputDefaults' => array('div' => false, 'label' => false))) ?>
<fieldset>
	<div class="clearfix">
		<?php echo $this->Form->label('email', 'Email') ?>
		<div class="input"><?php echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'placeholder' => 'Digite seu email')) ?></div>			
	</div>
</fieldset>
	
<div class="actions">
	<?php echo $this->Form->submit('Enviar nova senha', array('class' => 'btn primary right', 'div' => false)) ?>			
	<?php echo $this->Html->link('Login', array('action' => 'login'), array('class' => 'btn left', 'div' => false)) ?>	
</div>	
<?php echo $this->Form->end() ?>