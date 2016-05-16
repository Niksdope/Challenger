<?php			
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *");
    $host = "ngurins.cloudapp.net";
    $user = "niksdope";
    $password = "shalle";
    $database = "project";

    $delimiter = ',';
    
	$completed = $_GET['completed'];
	$email = $_GET['email'];
	
	$newChallenges;

	function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $challenges = range($min, $max);
    shuffle($challenges);
    return array_slice($challenges, 0, $quantity);
	}
	
	$queryMaxChallenges = "SELECT id from challenges ORDER BY id DESC LIMIT 1";
    $query = "SELECT * from users where email='{$email}'";
	
    $connect = mysqli_connect($host,$user,$password,$database) or die("Problem connecting.");
	
	$maxResult = mysqli_query($connect,$queryMaxChallenges) or die("Bad Query(find user).");
	$lastRow = $maxResult->fetch_array();
	$maxChallenges = $lastRow[0];
	
    $result = mysqli_query($connect,$query) or die("Bad Query(find user).");
    $row = $result->fetch_array();
	
	$rowRecent = $row ['recent'];
	$rowCompleted = $row ['completed'];
	$rowTotal = $row ['total'];
	
	$recent = explode($delimiter, $rowRecent);
	
	do 
	{
		$uniqueChals = true;
		$newChallenges = UniqueRandomNumbersWithinRange(1, $maxChallenges, 10);
		for ($i=0; $i<10; $i++)
		{
			for ($j=0; $j<10; $j++){
				if ($newChallenges[$i] == $recent[$j])
				{
					$uniqueChals = false;
					break;
				}
			}
			if ($uniqueChals == false)
			{
				break;
			}
		}
	}while ($uniqueChals != true);
	
	$rowRecent = "{$newChallenges[0]},{$newChallenges[1]},{$newChallenges[2]},{$newChallenges[3]},{$newChallenges[4]},{$newChallenges[5]},{$newChallenges[6]},{$newChallenges[7]},{$newChallenges[8]},{$newChallenges[9]}";
	$rowCompleted += $completed;
	$rowTotal += 10;
	
	$query = "UPDATE users SET challenges='{$rowRecent}', recent='{$rowRecent}', completed={$rowCompleted}, total={$rowTotal} WHERE email='{$email}'";
	$result = mysqli_query($connect,$query) or die("Bad Query(find user).");
    // $tasks = explode($delimiter, $row[0]);
	echo "Update complete";
    mysqli_close($connect);
?>