<?php

include'db.php';
$connection = mysqli_connect($host_name, $user_name, $password, $database) or die(mysqli_error);



session_start();
$dir = $_SESSION['id'];
$target_dir = "/var/www/html/webday/name/$dir/";

move_uploaded_file($_FILES["userfile"]["tmp_name"][$val], $target_file);

foreach ($_FILES["userfile"]["error"] as $key => $error) {
    
	if ($error == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES["userfile"]["tmp_name"][$key];
        $name = $_FILES["userfile"]["name"][$key];
        move_uploaded_file($tmp_name, "$target_dir/$name");
		
		
		
		$path_parts = pathinfo("$target_dir/$name");
		$ext = $path_parts['extension'];
		
		if($ext == "jpg" or $ext == "JPG"){
			
			
			$exif = exif_read_data("$target_dir/$name");
			
			
			$ImageID = md5_file("$target_dir/$name");
			
			echo "$ImageID";
			
			$ImageDate = $exif['DateTime'];

			$lon = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
			$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
			
			
			
			echo "$ImageID <br>";
			
			if(isset($ImageID)){
				$sql = "insert into image (imageId,DateTime,GPSLAT,GPSLON) values ('$ImageID','$ImageDate',$lat,$lon)";
				mysqli_query($connection,$sql);	
			
			}
		}
		
    }
}


function getGps($exifCoord, $hemi) {

    $degrees = count($exifCoord) > 0 ? gps2Num($exifCoord[0]) : 0;
    $minutes = count($exifCoord) > 1 ? gps2Num($exifCoord[1]) : 0;
    $seconds = count($exifCoord) > 2 ? gps2Num($exifCoord[2]) : 0;

    $flip = ($hemi == 'W' or $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

}

function gps2Num($coordPart) {

    $parts = explode('/', $coordPart);

    if (count($parts) <= 0)
        return 0;

    if (count($parts) == 1)
        return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);
}

mysqli_close($connection);

?>
<script>history.go(-1) </script>