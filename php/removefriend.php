<?php session_start();

include ('conn.php');
    $userid=$_SESSION['id'];
	$friend_id = $_GET['user_id'];
	$query = "delete from friends WHERE (friend0_id = '$friend_id' AND friend1_id = '$userid') OR (friend0_id = '$userid' AND friend1_id = '$friend_id')";
	$result = mysqli_query($conn, $query); 
	sleep(1);
	header("Refresh:0; url=profile.php?profileid=$friend_id");

?>
