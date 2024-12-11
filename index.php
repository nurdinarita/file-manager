<html> 
<head><title>WD File Manager 1.0</title> 
	<style> 
		table{font-family:arial;font-size:10pt} 
	</style>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"> 
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script> 

//membuat fungsi konfirmasi sebelum didelete 
function tanya(nama){ 
	x = confirm("Apakah anda akan mendelete\n"+nama); 
	if(x == 1){ 
        //jika user mengklik tombol OK 
        document.location = "del.php?f="+nama; 
    } 
} 
</script> 
</head> 
<body>
	<div class="container"> 
		
		<h2>WD File Manager V1.0</h2>
		
		<div class="row">
			<table class="table table-striped">
			<tr>
				<td>Path :</td>
			 
			<?php 
			ini_set("display_errors", 0);
			$dir = $_GET['dir']; 
			if(!$dir){ 
				echo "." ; 
			}else{ 
				// echo $dir;
				echo "<td><strong>$dir</strong><td>";
			}
	//kode di atas hanya untuk menampilkan path yang lagi dibuka 
			?>
		
			</tr>
		</table>
																	<!-- 450px -->
			<table class="table table-striped"> 
				<tr><td>File</td><td>Action</td><tr> 
					<?php 
	if(preg_match("/\/\.\./",$dir)){//untuk mencegah jika ada yang mengetik /../.. 
		die("tidak boleh"); 
	} 
	if ($handle = opendir("..".$dir)) { 
	//file browser.php ini kita letakkan di dalam folder filemanager 
	//sedangkan folder yang ingin diakses adalah folder parentnya 
	//maka kita selalu gunakan ".." 
		while (false !== ($file = readdir($handle))) { 
			if($file == ".."){ 
				if($dir!=""){ 
					$dirx = explode("/",$dir); 
					$diry = ""; 
					for($i=0;$i<(count($dirx)-1);$i++){ 
						$diry = $diry.$dirx[$i]."/";
					} 
	                $diry = substr($diry,0,-1);//untuk mendapatkan parent direktori 
	                if($diry == ""){ 
	                	echo "<tr><td colspan=2><a href='index.php'>UP</a></td></tr>"; 
	                }else{ 
	                	echo "<tr><td colspan=2><a href='index.php?dir=$diry'>UP</a></td></tr>"; 
	                } 
	            } 
	        }else if ($file != ".") { 
	            if(is_dir("../".$dir."/".$file)){//untuk mengetahui apakah file berupa direktori 
	            	$folder[] = "<tr><td><a class='fa fa-folder-o' href='index.php?dir=$dir/$file'> $file</a></td> 
	            	<td><a href=\"javascript:tanya('$dir/$file')\"><i class= 'fa fa-trash-o'> Del</i></a> | 
	            	<a href=\"chmod.php?f=$dir/$file\">CHMOD</a></td></tr>\n"; 
	            }else{ 
	            	$filenya[] = "<tr><td><a class='fa fa-file-o' href='..$dir/$file'> $file</a></td> 
	            	<td><a href=\"javascript:tanya('$dir/$file')\"><i class= 'fa fa-trash-o'> Del</i></a> | 
	            	<a href=\"chmod.php?f=$dir/$file\">CHMOD</a></td></tr>\n"; 
	            } 
	        } 
	    } 
	    //kita tampilkan yang berupa folder-folder 
	    for($i=0;$i<count($folder);$i++){ 
	    	echo $folder[$i];
	    } 
	    //sesudah menampilkan folder, kita tampilkan file-file 
	    for($i=0;$i<count($filenya);$i++){ 
	    	echo $filenya[$i];
	    } 
	    closedir($handle); 
	} 
	
	?> 
</table>
</div> 
<p> 
	<font size=2 color="#ababab"> 
		Catatan :<br> 
		Untuk delete folder, isi folder harus di kosongkan terdahulu<br> 
		CHMOD hanya untuk UNIX/Linux 
	</font>
</p> 
<p>
	<progress class="progress-bar" id="progressBar" value="0" max="100" style="width: 470px;"></progress>
</p>

		<div>
         	<!-- <form id="upload_form" enctype="multipart/form-data"> -->
         		<form method="post" action="upload.php" enctype="multipart/form-data">
					<p>
         			<input type="file" name="f[]" id="fileku">
					</p>
					<p id="status"></p>
         			<!-- <a class="btn btn-success fa fa-upload" onclick="uploadFile()"> Upload File</a> -->
         			<input type="submit" class="btn btn-success fa fa-upload" onclick="uploadFile()" value="Upload">
         			<a href="index.php" class="btn btn-warning fa fa-repeat"> Batal</a>
         			<!-- <input class="btn btn-warning" type=reset value="Batal"> -->
         			<a class="btn btn-info fa fa-folder-o" href="#" data-toggle="modal" data-target="#contact"> Add Folder</a>
         			</p>
         			<input type=hidden name=dir value="<?php echo $dir; ?>">
         			<h4 id="status"></h4>
         			<!-- <input type=submit value="upload"> -->
         		</form> 
        </div>
<!-- <progress id="progressBar" value="0" max="100" style="width: 300px;"></progress> -->
</div>

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4 class="modal-title" id="myModalLabel">Buat Folder</h4>
      </div>
      <div class="modal-body">
      	<form action="buatfolder.php" method="post"> 
      		Nama Folder : <input type="text" name="folder"> 
      		<input type=hidden name=dir value="<?php echo $dir; ?>"> 
      		<input type=submit value="Buat"> 
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	function uploadFile(){
			//Membaca data file yg akan diupload, dari komputer
			var file = document.getElementById('fileku').files[0];
			var formdata = new FormData();
			formdata.append("f[]", file);
			//proses upload via ajax di submit ke upload.php
			//selama proses upload, akan menalankan prosebar
			var ajax = new XMLHttpRequest();
			if (file == null ) {
			document.getElementById("status").innerHTML = "File Kosong";	
			}else {
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.open("POST", "upload.php", true);
				ajax.send(formdata);
			}
		}
			function progressHandler(event){
			//Hitung presentase
			var percent = (event.loaded / event.total) * 100;
			//enapilkan prosentase ke komponen  id progressbar
			document.getElementById("progressBar").value = Math.round(percent);
			document.getElementById("status").innerHTML = Math.round(percent)+"% telah terupload";
			$Tes = Math.round(percent);
			// menapilkan file size yg telah terupload dan totalnya ke komponen
			document.getElementById('total').innerHTML = "Telah terupload "+event.loaded+"bytes dari "+event.total;
			}

		</script>
<script src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script src="jquery-1.10.2.js"></script>
</body> 
</html> 