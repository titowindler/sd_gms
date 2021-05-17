<?php
    session_start();
    include('includes/classService.php');
    include('includes/orderClass.php');

    if(isset($_GET['service'])){
        if(isset($_SESSION['email'])){
            $class_id = $_GET['service'];
            $member_id = $_SESSION['id'];

            $order = new OrderClass();

            if($order->insertOrder($class_id, $member_id)){
                echo "Success!";
                header('location: http://localhost/staminaGym/purchase.php');
            }else{
                echo "Failed to Order!".mysqli_error($order->conn);
            }
        }else{
            header('location: http://localhost/staminagym/login.php');
        }
    }

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stamina</title>
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
    <link rel="stylesheet" href="css/w3.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
    <style>
        .row{
            width:100%;
        }
        .row{
            margin-left:5px;
            margin-right:5px;
        }
    </style>

	</head>
	
	<body>

	<div id="page">
		
		<div class="fh5co-loader"></div>
		
		<?php include('views/navbar.php'); ?>

		<div id="fh5co-pricing">

			<div class="container">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Pilates Class Services</h2>
                    </div>
                </div>
			</div>


			<div class="container-fluid w3-row-padding" id="about">
                <?php
                    $display = new ClassService();
                    $stm = "SELECT * FROM class_service WHERE type='pilates' AND status='active'";
                    if($result = mysqli_query($display->conn, $stm)){
                        $ctr = mysqli_num_rows($result);
                        if($ctr > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $type = $row['type'];
                                $title = $row['title'];
                                $max = $row['max_cap'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $month = $row['duration_month'];
                                $year = $row['duration_year'];
                                $schedule = $row['schedule_class'];
                                $date_created = $row['date_created'];
                                $num_ordered = $row['num_ordered'];
    
                                $displayDesc = substr($description, 0, 45);
    
                                echo '<div class="w3-third w3-margin-bottom animate-box">
                                <div class="w3-card-4">
                                <img class="cards-img" src="images/gallery-1.jpg" alt="John" style="width:100%">
                                <div class="w3-container">
                                    <h3 class="title-class-card"><a href="#">'.$title.'</a></h3>
                                    <h4 class="title-class-card"><a href="#">Php '.$price.'</a></h4>
                                    <p class="w3-opacity">'.$month.' Month/s '.(($year != 0)?$year.' year':'').'</p>
                                    <p>'.$displayDesc.'</p>
                                    <p class="text-center"><a href="#"><button class="btn btn btn-primary btn-class-card" data-toggle="modal" data-target="#order'.$id.'">Add to Purchase</button></a></p>
                                </div>
                                </div>
                            </div>';

                            echo '<div id="order'.$id.'" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                        
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">'.$title.'</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="row">
                                            <img src="images/extra.jpg" style="width:auto; height:250px;">
                                            <h3 class="service-title">'.$title.'</h3>
                                            <h4 style="color:red;">Php '.$price.'</h4>
                                        </div>

                                        <div class="row" style="text-align:left;">
                                            <div class="col-sm-3"><strong>Schedule</strong></div>
                                            <div class="col-sm-9">'.$schedule.'</div>
                                        </div>
                                        <div class="row" style="text-align:left;">
                                            <div class="col-sm-3"><strong>Duration</strong></div>
                                            <div class="col-sm-9">null</div>
                                        </div>
                                        <div class="row" style="text-align:left;">
                                            <div class="col-sm-3"><strong>Date Start</strong></div>
                                            <div class="col-sm-9">'.$date_created.'</div>
                                        </div>
                                        <div class="row" style="text-align:left;">
                                            <div class="col-sm-3"><strong>Max Enrollee</strong></div>
                                            <div class="col-sm-9">'.$max.'</div>
                                        </div>
                                        <div class="row" style="text-align:left;">
                                            <div class="col-sm-3"><strong>Description</strong></div>
                                            <div class="col-sm-9">'.$description.'</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="?service='.$id.'"><button type="button" class="btn btn-primary" style="width:100%;">Order Class Service</button></a>
                                    </div>
                                    </div>
                        
                                </div>
                                </div>';
                            }

                        }else{
                            echo '<h4 class="text-center">No results found.</h4><br>';
                        }
                    }
                ?>

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