<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' aulas');

$this->Bootstrap->addCrumb('Turmas', array('controller' => 'my_classes'));
$this->Bootstrap->addCrumb('Aulas');
?>

<?php if (!empty($data)) { ?>
<table class="bordered-table zebra-striped">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Lesson.id', '#') ?></th>
		<th><?php echo $this->Paginator->sort('Lesson.title', 'Título') ?></th>
		<th><?php echo $this->Paginator->sort('Lesson.description', 'Descrição') ?></th>
		<th colspan="2"><?php echo $this->Paginator->sort('MyClass.code', 'Turma') ?></th>
		<th><?php echo $this->Paginator->sort('Lesson.datetime', 'Data') ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
	?>
	<tr>
		<td><?php echo $Lesson['id'] ?></td>
		<td><?php echo $this->Html->link($Lesson['title'], array('action' => 'edit', $Lesson['id'])) ?></td>
		<td><?php echo $this->Text->truncate($Lesson['description'], 30) ?></td>
		<td><?php echo $MyClass['shortname'] ?></td>
		<td><?php echo $this->Html->tag('span', $MyClass['code'], array('class' => 'label', 'style' => 'background: ' . stringToColor($MyClass['code']))) ?></td>
		<td class="center"><?php echo $this->Time->format('d/m ~ H:i', $Lesson['datetime']) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhuma aula encontrada')) ?>
