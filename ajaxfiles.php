<?php
session_start();
$id = $_SESSION[id];

$t = $_POST['t'];

$dir = "/var/www/html/webday/name/$id/*";
		
$uploads = glob($dir);





if($t == "Files"){
	echo"<table class = 'table table-hover table-striped' style='100%'>";
	echo"<form id = 'Files' method = 'POST' action='download.php'>";
	foreach($uploads as $value)
	{
		
		$len = strlen($id) + 27;
		$row = substr($value,$len);
		$url = "/webday/name/$id/".$row;
		$path_parts = pathinfo($url);
		$ext = $path_parts['extension'];
		
		
		if ($ext == "mp3" or $ext == "jpg" or $ext == "JPG" or $ext == "png" or $ext == "gif" or $ext == "m4a"){
			
			
			
		}else{
			
			echo "<tr>";
			
				echo"<td>"; 
				
					echo "<a href='$url' target='_blank'>$value</a>";
		
				echo"</td>";
				
				echo"<td>";
					
					echo "File Extention: $ext";
				
				echo"</td>";
				
				echo"<td>"; 
			
					echo"<li class='list-group-item'>Select: <input type='checkbox' name = 'chk[]' value = '$value'></li>";
			
				echo"</td>";
				
			echo"</tr>";			
				

		};
			
	}
	echo"</form>";
	echo"</table>";
}



if($t == "Music"){
	echo"<table class = 'table table-hover table-striped' style='100%'>";
	echo"<form id = 'Files' method = 'POST' action='download.php'>";
	foreach($uploads as $value)
	{
		
		$len = strlen($id) + 27;
		$row = substr($value,$len);
		$url = "/webday/name/$id/".$row;
		$path_parts = pathinfo($value);
		$ext = $path_parts['extension'];
		$base = $path_parts['basename'];
		
		if ($ext == "mp3" or $ext == "m4a"){
			
			echo "<tr>";
			
				echo"<td>"; 
				
					echo "<img src='' style = 'height:100px;width:100px' alt='$base'>";
		
				echo"</td>";
				
				echo"<td>";
				
					echo"<span>$base</span>";
					
				echo"</td>";
				
				echo"<td>";
				
					echo"<input type='submit' class='btn btn-primary' value='Play' onclick='playaudio(\"$url\",\"$base\");'>";
					
				echo"</td>";
			
				echo"<td>"; 
			
					echo"<li class='list-group-item'>Select: <input type='checkbox' name = 'chk[]' value = '$value'></li>";
			
				echo"</td>";
				
			echo"</tr>";			
				

		};
			
	}
	echo"</form>";
	echo"</table>";	

	
	
	
}

if($t == "Pictures"){
	echo"<table class = 'table table-hover table-striped' style='100%'>";
	echo"<form id = 'Files' method = 'POST' action='download.php'>";
	foreach($uploads as $value)
	{
		
		$len = strlen($id) + 27;
		$row = substr($value,$len);
		$url = "/webday/name/$id/".$row;
		$path_parts = pathinfo($value);
		$ext = $path_parts['extension'];
		
		if ($ext == "jpg" or $ext == "JPG" or $ext == "png" or $ext == "gif"){
			
			echo "<tr>";
			
				echo"<td>"; 
				
					echo "<img src='$url' style = 'height:100px;width:100px' alt='$value'>";
		
				echo"</td>";
				
				echo"<td>"; 
			
					echo"<li class='list-group-item'>Select: <input type='checkbox' name = 'chk[]' value = '$value'></li>";
			
				echo"</td>";
				
			echo"</tr>";			
				

		};
			
	}
	echo"</form>";
	echo"</table>";	
}





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


?>
