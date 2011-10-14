<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' aulas');

$this->Bootstrap->addCrumb('Turmas', array('controller' => 'my_classes'));
$this->Bootstrap->addCrumb('Aulas');
?>

<?php if (!empty($data)) { ?>
<table class="zebra-striped">
<thead>
	<tr>
		<th>#</th>
		<th>Título</th>
		<th>Descrição</th>
		<th colspan="2">Turma</th>
		<th>Data</th>
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
		<td><?php echo $Lesson['description'] ?></td>
		<td><?php echo $MyClass['shortname'] ?></td>
		<td><?php echo $MyClass['code'] ?></td>
		<td><?php echo $this->Time->format('d/m ~H:i', $Lesson['datetime']) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhum aluno encontrado')) ?>