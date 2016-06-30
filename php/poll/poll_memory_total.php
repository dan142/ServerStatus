<?php
	$mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
	$result = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
	echo $result;
	return $result;
?>