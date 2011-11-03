<h2>Calendário de aulas</h2>

<?php
foreach ($MyClasses AS $row) {
	extract($row);
	
	$grid = floor(12 / max(1, count($Lesson)));
?>
<h3><?php echo $MyClass['title'] ?></h3>
<div class="aulas">
	<?php foreach ($Lesson AS $row) { ?>
	<article class="<?php echo (strtotime($row['datetime']) < time()) ? 'passado' : 'futuro' ?> grid_<?php echo $grid ?>">
		<datetime datetime="<?php echo $this->Time->format('c', $row['datetime']) ?>"><?php echo $this->Time->format('d/m - H:i', $row['datetime']) ?></datetime>
		<h4><?php echo $row['title'] ?></h4>
		<p><?php echo $row['description'] ?></p>
	</article>
	<?php } ?>
</div>
<?php } ?>

<h2 style="margin-top: 50px">Arquivos publicados</h2>

<?php
foreach ($MyClasses AS $row) {
	extract($row);	
?>
<h3><?php echo $MyClass['title'] ?></h3>
<div class="arquivos">
	<?php
	foreach ($MyFile AS $row) {
		$extension = end(explode('.', $row['location']));
	?>
	<article class="file grid_6 file-<?php echo $extension ?>">
		<h4><?php echo $this->Html->link($row['title'], array('controller' => 'my_files', 'action' => 'download', 'token' => sha1($row['location'])), array('rel' => 'external')) ?></h4>
		<p><?php echo $row['description'] ?></p>
	</article>
	<?php } ?>
</div>
<?php } ?>