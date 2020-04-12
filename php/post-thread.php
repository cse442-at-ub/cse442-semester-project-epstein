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
    <title>Post</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    
    
if (isset($_GET['postToDelete']) && isset($_GET['OPID'])) {
    $currentUSERID = $_SESSION['id'];
    $requestUSERID = $_GET['OPID'];
    
    if ($currentUSERID == $requestUSERID) {
         $host = "tethys.cse.buffalo.edu";
         $username = "mdrafsan";
         $password = "50100208";
         $dbname = "cse442_542_2020_spring_teamg_db";
    
         $dbh = testdb_connect ($host, $username, $password);
         $classId = $_GET['allclassi'];
    
         $query = "DELETE FROM POSTS WHERE id=".$_GET["postToDelete"];

         $stmt = $dbh->prepare( $query );
         $product_id=1;
         $stmt->bindParam(1, $product_id);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);                
    }
} 
    
if (isset($_GET['postToReport'])) {
    $host = "tethys.cse.buffalo.edu";
    $username = "mdrafsan";
    $password = "50100208";
    $dbname = "cse442_542_2020_spring_teamg_db";
    
    $dbh = testdb_connect ($host, $username, $password);
    $postToReport = addslashes ($_GET['postToReport']);
    $classId = $_GET['allclassi'];
    
    $query = "INSERT INTO reportedPosts ". "(postReported,classId) "."VALUES ". "('$postToReport','$classId' )";

    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
}
if (isset($_GET['classi']) ||  isset($_GET['allclassi'])){
    //to differentiate between all classes and user's classes
    if (!isset($_GET['classi'])){
        $classid = $_GET['allclassi'];
    }else{
        $classid =  $_GET['classi'];
    }

    include ('conn.php');
    $classname = mysqli_query($conn,"select * from classes where id = '$classid'");
    $rows = mysqli_fetch_array($classname);
    $namerow = $rows['name'];
    $numrow = $rows['classnum'];
    $classnamefull = $namerow.$numrow;
    
    echo '<strong style="font-size: xx-large">';
    echo $classnamefull;
    echo  '</strong>';
    $totalPOSTS = 0;
    $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM POSTS where classid = '$classid'");
    $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `POSTS` where classid = '$classid'");
        while ($row = $totalUsers->fetch_assoc()) {
            $totalPOSTS = $row['COUNT(*)'];
                        

            
    }
    
    $totalStudents = 0;
    $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM userclasses where classid = '$classid'");
    $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `userclasses` where classid = '$classid'");
        while ($row = $totalUsers->fetch_assoc()) {
            $totalStudents = $row['COUNT(*)'];
                        
            
    }
    
    
    
    echo '<strong style="border: solid 1px; border-color:black; background: white; font-size: normal; color:black; margin: 100px; padding:10px" >';
            echo "At a glance: Total Posts: ".$totalPOSTS."  "." Total Students: ".$totalStudents;
                echo  '</strong>';
    echo '<strong style="border: solid 1px; border-color:black; background: white; font-size: normal; color:black; margin: 100px; padding:10px" >';
            echo "At a glance: Total Posts: ".$totalPOSTS."  "." Total Students: ".$totalStudents;
                echo  '</strong>';
    
     echo '
<dialog id="favDialog">
  <form method="dialog">
    <p><label>Which post would you like to report? :
      <select>
        <option></option>';
    $host = "tethys.cse.buffalo.edu";
    $username = "mdrafsan";
    $password = "50100208";
    $dbname = "cse442_542_2020_spring_teamg_db";
    $conn = new mysqli($host, $username, $password, $dbname);
    $sql = "SELECT id, userid, subject, content, date FROM POSTS where classid = '$classid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<option>".$row["content"]."</option>";
        }
    }
        
      echo '</select>
    </label></p>
    <menu>
      <button value="cancel">Cancel</button>
      <button id="confirmBtn" value="default">Confirm</button>
    </menu>
  </form>
</dialog>
<span>

  <button id="updateDetails" style="width:150px;height:50px; background-color:#ED2939;border:solid 3px; border-color:white; color:white; font-size:15px; font-style:bold" display="inline">Report a Post!</button>
</span>

<br>
<br>
<output aria-live="polite"></output></div>';
}
?>
<div>
    <form action="" method="post">
        <textarea input type="text" name="number1" cols="40" rows="5" style="margin-bottom:10px;width:1200px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: white;"></textarea>
        <p><input type="submit"/></p>
        <hr style="margin-top: 0px;">
