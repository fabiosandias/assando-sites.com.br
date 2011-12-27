<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' arquivos');

$this->Bootstrap->addCrumb('Arquivos');
?>

<?php if (!empty($data)) { ?>
<table class="bordered-table zebra-striped">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('MyFile.id', '#') ?></th>
		<th colspan="2"><?php echo $this->Paginator->sort('MyFile.title', 'Arquivo') ?></th>
		<th><?php echo $this->Paginator->sort('MyFile.description', 'Descrição') ?></th>
		<th><?php echo $this->Paginator->sort('MyClass.code', 'Turma') ?></th>
		<th><?php echo $this->Paginator->sort('MyFile.created', 'Cadastro') ?></th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
		
		switch ($MyFile['status_id']) {	
			case STATUS_ATIVO:
				$labelClass = 'success';
				break;			
			case STATUS_INATIVO:
				$labelClass = 'warning';
				break;
			case STATUS_DELETADO:
				$labelClass = 'important';
				break;
		}
	?>
	<tr>
		<td><?php echo $MyFile['id'] ?></td>
		<td><?php echo $this->Html->link($MyFile['title'], array('action' => 'edit', $MyFile['id'])) ?></td>
		<td><?php echo $this->Html->link(end(explode('.', $MyFile['location'])), $MyFile['location']) ?></td>
		<td><?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?> <?php echo $this->Text->truncate($MyFile['description'], 100) ?></td>
		<td><?php echo $this->Html->tag('span', $MyClass['code'], array('class' => 'label', 'style' => 'background: ' . stringToColor($MyClass['code']))) ?></td>
		<td class="center"><?php echo $this->Time->format('d/m ~ H:i', $MyFile['created']) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhum arquivo encontrado')) ?>
