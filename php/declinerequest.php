<?php session_start();

include ('conn.php');
    $userid=$_SESSION['id'];
	$requestid = $_GET['id'];
	$query = "delete from friends WHERE (id = '$requestid' AND friend1_id = '$userid')";
	$result = mysqli_query($conn, $query); 
	sleep(1);
	header("Refresh:0; url=requests.php");

?>
