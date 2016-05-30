<?php
$name = $_POST["n"];

if(is_file($name)){
	
	unlink($name);
	
};



?>

