<?php session_start();

include ('conn.php');
    $userid=$_SESSION['id'];
	$post_id = $_GET['post_id'];
	$postq = mysqli_query($conn, "select * from POSTS where id = '$post_id'");
	$postrow=mysqli_fetch_array($postq);
	$post_content = $postrow['content'];
	$post_time = $postrow['date'];
	$commentq =  mysqli_query($conn, "select * from comments where post_id = '$post_id' ORDER BY id DESC LIMIT 1");
	if($commentq->num_rows > 0){
		$commentrow=mysqli_fetch_array($commentq);
		$comment_id = $commentrow['id'];
	}
	else{
		$comment_id = -1;
	}
	$query = "SELECT * from favorites where userid = '$userid' AND postid = '$post_id' ";
	$result = mysqli_query($conn, $query); 
	if(mysqli_num_rows($result)==0){
	$query = "INSERT INTO favorites (userid, postid, commentid) VALUES ('$userid', '$post_id', $comment_id)";
	$result = mysqli_query($conn, $query); 
	}
	if(!isset($_GET['classid'])){
		header("Refresh:0; url=favorites.php");
	}
	else{
		$location = $_GET['classid'];
		header("Refresh:0; url=processclass.php?classi=".$location);
	}
?>
