<div class='container'>
	<div class='sixteen columns'>
		<h3>Operating System</h3>
		<p id="os_name_text">Operating System: <?php echo php_uname('s'); ?></p>
		<p id="os_kernel_text">Kernel: <?php echo php_uname('r'); ?></p>
		<p id="os_uptime_text">Uptime: <?php echo "$days days $hours hours $mins minutes and $secs seconds"; ?></p>
	</div>
</div>