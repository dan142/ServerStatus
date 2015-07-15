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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Crete+Round&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="./css/reset.min.css">
	<link rel="stylesheet" href="./css/base.css">
	<link rel="stylesheet" href="./css/skeleton.min.css">

	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
	<?php
		$config = parse_ini_file('./conf/serverstatus.ini');
		$displayos = $config["displayos"];
		$displaymemory = $config['displaymemory'];
		$displayhdd1 = $config['displayhdd1'];
		$displayhdd2 = $config['displayhdd2'];
		$displayhdd3 = $config['displayhdd3'];
		$displaycpu = $config['displaycpu'];
		$displaynetwork = $config['displaynetwork'];
		//os stat
		if ($displayos != false) {
			$uptime = shell_exec("cut -d. -f1 /proc/uptime");
			$days = floor($uptime/60/60/24);
			$hours = $uptime/60/60%24;
			$mins = $uptime/60%60;
			$secs = $uptime%60;
		}
		//cpu stat
		if ($displaycpu != false) {
			$prevVal = shell_exec("cat /proc/stat");
			$prevArr = explode(' ',trim($prevVal));
			$prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
			$prevIdle = $prevArr[5];
			usleep(0.15 * 1000000);
			$val = shell_exec("cat /proc/stat");
			$arr = explode(' ', trim($val));
			$total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
			$idle = $arr[5];
			$intervalTotal = intval($total - $prevTotal);
			$stat['cpu'] =  intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
			$cpu_result = shell_exec("cat /proc/cpuinfo | grep model\ name");
			$stat['cpu_model'] = strstr($cpu_result, "\n", true);
			$stat['cpu_model'] = str_replace("model name	: ", "", $stat['cpu_model']);
		}
		//memory stat
		if ($displaymemory != false) {
			$stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
			$stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
			$stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];
		}
		//hdd1 stat
		if ($displayhdd1 != false) {
			$hdd1path = $config['hdd1path'];
			$stat['hdd1_free'] = round(disk_free_space("$hdd1path") / 1024 / 1024 / 1024, 2);
			$stat['hdd1_total'] = round(disk_total_space("$hdd1path") / 1024 / 1024/ 1024, 2);
			$stat['hdd1_used'] = $stat['hdd1_total'] - $stat['hdd1_free'];
			$stat['hdd1_percent'] = round(sprintf('%.2f',($stat['hdd1_used'] / $stat['hdd1_total']) * 100), 2);
		}
		//hdd2 stat
		if ($displayhdd2 != false) {
			$hdd2path = $config['hdd2path'];
			$stat['hdd2_free'] = round(disk_free_space("$hdd2path") / 1024 / 1024 / 1024, 2);
			$stat['hdd2_total'] = round(disk_total_space("$hdd2path") / 1024 / 1024/ 1024, 2);
			$stat['hdd2_used'] = $stat['hdd2_total'] - $stat['hdd2_free'];
			$stat['hdd2_percent'] = round(sprintf('%.2f',($stat['hdd2_used'] / $stat['hdd2_total']) * 100), 2);
		}
		//hdd3 stat
		if ($displayhdd3 != false) {
			$hdd3path = $config['hdd3path'];
			$stat['hdd3_free'] = round(disk_free_space("$hdd3path") / 1024 / 1024 / 1024, 2);
			$stat['hdd3_total'] = round(disk_total_space("$hdd3path") / 1024 / 1024/ 1024, 2);
			$stat['hdd3_used'] = $stat['hdd3_total'] - $stat['hdd3_free'];
			$stat['hdd3_percent'] = round(sprintf('%.2f',($stat['hdd3_used'] / $stat['hdd3_total']) * 100), 2);
		}
		//network stat
		if ($displaynetwork != false) {
			$interface = $config['interface'];
			$stat['network_rx'] = round(trim(file_get_contents("/sys/class/net/$interface/statistics/rx_bytes")) / 1024/ 1024/ 1024, 2);
			$stat['network_tx'] = round(trim(file_get_contents("/sys/class/net/$interface/statistics/tx_bytes")) / 1024/ 1024/ 1024, 2);
		}
	?>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
	<header>
		<a id="top"></a>

<!--Navigation-->

		<nav>
			<div class='container'>
				<div class='sixteen columns'>
					<h1 id="logotext">ServerStatus</h1>
				</div>
			</div>
		</nav>
	</header>

<!--Content-->

	<div class='content' id='profiles'>
		<?php if ($displayos != false): ?>
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
		<?php if ($displaymemory != false): ?>
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
		<?php if ($displayhdd1 != false): ?>
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
				<h3>Hard Drive 1 (<?php echo $hdd1path; ?>)</h3>
				<p>Hard Drive Usage: <?php echo $stat['hdd1_percent'],"%"; ?><br>
				Hard Drive Capacity: <?php echo $stat['hdd1_total']," GB"; ?><br>
				Hard Drive Free Space: <?php echo $stat['hdd1_free']," GB"; ?><br>
				Hard Drive Used Space: <?php echo $stat['hdd1_used']," GB"; ?>
				</p>
			</div>
		</div>
		<?php endif ?> 
		<?php if ($displayhdd2 != false): ?>
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
					<h3>Hard Drive 2 (<?php echo $hdd2path; ?>)</h3>
					<p>Hard Drive Usage: <?php echo $stat['hdd2_percent'],"%"; ?><br>
					Hard Drive Capacity: <?php echo $stat['hdd2_total']," GB"; ?><br>
					Hard Drive Free Space: <?php echo $stat['hdd2_free']," GB"; ?><br>
					Hard Drive Used Space: <?php echo $stat['hdd2_used']," GB"; ?>
					</p>
				</div>
			</div>
		<?php endif ?>
		<?php if ($displayhdd3 != false): ?>
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
					<h3>Hard Drive 3 (<?php echo $hdd3path; ?>)</h3>
					<p>Hard Drive Usage: <?php echo $stat['hdd3_percent'],"%"; ?><br>
					Hard Drive Capacity: <?php echo $stat['hdd3_total']," GB"; ?><br>
					Hard Drive Free Space: <?php echo $stat['hdd3_free']," GB"; ?><br>
					Hard Drive Used Space: <?php echo $stat['hdd3_used']," GB"; ?>
					</p>
				</div>
			</div>
		<?php endif ?> 
		<?php if ($displaycpu != false): ?>
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
		<?php if ($displaynetwork != false): ?>
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
				<h5>GitHub</h5>
				<p>Visit the ServerStatus <a href='https://github.com/dan142/ServerStatus'>GitHub page</a> to access the documentation or to help by submitting improvements.</p>
			</div>
		</div>
	</footer>

<!--Scripts-->



</body>
</html>