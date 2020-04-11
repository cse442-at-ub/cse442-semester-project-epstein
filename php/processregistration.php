<?php session_start();

    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['pass'])){

        // get values passed in from userRegistration.php
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $name = $firstName.$lastName;
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['pass'];

        //check if valid buffalo.edu email
        require_once 'validate.php';
        $validate_email = new validate_email();
        if (!($validate_email->validate_by_domain($email))) {
            $_SESSION['message']="Email must be of the domain @buffalo.edu";
            header('location:userRegistration.php');
            exit();
        }

        //query database for email and check if email already exists
        include('conn.php');
        $emailquery = mysqli_query($conn,"select * from `users` where email = '$email'");
        $numrows = mysqli_num_rows($emailquery);
        if ($numrows !=0){
            $_SESSION['message']= "Email already used for another account";
            header('location:userRegistration.php');
            exit();
        }

        //query database for username and check if already taken
        $userquery = mysqli_query($conn,"select * from `users` where username = '$username'");
        $numrows = mysqli_num_rows($userquery);
        if ($numrows !=0){
            $_SESSION['message']= "username already taken";
            header('location:userRegistration.php');
            exit();
        }

        //if not, insert new user into database
       $insertquery = mysqli_query($conn, "INSERT INTO `users` (username , email , password , name )
                  VALUES ('$username', '$email', '$password', '$name')");


        $query = mysqli_query($conn, "select * from 'users' where username = '$username'");
        $row = mysqli_fetch_array($query);

        header('location:loginpage.php');
        exit();

    }else{
        $_SESSION['message'] = "Error processing submitted form";
        header('location:loginpage.php');
        exit();
    }
?>