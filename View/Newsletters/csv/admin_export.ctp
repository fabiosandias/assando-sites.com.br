<?php

foreach ($contacts AS $contact) {
	echo join(',', $contact['Newsletter']) . PHP_EOL;
}