
<center>

<h1>No Signups Yet</h1>

</center>

<?php


	include'db.php';

	$id = $_POST['id'];
	$firstpass = $_POST['pass'];
	$secondpass = $_POST['pass2'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];

	$connection = mysqli_connect($host_name, $user_name, $password, $database) or die(mysqli_error);
	
	$pass = $firstpass;
	
	$sql = "select * from users where username = '$id'";
	
	$recordSet = mysqli_query($connection,$sql);
	
	if($firstpass==$secondpass){
	
				
		if($id == null or $pass == null){
			
			echo"<center>";
	
			echo"<h1>Null VALUES are Unacceptable</h1>";
		
			echo"<a href='signup.html'>Try again</a>";
		
			echo"<center>";
			
		} else if ($record = mysqli_fetch_array($recordSet, MYSQLI_ASSOC)){
			
			echo"<center>";
		
			echo"<h1>ACCOUNT EXISTS</h1>";
		
			echo"<a href='signup.html'>Try again</a>";

			echo"</center>";
			
		} else {
			
			$sql= "insert into users (username,password,first,last,email) VALUES ('$id','$pass','$first','$last','$email')";
		
			mysqli_query($connection,$sql);
		
			mkdir("/var/www/html/webday/name/$id",0777,true);
		
			echo"<center>";
		
			echo"<h1>ACCOUNT CREATED</h1>";
		
			echo"<h1><a href='login.html'>Login</a></h1>";

			echo"</center>";
			
		};
		
		
		
	}else{
	
			echo"<center>";
	
			echo"<h1>PASSWORDS DO NOT MATCH</h1>";
		
			echo"<a href='signup.html'>Try again</a>";
		
			echo"<center>";
		
	};
	


	
	
mysqli_free_result($record);

mysqli_close($connection);


?>