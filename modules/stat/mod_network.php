<div class='container'>
	<div class='six columns chart'>
		<canvas id="network" height="172" width="240"></canvas>
		<script>		
			var data = {
				labels: [
					"TX",
					"RX"
				],
				datasets: [{
					data: [<?php echo $stat['network_tx']; ?>, <?php echo $stat['network_rx']; ?>],
					backgroundColor: ["#2980b9", "#2980b9"],
					hoverBackgroundColor: ["#2573A7", "#2573A7"],
					borderColor: ["#ccc", "#ccc"],
					borderWidth: 2,
				}]
			};

			var options = {
				responsive: false,
				legend: {
           			display: false,
        		},
		        tooltips: {
	                callbacks: {
	                    label: function(tooltipItem, data) {
	                        var value = data.datasets[0].data[tooltipItem.index];
	                        var label = data.labels[tooltipItem.index];
	                        return value + 'GB';
	                    }
	                }
            	},
            	scales: {
	                yAxes: [{
	                    gridLines: {
	                        display: false,
	                    },
	                    ticks: {
		                    userCallback: function(value, index, values) {
	                            value = value.toString();
	                            return value + 'GB';
	                        },
	                        fontColor: "#ccc",
	                    },
	                }],
	                xAxes: [{
	                    gridLines: {
	                        display: false,
	                    },
	                    ticks: {
	                    	fontColor: "#ccc",
	                    }
	                }]
	            }
			};

			var canvas = document.getElementById("network");

			var ctx = canvas.getContext("2d");

			var network_chart = new Chart(ctx,{
			    type: 'bar',
			    data: data,
			    options: options
			});

		</script>
	</div>
	<div class='ten columns'>
		<h3>Network</h3>
		<p id="network_ip_text">IP Address: <?php echo $_SERVER['SERVER_ADDR']; ?></p>
		<p id="network_tx_text">Network Tx: <?php echo $stat['network_tx']," GB"; ?></p>
		<p id="network_rx_text">Network Rx: <?php echo $stat['network_rx']," GB"; ?></p>
		</p>
	</div>
</div>