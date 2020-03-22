<?php session_start();
	  //get data to store
	  $name = $_POST['fullname'];
	  $picture_file = $_POST['file-input'];
      $major = $_POST['majorinput'];
      $year = $_POST['yearinput'];
      $linkedin = $_POST['linkedin_url'];
      $github = $_POST['github_url'];
      $bio = $_POST['about'];
      $skills = $_POST['skills'];
      $id = $_SESSION['id'];
      
      require_once 'validate.php';
      //check that inputs are valid to be stored in database
      $validate_profile = new validate_profile();
      if (!($validate_profile->valid_picture($picture_file))) {
	      $_SESSION['message']="Picture must be less than 2MB";
          header('location:profile.php');
          exit();
       }
      
      if (!($validate_profile->valid_year($year))) {
	      $_SESSION['message']="Graduation year must be possible";
          header('location:profile.php');
          exit();
       }
      
       if (!($validate_profile->valid_length($name))) {
	      $_SESSION['message']="Name must be fewer than 100 characters";
          header('location:profile.php');
          exit();
       }
       
        if (!($validate_profile->valid_length($major))) {
	      $_SESSION['message']="Major must be fewer than 100 characters";
          header('location:profile.php');
          exit();
       }
       
        if (!($validate_profile->valid_length($linkedin))) {
	      $_SESSION['message']="Link must be fewer than 100 characters";
          header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_length($github))) {
	      $_SESSION['message']="Link must be fewer than 100 characters";
          header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_long_length($bio))) {
	      $_SESSION['message']="Biography must be fewer than 255 characters";
          header('location:profile.php');
          exit();
       }
       
       if (!($validate_profile->valid_long_length($skills))) {
	      $_SESSION['message']="Skills text must be fewer than 255 characters";
          header('location:profile.php');
          exit();
       }
       
       include('conn.php');
       $file_name = basename($picture_file).strval($id);
       $query = mysqli_query($conn,"update 'cse442_542_2020_spring_teamg_db' 'users'
       set 'name' = '$name', 'major' = '$major', 'graduation = '$year',
       'linkedin' = '$linkedin', 'github' = '$github', 'biography' = '$bio',
       'skills' = '$skills', 'picture_path' = '/web/CSE442-542/2020-spring/cse-442g/images/profile/.$file_name' WHERE 'users' 'id' = '$id'");
       
       
       
	class validate_profile {
	
		public function valid_picture($picture){
			$size = filesize($picture);
			$kilobytes = round($size / 1024 , 2);
			if(kilobytes<2048){
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