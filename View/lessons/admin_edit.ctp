<?php
$this->Bootstrap->addCrumb('Turmas', array('controller' => 'my_classes'));
$this->Bootstrap->addCrumb('Aulas', array('action' => 'index'));
$this->Bootstrap->addCrumb(isset($this->data['Lesson']['id']) ? $this->data['Lesson']['title'] : 'Agendar aula');
?>

<?php echo $this->Form->create('Lesson', array('inputDefaults' => array('div' => false, 'label' => false))) ?>
	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Dados da aula') ?>
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
			<?php echo $this->Form->label('datetime', 'Hora da aula') ?>
			<div class="input"><?php echo $this->Form->input('datetime', array('dateFormat' => 'DMYHS', 'separator' => ' de ', 'minYear' => date('Y') - 1, 'maxYear' => date('Y') + 1, 'timeFormat' => 24, 'interval' => 15, 'class' => 'mini')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('length', 'Duração') ?>
			<div class="input">
				<?php echo $this->Form->input('length', array('class' => 'mini')) ?>
				<span class="help-inline">minutos</span>			
			</div>
		</div>
		
	</fieldset>
	
	<div class="actions">
		<?php echo $this->Form->submit('Salvar', array('class' => 'btn primary', 'div' => false)) ?>	
		<?php if (isset($this->data['Lesson']['id']) && !empty($this->data['Lesson']['id'])) echo $this->Html->link('Deletar turma', array('action' => 'delete', (int)$this->data['Lesson']['id']), array('class' => 'red right'), 'Deseja realmente deletar esta aula? Toda as informações relacionadas serão apagadas!') ?>			
	</div>
<?php echo $this->Form->end() ?>
