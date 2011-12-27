<?php 
$this->Bootstrap->addCrumb('Alunos', array('action' => 'index'));
$this->Bootstrap->addCrumb($this->data['Student']['fullname']);
?>

<?php echo $this->Form->create('Student', array('inputDefaults' => array('div' => false, 'label' => false))) ?>
<div class="row">
	<div class="span9">
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Dados do aluno') ?>
		<?php echo $this->Form->hidden('id') ?>
		
		<div class="clearfix">
			<?php echo $this->Form->label('name', 'Nome') ?>
			<div class="input"><?php echo $this->Form->input('name', array('class' => 'span3')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('surname', 'Sobrenome') ?>
			<div class="input"><?php echo $this->Form->input('surname', array('class' => 'span3')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('email', 'E-mail') ?>
			<div class="input"><?php echo $this->Form->input('email', array('class' => 'span5')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('status_id', 'Status') ?>
			<div class="input"><?php echo $this->Form->input('status_id', array('options' => $Status, 'empty' => false)) ?></div>			
		</div>
		
	</fieldset>
	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Informações extras') ?>
		<?php echo $this->Form->hidden('Information.id') ?>
		<?php echo $this->Form->hidden('Information.student_id', array('value' => $this->data['Student']['id'])) ?>
		
		<div class="clearfix">
			<?php echo $this->Form->label('Information.cpf', 'CPF') ?>
			<div class="input"><?php echo $this->Form->input('Information.cpf', array('class' => 'span3')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('Information.twitter', 'Twitter') ?>
			<div class="input">
				<div class="input-prepend">
					<span class="add-on">@</span>
					<?php echo $this->Form->input('Information.twitter', array('class' => 'span3')) ?>
				</div>
			</div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('Information.phone', 'Telefone') ?>
			<div class="input"><?php echo $this->Form->input('Information.phone', array('class' => 'span4')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('Information.city', 'Cidade') ?>
			<div class="input"><?php echo $this->Form->input('Information.city', array('class' => 'span4')) ?></div>			
		</div>
		
		<div class="clearfix">
			<?php echo $this->Form->label('Information.state', 'Estado') ?>
			<div class="input"><?php echo $this->Form->input('Information.state', array('class' => 'span4')) ?></div>			
		</div>
		
	</fieldset>
	</div>
	
	<div class="span6">	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Turmas', array('style' => 'padding-left: 0')) ?>
		
		<?php echo $this->Form->input('MyClass', array('options' => $MyClass, 'multiple' => 'checkbox')) ?>
		
	</fieldset>	
	<fieldset>
		<?php echo $this->Html->tag('legend', 'Pagamentos', array('style' => 'padding-left: 0')) ?>
		
		<table>
			<thead>
				<tr>
					<th>Valor</th>
					<th>Data</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($Payments AS $Payment) {
					extract($Payment);
		
					switch ($Status['id']) {
						case STATUS_PAYMENT_AGUARDANDO_PAGAMENTO:
						case STATUS_PAYMENT_EM_ANALISE:
							$labelClass = 'warning';
							break;
						case STATUS_PAYMENT_PAGO:
						case STATUS_PAYMENT_DISPONIVEL:
							$labelClass = 'success';
							break;
						case STATUS_PAYMENT_EM_DISPUTA:
						case STATUS_PAYMENT_DEVOLVIDO:
						case STATUS_PAYMENT_CANCELADO:
							$labelClass = 'important';
							break;
				}
				?>
				<tr>
					<td><?php echo $this->Number->format($Payment['value'], array('places' => 2, 'decimals' => ',', 'before' => 'R$ ')) ?></td>
					<td class="center"><?php echo $this->Time->format('d/m', $Payment['datetime']) ?></td>
					<td><?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
	</fieldset>
	</div>
</div>
		
	<div class="actions">
		<?php echo $this->Form->submit('Salvar', array('class' => 'btn primary', 'div' => false)) ?>

		<?php if (!empty($this->data['Information']['highrise_person_id'])) echo $this->Html->link('Ir para o Highrise', 'https://' . Configure::read('Highrise.account') . '.highrisehq.com/people/' . $this->data['Information']['highrise_person_id'], array('class' => 'btn success', 'target' => '_blank', 'escape' => false)) ?>

		<?php echo $this->Html->link('Deletar aluno', array('action' => 'delete', (int)$this->data['Student']['id']), array('class' => 'red right'), 'Deseja realmente deletar este aluno? Toda as informações relacionadas serão apagadas!') ?>			
	</div>
<?php echo $this->Form->end() ?>