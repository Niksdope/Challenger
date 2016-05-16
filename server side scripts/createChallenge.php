<?php			
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *");
    $host = "ngurins.cloudapp.net";
    $user = "niksdope";
    $pass = "shalle";
    $database = "project";

    $challenge = $_GET['challenge'];
	$challengeExists = false;
	
	$querySelect = "SELECT * from challenges";
	$queryInsert = "INSERT into challenges values('', '{$challenge}')";
	
	$connect = mysqli_connect($host,$user,$pass,$database) or die("Problem connecting.");
    $result = mysqli_query($connect,$querySelect) or die("Bad Query.");
	
	while($row = $result->fetch_array()){
		if(strtolower($row ['challenge']) == strtolower($challenge)){
			echo "Challenge already exists";
			$challengeExists = true;
			break;
		}
	}
	
	if(!$challengeExists){
		$result = mysqli_query($connect,$queryInsert) or die("Bad Query.");
		echo "Challenge added";
	}
	
    mysqli_close($connect);
?>