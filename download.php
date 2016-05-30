<?php
session_start();
$id = $_SESSION[id];
mkdir("/var/www/html/webday/name/$id/temp",0777,true);
mkdir("/var/www/html/webday/name/$id/temp/temp",0777,true);


	
foreach($_POST as $key => $file){
	
		$path = "/var/www/html/webday/name/$id/";
		
        $name = substr($file,strlen($path),strlen($file)-strlen($path));
	
	

	copy($file,"/var/www/html/webday/name/$id/temp/temp/$name");
	
	
	
};

$z = new ZipArchive();
$z->open("/var/www/html/webday/name/$id/test".rand().".zip", ZIPARCHIVE::CREATE);
folderToZip("/var/www/html/webday/name/$id/temp", $z);
$z->close();

$dir = "/var/www/html/webday/name/$id/temp/";

delTree($dir);

function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 

echo"<script>window.history.go(-1)</script>";




function folderToZip($folder, &$zipFile, $subfolder = null) {
    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
    $folder .= end(str_split($folder)) == "/" ? "" : "/";
    $subfolder .= end(str_split($subfolder)) == "/" ? "" : "/";
    // we start by going through all files in $folder
    $handle = opendir($folder);
    while ($f = readdir($handle)) {
        if ($f != "." && $f != "..") {
            if (is_file($folder . $f)) {
                // if we find a file, store it
                // if we have a subfolder, store it there
                if ($subfolder != null)
                    $zipFile->addFile($folder . $f, $subfolder . $f);
                else
                    $zipFile->addFile($folder . $f);
            } elseif (is_dir($folder . $f)) {
                // if we find a folder, create a folder in the zip 
                $zipFile->addEmptyDir($f);
                // and call the function again
                folderToZip($folder . $f, $zipFile, $f);
            }
        }
    }
}
?>