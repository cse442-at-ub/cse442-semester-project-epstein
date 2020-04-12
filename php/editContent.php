<?php session_start();
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
}
include "header.php";
include "conn.php";
if (isset($_GET['post_id'])) {


    $post_id = $_GET['post_id'];
    $dataq = mysqli_query($conn, "SELECT id, subject, content, date, classid FROM POSTS where id=$post_id");
    $rows = mysqli_fetch_array($dataq);
    $content = $rows['content'];
    $classid = $rows['classid'];
    $_SESSION['editid'] = $post_id;
    $_SESSION['classid'] = $classid;


}else if (isset($_GET['comment_id'])){






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
    <script type="text/javascript" src="../js/editContent.js"></script>

</head>
<body>

<section id = 'editPost'>

    <div class="text"> Edit Post: </div>

    <form action = "updateContent.php" method = "POST">
        <textarea input type="text"  name="number2" cols="40" rows="5" style="margin-bottom:10px;width:1200px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: white;">
        <?php echo $content ?>
        </textarea
        <p><input type="submit" /></p>
        <hr style="margin-top: 0px;">

    </form>

</section>
</body>










