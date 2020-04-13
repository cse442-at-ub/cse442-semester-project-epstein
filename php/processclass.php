<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
}
include ('conn.php');

//This part is used when the subscribe button is pressed
if (!empty($_GET['subinput'])){

    $sub_id = $_GET['subinput'];
    echo $sub_id;
    $user_id = $_SESSION['id'];
    echo $user_id;
    $subque = mysqli_query($conn, "INSERT INTO `userclasses` (classid, userid) VALUES ('$sub_id','$user_id')");
    if (!$subque){
        echo'error';
        exit();
    }
    header('location:homepage.php');
    exit();
}
if (!empty($_GET['unsubinput'])){
    $unsub_id = $_GET['unsubinput'];
    $user_id = $_SESSION['id'];
    $unsubque = mysqli_query($conn, "DELETE FROM `userclasses` WHERE classid = '$unsub_id' AND userid = '$user_id'");
    if (!$unsubque){
        echo 'failed';
        exit();
    }
    header('location:homepage.php');
    exit();
}

//This part is used for redirection to class page

if (!empty($_GET['allclassi']) || !empty($_GET['classi'])) {

    if (!isset($_GET['classi'])) {
        $classid = $_GET['allclassi'];
    } else {
        $classid = $_GET['classi'];
    }

    $_SESSION['class'] = $classid;
    header('location:post-thread.php');
    exit();
}

