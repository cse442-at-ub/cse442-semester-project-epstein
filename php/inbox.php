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
    <title>Inbox</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
   <strong style="font-size: xx-large">Inbox</strong>;


</body></html>
<?php
    include ('conn.php');
    $userid=$_SESSION['id'];
try {
	       
	
    $sql = "SELECT * FROM direct_messages where recipient_id = '$userid' ORDER BY timestamp";
    $messages = $conn->query($sql);
    if ($messages->num_rows > 0) {
        echo "<table><tr><th></th>Received<th></th></tr>";

        while($row = $messages->fetch_assoc()) {
            $sender_id = $row['sender_id'];
			if(!senders.contains($sender_id)){
			$senders.add($sender_id)
            $msgID = $row["id"];
            $previous_msgID = $row['lastid'];
            echo "<tr><td>".$row["message"]."</td></tr>";            
            $senderq = mysqli_query($conn, "select name from users where id = '$sender_id'");
            $sender_rows=mysqli_fetch_array($senderq);
            $sender_name = $sender_rows['name'];


            echo "<tr><td>Sent From: ";
            echo $sender_name;
            echo "at" ;
            echo $row['timestamp'];
            echo      "</tr></td>";


            echo "<tr><td>"."<button onclick=\"location.href='directmessage.php?msg_id=$msgID'\" type=\"button\">Open Message Thread</button>"."<hr>"."</td></tr>";
			}
        }
    } else {
        echo "0 received messages";
    }
    
    
     $sql = "SELECT * FROM direct_messages where sender_id = '$userid' ORDER BY timestamp";
    $messages = $conn->query($sql);
    if ($messages->num_rows > 0) {
        echo "<table><tr><th></th>/Sent<th></th></tr>";

        while($row = $messages->fetch_assoc()) {
            $recipient_id = $row['recipient_id'];
			if(!recievers.contains($recipient_id)){
			$senders.add($recipient_id);
            $msgID = $row["id"];
            $previous_msgID = $row['lastid'];
            echo "<tr><td>".$row["message"]."</td></tr>";            
            $recipientq = mysqli_query($conn, "select name from users where id = '$sender_id'");
            $recipient_rows=mysqli_fetch_array($recipientq);
            $recipient_name = $recipient_rows['name'];


            echo "<tr><td>Sent To: ";
            echo $recipient_name;
            echo "at" ;
            echo $row['timestamp'];
            echo      "</tr></td>";


            echo "<tr><td>"."<button onclick=\"location.href='directmessage.php?msg_id=$msgID'\" type=\"button\">Open Message Thread</button>"."<hr>"."</td></tr>";
			}
        }
        echo "</table>";
    } else {
        echo "0 sent messages";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}


?>