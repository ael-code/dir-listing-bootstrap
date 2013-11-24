<!DOCTYPE html>
<html>
	<head>
		<!-- Bootstrap -->
		<link href="/dirl/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<!-- Icon -->
		<link rel="icon" href="/dirl/favicon32.ico">
		<title><?php echo $_SERVER['REQUEST_URI'] ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
      	body {
      	  padding-top: 60px;
      	 }
   	</style>
	</head>
	<!--page content-->
	<body>
	
	<?php
include 'dir_listing_func.php';
include 'dir_listing_config.php';


//PATH

	$path = $_SERVER['REQUEST_URI'];
	//Substitute %xx characters
	$path = rawurldecode($path);
	//Remove first '/'
	$path = ltrim($path , '/');
	//Create full path
	$full_path = $_SERVER['DOCUMENT_ROOT'].$path;

//END PATH

//BREADCRUMB

	$folders=explode('/',$path);
	$fathers=count($folders)-2;

	echo "		<div class='container navbar-fixed-top'>\n";
	echo "			<ol class='breadcrumb'>\n";

	//fathers path
	for($i=0;$i<$fathers;++$i){
	echo "			<li><a href='";
		for($j=0;$j<($fathers-$i);++$j){
		echo '../';
		}
	echo "'>".htmlentities($folders[$i])."</a></li>\n";
	}

	//this folder
	echo "			<li class='active'>".htmlentities($folders[$fathers])."</li>\n";
	echo "			</ol>\n";
	echo "		</div>\n";


//END_BREADCRUMB

//TABLE

	$dir_handle = opendir($full_path);
	
	//error opening folder
	if($dir_handle == false){
		echo "<br><br><div class='container'><div class='alert alert-danger text-center'><strong>Error!</strong> failed to open folder </div></div>\n";
		break;
	}
	
	$folderlist = array();
	$filelist = array();
		
	while( false !== ($entry = readdir($dir_handle))){
		
		if ( ( strpos($entry,'.') === 0 and $show_hidden_file===true) | $entry == "." | $entry == ".." ){
		}else if ( is_dir( $full_path.$entry ) ) {
			$folderlist[] = $entry;	
		}else{
			$filelist[] = $entry;
		}
	}
	
	//foldere is empty
	if(count ($folderlist) == 0 and count ($filelist) == 0){
		echo '<br><br><div class="container"><div class="alert alert-info text-center"><strong>This folder is empty</strong></div></div>';
		break;
	}
	
	//print files table	
		//print header
		echo'
		<div class="container">
			<table class="table table-condensed table-hover">
			<thead>
				<th width="35"></th>
				<th class="text-primary">Name</th>
	  			<th width="89" class="text-primary text-center">Dim</th>';
	  	if($show_modified_time === true)
	  		echo'
	  			<th class="text-primary text-center">Last modified</th>';
	  	echo'
	  		</thead>';
	 	
	 	//print folder
		foreach ($folderlist as $val) {
			echo '
			<tr>
				<td><span class="glyphicon glyphicon-folder-open"></span></td>
				<td><a href="'.rawurlencode($val).'">'.htmlentities($val).'</td>
				<td class="text-center">-</td>';
			
			if($show_modified_time === true)
				echo'
				<td></td>';
			echo'
			</tr>';
		}
	
		//print file
		foreach ($filelist as $val) {
		echo '
			<tr>
				<td><span class="glyphicon '.choose_icon($val).'"></span></td>
				<td><a href="'.rawurlencode($val).'">'.htmlentities($val).'</td>
				<td class="text-right">'. format_bytes(get_file_size($full_path.$val)) .'</td>';
		
		if($show_modified_time === true)
	  		echo'
	  			<td class="text-center"><small>'.date("d/m/y H:i:s",filectime($full_path.$val)).'</small></td>';
		echo '
			</tr>';
		
		}
		echo '
			</table>
		</div>'."\n";
	//end files table print
	
?>
		<div class="container">
			<p class="text-right"><a href="https://github.com/ael-code/dir-listing-bootstrap" class="text-muted"><small>Ael's php directory listing</small></a></p>
		</div>

	 	<!-- jQuery (necessary for Bootstrap's JavaScript plugins)--> 
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/dirl/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
