<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' turmas');

$this->Bootstrap->addCrumb('Turmas');
?>

<?php if (!empty($data)) { ?>
<table class="bordered-table zebra-striped">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('MyClass.id', '#') ?></th>
		<th colspan="2"><?php echo $this->Paginator->sort('MyClass.code', 'Turma') ?></th>
		<th>Alunos</th>
		<th><?php echo $this->Paginator->sort('MyClass.start', 'Inscrições') ?></th>
		<th><?php echo $this->Paginator->sort('MyClass.start', 'Aulas') ?></th>
		<th><?php echo $this->Paginator->sort('Status.name', 'Status') ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
		
		switch ($Status['id']) {	
			case STATUS_CLASS_PENDENTE:
				$labelClass = 'warning';
				break;			
			case STATUS_CLASS_INSCRICOES_ABERTAS:
				$labelClass = 'success';
				break;
			case STATUS_CLASS_ENCERRADA:				
			case STATUS_CLASS_INSCRICOES_FECHADAS:
				$labelClass = 'important';
				break;
		}
	?>
	<tr class="status-<?php echo $Status['id'] ?>">
		<td><?php echo $MyClass['id'] ?></td>
		<td><?php echo $this->Html->tag('span', $MyClass['code'], array('class' => 'label', 'style' => 'background: ' . stringToColor($MyClass['code']))) ?></td>
		<td><?php echo $this->Html->link($MyClass['title'], array('action' => 'edit', $MyClass['id'])) ?></td>
		<td><?php echo $this->Html->link(count($Student), array('controller' => 'students', 'class' => $MyClass['id'])) ?></td>
		<td class="center"><?php printf('Até %s', $this->Html->tag('strong', $this->Time->format('d/m', $MyClass['start'] . ' -1 week'))) ?></td>
		<td class="center"><?php printf('%s até %s', $this->Html->tag('strong', $this->Time->format('d/m', $MyClass['start'])), $this->Html->tag('strong', $this->Time->format('d/m', $MyClass['end']))) ?></td>
		<td><?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhuma turma encontrada')) ?>
