<?php session_start();
include('header.php');
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>4-A.M. - Get your education right!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/expandedPost.css">
<!--===============================================================================================-->
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <center>
                    <img src="../images/IconCSE442.png" alt="Girl in a jacket" style="width:30%;">
                </center>
                <span class="login100-form-title">
						DM Thread 
                </span>
                <div>
                    
                    <p>
                        <?php
	include ('conn.php');
    $userid=$_SESSION['id'];
try {
	    $message_id = $_GET['msg_id'];
		
	echo	"<form action='' method='post'> <textarea input type='text' name='message' cols='40' rows='5' style='margin-bottom:10px;width:700px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: coral;'></textarea> <p><input type='submit'/></p>";
		echo "<table><tr><th></th><th></th></tr>";
		while($message_id!=-1){
			$sql = "SELECT * FROM direct_messages where id = '$message_id'";
			$messageq = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($messageq);
			echo "<tr><td>"." ".""." ".$row["message"]."</td></tr>";
            echo "<tr><td>"."<hr>"."</td></tr>";
			$sender_id = $row['sender_id'];
			$recipient_id = $row['recipient_id'];
			if($sender_id!=$userid){
				$senderq = mysqli_query($conn, "select name from users where id = '$sender_id'");
				$sender_row=mysqli_fetch_array($senderq);
				$sender_name = $sender_row['name'];
				echo "<tr><td>Sent From: ";
				echo $sender_name;
				echo " <br> Date: " ;
				echo substr($row['timestamp'], 5, 5);
				echo " <br> Time: ";
				echo substr($row['timestamp'], 11, 8);
				echo      "</tr></td>";
				echo "<tr><td>"."<hr>"."</td></tr>";

			}
			else{
				$recipientq = mysqli_query($conn, "select name from users where id = '$recipient_id'");
				$recipient_row=mysqli_fetch_array($recipientq);
				$recipient_name = $recipient_row['name'];
				echo "<tr><td>Sent To: ";
				echo $recipient_name;
				echo " <br> Date: " ;
				echo substr($row['timestamp'], 5, 5);
				echo " <br> Time: ";
				echo substr($row['timestamp'], 11, 8);
				echo      "</tr></td>";
                echo "<tr><td>"."<hr>"."</td></tr>";
			}
			$message_id = $row['lastid'];
		}
		echo "</table>";
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
                    </p>
                </div>
                
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>

<?php
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
		$lastid = $_GET['msg_id'];
		
		if($sender_id==$userid){
			$sender_id = $recipient_id;
		}

		$query = "INSERT INTO direct_messages (lastid, recipient_id, sender_id, message) VALUES ('$lastid', '$sender_id', '$userid', '$message')";

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn)); 
		$query = "SELECT id from direct_message where lastid = '$lastid'";
		$row = mysqli_fetch_array(mysqli_query($conn, $query));
		$id = $row['id'];
		header("Refresh:0; url=directmessage.php?msg_id='$id'");
	}
?>