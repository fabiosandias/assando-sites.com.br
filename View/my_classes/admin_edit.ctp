<?php
$this->Bootstrap->addCrumb('Turmas', array('action' => 'index'));
$this->Bootstrap->addCrumb(isset($this->data['MyClass']['id']) ? $this->data['MyClass']['title'] : 'Criar nova turma');
?>

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
			<div class="input"><?php echo $this->Form->input('status_id', array('options' => $Status, 'empty' => false, 'class' => 'span3')) ?></div>			
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
					<?php echo $this->Form->input('price', array('class' => 'small', 'autocomplete' => 'off')) ?>
					<span class="help-inline">Desconto de <?php echo $this->Html->tag('strong', Configure::read('Inscricao.Desconto.porcentagem') . '%') ?> até <?php echo $this->Html->tag('strong', (int)abs(Configure::read('Inscricao.Desconto.limite')) . ' dias') ?> antes do início das aulas</span>
				</div>
			</div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('desconto', 'Valor com desconto') ?>
			<div class="input">
				<div class="input-prepend">
					<span class="add-on">R$</span>
					<?php echo $this->Form->input('desconto', array('class' => 'small', 'readonly' => true)) ?>
				</div>
			</div>			
		</div>
		
	</fieldset>
	
	<div class="actions">
		<?php echo $this->Form->submit('Salvar', array('class' => 'btn primary', 'div' => false)) ?>	
		<?php if (isset($this->data['MyClass']['id']) && !empty($this->data['MyClass']['id'])) echo $this->Html->link('Deletar turma', array('action' => 'delete', (int)$this->data['MyClass']['id']), array('class' => 'red right'), 'Deseja realmente deletar esta turma? Toda as informações relacionadas serão apagadas!') ?>			
	</div>
<?php echo $this->Form->end() ?>

<script type="text/javascript">
$('#MyClassPrice').keyup(function() {
	var valor = (this.value) ? parseFloat(this.value) : 0;
	var desconto = <?php echo Configure::read('Inscricao.Desconto.porcentagem') ?> / 100;

	var valor_com_desconto = Math.ceil(valor - (valor * desconto)).toFixed(2);

	$('#MyClassDesconto').val(valor_com_desconto);	
});

$('#MyClassPrice').trigger('keyup');
</script>
