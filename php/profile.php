<?php session_start()?>
<html>
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href ="../CSS/profile.css" rel = "stylesheet">
    <script type="text/javascript" src="../js/Profile.js"></script>
  </head>
<?php include('header.php'); ?>
  
  <body class = "container full-height-grow">
	<section class = "profile-main-section" id="main">

    <div class = "column" id = "left-side-wrapper">
       <?php
       //connect to database, pull the appropriate row from the user database for whoever is logged in
       include('conn.php');
       $userid=$_SESSION['id'];
	   $profileid=$_GET['profileid'];
	   $is_user = "false";
	   if($userid==$profileid){
			$is_user = "true";
	   }
       $userrow=mysqli_fetch_array(mysqli_query($conn,"select * from users where id='$profileid'"));
    
       //create all the variables to be used in the html elements
	   $name=$userrow['name'];
       $profile_pic=$userrow['picture_path'];
       $major=$userrow['major'];
       $year=$userrow['graduation'];
	   if($userrow['linkedin']==NULL){
		   $linkedin="https://www.linkedin.com/";
	   }
	   else{
			$linkedin=$userrow['linkedin'];
       }
	    if($userrow['github']==NULL){
		   $github="https://www.github.com/";
	   }
	   else{
			$github=$userrow['github'];
       }
       $bio=$userrow['biography'];
       $skills=$userrow['skills'];
       
       //gets all class-user data
        $allclasses = mysqli_query($conn, "select * from `userclasses` where userid ='$profileid'");
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
		$friend_ids = array();
		$friends0 = mysqli_query($conn, "select friend1_id from `friends` where friend0_id ='$profileid' AND request_accepted = 1");
		$friends1 = mysqli_query($conn, "select friend0_id from `friends` where friend1_id ='$profileid' AND request_accepted = 1");
		while ($row = mysqli_fetch_assoc($friends0)){
            $friend_ids[] = $row['friend1_id'];
        }
		while ($row = mysqli_fetch_assoc($friends1)){
            $friend_ids[] = $row['friend0_id'];
        }
		$friends = array();
		foreach($friend_ids as $friend_id){
            $friendq = mysqli_fetch_array(mysqli_query($conn, "select * from users where id ='$friend_id'"));
            $friends[] = $friendq;
        }
echo '
		<img id="profile_pic" src = "'.$profile_pic.'" width=100px; height=100px;></img>
		<div class="text" id="name">
		<p id = "name_text">'.$name.'</p>
		</div>';
	if($is_user=="false"){
		echo '<button class = "icons" onclick="location.href=\'directmessage.php?user_id='.$profileid.'\'" title="Start direct message" style="background: url(../images/message.svg); height:30px;width:30px"></button>';
		if(!in_array($userid, $friend_ids)){
		echo '<button class = "icons" onclick="location.href=\'friendrequest.php?user_id='.$profileid.'\'" title="Friend Request" style="background: url(../images/friend.png); height:30px;width:30px"></button>';
		}
		else{
		echo '<button class = "icons" onclick="location.href=\'removefriend.php?user_id='.$profileid.'\'" title="Remove Friend" style="background: url(../images/removefriend.svg); height:30px;width:30px"></button>';
		}
	}
	echo '<img class="icons" onclick="share()" title="Copy profile link" src = "../images/share.svg" width = "26" height ="26"></img>';
	if($is_user=="true"){
		echo '<img class="icons" onClick="edit();" title="Edit profile" src = "../images/edit.svg" width = "26" height ="26" id="edit"></img>';
	}
	
	echo '
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


    <div class = "column" id = "center-wrapper">
		<div class="info" id="bio_box">
		<div class="smalltext" id="bio_text">About Me: '.$bio.'</div>
		</div>
		<div class="info" id="skills_box">
		<div class="smalltext" id="skills_text">Skills: '.$skills.'</div>
		</div>
		
	</div>

    <div class = "column" id = "right-side-wrapper">
		
		<div class="smalltext" id="class_text">Registered Classes</div>
	    <form name = "classf" id = "classform" method = "POST" action = "post-thread.php">
               <input name = "classi" type = "hidden" id = "classinput" value = "">
        
               <ul class = "classes-list">';

                foreach($classes as $class){
                    $id = $class['id'];

                    echo '<li onclick="leftclk(this.id)" id = "'.$id.'" class = "classoptiond" > 
                         
                         '.$class['classnum'] . $class['name'].'
                          
                          <div class = "dropdown-content">
                                <a onclick="unsubscribe(this.id)" id = "'.$id.'" > Unsubscribe from class  </a>
                                <a onclick="rightclk(this.id)" id = "'.$id.'" > Go to class page </a>
                               
                               </div>
                          
                          
                          </li> ';
						  } 
        echo '</ul>
              </form>
	
		 
		

		<div class="smalltext" id="class_text">Friends List</div>
	
			<nav>
				<ul>';
				 foreach($friends as $friend){
                    $friendid = $friend['id'];

                    echo '<button onclick="location.href=\'profile.php?profileid='.$friendid.'\'" type="button" style = color:brown>'.$friend['name'].'</button><br>';
					} 
				
	echo '		</ul>
			</nav>
	
		</div>
	</div>

</section>
 <script type = "text/javascript">
			 function leftclk(elem) {
                document.getElementById("classinput").setAttribute("value", elem);
                document.getElementById("classform").submit();
            }
            function rightclk(elem) {
                document.getElementById("allclassinput").setAttribute("value", elem);
                document.getElementById("allclassform").submit();
            }

            function unsubscribe(elem){
                document.getElementById("unsubinput").setAttribute("value", elem);
                document.getElementById("classform").submit();
            }
        </script>

  <section class = "edit-profile-section" id="edit-section">
  	<form action="saveprofile.php" method = "POST" enctype="multipart/form-data">
		 				
	    <div class = "column" id = "left-side-wrapper1">
		    <div class="text" id="editformheader">Edit Profile Info:</div><br>
		    <label for="uploadpic">Upload Profile Picture</label><br>
			<input type="file" name="uploadpic" id="uploadpic" accept="image/gif, image/jpeg, image/png" /><br>
			<label for="fullname">Full Name:</label><br>
			<input type="text" id="fullname" name="fullname" value="'.$name.'"><br>
			<label for="majorinput">Major:</label><br>
			<input type="text" id="majorinput" name="majorinput" value="'.$major.'"><br>
			<label for="yearinput">Class of:</label><br>
			<input type="text" id="yearinput" name="yearinput" value="'.$year.'"><br>
			<label for="linkedin_url">LinkedIn URL:</label><br>
			<input type="text" id="linkedin_url" name="linkedin_url" value="'.$linkedin.'"><br>
			<label for="github_url">Github URL:</label><br>
			<input type="text" id="github_url" name="github_url" value="'.$github.'"><br>
			<label for="about">About Me:</label><br>
			<input type="text" id="about" name="about" value="'.$bio.'"><br>
			<label for="skills">Skills:</label><br>
			<input type="text" id="skills" name="skills" value="'.$skills.'"><br>
	    </div>

		  
	<input type = "submit" id="save"  value="Save Changes" />
		
  
  
  </section>
		</form>

	
  </body>
</html>
';
