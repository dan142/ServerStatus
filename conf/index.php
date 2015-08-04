<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>ServerStatus</title>
	<meta name="description" content="ServerStatus">
	<link rel="shortcut icon" href="../img/favicon.png" />
	<!--<meta http-equiv="X-UA-Compatible" content="IE=9" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="../css/reset.min.css">
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/skeleton.min.css">

	<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		function write_ini_file($assoc_arr, $path, $has_sections=FALSE) { 
		    $content = ""; 
		    if ($has_sections) { 
		        foreach ($assoc_arr as $key=>$elem) { 
		            $content .= "[".$key."]\n"; 
		            foreach ($elem as $key=>$elem2) { 
		                if(is_array($elem2)) 
		                { 
		                    for($i=0;$i<count($elem2);$i++) 
		                    { 
		                        $content .= $key."[] = \"".$elem2[$i]."\"\n"; 
		                    } 
		                } 
		                else if($elem2=="") $content .= $key." = \n"; 
		                else $content .= $key." = \"".$elem2."\"\n"; 
		            } 
		        } 
		    } 
		    else { 
		        foreach ($assoc_arr as $key=>$elem) { 
		            if(is_array($elem)) 
		            { 
		                for($i=0;$i<count($elem);$i++) 
		                { 
		                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
		                } 
		            } 
		            else if($elem=="") $content .= $key." = \n"; 
		            else $content .= $key." = \"".$elem."\"\n"; 
		        } 
		    } 

		    if (!$handle = fopen($path, 'w')) { 
		        return false; 
		    }

		    $success = fwrite($handle, $content);
		    fclose($handle); 

		    return $success; 
		}
	?>
	<?php
		if(isset($_GET['submit'])){
			$ini_write = array(
				'os' => array(
	                'display' => $_GET["os_display"],
	                ),
				'memory' => array(
	                'display' => $_GET["memory_display"],
	                ),
				'hdd1' => array(
	                'display' => $_GET["hdd1_display"],
	                'path' => $_GET["hdd1_path"],
	                ),
				'hdd2' => array(
	                'display' => $_GET["hdd2_display"],
	                'path' => $_GET["hdd2_path"],
	                ),
				'hdd3' => array(
	                'display' => $_GET["hdd3_display"],
	                'path' => $_GET["hdd3_path"],
	                ),
				'cpu' => array(
	                'display' => $_GET["cpu_display"],
	                ),
				'network' => array(
	                'display' => $_GET["network_display"],
	                'interface' => $_GET["network_interface"],
	                ),
				);
			write_ini_file($ini_write, './conf.ini', true);
			header( 'Location: ../') ;
			}
	?>
	<?php
		$settings = parse_ini_file ("conf.ini", true);
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

	<form name=”form” id=”form” method=”get” action=./index.php>
	<div class='content' id='modules'>
		<div class='container'>
			<h2>Configuration</h2>
				<p>This page allows you to alter the options for each module included with ServerStatus. Be sure to hit submit at the bottom when you're done!</p>
		</div>
		<div class='container'>
			<h3>Operating System</h3>
				<h5>Display</h5>
				<p>This will allow you to choose whether or not to display the Operating System section of the page.</p>
				<br>
                <select name="os_display" id="os_display">
                    <option value="1" <?php $display = $settings["os"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0"<?php $display = $settings["os"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
                <br>
		</div>
		<div class='container'>
			<h3>Memory</h3>
				<h5>Display</h5>
				<p>This will allow you to choose whether or not to display the Memory section of the page.</p>
				<br>
                <select name="memory_display" id="memory_display">
                    <option value="1" <?php $display = $settings["memory"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["memory"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
                <br>
		</div>
		<div class='container'>
			<h3>Hard Drives</h3>
				<br>
				<h4>HDD1</h4>
				<br>
				<h5>Display</h5>
				<p>This will allow you to choose whether or not to display the Hard Drive 1 section of the page.</p>
				<br>
                <select name="hdd1_display" id="hdd1_display">
                    <option value="1" <?php $display = $settings["hdd1"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["hdd1"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
				<h5>Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored. Detected mountpoints are listed below.</p>
				<br>
                <select name="hdd1_path" id="hdd1_path">
                    <?php 
                    $display = $settings["hdd1"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <br>
                <h4>HDD2</h4>
                <br>
                <h5>Display</h5>
                <p>This will allow you to choose whether or not to display the Hard Drive 2 section of the page. This is useful if you want to see metrics for more than one drive or partition.</p>
                <br>
                <select name="hdd2_display" id="hdd2_display">
                    <option value="1" <?php $display = $settings["hdd2"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["hdd2"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
				<h5>Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored. Detected mountpoints are listed below.</p>
				<br>
                <select name="hdd2_path" id="hdd2_path">
                    <?php 
                    $display = $settings["hdd2"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <br>
                <h4>HDD3</h4>
                <br>
                <h5>Display</h5>
                <p>This will allow you to choose whether or not to display the Hard Drive 3 section of the page. This is useful if you want to see metrics for more than one drive or partition.</p>
                <br>
                <select name="hdd3_display" id="hdd3_display">
                    <option value="1" <?php $display = $settings["hdd3"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["hdd3"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
				<h5>Drive Root</h5>
				<p>This will allow you to set the location of the drive that is to be monitored. Detected mountpoints are listed below.</p>
				<br>
                <select name="hdd3_path" id="hdd3_path">
                    <?php 
                    $display = $settings["hdd3"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <br>
		</div>
		<div class='container'>
			<h3>CPU</h3>
				<h5>Display</h5>
				<p>This will allow you to choose whether or not to display the CPU section of the page.</p>
				<br>
                <select name="cpu_display" id="cpu_display">
                    <option value="1" <?php $display = $settings["cpu"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["cpu"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
                <br>
		</div>
		<div class='container'>
			<h3>Network</h3>
				<h5>Display</h5>
				<p>This will allow you to choose whether or not to display the Network section of the page.</p>
				<br>
                <select name="network_display" id="network_display">
                    <option value="1" <?php $display = $settings["network"]["display"]; if ($display != '0'){echo "selected";};?>>Display</option>
                    <option value="0" <?php $display = $settings["network"]["display"]; if ($display != '1'){echo "selected";};?>>Hide</option>
                </select>
                <br>
                <br>
				<h5>Interface</h5>
				<p>This will allow you to select the network interface that is to be monitored. Detected interfaces are listed below.</p>
				<br>
                <select name="network_interface" id="network_interface">
                    <?php 
                    $display = $settings["network"]["interface"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($lsarray as $k => $v ) {
						echo "<option value='$v'>$v</option>";
					}
					?>
                </select>
                <br>
                <br>
                <br>
                <button type="submit" value="submit" name="submit">Submit</button>
                <br>
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