<?php $this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' turmas') ?>

<?php if (!empty($data)) { ?>
<table class="zebra-striped">
<thead>
	<tr>
		<th>#</th>
		<th colspan="2">Turma</th>
		<th>Alunos</th>
		<th>Data</th>
		<th>Status</th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
		
		switch ($Status['id']) {	
			case Status::STATUS_CLASS_PENDENTE:
				$labelClass = 'warning';
				break;			
			case Status::STATUS_CLASS_INSCRICOES_ABERTAS:
				$labelClass = 'success';
				break;
			case Status::STATUS_CLASS_ENCERRADA:				
			case Status::STATUS_CLASS_INSCRICOES_FECHADAS:
				$labelClass = 'important';
				break;
		}
	?>
	<tr class="status-<?php echo $Status['id'] ?>">
		<td><?php echo $MyClass['id'] ?></td>
		<td><?php echo $MyClass['code'] ?></td>
		<td><?php echo $this->Html->link($MyClass['title'], array('action' => 'edit', $MyClass['id'])) ?></td>
		<td><?php echo count($Student) ?></td>
		<td><?php printf('%s até %s', $this->Time->format('d/m', $MyClass['start']), $this->Time->format('d/m', $MyClass['end'])) ?></td>
		<td><?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhum aluno encontrado')) ?>