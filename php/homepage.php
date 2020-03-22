<?php session_start()?>

<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8">
    <link href ="../CSS/HomePage.css" rel = "stylesheet">
    <title>4 AM</title>
</head>


<body class = "container full-height-grow">


<?php include('header.php'); ?>


<section class = "home-main-section">

    <div class = "left-side-wrapper">

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


        //displays the list of a classes as a single form which goes to the class page, with a hidden input for the class ID


        echo '<form name = "classf" id = "classform" method = "POST" action = "post-thread.php">

               <input name = "classi" type = "hidden" id = "classinput" value = "">
        
               <ul class = "classes-list">';

                foreach($classes as $class){
                    $id = $class['id'];

                    //displays element (one class) with id set as class id
                    echo '<li onclick="clk(this.id)" id = "'.$id.'" class = "classoption" > '.$class['classnum'] . $class['name'].' </li> ';
                }

        echo '</ul>
              </form>';

        ?>


        <script type = "text/javascript">
            function clk(elem) {
                document.getElementById("classinput").setAttribute("value", elem);
                document.getElementById("classform").submit();
            }
        </script>

    </div>


    <div class = "right-side-wrapper">

        <ul class = "classes-list">
            <li > <a href ="post-thread.php" class = "classoption"> Class 1 </a> </li>
            <li > <a href ="post-thread.php" class = "classoption"> Class 2 </a> </li>
            <li > <a href ="post-thread.php" class = "classoption"> Class 3 </a> </li>
            <li > <a href ="post-thread.php" class = "classoption"> Class 4 </a> </li>
        </ul>

    </div>

</section>

</body>

</html>