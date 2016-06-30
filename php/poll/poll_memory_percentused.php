<?php
	$result = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
	echo $result;
	return $result;
?>