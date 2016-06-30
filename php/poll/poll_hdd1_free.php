<?php
	$result = round(disk_free_space($config['hdd1']['path']) / 1024 / 1024 / 1024, 2);
	echo $result;
	return $result;
?>