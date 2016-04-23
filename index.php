<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<!--<meta http-equiv="X-UA-Compatible" content="IE=9" />-->
	<meta charset="utf-8">
	<title>ServerStatus</title>
	<meta name="description" content="ServerStatus">
	<link rel="shortcut icon" href="./img/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="./css/reset.min.css">
	<link rel="stylesheet" href="./css/base.css">
	<link rel="stylesheet" href="./css/skeleton.min.css">
	<meta name="theme-color" content="#333">
	<meta name="msapplication-navbutton-color" content="#333">

	<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php
		$config = parse_ini_file('./conf/conf.ini', true);
		if ($config["display"]["os"] != false) {
			include './php/get_os.php';
		}
		if ($config["display"]["cpu"] != false) {
			include './php/get_cpu.php';
		}
		if ($config["display"]["memory"] != false) {
			include './php/get_memory.php';
		}
		if ($config["display"]["hdd1"] != false) {
			include './php/get_hdd1.php';
		}
		if ($config["display"]["hdd2"] != false) {
			include './php/get_hdd2.php';
		}
		if ($config["display"]["hdd3"] != false) {
			include './php/get_hdd3.php';
		}
		if ($config["display"]["network"] != false) {
			include './php/get_network.php';
		}
	?>

</head>

<body>
	<header>
		<a id="top"></a>
		<div class='container'>
			<div class='sixteen columns'>
				<h1><a href='./'>ServerStatus</a></h1>
			</div>
		</div>
	</header>

