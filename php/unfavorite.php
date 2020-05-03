<?php session_start();

include ('conn.php');
    $userid=$_SESSION['id'];
	$post_id = $_GET['post_id'];
	$query = "delete from favorites WHERE userid = '$userid' AND postid = '$post_id'";
	$result = mysqli_query($conn, $query); 
	sleep(1);
	if(!isset($_GET['classid'])){
		header("Refresh:0; url=favorites.php");
	}
	else{
		$location = $_GET['classid'];
		header("Refresh:0; url=processclass.php?classi='$location'");
	}
?>
