<?php
	$stat['hdd1_free'] = round(disk_free_space($config['hdd1']['path']) / 1024 / 1024 / 1024, 2);
	$stat['hdd1_total'] = round(disk_total_space($config['hdd1']['path']) / 1024 / 1024/ 1024, 2);
	$stat['hdd1_used'] = $stat['hdd1_total'] - $stat['hdd1_free'];
	$stat['hdd1_percent'] = round(sprintf('%.2f',($stat['hdd1_used'] / $stat['hdd1_total']) * 100), 2);
?>