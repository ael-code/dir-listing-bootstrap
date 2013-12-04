<?php

function format_bytes($size){
			
	$sizes = array('&nbsp&nbspB', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	$count = 0;
	while( $count < (count( $sizes )-1) and $size > 1024){
		$size = $size/1024;
		$count ++;
	}
	$result = sprintf("%.2f %s", $size, $sizes[$count]);
	return $result;
}

function choose_icon($name){

	$ext = strrchr( $name , '.');
	$ext = ltrim($ext , '.');
	$ext = strtolower($ext); 
	
	$types = array(
	"audio" => array("aif","iff","m3u","m4a","mid","mp3","mpa","ra","wav","wma"),
	"video" => array("avi","mkv","3gp","asf","asx","3g2","flv","m4v","mov","mp4","mpg","rm","srt","swf","vob","wmv"),
	"image" => array("gif","jpg","jpeg","png","psd","pspimage","tga","thm","tif","tiff","yuv","svg","bmp","dds"),
	"text" => array("doc","docx","log","msg","odt","pages","rtf","tex","txt","wpd","wps","pdf"),
	"zip" => array("7z","deb","gz","pkg","rar","rpm",".tar.gz","zip","zipx","jar"),
	"disk" => array("bin","cue","dmg","iso","mdf","toast","vcd"),
	"code" => array("java","c","class","pl","py","sh","cpp","cs","dtd","fla","h","lua","m","sln"),
	"excel" => array("xlr","xls","xlsx")
	);
	$icons = array(
	"audio" => "glyphicon-music",
	"video" => "glyphicon-film",
	"image" => "glyphicon-picture",
	"text" => "glyphicon-file",
	"zip" => "glyphicon-compressed",
	"disk" => "glyphicon-record",
	"code" => "glyphicon-indent-left",
	"excel" => "glyphicon-list-alt",
	"generic" => "glyphicon-unchecked"
	);

	foreach( $types as $elem_i => $elem_v){
		if(in_array($ext, $elem_v)){
			return $icons[$elem_i];
		}
	}
	return $icons['generic'];
}

function get_file_size($file){
	include 'dir_listing_config.php';
	
	if( $use_du_command === true){
		return get_file_size_du($file);
	}else{
		//undefined result for file > 2GB on 32bit 
		return fileSize($file);
	}
}

function get_file_size_du($file){
	exec("du -LsB 1 \"$file\"",$exec);
		return $exec[0];
}

?>
