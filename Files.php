<html>
<head>
	<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
<!-- Latest compiled JavaScript -->
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>

<style>

.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.logo {
    color: #f4511e;
    font-size: 100px;
	padding:25px;
}


</style>



</head>
<body>
	
	<div class='row'>
	
	<div class='col-sm-2'>
	<center>
      <span class="glyphicon glyphicon-hdd logo" onclick="location='http://Erkcurley.net'"></span>
	</center>
    </div>
	
	<div class='col-sm-10'>
		<div id = 'data' class='logo'></div>
		<div> </div>
		
		<div id='progress'></div>
		
		
	</div>
		
	</div>
	
	<div style = 'padding:75px'>
	
		<div class='row'>
  		
		
		<?php 
		session_start();
		
		if($_SESSION[username] == ""){
			echo"<script>location = 'http://erkcurley.net'</script>";
		};
		$id = $_SESSION[id];

		echo "<h1>Welcome: $_SESSION[username] ";
		echo " <input type='submit' class='btn btn-primary'  value='Files' onclick='Filestable(\"Files\");'>";
		echo " <input type='submit' class='btn btn-primary'  value='Music' onclick='Filestable(\"Music\");'>";
		echo " <input type='submit' class='btn btn-primary'  value='Pictures' onclick='Filestable(\"Pictures\");'>";
		echo "</h1>";
		
		echo"<br>";
		echo"<div id='audioplayer'></div>";
		echo"<br>";
	?>
		
		
		
		
		
		<div class='col-sm-2'>
			
			<ul class="list-group">
			
 				
				<form action="upload.php" method="post" multipart="" enctype="multipart/form-data">
						<li class="list-group-item"><input type="file"  class='btn btn-primary' name="userfile[]" style="width:100%" id="fileToUpload" multiple="multiple"></li>
						<li class="list-group-item"><input type="submit" class='btn btn-primary' style="width:100%" value="Upload" name="submit"></li>
				</form>
				
				
					<li class="list-group-item"><input type="submit" class='btn btn-primary' style="width:100%" value="Download" onclick="document.getElementById('Files').submit();" name="submit"></li>
					<li class="list-group-item"><input type="submit" class='btn btn-primary' style="width:100%" value="New Folder" onclick="CreateDir();"></li>
						
			</ul>
			<ul class="list-group">
				<li class="list-group-item"><input type="submit" class='btn btn-danger' style="width:100%" value="Delete" onclick="home();"></li>
			</ul>
		
		
		
		</div>
		
		
		
		<script type="text/javascript">
		function home()
		{
			
			var chk_arr =  document.getElementsByName("chk[]");
				var chklength = chk_arr.length;             

				for(k=0;k<chklength;k++)
					{
						
						if(chk_arr[k].checked == true){
							
							par1 = chk_arr[k].value;
							
							var xhttp = new XMLHttpRequest();
							name = par1;
							xhttp.open("POST", "deletefiles.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("n="+name);
							
							};
						
						
					} 
			
			setTimeout(location.reload(),100);
			
		}
		
		function CreateDir()
		{
			
			var xhttp = new XMLHttpRequest();
			
			name = window.prompt('Name:');
			
			xhttp.open("POST", "createdir.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//xhttp.send("n="+name);
			
			
			setTimeout(location.reload(),100);
			
		}
		
		function Filestable(par1)
		{
			
			
			var xhttp = new XMLHttpRequest();
			
			xhttp.onreadystatechange = function() {
            
			if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("ajaxcontent").innerHTML = xhttp.responseText;
            }
			};
			
			
			xhttp.open("POST", "ajaxfiles.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("t="+par1);
			
		}
		
		function playaudio(url,name)
		{
			
			document.getElementById('audioplayer').innerHTML = "<center><span>"+name+":</span><span>      </span><audio controls><source src='"+url+"' type='audio/mpeg'>Your browser does not support the audio element.</audio><center>";
			
		}
		
		
		</script>
		
		
		
		
		
<?php





		$dir = "/var/www/html/webday/name/$id/*";
		
		$uploads = glob($dir);
			
			
		$space = disk_total_space("/var/www/html/webday/name/$id");
		
		$totalsize = 0;
		
		for($i=0;$i<count($uploads);$i++){
			
			$filesize = filesize($uploads[$i]);

			$totalsize = $totalsize + $filesize;
			
		};
		
		echo"<div class='col-sm-10' style = 'border:2px;height:75%'>";
		echo"<div><span id = 'ajaxcontent'></span></div>";
		
		/*
		
		echo"<table class = 'table table-hover table-striped' style='100%'>";
		
		echo"<form id = 'Files' method = 'POST' action='download.php'>";
		
		
		
		for($i=0;$i<count($uploads);$i++){
			
			$Key = 'File'+$i;
			
			$len = strlen($id) + 27;
			
			$row = substr($uploads[$i],$len);
			
			$url = "/webday/name/$id/".$row;
				
			
				
			$start = strlen($row) - 3;	
			
			$fext = substr($row,$start,3);
			
			
			if ($fext == "jpg" or $fext == "JPG" or $fext == "png" or $fext == "gif"){
				$purl = $url;
			}else{
				$purl = "";
			};
			
			if ($fext == "mp3"){
				$purl = $url;
			}else{
				$purl = "";
			};
			
			
			
			if (is_dir($uploads[$i])){
				$box = "<img src='' style = 'height:100px;width:100px' alt='$uploads[$i]'>";
			}else if($fext == "mp3"){
				$box = "<a href='$purl' target='_blank'><img src='' style = 'height:100px;width:100px' alt='$row'></a>";
			}else{
				$box = "<a href='$purl' target='_blank'><img src='$purl' style = 'height:100px;width:100px' alt='$row'></a>";
			};
			
				
				
			echo "<tr>";
			echo"<td>"; 
				
				echo"$box";
		
			echo"</td>";
			
			echo"<td>"; 
			
				echo"<li class='list-group-item'>Select: <input type='checkbox' name = 'chk[]' value = '$uploads[$i]'></li>";
			
			echo"</td>";
			echo"</tr>";
			
		}; 
		
		echo"</form>";
		echo"</table>";
		*/
		
		$storage = $totalsize;
		$totalsize = number_format($totalsize,0,".",",");
		$Size = substr($totalsize,0,strpos($totalsize,","));
	
		$digits = strlen($totalsize);
		
		if($digits >= 0 and $digits <= 4) {
			$totalsize = $totalsize . "B";
		}else if ($digits > 4 and $digits <= 8){
			$totalsize = $Size . "KB";
		}else if ($digits >8 and $digits <=12){
			$totalsize = $Size . "MB";
		}else if($digits >12 and $digits <=16){
			$totalsize = $Size . "GB";
		};
		
		
		$maxstorage = 20000000000;
		$percent = $storage / $maxstorage;
		$percent = round($percent,2)*100;
		
		$totalsize = $totalsize . " / " . 20 . "GB" ;
		
		if($percent < 50){
			
			$progressbar = "<div class='progress'><div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='width:$percent%'>$percent%</div></div>";
			
		}else if($percent < 75){
			
			$progressbar = "<div class='progress'><div class='progress-bar progress-bar-warning progress-bar-striped active' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='width:$percent%'>$percent%</div></div>";
			
		}else{
			
			$progressbar = "<div class='progress'><div class='progress-bar progress-bar-danger progress-bar-striped active' role='progressbar' aria-valuenow='$percent' aria-valuemin='0' aria-valuemax='100' style='width:$percent%'>$percent%</div></div>";
			
		};
		
		
		
		echo"<script> document.getElementById('progress').innerHTML = \"$progressbar\" </script>";
		echo"<script> document.getElementById('data').innerHTML = '$totalsize'</script>";



		
		
			
		
		
		?>	
	
	
	
			</div>
		</div>
	
	</div>



</body>
</html>



