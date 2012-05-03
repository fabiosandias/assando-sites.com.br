<pre>
<?php
foreach ($Students AS $Student) {
	printf('%s,%s,%s,%s,%s' . PHP_EOL, $Student['name'], $Student['surname'], $Student['email'], $Student['email'], substr(sha1($Student['email']), 0, 8));
}
?>
</pre>