<?php session_start();
	  //get data to store
	  if (!isset($_SESSION['id'])) {
	    header('Location: loginpage.php');
		}
	  $name = $_POST['fullname'];
	  $picture_file = $_FILES['uploadpic'];
      $major = $_POST['majorinput'];
      $year = $_POST['yearinput'];
      $linkedin = $_POST['linkedin_url'];
      $github = $_POST['github_url'];
      $bio = $_POST['about'];
      $skills = $_POST['skills'];
      $id = $_SESSION['id'];
      
      //check that inputs are valid to be stored in database
      $validate_profile = new validate_profile();
      if (!($validate_profile->valid_picture($picture_file))) {
	      $_SESSION['message']="Picture must be less than 2MB";
		  sleep(2); 
		  header('location:profile.php');
          exit();
       }
      
      if (!($validate_profile->valid_year($year))) {
	      $_SESSION['message']="Graduation year must be possible";
		  sleep(2);
		  header('location:profile.php');
          exit();
       }
      
       if (!($validate_profile->valid_length($name))) {
	      $_SESSION['message']="Name must be fewer than 100 characters";
		  sleep(2);               
	      header('location:profile.php');
          exit();
       }
       
        if (!($validate_profile->valid_length($major))) {
	      $_SESSION['message']="Major must be fewer than 100 characters";
		  sleep(2);
		  header('location:profile.php');
          exit();
       }
       
        if (!($validate_profile->valid_length($linkedin))) {
	      $_SESSION['message']="Link must be fewer than 100 characters";
	      sleep(2);
		  header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_length($github))) {
	      $_SESSION['message']="Link must be fewer than 100 characters";
		  sleep(2);
		  header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_long_length($bio))) {
	      $_SESSION['message']="Biography must be fewer than 255 characters";
		  sleep(2);
		  header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_long_length($skills))) {
	      $_SESSION['message']="Skills text must be fewer than 255 characters";
		  sleep(2);
		  header('location:profile.php');
          exit();
       }
	   
	   //
	   $uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/images/";
	   	   $randomid = "1000" . strval($id*3);
	   $localdir = "../images/" . $randomid . basename($_FILES['uploadpic']['name']);
	   $upload_file = $uploaddir . $randomid . basename($_FILES['uploadpic']['name']);
	   move_uploaded_file($_FILES['uploadpic']['tmp_name'], $upload_file);
		$query = "";
		if(file_exists($upload_file)){
			chmod($upload_file, 0777);
			$query = "update cse442_542_2020_spring_teamg_db.users set name = '$name', major = '$major', graduation = '$year',
			linkedin = '$linkedin', github = '$github', biography = '$bio',
			skills = '$skills', picture_path = '$localdir' WHERE users .id = '$id'";
		}
		else{
			$query = "update cse442_542_2020_spring_teamg_db.users set name = '$name', major = '$major', graduation = '$year',
       linkedin = '$linkedin', github = '$github', biography = '$bio',
       skills = '$skills' WHERE users .id = '$id'";
		}
	    $host = "tethys.cse.buffalo.edu";

	   $username = "jjgrimm";
	   $password = "50240176";
	   $dbh = new PDO("mysql:host=$host;dbname=cse442_542_2020_spring_teamg_db", $username, $password);

       $stmt = $dbh->prepare( $query );

		$stmt->execute();

    echo "<meta http-equiv='refresh' content='0'>";

       
	class validate_profile {
	
		public function valid_picture($picture){

			$size = $picture['size'];
			$kbs = round($size / 1024 , 2);
			if($kbs<2048){
			return true;
			}
			return false;
		}
	
		public function valid_year($year) {
			if($year>2019&&$year<2029) {
				return true;
			}
			
			return false;
		}
		
		public function valid_long_length($text) {
			if(strlen($text)<255) {
				return true;
			}
			
			return false;
		}
		
		
		public function valid_length($text) {
			if(strlen($text)<100) {
				return true;
			}
			
			return false;
		}
	}