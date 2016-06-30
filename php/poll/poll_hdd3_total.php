<?php
	$result = round(disk_total_space($config['hdd3']['path']) / 1024 / 1024/ 1024, 2);
	echo $result;
	return $result;
?>