<?php session_start();
include('header.php');
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');

}?>

<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8">
    <link href ="../CSS/HomePage.css" rel = "stylesheet">
    <title>4 AM</title>
</head>


<body class = "container full-height-grow">





<section class = "home-main-section">

    <div class = "left-side-wrapper">

        <strong style="font-size: xx-large"> Your Classes</strong>

        <form name = "classf" id = "classform" method = "GET" action = "post-thread.php">
               <input name = "classi" type = "hidden" id = "classinput" value = "">
               <ul class = "classes-list">
                <?php
                include('conn.php');
                $user_id = $_SESSION['id'];


                //gets all class-user data
                $allclasses = mysqli_query($conn, "select * from `userclasses` where userid ='$user_id'");
                if (!$allclasses){
                    echo "Error accessing class list";
                }
                //fetches classid list
                $class_ids = array();
                while ($line = mysqli_fetch_assoc($allclasses)){
                    $class_ids[] = $line['classid'];
                }
                //fetches actual classes by classid and sets to $classes
                $classes = array();
                foreach($class_ids as $class_id){
                    $classq = mysqli_fetch_array(mysqli_query($conn, "select * from classes where id ='$class_id'"));
                    $classes[] = $classq;
                }

                foreach($classes as $class){
                         $id = $class['id'];
                         //displays element (one class) with id set as class id
                         echo '<li onclick="leftclk(this.id)" id = "'.$id.'" class = "classoption" > '.$class['classnum'] . $class['name'].' </li> ';
                     } ?>
               </ul>
        </form>


        <script type = "text/javascript">
            function leftclk(elem) {
                document.getElementById("classinput").setAttribute("value", elem);
                document.getElementById("classform").submit();
            }
            function rightclk(elem) {
                document.getElementById("allclassinput").setAttribute("value", elem);
                document.getElementById("allclassform").submit();
            }
        </script>
    </div>


    <div class = "right-side-wrapper">

        <strong style="font-size: xx-large"> Available Classes</strong>

        <form name = "allclassf" id = "allclassform" method = "GET" action = "post-thread.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" value = "">
        <ul class = "classes-list">
            <?php $class_list = mysqli_query($conn, "select * from classes");
                    foreach($class_list as $class){
                        $id = $class['id'];
                         //displays element (one class) with id set as class id
                         echo '<li onclick="rightclk(this.id)" id = "'.$id.'" class = "classoption" > '.$class['classnum'] . $class['name'].' </li> ';
                    } ?>
        </ul>
        </form>

    </div>

    </form>

</section>

</body>

</html>