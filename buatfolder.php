<?php 
$folder = $_POST['folder']; 
	$dir = $_POST['dir']; 
	mkdir("..".$dir."/".$folder, 0775); 
	header("location:index.php?dir=$dir"); 
	?> 