<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>ServerStatus | Configuration</title>
	<meta name="description" content="ServerStatus">
	<link rel="shortcut icon" href="../img/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="../css/reset.min.css">
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/skeleton.min.css">
	<meta name="theme-color" content="#333">
	<meta name="msapplication-navbutton-color" content="#333">

	<script type="text/javascript" src="../js/jquery-1.12.3.min.js"></script>

	<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);

		if(isset($_GET['submit'])){
			include '../php/write_ini_file.php';
			$ini_write = array(
				'display' => array(
	                'os' => isset($_GET["os_display"]) ? "1":"0",
	                'memory' => isset($_GET["memory_display"]) ? "1":"0",
	                'hdd1' => isset($_GET["hdd1_display"]) ? "1":"0",
	                'hdd2' => isset($_GET["hdd2_display"]) ? "1":"0",
	                'hdd3' => isset($_GET["hdd3_display"]) ? "1":"0",
	                'cpu' => isset($_GET["cpu_display"]) ? "1":"0",
	                'network' => isset($_GET["network_display"]) ? "1":"0",
	                ),
				'hdd1' => array(
	                'path' => $_GET["hdd1_path"],
	                ),
				'hdd2' => array(
	                'path' => $_GET["hdd2_path"],
	                ),
				'hdd3' => array(
	                'path' => $_GET["hdd3_path"],
	                ),
				'network' => array(
	                'interface' => $_GET["network_interface"],
	                ),
				);
			write_ini_file($ini_write, './server_conf.ini', true);
			header( 'Location: ../') ;
		}

		$root = "../";
		$config = parse_ini_file ("server_conf.ini", true);
		$df = shell_exec("df --output='target'");
		$dflist = substr($df, 11, -1);
		$dfarray = explode("\n", $dflist);
		$ls = shell_exec("ls /sys/class/net");
		$lslist = substr($ls, 0, -1);
		$lsarray = explode("\n", $lslist);
	?>

</head>

<body>
	<?php include $root.'modules/common/mod_header.php' ?>

<!--Content-->

	<form name="form" id="form" method="get" action=./index.php>

		<div class='content' id='modules'>

			<div class='container'>
				<h2>Configuration</h2>
				<p>This page allows you to alter the options for the configurable modules included with ServerStatus. Be sure to hit submit when you're done!</p>
			</div>

			<?php include $root.'modules/conf/mod_modulepicker.php' ?>
			<?php include $root.'modules/conf/mod_serveroptions.php' ?>
			<?php include $root.'modules/conf/mod_styleoptions.php' ?>

		</div>

	</form>

<!--Footer-->

	<?php include $root.'modules/common/mod_footer.php' ?>

<!--Scripts-->



</body>
</html>