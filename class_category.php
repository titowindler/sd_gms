<?php
    session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tujan Stamina Gym</title>
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
	
	<body>

	<div id="page">
		
		<div class="fh5co-loader"></div>
		
		<?php include('views/navbar.php'); ?>

        <div id="fh5co-gallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                        <h2>Workout Routines</h2>
                        <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row row-bottom-padded-md">
                    <div class="col-md-12">
                        <ul id="fh5co-portfolio-list">

                            <li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/pilates.jpg); ">
                                <a href="#class_pilates.php">
                                    <div class="case-studies-summary">
                                        <h2>Pilates Routine</h2>
                                    </div>
                                </a>
                            </li>

                            <li class="two-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/extra2.jpeg); ">
                                <a href="class_regular.php">
                                    <div class="case-studies-summary">
                                        <h2>Regular Fee (Gym Usage)</h2>
                                    </div>
                                </a>
                            </li>

                            <li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(images/cardio2.jpg); ">
                                <a href="#class_cardio.php">
                                    <div class="case-studies-summary">
                                        <h2>Cardio Routine</h2>
                                    </div>
                                </a>
                            </li>

                            <li class="one-half animate-box" data-animate-effect="fadeIn" style="background-image: url(images/yoga.jpeg); ">
                                <a href="#class_yoga.php">
                                    <div class="case-studies-summary">
                                        <h2>Yoga Routine</h2>
                                    </div>
                                </a>
                            </li>

                            <li class="one-half animate-box" data-animate-effect="fadeIn" style="background-image: url(images/bodybuilding.jpeg); "> 
                                <a href="#class_bodybuilding.php">
                                    <div class="case-studies-summary">
                                        <h2>Body Building Routine</h2>
                                    </div>
                                </a>
                            </li>
                            
                        </ul>		
                    </div>
                </div>
            </div>
        </div>
		
		<?php include('views/footer.php'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
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

