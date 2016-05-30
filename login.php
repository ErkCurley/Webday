<?php
session_start();

	$id = $_POST[id];
	$pass = $_POST[pass];

	include 'db.php';


   	
	$connection = mysqli_connect($host_name, $user_name, $password, $database) or die(mysqli_error);
	
	$sql = "select * from users where username = '$id' and password = '$pass'";

	$recordSet = mysqli_query($connection,$sql);
	
	
	if ($record = mysqli_fetch_array($recordSet, MYSQLI_ASSOC)) {
				
				$_SESSION[id] = $id;
				
				$_SESSION[username] = $record[username];
				
				echo"<script>location='Files.php'</script>";
				
				

   		 } else {
   		 
				echo"<h1>User not found</h1>";
				echo"<a href='signup.html'>Sign Up now!</a>";

   		 };

	
	mysqli_free_result($record);

		
	mysqli_close($connection);


?>