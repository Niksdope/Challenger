<?php
	header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *");
    $host = "ngurins.cloudapp.net";
    $user = "niksdope";
    $pass = "shalle";
    $database = "project";
	
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	if($email == null || $password == null)
	{
		echo "E-mail and password are required";
	}
	else {
		$query = "SELECT email, password, type from users WHERE email='{$email}'"; 
		$connect = mysqli_connect($host,$user,$pass,$database) or die("Problem connecting.");
		$result = mysqli_query($connect,$query) or die("Bad Query.");
		
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		$row_num = mysqli_num_rows($result);
		
		if($row_num > 0 && $row ['password'] == $password)
		{
			echo (string)$row ['type'];
		}
		else{
			echo "E-mail and password did not match";
		}
		
		mysqli_close($connect);
	}
?>