<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' alunos');

$this->Bootstrap->addCrumb('Alunos');
?>


<?php if (!empty($data)) { ?>
<table class="bordered-table zebra-striped">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Student.id', '#') ?></th>
		<th><?php echo $this->Paginator->sort('Student.fullname', 'Nome') ?></th>
		<th><?php echo $this->Paginator->sort('Student.email', 'Email') ?></th>
		<th><?php echo $this->Paginator->sort('Status.name', 'Status') ?></th>
		<th><?php echo $this->Paginator->sort('Student.created', 'Cadastro') ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
		
		switch ($Status['id']) {
			case STATUS_STUDENT_INSCRICAO_PENDENTE:
				$labelClass = 'warning';
				break;
			case STATUS_STUDENT_INSCRICAO_CONFIRMADA:
				$labelClass = 'success';
				break;
			case STATUS_STUDENT_DELETADO:
				$labelClass = 'important';
				break;
		}

		$highrise_link = 'https://' . Configure::read('Highrise.account') . '.highrisehq.com/people/' . $Information['highrise_person_id'];
	?>
	<tr class="status-<?php echo $Status['id'] ?>">
		<td><?php echo $Student['id'] ?></td>
		<td><?php echo $this->Html->link($Student['fullname'], array('action' => 'edit', $Student['id'])) ?><?php if (!empty($Information['highrise_person_id'])) echo $this->Html->link($this->Html->image('icons/highrise.png'), $highrise_link, array('title' => 'Highrise: ' . $Student['fullname'], 'style' => 'float: right; height: 16px', 'target' => '_blank', 'escape' => false)) ?></td>
		<td><?php echo $Student['email'] ?></td>
		<td>
			<?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?>
			<?php foreach ($MyClass AS $class): ?>
			<?php echo $this->Html->link($this->Html->tag('span', $class['code'], array('class' => 'label', 'style' => 'background: ' . stringToColor($class['code']))), array('class' => $class['id']), array('escape' => false)) ?>
			<?php endforeach ?>
		</td>
		<td class="center"><?php echo $this->Time->format('d/m ~ H:i', $Student['created']) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhum aluno encontrado')) ?>