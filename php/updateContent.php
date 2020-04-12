<?php session_start();
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
}
include "conn.php";

if (isset($_POST['number2'])){
    $content = addslashes($_POST['number2']);
    $pid = $_SESSION['editid'];
    $updateq = mysqli_query($conn, "UPDATE POSTS SET content = '$content' WHERE id='$pid'");
    $cid = $_SESSION['classid'];
    if ($_SESSION['fromExpanded']){
        header("location:expandedPost.php?post_id=$pid");
        exit();

    }else {
        header("location:post-thread.php?classi=$cid");
        exit();
    }


}
