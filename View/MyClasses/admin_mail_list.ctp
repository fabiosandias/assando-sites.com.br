<pre>
<?php
foreach ($Students AS $Student) {
	printf('"%s" &lt;%s&gt;,' . "\r\n", $Student['fullname'], $Student['email']);
}
?>
</pre>