<?php 
	$f = $_GET['f']; 
$xfile = "..".$f; 
if(is_dir($xfile)){ 
    rmdir($xfile);
	}else{ 
	    unlink($xfile); 
	} 
	$dirx = explode("/",$f); 
	$diry = ""; 
	for($i=0;$i<(count($dirx)-1);$i++){ 
	    $diry = $diry.$dirx[$i]."/"; 
	} 
	$diry = substr($diry,0,-1); 
	header("location:index.php?dir=$diry"); 
	
	?> 