<!--Content-->

	<div class='content' id='modules'>
		<?php if ($config["display"]["os"] != false): ?>
		<div class='container'>
			<div class='sixteen columns'>
				<h3>Operating System</h3>
				<p>Operating System: <?php echo php_uname('s'); ?><br>
				Kernel: <?php echo php_uname('r'); ?><br>
				Uptime: <?php echo "$days days $hours hours $mins minutes and $secs seconds"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
		<?php if ($config["display"]["memory"] != false): ?>
		<div class='container'>
			<div class='six columns chart'>
				<canvas id="memory" height="172" width="172"></canvas>
				<script>
					var data = [
					    {
					    	label: "Used",
					        value: <?php echo $stat['mem_used']; ?>,
					        color: "#e74c3c",
					        highlight: "#E43825"
					    },
					    {
					    	label: "Free",
					        value: <?php echo $stat['mem_free']; ?>,
					        color:"#2980b9",
					        highlight: "#2573A7"
					    }
					];
					var options = {animateRotate:false, animateScale:false, segmentStrokeColor : "#ccc", tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' GB' %>"};
					var canvas = document.getElementById("memory");
					var ctx = canvas.getContext("2d");
					new Chart(ctx).Pie(data,options);
				</script>
			</div>
			<div class='ten columns'>
				<h3>Memory</h3>
				<p>Percentage Used: <?php echo $stat['mem_percent'],"%"; ?><br>
				Total Memory: <?php echo $stat['mem_total']," GB"; ?><br>
				Free Memory: <?php echo $stat['mem_free']," GB"; ?><br>
				Used Memory: <?php echo $stat['mem_used']," GB"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
		<?php if ($config["display"]["hdd1"] != false): ?>
		<div class='container'>
			<div class='six columns chart'>
				<canvas id="hdd1" height="172" width="172"></canvas>
				<script>
					var data = [
					    {
					    	label: "Used",
					        value: <?php echo $stat['hdd1_used']; ?>,
					        color: "#e74c3c",
					        highlight: "#E43825"
					    },
					    {
					    	label: "Free",
					        value: <?php echo $stat['hdd1_free']; ?>,
					        color:"#2980b9",
					        highlight: "#2573A7"
					    }
					];
					var options = {animateRotate:false, animateScale:false, segmentStrokeColor : "#ccc", tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' GB' %>"};
					var canvas = document.getElementById("hdd1");
					var ctx = canvas.getContext("2d");
					new Chart(ctx).Pie(data,options);
				</script>
			</div>
			<div class='ten columns'>
				<h3>Hard Drive 1 (<?php echo $config['hdd1']['path']; ?>)</h3>
				<p>Hard Drive Usage: <?php echo $stat['hdd1_percent'],"%"; ?><br>
				Hard Drive Capacity: <?php echo $stat['hdd1_total']," GB"; ?><br>
				Hard Drive Free Space: <?php echo $stat['hdd1_free']," GB"; ?><br>
				Hard Drive Used Space: <?php echo $stat['hdd1_used']," GB"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
		<?php if ($config["display"]["hdd2"] != false): ?>
			<div class='container'>
				<div class='six columns chart'>
					<canvas id="hdd2" height="172" width="172"></canvas>
					<script>
						var data = [
						    {
						    	label: "Used",
						        value: <?php echo $stat['hdd2_used']; ?>,
						        color: "#e74c3c",
						        highlight: "#E43825"
						    },
						    {
						    	label: "Free",
						        value: <?php echo $stat['hdd2_free']; ?>,
						        color:"#2980b9",
						        highlight: "#2573A7"
						    }
						];
						var options = {animateRotate:false, animateScale:false, segmentStrokeColor : "#ccc", tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' GB' %>"};
						var canvas = document.getElementById("hdd2");
						var ctx = canvas.getContext("2d");
						new Chart(ctx).Pie(data,options);
					</script>
				</div>
				<div class='ten columns'>
					<h3>Hard Drive 2 (<?php echo $config['hdd2']['path']; ?>)</h3>
					<p>Hard Drive Usage: <?php echo $stat['hdd2_percent'],"%"; ?><br>
					Hard Drive Capacity: <?php echo $stat['hdd2_total']," GB"; ?><br>
					Hard Drive Free Space: <?php echo $stat['hdd2_free']," GB"; ?><br>
					Hard Drive Used Space: <?php echo $stat['hdd2_used']," GB"; ?>
					</p>
				</div>
			</div>
		<?php endif ?>
		<?php if ($config["display"]["hdd3"] != false): ?>
			<div class='container'>
				<div class='six columns chart'>
					<canvas id="hdd3" height="172" width="172"></canvas>
					<script>
						var data = [
						    {
						    	label: "Used",
						        value: <?php echo $stat['hdd3_used']; ?>,
						        color: "#e74c3c",
						        highlight: "#E43825"
						    },
						    {
						    	label: "Free",
						        value: <?php echo $stat['hdd3_free']; ?>,
						        color:"#2980b9",
						        highlight: "#2573A7"
						    }
						];
						var options = {animateRotate:false, animateScale:false, segmentStrokeColor : "#ccc", tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' GB' %>"};
						var canvas = document.getElementById("hdd3");
						var ctx = canvas.getContext("2d");
						new Chart(ctx).Pie(data,options);
					</script>
				</div>
				<div class='ten columns'>
					<h3>Hard Drive 3 (<?php echo $config['hdd3']['path']; ?>)</h3>
					<p>Hard Drive Usage: <?php echo $stat['hdd3_percent'],"%"; ?><br>
					Hard Drive Capacity: <?php echo $stat['hdd3_total']," GB"; ?><br>
					Hard Drive Free Space: <?php echo $stat['hdd3_free']," GB"; ?><br>
					Hard Drive Used Space: <?php echo $stat['hdd3_used']," GB"; ?>
					</p>
				</div>
			</div>
		<?php endif ?> 
		<?php if ($config["display"]["cpu"] != false): ?>
		<div class='container'>
			<div class='six columns chart'>
				<canvas id="cpu" height="172" width="172"></canvas>
				<script>
					var data = [
					    {
					    	label: "Used",
					        value: <?php echo $stat['cpu']; ?>,
					        color: "#e74c3c",
					        highlight: "#E43825"
					    },
					    {
					    	label: "Free",
					        value: 100 - <?php echo $stat['cpu']; ?>,
					        color:"#2980b9",
					        highlight: "#2573A7"
					    }
					];
					var options = {animateRotate:false, animateScale:false, segmentStrokeColor : "#ccc", tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + '%' %>"};
					var canvas = document.getElementById("cpu");
					var ctx = canvas.getContext("2d");
					new Chart(ctx).Pie(data,options);
				</script>
			</div>
			<div class='ten columns'>
				<h3>CPU</h3>
				<p>CPU Model: <?php echo $stat['cpu_model']; ?><br>
				CPU Usage: <?php echo $stat['cpu'],"%"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
		<?php if ($config["display"]["network"] != false): ?>
		<div class='container'>
			<div class='six columns chart'>
				<canvas id="net" height="172" width="240"></canvas>
				<script>
					var data = {
					    labels: ["TX", "RX"],
					    datasets: [
					        {
					            label: "value",
					            fillColor: "#2980b9",
					            strokeColor: "#CCCCCC",
					            highlightFill: "#2573A7",
					            data: [<?php echo $stat['network_tx']; ?>, <?php echo $stat['network_rx']; ?>]
					        },
					    ]
					};
					var options = {animation : false, scaleLabel : "<%=value%>GB", scaleBeginAtZero : true, scaleShowGridLines : false, barValueSpacing : 20, scaleShowVerticalLines: false, scaleShowHorizontalLines: false, tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' GB' %>"};
					var canvas = document.getElementById("net");
					var ctx = canvas.getContext("2d");
					new Chart(ctx).Bar(data,options);
				</script>
			</div>
			<div class='ten columns'>
				<h3>Network</h3>
				<p>IP Address: <?php echo $_SERVER['SERVER_ADDR']; ?><br>
				Network Tx: <?php echo $stat['network_tx']," GB"; ?><br>
				Network Rx: <?php echo $stat['network_rx']," GB"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
	</div>

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