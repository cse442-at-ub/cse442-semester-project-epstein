
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
 include('header.php');
 session_start();

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

    $sql = "SELECT id, subject, content, date FROM POSTS where classid = '$classid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th></th><th></th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["subject"]." - "." ".$row["content"]."</td></tr>";
            $postID = $row["id"];
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
    $query = "INSERT INTO POSTS ". "(subject,content, date, classid) "."VALUES ". "('->','$description','2014', $classid)";

    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Refresh:0; url=post-thread.php?classi=$classid");

}
?>