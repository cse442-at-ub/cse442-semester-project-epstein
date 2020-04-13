<?php session_start();
include('header.php');
if (!isset($_SESSION['id'])) {
    header('Location: loginpage.php');
    exit();
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

        <form name = "classf" id = "classform" method = "GET" action = "processclass.php">
               <input name = "classi" type = "hidden" id = "classinput" >
               <input name  = "unsubinput" type = "hidden" id = "unsubinput" >
               <ul class = "classes-list">
                <?php
                include('conn.php');
                $user_id = $_SESSION['id'];

                //gets all class-user data
                $subclasses = mysqli_query($conn, "select * from `userclasses` where userid ='$user_id'");
                if (!$subclasses){
                    echo "Error accessing class list";
                }
                //fetches classid list
                $class_ids = array();
                while ($line = mysqli_fetch_assoc($subclasses)){
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
                         echo '<li onclick="leftclk(this.id)" id = "'.$id.'" class = "classoptiond" > 
                         
                         '.$class['classnum'] . $class['name'].'
                          
                          <div class = "dropdown-content">
                                <a onclick="unsubscribe(this.id)" id = "'.$id.'" > Unsubscribe from class  </a>
                                <a onclick="rightclk(this.id)" id = "'.$id.'" > Go to class page </a>
                               
                               </div>
                          
                          
                          </li> ';
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
            function subscribe(elem){
                document.getElementById("subinput").setAttribute("value", elem);
                document.getElementById("allclassform").submit();
            }
            function unsubscribe(elem){
                document.getElementById("unsubinput").setAttribute("value", elem);
                document.getElementById("classform").submit();
            }
        </script>
    </div>


    <div class = "right-side-wrapper">

        <strong style="font-size: xx-large"> Available Classes</strong>

        <!-form will be used for class page navigation and subscritption>
        <form name = "allclassf" id = "allclassform" method = "GET" action = "processclass.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" >
            <input name  = "subinput" type = "hidden" id = "subinput" >
        <ul class = "classes-list">
            <?php $class_list = mysqli_query($conn, "select * from classes");
                    foreach($class_list as $class){
                        $id = $class['id'];
                        if (!(in_array($id, $class_ids))) {
                            //displays element (one class) with id set as class id


                            echo '<li class = "classoptiond" >'
                                . $class['classnum'] . $class['name'] .

                                ' <div class = "dropdown-content">
                               
                                <a onclick="subscribe(this.id)" id = "'.$id.'" > Subscribe to class  </a>
                                <a onclick="rightclk(this.id)" id = "'.$id.'" > Go to class page </a>
                               
                               </div>
                                 </li> ';


                        }
                    } ?>
            
        </ul>
            
        </form>
        
        

    </div>
    
    <div class = "right-side-wrapper">

        <strong style="font-size: xx-large"> Community at a Glance </strong>
        <br>
        
        
        <form name = "allclassf" id = "allclassform" method = "GET" action = "post-thread.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" value = "">
        <ul class = "classes-list">
            <?php 
        
            $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `users`");
        while ($row = $totalUsers->fetch_assoc()) {
                echo '<li class = "statOption" > '."Total Users: " . $row['COUNT(*)'].' </li> ';            

            
        }
        ?>
        </ul>
        </form>
        
        <form name = "allclassf" id = "allclassform" method = "GET" action = "post-thread.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" value = "">
        <ul class = "classes-list">
            <?php 
        
            $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `POSTS`");
        while ($row = $totalUsers->fetch_assoc()) {
                echo '<li class = "statOption" > '."Total Posts:  " . $row['COUNT(*)'].' </li> ';            

            
        }
        ?>
        </ul>
        </form>
        
        <form name = "allclassf" id = "allclassform" method = "GET" action = "post-thread.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" value = "">
        <ul class = "classes-list">
            <?php 
        
            $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `comments`");
        while ($row = $totalUsers->fetch_assoc()) {
                echo '<li class = "statOption" > '."Contributions:  ". $row['COUNT(*)'].' </li> ';            

            
        }
        ?>
        </ul>
        </form>
        
        <form name = "allclassf" id = "allclassform" method = "GET" action = "post-thread.php">
            <input name = "allclassi" type = "hidden" id = "allclassinput" value = "">
        <ul class = "classes-list">
            <?php 
        
            $totalUsers = mysqli_query($conn, "SELECT COUNT(*) FROM `userclasses`");
        while ($row = $totalUsers->fetch_assoc()) {
                echo '<li class = "statOption" > '."Total Classes: " . $row['COUNT(*)'].' </li> ';            

            
        }
        ?>
        </ul>
        </form>

    </div>

    </form>

</section>

</body>

</html>