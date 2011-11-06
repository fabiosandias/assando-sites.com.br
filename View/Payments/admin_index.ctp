<?php
$this->set('subtitle_for_layout', '&ndash; ' . $this->Paginator->counter(array('format' => '%count%')) . ' pagamentos');

$this->Bootstrap->addCrumb('Pagamentos');
?>


<?php if (!empty($data)) { ?>
<table class="zebra-striped">
<thead>
	<tr>
		<th>#</th>
		<th>Aluno</th>
		<th>Valor</th>
		<th>Forma de pagamento</th>
		<th>Status</th>
		<th>Cadastro</th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($data AS $row):
		extract($row);
		
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
	<tr class="status-<?php echo $Status['id'] ?>">
		<td><?php echo $Payment['id'] ?></td>
		<td><?php echo $this->Html->link($Student['fullname'], array('controller' => 'students', 'action' => 'edit', $Student['id'])) ?></td>
		<td><?php echo $this->Number->format($Payment['value'], array('places' => 2, 'decimals' => ',', 'before' => 'R$ ')) ?></td>
		<td><?php echo $PaymentMethod['name'] ?></td>
		<td><?php echo $this->Html->tag('span', $Status['name'], array('class' => 'label ' . $labelClass)) ?></td>
		<td class="center"><?php echo $this->Time->format('d/m ~ H:i', $Payment['datetime']) ?></td>
	</tr>
	<?php endforeach ?>
</tbody>
</table>

<?php echo $this->element('admin/pagination') ?>

<?php } else echo $this->element('admin/alerts/inline', array('class' => 'warning', 'message' => 'Nenhum aluno encontrado')) ?>