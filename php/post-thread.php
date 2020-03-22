<!DOCTYPE html>
<html lang="en" style="
	background: linear-gradient(-135deg, #f0ffb1, #fdc689);

"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
   <header class = "main-header">

    <a href="../HTML/HomePage.html" class="logo">

        <img src="images/IconCSE4421.svg" width="150" height="75" fill-opacity=".5">

    </a>

    <div class="dropdown">

        <button class = "dropbtn">
            <img src = "images/heisenberg.svg" width = "50" height ="50">
            <a>Username Here</a>
        </button>

        <div class="dropdown-content">
            <a id=view_profile href="../HTML/profile.html">View Profile</a>
            <a href="#">Sign Out</a>
        </div>
    </div>
</header>

	<strong style="
	font-size: -webkit-xxx-large;">English 101
	</strong>
	<div>
        <form action="" method="post">
        <textarea input type="text" name="number1" cols="40" rows="5" style="margin-bottom:10px;width:1200px;height: 150px;border: 4px solid #e0b1b1;margin-top: 15px;background-color: white;"></textarea>

        
        
		<p><input type="submit"/></p>
		<ul class="post-OP">
			<li class="poster">
				<div class="media-body">
					<span class="text-muted pull-right">
						<small class="text-muted">55 min ago</small>
					</span>
					<strong class="text-success">Posted by: <a>
						<a href="will be profile link"> @Rasel Ahmed</strong>
					</a>
			</li>
		</ul>	
	<hr style="margin-top: 0px;">
	</div>
	

</body></html>
<?php
if (isset($_POST['number1'])) {
    $dbh = testdb_connect ($host, $username, $password);
    $description = addslashes ($_POST['number1']);
    $query = "INSERT INTO POSTS ". "(subject,content, date) "."VALUES ". "('->','$description','2014')"; 
    
    $stmt = $dbh->prepare( $query );
    $product_id=1;
    $stmt->bindParam(1, $product_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>