<?php
	header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *");
    $host = "ngurins.cloudapp.net";
    $user = "niksdope";
    $pass = "shalle";
    $database = "project";
	
	$email = $_GET['email'];
	
	$query = "SELECT completed, total from users WHERE email='{$email}'"; 
	$connect = mysqli_connect($host,$user,$pass,$database) or die("Problem connecting.");
	$result = mysqli_query($connect,$query) or die("Bad Query.");
	
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($row);
	
	mysqli_close($connect);
?>