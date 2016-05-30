<?php

session_start();
$id = $_SESSION['id'];
$name = $_POST["n"];

mkdir("/var/www/html/webday/name/$id/$name",0777,true);

?>