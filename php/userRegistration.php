<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>4-A.M. - Get your education right!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/userReg.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="../images/IconCSE442.png" alt="IMG">
			</div>

			<form class="login100-form validate-form"  action = 'processregistration.php' method="POST">
					<span>
							<img src="../images/loginImage.png" alt="Girl in a jacket" style="width:30%;height:auto;">
					</span>
				<span class="login100-form-title">
						Student Registration
					</span>
				<span>
							<button class="button button1" height=10px>Switch Mode</button>
					</span>
                <?php
                if (isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
                ?>

                <div class="wrap-input100 validate-input" data-validate = "First Name is required">
						<input class="input100" type="text" name="firstName" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
                </div>	

                <div class="wrap-input100 validate-input" data-validate = "Last Name is required">
                    <input class="input100" type="text" name="lastName" placeholder="Last Name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                </div>	
                
				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="email" placeholder="Email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div> 
                
                <div class="wrap-input100 validate-input" data-validate = "Username is required">
                    <input class="input100" type="text" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                </div>	

				<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" name="pass" placeholder="Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
				</div>

                <div class="container-login100-form-btn">

                    <input class="login100-form-btn" type = "submit" value="Sign up">

                </div>

            </form>
		</div>
	</div>
</div>

<!--===============================================================================================-->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/bootstrap/js/popper.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="../vendor/tilt/tilt.jquery.min.js"></script>
<script >
	$('.js-tilt').tilt({
		scale: 1.1
	})
</script>
<!--===============================================================================================-->
<script src="../js/main.js"></script>

</body>
</html>