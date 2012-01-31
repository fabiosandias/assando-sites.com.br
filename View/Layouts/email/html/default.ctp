<div style="border-top: 5px solid #f08c94; border-bottom: 10px solid #CCC; border-left: 1px solid #EEE; border-right: 1px solid #EEE; padding: 5px 20px; border-radius: 6px; max-width: 750px">
<?php echo $this->fetch('content') ?>
	<p>Atenciosamente,</p>
	<p style="color: silver">--</p>
	<p><strong style="font-size: 1.2em">Assando Sites</strong><br /><em>Curso online de CakePHP</em><br /><?php echo $this->Html->link($this->Html->url('/', true)) ?></p>
</div>