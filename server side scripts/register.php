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
	
	function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $challenges = range($min, $max);
    shuffle($challenges);
    return array_slice($challenges, 0, $quantity);
	}
	
	$queryMaxChallenges = "SELECT id from challenges ORDER BY id DESC LIMIT 1";
	$query = "SELECT email from users where email = '{$email}'";
	$connect = mysqli_connect($host,$user,$pass,$database) or die("Problem connecting.");
	$maxResult = mysqli_query($connect,$queryMaxChallenges) or die("Bad Query(find user).");
	$lastRow = $maxResult->fetch_array();
	$maxChallenges = $lastRow[0];
    $result = mysqli_query($connect,$query) or die("Bad Query.");
	
	$challenges = UniqueRandomNumbersWithinRange(1, $maxChallenges, 10);
	
	$row_num = mysqli_num_rows($result);
	if($row_num > 0){
		echo 'fail';
	}
	else{
		$query = "INSERT into users values('{$email}','{$password}','normal',
		'{$challenges[0]},{$challenges[1]},{$challenges[2]},{$challenges[3]},{$challenges[4]},{$challenges[5]},{$challenges[6]},{$challenges[7]},{$challenges[8]},{$challenges[9]}'
		,'{$challenges[0]},{$challenges[1]},{$challenges[2]},{$challenges[3]},{$challenges[4]},{$challenges[5]},{$challenges[6]},{$challenges[7]},{$challenges[8]},{$challenges[9]}'
		,0, 0)";
		$result = mysqli_query($connect,$query) or die("Bad Query.");
		
		echo 'pass';
	}
	
    mysqli_close($connect);
?>