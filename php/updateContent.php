<?php session_start();
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
}
include "conn.php";

if (isset($_POST['number2'])){


    if ($_SESSION['editpost']) {
        $content = addslashes($_POST['number2']);
        $pid = $_SESSION['editpostid'];
        $updateq = mysqli_query($conn, "UPDATE POSTS SET content = '$content' WHERE id='$pid'");
        $clid = $_SESSION['classid'];
        if ($_SESSION['fromExpanded']) {
            header("location:expandedPost.php?post_id=$pid");
            exit();

        } else {
            header("location:post-thread.php?classi=$clid");
            exit();
        }
    }else if (!$_SESSION['editpost']){
        $content = addslashes($_POST['number2']);
        $cid = $_SESSION['editcommentid'];
        $updateq = mysqli_query($conn, "UPDATE comments SET content = '$content' WHERE id='$cid'");
        $pid = $_SESSION['postid'];

        header("location:expandedPost.php?post_id=$pid");
        exit();





    }


}
