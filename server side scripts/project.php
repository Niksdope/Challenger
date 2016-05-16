<?php			
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Origin: *");
    $host = "ngurins.cloudapp.net";
    $user = "niksdope";
    $password = "shalle";
    $database = "project";

    $delimiter = ',';
    
    $email = $_GET['email'];

    $query = "SELECT challenges from users where email='{$email}'";
    //"SELECT * from people where name='{$name}'";
    $connect = mysqli_connect($host,$user,$password,$database) or die("Problem connecting.");

    $result = mysqli_query($connect,$query) or die("Bad Query(find user).");
    $row = mysqli_fetch_row($result);
    $tasks = explode($delimiter, $row[0]);
    $result = mysqli_query($connect, "SELECT * from challenges where id IN ('{$tasks[0]}', '{$tasks[1]}', '{$tasks[2]}', '{$tasks[3]}', '{$tasks[4]}', '{$tasks[5]}', '{$tasks[6]}', '{$tasks[7]}', '{$tasks[8]}', '{$tasks[9]}')") or die("Bad Query(get chals)");

    $challengearray = array();
    while ($row = mysqli_fetch_assoc($result))
    {
        $challengearray[] = $row;
    }
    
    echo json_encode($challengearray);
	/*while ($row = $result->fetch_array())
	{
		echo $row['challenge'];
	}*/
    mysqli_close($connect);
?>