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