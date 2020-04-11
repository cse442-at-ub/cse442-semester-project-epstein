
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <link href ="../CSS/HomePage.css" rel = "stylesheet">
    <title>4 AM</title>
</head>

    <body>
<header class = "main-header">

    <div class="logo">
        <a href = "homepage.php">
             <img src="../images/IconCSE4421.svg" width="150" height="75" fill-opacity=".5">
        </a>
    </div>

    <div class="dropdown">

        <button class = "dropbtn">
            <img src = "../images/heis.png" width = "50" height ="50">
        </button>

<?php
		 $userid=$_SESSION['id'];
    echo   ' <div class="dropdown-content">
            <a href="profile.php?profileid='.$userid.'">View Profile</a>
	        <a href="inbox.php">View Inbox</a>
            <a href="logout.php">Sign Out</a>
        </div>
    </div>';
?>

</header>

<body>
