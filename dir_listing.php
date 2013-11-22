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
		<title>Dir listing</title><!-- @@@@@@@@dinamic-->
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

	//echo '	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">'."\n";
	echo "	<div class='container navbar-fixed-top'>\n";
	echo "		<ol class='breadcrumb'>\n";

	//fathers path
	for($i=0;$i<$fathers;++$i){
	echo "			<li><a href='";
		for($j=0;$j<($fathers-$i);++$j){
		echo '../';
		}
	echo "'>".$folders[$i]."</a></li>\n";
	}

	//this folder
	echo "			<li class='active'>".$folders[$fathers]."</li>\n";
	echo "		</ol>\n";
	echo "	</div>\n";
	//echo "	</nav>\n";


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
		if ($entry == "." | $entry == ".."){
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
		echo'
	
		<div class="container">
			<table class="table table-condensed table-hover">
			<thead>
				<th></th>
				<th class="text-primary">Name</th>
	  			<th class="text-primary text-center">Dim</th>
	  		</thead>';
	 
		foreach ($folderlist as $val) {
			echo '
				<tr>
				<td><span class="glyphicon glyphicon-folder-open"></span></td>
				<td><a href="'.$val.'">'.$val.'</td>
				<td class="text-center"> &nbsp&nbsp- </td>
			</tr>';
		}
	
		foreach ($filelist as $val) {
		echo '
		<tr>
			<td><span class="glyphicon '.choose_icon($val).'"></span></td>
			<td><a href="'.$val.'">'.$val.'</td>
			<td class="text-right">'. format_bytes(get_file_size($full_path.$val)) .'</td>
			</tr>';
		}
		echo '
			</table>
		</div>';
	//end files table print
	
?>
		<div class="container">
			<p class="text-right"><a href="https://github.com/ael-code/dir-listing-bootstrap" class="text-muted"><small>Ael's php directory listing</small></a></p>
		</div>

	 	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/dirl/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
