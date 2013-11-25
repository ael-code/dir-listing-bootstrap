<?php
	//show hidden file, starting with '.'  (default: true)
	$show_hidden_file = true;
	
	//show last modified time (default: false)
	$show_modified_time = false;
	
	// use unix du command to calculate file size (default: false)
	// useful on 32bit machine because php function filesize() has undefined results on this architecture
	// on raspberryPy set to true
	$use_du_command = false;
?>

