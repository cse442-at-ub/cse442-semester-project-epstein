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
   <strong style="font-size: xx-large">Friend Requests</strong><br>


</body></html>
<?php
    include ('conn.php');
    $userid=$_SESSION['id'];
try {
	       
    $sql = "SELECT * FROM friends where friend1_id = '$userid' AND request_accepted = 0 ORDER BY time DESC";
    $requests = $conn->query($sql);
    echo "<table><tr><th></th><br><b>Received Requests</b><th></th></tr>";
	if($requests){
   if ($requests->num_rows > 0) {
        while($row = $requests->fetch_assoc()) {
            $sender_id = $row['friend0_id'];
            $senderq = mysqli_query($conn, "select name from users where id = '$sender_id'");
            $sender_rows=mysqli_fetch_array($senderq);
            $sender_name = $sender_rows['name'];


            echo "<tr><td>Friend Request From: ";
            echo '<button onclick="location.href=\'profile.php?profileid='.$sender_id.'\'" type="button" style = color:brown>'.$sender_name.'</button><br>';
            echo " <br> Date: " ;
            echo substr($row['time'], 5, 5);
			echo " <br> Time: ";
			echo substr($row['time'], 11, 8);
            echo      "</tr></td>";


			$requestid = $row['id'];
            echo "<tr><td>"."<button onclick=\"location.href='acceptrequest.php?id=$requestid'\" type=\"button\">Accept</button>";
			echo "<button onclick=\"location.href='declinerequest.php?id=$requestid'\" type=\"button\">Decline</button>"."<hr>"."</td></tr>";

        }
    } else {
        echo "<br>0 friend requests<br>";
    }
	}
	else{
		 echo "<br>0 friend requests<br>";
	}
} catch(PDOException $e) {
    echo $e->getMessage();
}


?>