<?php
	$uptime = shell_exec("cut -d. -f1 /proc/uptime");
	$days = floor($uptime/60/60/24);
	$hours = $uptime/60/60%24;
	$mins = $uptime/60%60;
	$secs = $uptime%60;
	$result = "$days days $hours hours $mins minutes and $secs seconds";
	echo $result;
	return $result;
?>