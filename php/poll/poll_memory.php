<?php
	$stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
	$mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
	$stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
	$mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
	$stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
	$stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];
?>