<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link href ="../CSS/profile.css" rel = "stylesheet">
    <script type="text/javascript" src="../js/Profile.js"></script>
  </head>
  <body class = "container full-height-grow">
  
  <header class = "main-header">s

    <a href="homepage.php" class="logo">

        <img src="../images/IconCSE4421.svg" width="150" height="75" fill-opacity=".5">

    </a>

    <div class="dropdown">

        <button class = "dropbtn">
            <img src = "../images/heisenberg.svg" width = "50" height ="50">
        </button>

        <div class="dropdown-content">
            <a id=view_profile href="profile.php">View Profile</a>
            <a href="loginpage.php">Sign Out</a>
        </div>
    </div>
</header>
  
  <section class = "profile-main-section" id="main">

    <div class = "group" id = "left-side-wrapper">
		<img id="profile_pic" src = "../images/user.svg" width=100px; height=100px;></img>
		<div class="text" id="name">
		<p id = "name_text">
            <?php
            session_start();
            include('conn.php');
            $userid=$_SESSION['id'];

            $userq=mysqli_query($conn,"select * from `users` where id='$userid'");
            $userrow=mysqli_fetch_array($userq);
            echo $userrow['username'];
            ?>
        </p>
		</div>
		<img class = "icons" onclick="openDM()" title="Start direct message" src = "../images/message.svg" width = "26" height ="26"></img>
	    <img class="icons" onclick="share()" title="Copy profile link" src = "../images/share.svg" width = "26" height ="26"></img>
		<img class="icons" onClick="edit();" src = "../images/edit.svg" width = 26" height ="26" id="edit"></img>
		<div class="info">
		<div class="smalltext" id="major">
		<p id = "major_text">Major: </p>
		</div>
		<div class="smalltext" id="year">
		<p id ="year_text">Class of: </p>
		</div>
		<p>
		<a id="linkedin_link" href="https://www.linkedin.com/"> 
		<img id="linkedin" src = "../images/linkedin.svg" width = "40" height ="40"></img>
		</a>
		<a id="github_link" href="https://www.github.com/"> 
		<img id="github" src = "../images/github.svg" width = "40" height ="40"></img>
		</a>
		</p>
		</div>
    </div>


    <div class = "group" id = "center-wrapper">
		<div class="info" id="bio_box">
		<div class="smalltext" id="bio_text">About Me:</div>
		</div>
		<div class="info" id="skills_box">
		<div class="smalltext" id="skills_text">Skills:</div>
		</div>
	</div>

    <div class = "group" id = "right-side-wrapper">
		<div class="info" id="classes">
		<div class="smalltext" id="class_text">Registered Classes</div>
		<div class="smalltext" id="class_links">links to class boards</div>
		</div>
		<div class="info" id="last_box">
		<div class="smalltext" id="last_comment">Last Comment:</div>
		<div class="smalltext" id="last_post">Last Post:</div>
		</div>
		
	</div>




</section>


  <section class = "edit-profile-section" id="edit-section">
	    <div class = "left-side-wrapper">
		    <div class="text" id="editformheader">Edit Profile Info:</div><br>
		    <label for="uploadpic">Upload Profile Picture</label>
			<input id="file-input" type="file" accept="image/gif, image/jpeg, image/png" name="image" /><br>
			<label for="fullname">Full Name:</label>
			<input type="text" id="fullname" name="fullname" value="Joshua Grimm"><br>
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

		  
	<input type = "button" id="save" onclick="save_edit()" value="Save Changes" />
		
  
  
  </section>

	
  </body>
</html>