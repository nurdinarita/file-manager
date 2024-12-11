<?php 
// $fileName = $_FILES["datafile"]["name"];
// // baca file temporary upload
// $fileTemp = $_FILES["datafile"]["tmp_name"];
// //baca tipe file
// $fileType = $_FILES["datafile"]["type"];
// //baca filesize
// $fileSize = $_FILES["datafile"]["size"];
// // proses upload file ke folder / upload
	
	$dir = $_POST['dir']; 
	$folder = "..".$dir; 
	foreach($_FILES['f']['name'] as $key =>$value){ 
	    if($value){ 
	        $tmp_name = $_FILES["f"]["tmp_name"][$key]; 
	        $up = move_uploaded_file($tmp_name, "$folder/$value");
	    } 
	} 
	// if (move_uploaded_file($fileTemp, 'DataFolder/'.$fileName)) {
	// 	echo "Upload $fileName selesai";
	// } 
	header("location:index.php?dir=$dir"); 
	?> 