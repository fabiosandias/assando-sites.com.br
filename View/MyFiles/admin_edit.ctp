<?php
$this->Bootstrap->addCrumb('Arquivos', array('action' => 'index'));
$this->Bootstrap->addCrumb(isset($this->data['File']['id']) ? $this->data['File']['title'] : 'Enviar arquivo');
?>

<?php echo $this->Form->create('MyFile', array('inputDefaults' => array('div' => false, 'label' => false))) ?>
	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Dados do arquivo') ?>
		<?php echo $this->Form->hidden('id') ?>
		
		<div class="clearfix">
			<?php echo $this->Form->label('class_id', 'Turma') ?>
			<div class="input"><?php echo $this->Form->input('class_id', array('options' => $MyClass, 'empty' => false)) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('title', 'Título') ?>
			<div class="input"><?php echo $this->Form->input('title', array('class' => 'span4')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('description', 'Descrição') ?>
			<div class="input"><?php echo $this->Form->input('description', array('class' => 'span6', 'rows' => 3)) ?></div>
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('location', 'Local / URL') ?>
			<div class="input"><?php echo $this->Form->input('location', array('class' => 'span8')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('status_id', 'Status') ?>
			<div class="input"><?php echo $this->Form->input('status_id', array('options' => $Status, 'empty' => false, 'class' => 'small')) ?></div>			
		</div>
		
	</fieldset>
	
	<div class="actions">
		<?php echo $this->Form->submit('Salvar', array('class' => 'btn primary', 'div' => false)) ?>	
		<?php if (isset($this->data['File']['id']) && !empty($this->data['File']['id'])) echo $this->Html->link('Deletar arquivo', array('action' => 'delete', (int)$this->data['File']['id']), array('class' => 'red right'), 'Deseja realmente deletar este arquivo? Toda as informações relacionadas serão apagadas!') ?>			
	</div>
<?php echo $this->Form->end() ?>
