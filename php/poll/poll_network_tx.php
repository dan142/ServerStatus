<?php
	$result = round(trim(file_get_contents("/sys/class/net/".$config['network']['interface']."/statistics/tx_bytes")) / 1024/ 1024/ 1024, 2);
	echo $result;
	return $result;
?>