<?php
	$stat['network_rx'] = round(trim(file_get_contents("/sys/class/net/".$config['network']['interface']."/statistics/rx_bytes")) / 1024/ 1024/ 1024, 2);
	$stat['network_tx'] = round(trim(file_get_contents("/sys/class/net/".$config['network']['interface']."/statistics/tx_bytes")) / 1024/ 1024/ 1024, 2);
?>