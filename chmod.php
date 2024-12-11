<html> 
<head><title>DRZ File Manager 1.0</title> 
	</head> 
	<body> 
	<h2>DRZ File Manager V1.0</h2> 
	<form action=chmod2.php method=post> 
	File/Folder : 
	<?php 
	$f = $_GET['f']; 
	echo $f; 
	?> 
	<br> 
		CHMOD menjadi : <input type=text name=chmod size=3 maxlength="3"> Contoh : 777<br> 
	<input type=hidden name=f value="<?php echo $f; ?>"> 
	<input type=submit value=Ubah> 
	</form> 
	</body> 
	</html> 