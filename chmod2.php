<?php 
	$f = $_POST['f']; 
	$chmod = "0".$_POST['chmod']; 
	$file = "..".$f; 
	chmod($file,$chmod); 
	$dirx = explode("/",$f); 
	$diry = ""; 
	for($i=0;$i<(count($dirx)-1);$i++){ 
	    $diry = $diry.$dirx[$i]."/"; 
	} 
		$diry = substr($diry,0,-1);//untuk mendapatkan parent direktori 
	header("location:index.php?dir=$diry"); 
	?> 