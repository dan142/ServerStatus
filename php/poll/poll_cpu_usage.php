<?php
	$prevVal = shell_exec("cat /proc/stat");
	$prevArr = explode(' ',trim($prevVal));
	$prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
	$prevIdle = $prevArr[5];
	usleep(0.15 * 1000000);
	$val = shell_exec("cat /proc/stat");
	$arr = explode(' ', trim($val));
	$total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
	$idle = $arr[5];
	$intervalTotal = intval($total - $prevTotal);
	$result = intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
	echo $result;
	return $result;
?>