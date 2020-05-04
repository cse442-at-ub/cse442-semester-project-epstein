<?php session_start();
global $secret_key;
$secret_key = $_GET["secret_key"];
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
						Professor Dashboard
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
    echo '<h3>Reported Posts</h3>';
    echo '<br>';
    //displaying Main post
    $conn = new mysqli($host, $username, $password, $dbname);

    $sql = "SELECT id, classnum, name, professor FROM classes where secret_key='$secret_key'";
    $result = $conn->query($sql);
    echo "<table><tr><th></th><th></th></tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $clasdId = $row["id"];
            $sql = "SELECT postReported FROM reportedPosts where classId='$clasdId'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            echo "<table><tr><th></th><th></th></tr>";

            while($reportedPOST = $result->fetch_assoc()) {
                $postAssoc = $reportedPOST["postReported"];
                echo "<tr><td>"." ".""." ".$reportedPOST["postReported"]."</td></tr>";
                echo "<tr><td>"."<button onclick=\"location.href='professorPanel.php?secret_key=$secret_key&&postToDelete=$postAssoc'\" style=\"border-style: solid; border-radius: 5px;margin-left: 500px; padding-left: 10px; padding-right: 10px;border-color: red;background-color:red; color:white;\"type=\"button\">Delete Post</button>"."</td></tr>";
                echo "<tr><td>"."<hr>"."</td></tr>";


            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        }
    } else {
    }

} catch(PDOException $e) {
}

?>
                        <?php
                        echo '
                        </p>
                </div>
                <form action="" method="post">
                    <div type-"text"> Make an announcement:</div>';
                    
                        // 1. database credentials
                        $host = "tethys.cse.buffalo.edu";
                        $username = "mdrafsan";
                        $password = "50100208";
                        $dbname = "cse442_542_2020_spring_teamg_db";
                        // 2. connect to database
                        try {
                            
                            //displaying Main post
                            $conn = new mysqli($host, $username, $password, $dbname);
                            
                            $sql = "SELECT id, classnum, name, professor FROM classes where secret_key='$secret_key'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                    <div>
                                      <input type="radio" id='.$row["id"].' name="courseSelected" value='.$row["id"].'>
                                      <label for='.$row["id"].'>'.$row["classnum"].'</label>
                                    </div>';
                                }
                            } else {
                            }

                        } catch(PDOException $e) {
                        }
                        
                        echo '
                    </select>
                <textarea input type="text" name="announcement" cols="40" rows="5" style="margin-bottom:1px;margin-left:5px; width:100% ;height: 150px;border: 2px solid black;margin-top: 8px;background-color: #f0ffb1;"></textarea>

		        <p><input type="submit" style="margin-bottom:10px;margin-left:650px;width:80px;height: 50px;border: 2px solid black;margin-top: 1px;background-color: #fdc689; color:black;"></p>
                        ';
                        
                        
                        ?>

<?php
    function testdb_connect ($host, $username, $password){
        $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", $username, $password);
        return $dbh;
    }
                       
    if (isset($_POST['announcement']) && isset($_POST['courseSelected'])) {
        $announcementToPost = $_POST['announcement'];
        $classID = $_POST['courseSelected'];

        $dbh = testdb_connect ($host, $username, $password);
        $description = addslashes ($_POST['announcement']);
        if ($description != "") {
            
            $query = "INSERT INTO announcements ". "(classid, announcement) "."VALUES ". "('$classID','$announcementToPost')";

            $stmt = $dbh->prepare( $query );
            $product_id=1;
            $stmt->bindParam(1, $product_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } 
        
    } 
                        
     if ($_GET["postToDelete"]) {
        
        $dbh = testdb_connect ($host, $username, $password);
        $description = addslashes ($_GET["postToDelete"]);
        if ($description != "") {
            
            $query = "DELETE FROM reportedPosts WHERE postReported LIKE '%".$description."%'";

             $stmt = $dbh->prepare( $query );
             $product_id=1;
             $stmt->bindParam(1, $product_id);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } 
        
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
