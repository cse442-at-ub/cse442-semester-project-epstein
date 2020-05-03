<?php session_start();
include('header.php');
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
}
?>

<!DOCTYPE html>
<html lang="en" style="
	background: linear-gradient(-135deg, #f0ffb1, #fdc689);
"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Requests</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
   <strong style="font-size: xx-large">Favorited Posts</strong><br>


</body>
</html>
<?php
    include ('conn.php');
    $userid=$_SESSION['id'];
try {
    
    $sql = "SELECT * FROM favorites where userid = ".$userid;
    echo "<table><th></th><br><b>Changed Favorites</b><th></th><br>";
	$posts = 0;
	$favoritesq = $conn->query($sql);
	if(!$favoritesq){
		echo "<br>0 favorited posts changed";
	}
	else{
	   if ($favoritesq->num_rows > 0) {
		   $posts = array();
			while($row = $favoritesq->fetch_assoc()) {
				$favorite_id = $row['id'];
				$post_id = $row['postid'];
				$comment_id = $row['commentid'];
				$postq = mysqli_query($conn, "select * from POSTS where id = '$post_id'");
				$postrow=mysqli_fetch_array($postq);
				$post_content = $postrow['content'];
				$post_time = $postrow['date'];
				$class_id = $postrow['classid'];
				$classq =  mysqli_query($conn, "select * from classes where id = '$class_id'");
				$class=mysqli_fetch_array($classq);		
				$class_number = $class['classnum'];
				$class_name = $class['name'];
				$poster_id = $postrow['userid'];
				$posterq =  mysqli_query($conn, "select * from users where id = '$poster_id'");
				$poster=mysqli_fetch_array($posterq);		
				$poster_name = $poster['name'];
				$commentq =  mysqli_query($conn, "select * from comments where post_id = '$post_id' ORDER BY id DESC LIMIT 1");
				if($commentq->num_rows > 0){
					$commentrow=mysqli_fetch_array($commentq);
					$newcomment_id = $commentrow['id'];
					$comment_content = $commentrow['content'];
					$commenter_id = $commentrow['userid'];
					$new_time = $commentrow['datePosted'];
					$commenterq = mysqli_query($conn, "select * from users where id = '$commenter_id'");
					$commenter=mysqli_fetch_array($commenterq);	
					$commenter_name = $commenter['name'];
					if($comment_id==$newcomment_id){
						array_push($posts, $row);
					}
					else{
						$query = "update cse442_542_2020_spring_teamg_db.favorites set commentid = '$newcomment_id' WHERE id = '$favorite_id'";				
						$result = mysqli_query($conn, $query); 
						echo $post_content;
						echo "<br><button onclick=\"location.href='expandedPost.php?post_id=$post_id'\" type=\"button\">Go To Post</button>
						<button onclick=\"location.href='unfavorite.php?post_id=$post_id'\" type=\"button\">Unfavorite Class</button><br><br>Posted by: ".$poster_name."<br>Posted From Class: <button onclick=\"location.href='processclass.php?classi=".$class_id."'\" type=\"button\" style = color:brown>".$class_number . " " . $class_name."</button><br> Date: " ;
						echo substr($post_time, 5, 5);
						echo " <br> Time: ";
						echo substr($post_time, 11, 8);
						echo      "<br><br>Newest Comment: ". $comment_content."<br>Commented by: ".$commenter_name."<br> Date: " ;
						echo substr($new_time, 5, 5);
						echo " <br> Time: ";
						echo substr($new_time, 11, 8);
						echo      "<br><hr><br>";
					}
				}
				else{
					array_push($posts, $row);
				}
			}
		} else {
			echo "<br>0 favorited posts changed<br>";
		}
	}
	
	
    echo "<table><th></th><br><b>Unchanged Favorites</b><br><br>";
   if($posts!=0){
   if (count($posts) > 0) {
	  while(count($posts) > 0){
		$row = array_pop($posts);
		$favorite_id = $row['id'];
		$post_id = $row['postid'];
		$comment_id = $row['commentid'];
		$postq = mysqli_query($conn, "select * from POSTS where id = '$post_id'");
		$postrow=mysqli_fetch_array($postq);
		$post_content = $postrow['content'];
		$post_time = $postrow['date'];
		$class_id = $postrow['classid'];
		$classq =  mysqli_query($conn, "select * from classes where id = '$class_id'");
		$class=mysqli_fetch_array($classq);		
		$class_number = $class['classnum'];
		$class_name = $class['name'];
		$poster_id = $postrow['userid'];
		$posterq =  mysqli_query($conn, "select * from users where id = '$poster_id'");
		$poster=mysqli_fetch_array($posterq);		
		$poster_name = $poster['name'];


		if($comment_id != -1){
			$commentq =  mysqli_query($conn, "select * from comments where id = '$comment_id'");
			$commentrow=mysqli_fetch_array($commentq);
			$comment_content = $commentrow['content'];
			$commenter_id = $commentrow['userid'];
			$time = $commentrow['datePosted'];
			$commenterq = mysqli_query($conn, "select * from users where id = '$commenter_id'");
			$commenter=mysqli_fetch_array($commenterq);	
			$commenter_name = $commenter['name'];
			echo $post_content;
			echo "<br><button onclick=\"location.href='expandedPost.php?post_id=$post_id'\" type=\"button\">Go To Post</button>
			<button onclick=\"location.href='unfavorite.php?post_id=$post_id'\" type=\"button\">Unfavorite Post</button><br><br>Posted by: ".$poster_name."<br>Posted From Class: <button onclick=\"location.href='processclass.php?classi=".$class_id."'\" type=\"button\" style = color:brown>".$class_number . " " . $class_name."</button><br> Date: " ;
			echo substr($post_time, 5, 5);
			echo " <br> Time: ";
			echo substr($post_time, 11, 8);

			echo "<br><br>Last Comment: ". $comment_content;
			echo "<br>Commented by: ".$commenter_name."<br>";
			echo " Date: " ;
			echo substr($time, 5, 5);
			echo " <br> Time: ";
			echo substr($time, 11, 8);
			echo      "<br><hr><br>";
		}
		else{
			echo $post_content."<br>
			<button onclick=\"location.href='expandedPost.php?post_id=$post_id'\" type=\"button\">Go To Post</button>
			<button onclick=\"location.href='unfavorite.php?post_id=$post_id'\" type=\"button\">Unfavorite Post</button><br><br>Posted by: ".$poster_name."<br>Posted From Class: <button onclick=\"location.href='processclass.php?classi=".$class_id."'\" type=\"button\" style = color:brown>".$class_number . " " . $class_name."</button><br> Date: " ;
			echo substr($post_time, 5, 5);
			echo " <br> Time: ";
			echo substr($post_time, 11, 8);
			echo      "<br><br>No comments<br><br>";
		}
	  }
    } else {
        echo "0 favorited posts unchanged<br>";
		}
   }
   else{
	   echo "0 favorited posts unchanged<br>";
   }
	

	
} catch(PDOException $e) {
    echo $e->getMessage();
}


?>