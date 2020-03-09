<?php

    session_start();

    if (isset($_POST['email'], $_POST['pass'])) {

             // get values passed in form from loginpage.php
             $email = $_POST['email'];
             $password = $_POST['pass'];

             //checks if valid buffalo.edu email
             require_once 'validate.php';
             $validate_email = new validate_email();
             if (!($validate_email->validate_by_domain($email))) {
                 echo "Invalid email entered, must be @buffalo.edu";
                 exit;
             }

             include('conn.php');


             //query database for email and login
             $query = mysqli_query($conn,"select * from `users` where email = '$email' && password = '$password'");
             $numrows = mysqli_num_rows($query);

             if ($numrows==0){
                $_SESSION['message']="Email or password incorrect";
                header('location:loginpage.php');

             }else{
                 //create session variable
                 $row=mysqli_fetch_array($query);
                 $_SESSION['id']=$row['id'];
                 header('location:homepage.php');

             }





    }















?>