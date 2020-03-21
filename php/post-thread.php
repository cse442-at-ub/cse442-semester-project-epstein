<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="../CSS/postthreadstyles.css" rel="stylesheet" type="text/css">
</head>


<body class ="container full-height-grow">

<?php include('header.php');?>


<?php
if (isset($_POST['classi'])){

    $_SESSION['currentClass'] = $_POST['classi'];
    echo '<strong style="font-size: xx-large">';
    $classid = $_SESSION['currentClass'];
    include ('conn.php');
    $classname = mysqli_query($conn,"select * from classes where id = '$classid'");
    $rows = mysqli_fetch_array($classname);
    $namerow = $rows['name'];
    $numrow = $rows['classnum'];


    echo $numrow;
    echo $namerow;




    echo'</strong>';

}
?>

<div class="row bootstrap snippets">
		<div class="col-md-6 col-md-offset-2 col-sm-12">
			<div class="comment-wrapper">
				<div class="panel panel-info">

					<div class="panel-heading">
						<p><strong>Comment Panel</strong></p>
					</div>
					<div class="panel-body">
						<textarea class="form-control" placeholder="write a comment..." rows="3" style="margin: 0px; width: 1700px; height: 100px;"></textarea>
						<br>
						<button type="button" class="btn btn-info pull-right">Post</button>
						<div class="clearfix"></div>
						<hr>
						<ul class="media-list">


							<li class="media">
								<a href="#" class="pull-left">
									<img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
								</a>
								<div class="media-body">
									<span class="text-muted pull-right">
										<small class="text-muted">30 min ago</small>
									</span>
									<a>
									<a href="will be profile link">
									<strong class="text-success">@JoshGrimm</strong>
									</a>
									<p>
										I loved this course, it was very organized! I believe it is taught by Prof. Hertz <span><a href="#" style="margin-left: 20px;">reply</a></span> 
									</p>		
								</div>
							</li>


							<li class="media">
								<a href="#" class="pull-left">
									<img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
								</a>
								<div class="media-body">
									<span class="text-muted pull-right">
										<small class="text-muted">35 min ago</small>
									</span>
									<a>
									<a href="will be profile link">
									<strong class="text-success">@MDRafsan</strong>
								    </a>
									<p>
										I found the course very informative and learned a lot.<span><a href="#" style="
										margin-left: 20px;">reply</a></span>
									</p>
								</div>
							</li>


						</ul>
					</div>
				</div>
			</div>
	
		</div>
	</div>

</body></html>
