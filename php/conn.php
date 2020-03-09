<?php


    // connect to database
    $conn = mysqli_connect('tethys.cse.buffalo.edu', 'jwdubill', '50239013', 'jwdubill_db');

    //check for connection
    if (!$conn) {
        echo "Database Connection Failed";
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

?>