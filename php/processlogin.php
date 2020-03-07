<?php



    // get values passed in form from loginpage.php (must be @buffalo.edu email)
    $email = $_POST['email'];
    $password = $_POST['pass'];


   /*
    *
    * TODO: filter out invalid strings with ( / . , ? - ....) either client or server side
    *
    */


    // connect to database
    $conn = mysqli_connect('tethys.cse.buffalo.edu', 'jwdubill', '50239013', 'jwdubill_db');


    if (!$conn){

        echo "Database Connection Failed";
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;

    }else {

        echo "Database Connection Successful";

    }

    //query database for email and login

    $qemail = s




















?>