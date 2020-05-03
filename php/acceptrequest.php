<?php session_start();

include ('conn.php');
	$requestid = $_GET['id'];
	$query = "update cse442_542_2020_spring_teamg_db.friends set request_accepted = 1 WHERE id = $requestid";
	$result = mysqli_query($conn, $query); 
	sleep(1);
	header("Refresh:0; url=requests.php");

?>
