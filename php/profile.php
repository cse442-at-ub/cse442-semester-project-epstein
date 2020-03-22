<?php session_start()?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link href ="../CSS/profile.css" rel = "stylesheet">
    <script type="text/javascript" src="../js/Profile.js"></script>
  </head>
  
  <body class = "container full-height-grow">
	<section class = "profile-main-section" id="main">

    <div class = "group" id = "left-side-wrapper">
  <?php include('header.php'); 
       
       //connect to database, pull the appropriate row from the user database for whoever is logged in
       include('conn.php');
       $userid=$_SESSION['id'];
       $userq=mysqli_query($conn,"select * from 'users' where id='$userid'");
       $userrow=mysqli_fetch_array($userq);
    
       //create all the variables to be used in the html elements
	   $name=$userrow['name'];
       $profile_pic=$userrow['picture_path'];
       $major=$userrow['major'];
       $year=$userrow['graduation'];
       $linkedin=$userrow['linkedin'];
       $github=$userrow['github'];
       $bio=$userrow['biography'];
       $skills=$userrow['skills'];
       
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
 
echo '
		<img id="profile_pic" src = "'.$profile_pic.'" width=100px; height=100px;></img>
		<div class="text" id="name">
		<p id = "name_text">'.$name.'</p>
		</div>
		<img class = "icons" onclick="openDM()" title="Start direct message" src = "../images/message.svg" width = "26" height ="26"></img>
	    <img class="icons" onclick="share()" title="Copy profile link" src = "../images/share.svg" width = "26" height ="26"></img>
		<img class="icons" onClick="edit();" title="Edit profile" src = "../images/edit.svg" width = "26" height ="26" id="edit"></img>
		<div class="info">
		<div class="smalltext" id="major">
		<p id = "major_text">Major: '.$major.'</p>
		</div>
		<div class="smalltext" id="year">
		<p id ="year_text">Class of: '.$year.'</p>
		</div>
		<p>
		<a id="linkedin_link" href="'.$linkedin.'"> 
		<img id="linkedin" src = "../images/linkedin.svg" width = "40" height ="40"></img>
		</a>
		<a id="github_link" href="'.$github.'"> 
		<img id="github" src = "../images/github.svg" width = "40" height ="40"></img>
		</a>
		</p>
		</div>
    </div>


    <div class = "group" id = "center-wrapper">
		<div class="info" id="bio_box">
		<div class="smalltext" id="bio_text">About Me: '.$bio.'</div>
		</div>
		<div class="info" id="skills_box">
		<div class="smalltext" id="skills_text">Skills: '.$skills.'</div>
		</div>
	</div>

    <div class = "group" id = "right-side-wrapper">
		<div class="info" id="classes">
		<div class="smalltext" id="class_text">Registered Classes</div>
	    <form name = "classf" id = "classform" method = "POST" action = "post-thread.php">
               <input name = "classi" type = "hidden" id = "classinput" value = "">
        
               <ul class = "classes-list">';

                foreach($classes as $class){
                    $id = $class['id'];

                    //displays element (one class) with id set as class id
                    echo '<li onclick="clk(this.id)" id = "'.$id.'" class = "classoption" > '.$class['classnum'] . $class['name'].' </li> ';
                }

        echo '</ul>
              </form>
		</div>
		<div class="info" id="last_box">
		<div class="smalltext" id="last_comment">Last Comment: Will be here sprint 3</div>
		<div class="smalltext" id="last_post">Last Post: Will be here sprint 3</div>
		</div>
		
	</div>




</section>


  <section class = "edit-profile-section" id="edit-section">
  	<form action="saveprofile.php" method = "POST">
  
	    <div class = "left-side-wrapper">
		    <div class="text" id="editformheader">Edit Profile Info:</div><br>
		    <label for="uploadpic">Upload Profile Picture</label>
			<input id="file-input" type="file" accept="image/gif, image/jpeg, image/png" name="image" /><br>
			<label for="fullname">Full Name:</label>
			<input type="text" id="fullname" name="fullname" value="Full Name"><br>
			<label for="majorinput">Major:</label>
			<input type="text" id="majorinput" name="majorinput" value="Computer Science"><br>
			<label for="yearinput">Class of:</label>
			<input type="text" id="yearinput" name="yearinput" value="2021"><br>
			<label for="linkedin_url">LinkedIn URL:</label>
			<input type="text" id="linkedin_url" name="linkedin_url" value="https://www.linkedin.com/"><br>
			<label for="github_url">GitHub URL:</label>
			<input type="text" id="github_url" name="github_url" value="https://www.github.com/"><br>
			<label for="about">About Me:</label>
			<input type="text" id="about" name="about" value="Enter bio here"><br>
			<label for="skills">Skills:</label>
			<input type="text" id="skills" name="skills" value="Enter skills here"><br>
	    </div>

		  
	<input type = "submit" id="save"  value="Save Changes" />
		
  
  
  </section>
		</form>

	
  </body>
</html>
';
