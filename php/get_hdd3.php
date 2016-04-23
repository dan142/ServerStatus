<?php
	$stat['hdd3_free'] = round(disk_free_space($config['hdd3']['path']) / 1024 / 1024 / 1024, 2);
	$stat['hdd3_total'] = round(disk_total_space($config['hdd3']['path']) / 1024 / 1024/ 1024, 2);
	$stat['hdd3_used'] = $stat['hdd3_total'] - $stat['hdd3_free'];
	$stat['hdd3_percent'] = round(sprintf('%.2f',($stat['hdd3_used'] / $stat['hdd3_total']) * 100), 2);
?>