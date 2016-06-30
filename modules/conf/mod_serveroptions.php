<div class='container'>
	<h3>Server Options</h3>
	
		<h4>Hard Drives</h4>
		
			<h5>HDD1 Drive Root</h5>
			<p>This will allow you to set the location of the drive that is to be monitored by the HDD1 module. Detected mountpoints are listed below.</p>
	        <select name="hdd1_path" id="hdd1_path">
                <?php 
                    $display = $config["hdd1"]["path"];
                    echo "<option value='$display'>$display</option>";
                    foreach ($dfarray as $k => $v ) {
                    	if($v == $display) {
                    	    continue;
                    	}
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
                    	if($v == $display) {
                    	    continue;
                    	}
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
                    	if($v == $display) {
                    	    continue;
                    	}
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
                    	if($v == $display) {
                    	    continue;
                    	}
						echo "<option value='$v'>$v</option>";
					}
				?>
            </select>
        <div>
        	<button type="submit" value="submit" class="submit" name="submit">Submit</button>
        </div>
</div>