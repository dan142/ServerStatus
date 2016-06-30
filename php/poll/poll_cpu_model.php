<?php
	$cpu_result = shell_exec("cat /proc/cpuinfo | grep model\ name");
	$output = strstr($cpu_result, "\n", true);
	$result = str_replace("model name	: ", "", $output);
	echo $result;
	return $result;
?>