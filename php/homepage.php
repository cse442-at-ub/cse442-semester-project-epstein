
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href ="../CSS/HomePage.css" rel = "stylesheet">
    <title>4 AM</title>
</head>


<body class = "container full-height-grow">


<header class = "main-header">

    <div class="logo">

        <img src="../images/IconCSE4421.svg" width="150" height="75" fill-opacity=".5">

    </div>

    <div class="dropdown">

        <button class = "dropbtn">
            <img src = "../images/heis.png" width = "50" height ="50">
        </button>


        <div class="dropdown-content">
            <a href="profile.php">View Profile</a>
            <a href="#">Account Settings?</a>

            <a href="logout.php">Sign Out</a>
        </div>
    </div>


</header>


<section class = "home-main-section">

    <div class = "left-side-wrapper">

            <ul class = "classes-list">
                <li > <a href ="../HTML/post-thread.html" class = "classoption"> Class 1 </a> </li>
                <li > <a href ="../HTML/post-thread.html" class = "classoption"> Class 2 </a> </li>
                <li > <a href ="../HTML/post-thread.html" class = "classoption"> Class 3 </a> </li>
                <li > <a href ="../HTML/post-thread.html" class = "classoption"> Class 4 </a> </li>
            </ul>


    </div>


    <div class = "right-side-wrapper">

        <?php
        session_start();
        include('conn.php');
        $userid=$_SESSION['id'];

        $userq=mysqli_query($conn,"select * from `users` where id='$userid'");
        $userrow=mysqli_fetch_array($userq);
        echo $userrow['username'];
        ?>

    </div>

</section>

</body>

</html>