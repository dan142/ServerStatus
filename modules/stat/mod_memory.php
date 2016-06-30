<div class='container'>
	<div class='six columns chart'>
		<canvas id="memory" height="172" width="172"></canvas>
		<script>		
			var data = {
				labels: [
					"Used",
					"Free"
				],
				datasets: [{
					data: [<?php echo $stat['memory_used']; ?>, <?php echo $stat['memory_free']; ?>],
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
	                        return label + ': ' + value + 'GB';
	                    }
	                }
            	},
			};

			var canvas = document.getElementById("memory");

			var ctx = canvas.getContext("2d");

			var memory_chart = new Chart(ctx,{
			    type: 'pie',
			    data: data,
			    options: options
			});

			function poll_memory_usage() {
				console.log("Memory Usage Request Sent");
				$.ajax({
				    type: "POST",
				    url: "./php/poll/poll_memory_free.php",
				    success: function(response){
				    	console.log("Memory Usage Response Recieved: "+response);
				    	memory_chart.data.datasets[0].data[0] = (<?php echo $stat['memory_total']; ?> - response).toFixed(3);
				    	memory_chart.data.datasets[0].data[1] = Number(response).toFixed(3);
				    	memory_chart.update(250, false);
				    	document.getElementById("memory_percent_text").innerHTML = "Percentage Used: " + (100-((response/<?php echo $stat['memory_total']; ?>) *100)).toFixed(2) + "%";
				    	document.getElementById("memory_free_text").innerHTML = "Free Memory: " + Number(response).toFixed(3) + " GB";
				    	document.getElementById("memory_used_text").innerHTML = "Used Memory: " + (<?php echo $stat['memory_total']; ?> - response).toFixed(3) + " GB";
				        return response;
				    }
				});
			}
			
			setInterval(function() {
				poll_memory_usage();
			}, 2000);

		</script>
	</div>
	<div class='ten columns'>
		<h3>Memory</h3>
		<p id="memory_percent_text">Percentage Used: <?php echo $stat['memory_percent'],"%"; ?></p>
		<p id="memory_total_text">Total Memory: <?php echo $stat['memory_total']," GB"; ?></p>
		<p id="memory_free_text">Free Memory: <?php echo $stat['memory_free']," GB"; ?></p>
		<p id="memory_used_text">Used Memory: <?php echo $stat['memory_used']," GB"; ?></p>
	</div>
</div>