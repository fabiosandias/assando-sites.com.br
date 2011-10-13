<?php echo $this->Form->create('MyClass', array('inputDefaults' => array('div' => false, 'label' => false))) ?>

	<fieldset>
		<?php echo $this->Html->tag('legend', 'Dados da turma') ?>
		<?php echo $this->Form->hidden('id') ?>
		
		<div class="clearfix">
			<?php echo $this->Form->label('code', 'Código') ?>
			<div class="input"><?php echo $this->Form->input('code', array('class' => 'small')) ?></div>			
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
			<?php echo $this->Form->label('status_id', 'Status') ?>
			<div class="input"><?php echo $this->Form->input('status_id', array('options' => $Status, 'empty' => false)) ?></div>			
		</div>
		
	</fieldset>
	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Datas e valor') ?>
		
		<div class="clearfix">
			<?php echo $this->Form->label('start', 'Início das aulas') ?>
			<div class="input"><?php echo $this->Form->input('start', array('dateFormat' => 'DMY', 'separator' => ' de ', 'minYear' => date('Y') - 1, 'maxYear' => date('Y') + 1, 'class' => 'span2')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('end', 'Fim das aulas') ?>
			<div class="input"><?php echo $this->Form->input('end', array('dateFormat' => 'DMY', 'separator' => ' de ', 'minYear' => date('Y') - 1, 'maxYear' => date('Y') + 1, 'class' => 'span2')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('price', 'Valor da inscrição') ?>
			<div class="input">
				<div class="input-prepend">
					<span class="add-on">R$</span>
					<?php echo $this->Form->input('price', array('class' => 'small')) ?>
				</div>
			</div>			
		</div>
		
	</fieldset>
	
	<div class="actions">
		<?php echo $this->Form->submit('Salvar', array('class' => 'btn primary', 'div' => false)) ?>	
		<?php if (isset($this->data['MyClass']['id']) && !empty($this->data['MyClass']['id'])) echo $this->Html->link('Deletar turma', array('action' => 'delete', (int)$this->data['MyClass']['id']), array('class' => 'red right'), 'Deseja realmente deletar esta turma? Toda as informações relacionadas serão apagadas!') ?>			
	</div>
<?php echo $this->Form->end() ?>