</div>


</body></html>
<?php
// 1. database credentials
$host = "tethys.cse.buffalo.edu";
$username = "mdrafsan";
$password = "50100208";
$dbname = "cse442_542_2020_spring_teamg_db";
// 2. connect to database
function testdb_connect ($host, $username, $password){
    $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", $username, $password);
    return $dbh;
}
try {
    $conn = new mysqli($host, $username, $password, $dbname);

    $sql = "SELECT id, userid, subject, content, date FROM POSTS where classid = '$classid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";
        while($row = $result->fetch_assoc()) {
            $postID = $row["id"];
            $OPID = $row['userid'];
            if ($_SESSION['id'] == $row['userid']) {
                $classId = $_GET['allclassi'];

                echo "<tr><td>"."<button onclick=\"location.href='post-thread.php?allclassi=$classId&&postToDelete=$postID&&OPID=$OPID'\" style=\"border-style: solid; border-radius: 5px;margin-left: 500px; padding-left: 10px; padding-right: 10px;border-color: red;background-color:red; color:white;\"type=\"button\">Delete Post</button>"."</td></tr>";
            }
            $postID = $row["id"];
            
            echo "<tr><td>".$row["subject"]." - "." ".$row["content"]."</td></tr>";
            $OPID = $row['userid'];
            $userq = mysqli_query($conn, "select username, name, picture_path from users where id = '$OPID'");
            $userrows=mysqli_fetch_array($userq);
            $OPuser = $userrows['username'];
            $OPpath = $userrows['picture_path'];
            $OPdate = $row['date'];

            //display OP
            echo "<tr><td>Posted by: ";
            echo $OPuser;
            //display OP image
            echo "<img src='".$OPpath."' width='17' height='17' >
                  <tr></td>";
            
            echo "<tr><td>Posted on: ";
            echo $OPdate;


            echo "<tr><td>"."<button onclick=\"location.href='expandedPost.php?post_id=$postID'\" type=\"button\">Go To Post</button>"."<hr>"."</td></tr>";
            
            
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['number1'])) {
    $dbh = testdb_connect ($host, $username, $password);
    $description = addslashes ($_POST['number1']);
    
    if ($description != "") {
        $OP = $_SESSION['id'];
        $date = date('Y/m/d H:i:s');
        $query = "INSERT INTO POSTS ". "(subject,content, date, classid, userid) "."VALUES ". "('->','$description','$date', $classid, $OP )";

        $stmt = $dbh->prepare( $query );
        $product_id=1;
        $stmt->bindParam(1, $product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<meta http-equiv='refresh' content='0'>";
        echo $_COOKIE['post'];
    }
    
}
    
?>
    $OP = $_SESSION['id'];
    $date = date('Y/m/d H:i:s');
    $query = "INSERT INTO POSTS ". "(subject,content, date, classid, userid) "."VALUES ". "('->','$description','$date', $classid, $OP )";

    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<meta http-equiv='refresh' content='0'>";
    echo $_COOKIE['post'];
}
    
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script>
    var updateButton = document.getElementById('updateDetails');
    var favDialog = document.getElementById('favDialog');
    var outputBox = document.querySelector('output');
    var selectEl = document.querySelector('select');
    var confirmBtn = document.getElementById('confirmBtn');

    // "Update details" button opens the <dialog> modally
    updateButton.addEventListener('click', function onOpen() {
      if (typeof favDialog.showModal === "function") {
        favDialog.showModal();
      } else {
        alert("The <dialog> API is not supported by this browser");
      }
    });
    // "Favorite animal" input sets the value of the submit button
    selectEl.addEventListener('change', function onSelect(e) {
      confirmBtn.value = selectEl.value;
    });
    // "Confirm" button of form triggers "close" on dialog because of [method="dialog"]
    favDialog.addEventListener('close', function onClose() {
        if (favDialog.returnValue === "cancel") {
        } else {
            outputBox.value = "Your feedback has been sent to the instructor for "+ favDialog.returnValue;
            document.cookie="post=favDialog.returnValue";
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            
            var hello = "hello";
            var world = "world";
            window.location.href = "post-thread.php?allclassi=" + vars["allclassi"] + "&postToReport=" + favDialog.returnValue;
        }

    });
    
    
    
    
    
</script>
