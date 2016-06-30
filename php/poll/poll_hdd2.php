<?php
	$stat['hdd2_free'] = round(disk_free_space($config['hdd2']['path']) / 1024 / 1024 / 1024, 2);
	$stat['hdd2_total'] = round(disk_total_space($config['hdd2']['path']) / 1024 / 1024/ 1024, 2);
	$stat['hdd2_used'] = $stat['hdd2_total'] - $stat['hdd2_free'];
	$stat['hdd2_percent'] = round(sprintf('%.2f',($stat['hdd2_used'] / $stat['hdd2_total']) * 100), 2);
?>