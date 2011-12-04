<?php
$testmonials = $this->requestAction(array('controller' => 'testmonials', 'action' => 'index'));

if (!empty($testmonials)) {
?>
<h2 class="grid_12">Opinião de quem já participou</h2>

<?php
foreach ($testmonials AS $row) {
	extract($row);

	$gravatar = gravatar($author['email']);
?>
<article class="grid_6" itemscope itemtype="http://schema.org/Person">
	<?php echo $this->Html->image($gravatar, array('alt' => $author['name'], 'class' => 'avatar', 'width' => 70, 'height' => 70, 'itemprop' => 'image')) ?>
	<?php echo $this->Html->tag('cite', $message) ?>
	<h3><?php echo $this->Html->tag('span', $author['name'], array('itemprop' => 'name')) . (isset($author['twitter']) ? ' &ndash; ' . $this->Html->link("@{$author['twitter']}", "http://twitter.com/{$author['twitter']}", array('rel' => 'external', 'itemprop' => 'url')) : '') ?></h3>
</article>
<?php } } ?>