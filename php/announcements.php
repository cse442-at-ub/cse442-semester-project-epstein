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
						Announcements
                </span>
                <div>

                    <p>
                        <?php
// 1. database credentials
$host = "tethys.cse.buffalo.edu";
$username = "mdrafsan";
$password = "50100208";
$dbname = "cse442_542_2020_spring_teamg_db";
// 2. connect to database
try {
    //displaying Main post
    $conn = new mysqli($host, $username, $password, $dbname);
    $classId = $_GET['allclassi'];
    $sql = "SELECT announcement FROM announcements where classid=$classId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>"." ".""." ".$row["announcement"]."</td></tr>";
            echo "<tr><td>"."<hr>"."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $_SESSION['fromExpanded'] = true;

} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
               
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
