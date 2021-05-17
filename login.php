<?php 
    session_start();
    include('includes/member.php');

    if(isset($_SESSION['email'])){
        header('Location: http://localhost/staminaGym/');
    }

    $member = new Member();
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($member->loginMember($email, $password)){
			if($_SESSION['type']=="admin" || $_SESSION['type']=="superadmin"){
				header('Location: http://localhost/staminaGym/staminaAdmin/index.php');
			}else{
				header('Location: http://localhost/staminaGym/');
			}
        }else{
            echo "Error!";
        }
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stamina: Login Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/custom.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>

	<style>
		::-webkit-input-placeholder{
			color: #FFFFFF;
		}
	</style>
	
	<body>

	<div id="page">
		
		<div class="fh5co-loader"></div>
		
        <?php include('views/navbar.php'); ?>
        
            <center>
            <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
                    <div class="animate-box con-login" data-animate-effect="fadeIn">
                    <h3 class="text-center login-h3">Login Account</h3>
                        <form action="" method="post">
                            <input class="input-login" type="text" name="email" placeholder="Username" required/><br>
                            <input class="input-login" type="password" name="password" placeholder="Password" required/><br>
                            <button type="submit" name="submit" class="btn btn-primary btn-login" value="login" onclick="window.location.reload()">Login Account</button>
                        </form>
                        <p class="create-acct"><a href="signup.php">No account? Create an account.</a></p>
                    </div>
            </header>
            </center>
		
		<?php include('views/footer.php'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<script src="js/bootstrap.js"></script>
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

