<?php session_start();

include ('conn.php');
    $userid=$_SESSION['id'];
	$friendid = $_GET['user_id'];
	$query = "select * from friends WHERE (friend0_id = '$userid' AND friend1_id = '$friendid') OR (friend1_id = '$userid' AND friend0_id = '$friendid')";
	$result = mysqli_query($conn, $query); 
	if(mysqli_num_rows($result)==0){
	$query = "INSERT INTO friends (friend0_id, friend1_id) VALUES ('$userid', '$friendid')";
	$result = mysqli_query($conn, $query); 
	}
	sleep(1);
	header("Refresh:0; url=profile.php?profileid=$friendid");

?>
