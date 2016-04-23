<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<!--<meta http-equiv="X-UA-Compatible" content="IE=9" />-->
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

	<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		include '../php/write_ini_file.php';
		if(isset($_GET['submit'])){
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
			write_ini_file($ini_write, './conf.ini', true);
			header( 'Location: ../') ;
			}
	?>
	<?php
		$config = parse_ini_file ("conf.ini", true);
		$df = shell_exec("df --output='target'");
		$dflist = substr($df, 11, -1);
		$dfarray = explode("\n", $dflist);
		$ls = shell_exec("ls /sys/class/net");
		$lslist = substr($ls, 0, -1);
		$lsarray = explode("\n", $lslist);
	?>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
	<header>
		<a id="top"></a>
		<div class='container'>
			<div class='sixteen columns'>
				<h1><a href='../'>ServerStatus</a></h1>
			</div>
		</div>
	</header>

<!--Content-->

	<form name="form" id="form" method="get" action=./index.php>
	<div class='content' id='modules'>
		<div class='container'>
			<h2>Configuration</h2>
				<p>This page allows you to alter the options for the configurable modules included with ServerStatus. Be sure to hit submit when you're done!</p>
		</div>
		<div class='container'>
            <h3>Modules to Display</h3>
			<p>This will allow you to choose which modules are shown on the page.</p>
			<br>
			<form name="display_form" id="display_form" method="get" action=./index.php>
	            <h5>OS</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="os_display" <?php $display = $config["display"]["os"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <h5>Memory</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="memory_display" <?php $display = $config["display"]["memory"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <h5>HDD1</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="hdd1_display" <?php $display = $config["display"]["hdd1"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <h5>HDD2</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="hdd2_display" <?php $display = $config["display"]["hdd2"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
		        </div>
	            <h5>HDD3</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="hdd3_display" <?php $display = $config["display"]["hdd3"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <h5>CPU</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="cpu_display" <?php $display = $config["display"]["cpu"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <h5>Network</h5>
	            <div>
		            <label class="switch">
		            	<input type="checkbox" name="network_display" <?php $display = $config["display"]["network"]; if ($display != '0'){echo "checked";};?>>
		            	<div class="slider"></div>
		            </label>
	        	</div>
	            <button type="submit" value="submit" class="submit" name="submit">Submit</button>
	        </form>
		</div>
		<div class='container'>
			<h3>Options</h3>
				<h4>Hard Drives</h4>
				<h5>HDD1 Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored by the HDD1 module. Detected mountpoints are listed below.</p>
                <select name="hdd1_path" id="hdd1_path">
                    <?php 
                    $display = $config["hdd1"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <h5>HDD2 Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored by the HDD2 module. Detected mountpoints are listed below.</p>
                <select name="hdd2_path" id="hdd2_path">
                    <?php 
                    $display = $config["hdd2"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <h5>HDD3 Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored by the HDD3 module. Detected mountpoints are listed below.</p>
                <select name="hdd3_path" id="hdd3_path">
                    <?php 
                    $display = $config["hdd3"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
            <br>
            <br>
            <br>
			<h4>Network</h4>
				<h5>Interface</h5>
				<p>This will allow you to select the network interface that is to be monitored. Detected interfaces are listed below.</p>
                <select name="network_interface" id="network_interface">
                    <?php 
                    $display = $config["network"]["interface"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($lsarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <div>
                	<button type="submit" value="submit" class="submit" name="submit">Submit</button>
                </div>
		</div>
	</div>
</form>

<!--Footer-->

	<footer>
		<div class='container'>
			<div class='eight columns'>
				<h5>Configure</h5>
				<p>Visit the <a href='./conf'>configuration</a> page to alter which modules are displayed by ServerStatus, or to modify the content of them.</p>
			</div>
			<div class='eight columns'>
				<h5>GitHub</h5>
				<p>Visit the ServerStatus <a href='https://github.com/dan142/ServerStatus'>GitHub page</a> to access the documentation or to help by submitting improvements.</p>
			</div>
		</div>
	</footer>

<!--Scripts-->



</body>
</html>