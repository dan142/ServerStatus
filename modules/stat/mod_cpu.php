<div class='container'>
	<div class='six columns chart'>
		<canvas id="cpu" height="172" width="172"></canvas>
		<script>
			var data = {
				labels: [
					"Used",
					"Free"
				],
				datasets: [{
					data: [<?php echo $stat['cpu_usage']; ?>, 100 - <?php echo $stat['cpu_usage']; ?>],
					backgroundColor: ["#e74c3c", "#2980b9"],
					hoverBackgroundColor: ["#E43825", "#2573A7"],
					borderColor: ["#ccc", "#ccc"],
				}]
			};

			var options = {
				responsive: false,
				legend: {
           			display: false
        		},
		        tooltips: {
	                callbacks: {
	                    label: function(tooltipItem, data) {
	                        var value = data.datasets[0].data[tooltipItem.index];
	                        var label = data.labels[tooltipItem.index];
	                        return label + ': ' + value + '%';
	                    }
	                }
            	},
			};

			var canvas = document.getElementById("cpu");

			var ctx = canvas.getContext("2d");

			var cpu_chart = new Chart(ctx,{
			    type: 'pie',
			    data: data,
			    options: options
			});

			function poll_cpu_usage() {
				console.log("CPU Usage Request Sent");
				$.ajax({
				    type: "POST",
				    url: "./php/poll/poll_cpu_usage.php",
				    success: function(response){
				    	console.log("CPU Usage Response Recieved: "+response);
				    	cpu_chart.data.datasets[0].data[0] = response;
				    	cpu_chart.data.datasets[0].data[1] = 100 - response;
				    	cpu_chart.update(250, false);
				    	document.getElementById("cpu_usage_text").innerHTML = "CPU Usage: " + response + "%";
				        return response;
				    }
				});
			}
			
			setInterval(function() {
				poll_cpu_usage();
			}, 2000);

		</script>

	</div>
	<div class='ten columns'>
		<h3>CPU</h3>
		<p id="cpu_model_text">CPU Model: <?php echo $stat['cpu_model']; ?></p>
		<p id="cpu_usage_text">CPU Usage: <?php echo $stat['cpu_usage'],"%"; ?></p>
	</div>
</div>