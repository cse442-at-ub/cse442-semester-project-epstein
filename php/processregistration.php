<?php session_start();

    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['pass'])){

        // get values passed in from userRegistration.php
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
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
       $insertquery = "INSERT INTO users". "(id , username , email , password ,name , major ,graduation ,linkedin ,github ,biography ,skills ,picture_path) "."VALUES ". "('',$username, '$email', '$password', '$firstName', '$lastName', NULL , NULL , NULL , NULL , NULL , NULL , '/path/to/images/default')";

        $dbh = testdb_connect ("tethys.cse.buffalo.edu", "mdrafsan", "50100208");
        $stmt = $dbh->prepare($insertquery);
        $product_id=1;
        $stmt->bindParam(1, $product_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<meta http-equiv='refresh' content='0'>";
        exit();

    }else{
        $_SESSION['message'] = "Error processing submitted form";
        header('location:loginpage.php');
    }

    function testdb_connect ($host, $username, $password){
        $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", "mdrafsan", "50100208");
        return $dbh;
    }
?>