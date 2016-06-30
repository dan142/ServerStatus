<div class='container'>
    <h3>Modules to Display</h3>
	<p>This will allow you to choose which modules are shown on the page.</p>
	<br>
            
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

    	<div>
        	<button type="submit" value="submit" class="submit" name="submit">Submit</button>
        </div>

</div>