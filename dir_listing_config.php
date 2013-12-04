<?php
	//show hidden file, starting with '.'  (default: false)
	$show_hidden_files = false;
	
	//show last modified time (default: false)
	$show_modified_time = false;
	
	
	// use unix du command to calculate file/folder size (default: false)
	// useful on 32bit machine because php function filesize() has undefined results on this architecture
	// on raspberryPi set to true
	$use_du_command = false;
	
		//show also folders size using du (default: false)
		//works only if $use_du_command is true,
		//ATTENTION! may require lot of time (recursive)
		$show_folders_size = false;
?>

