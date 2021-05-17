<?php
    session_start();
    include('includes/orderClass.php');

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $delete = new OrderClass();

        if($delete->deleteOrder($id)){
            echo "Success!";
            header('location: http://localhost/staminaGym/purchase.php');
        }else{
            echo "Failed to delete!".mysqli_error($delete->conn);
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

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
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
    <style>
        table{
            width: 90%;
        }
    </style>

	</head>
	
	<body>

	<div id="page">
		
		<div class="fh5co-loader"></div>
		
		<?php include('views/navbar.php'); ?>

            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Subscribe</h2>
                </div>

            <div class="container animate-box">

                    <?php
                        $display = new OrderClass();
                        $memId = $_SESSION['id'];
                        
                        $stm = "SELECT * FROM order_class WHERE member_id='".$memId."' AND isPaid='not'";

                        if($result = mysqli_query($display->conn, $stm)){
                            $rowcount=mysqli_num_rows($result);

                            if($rowcount == 0){
                                echo '<br><br><br><br><h4 class="text-center">No Subscription Made!</h4><br><br>';
                            }else{
                                echo '<table class="table table-hover">
                                    <thead>
                                        <th>Workout Routine</th>
                                        <th>Assign Trainer</th>
                                        <th>Schedule</th>
                                        <th>Action</th>
                                    </thead>';
                            }

                            while($row = mysqli_fetch_assoc($result)){
                                $class = $display->getClassService($row['class_id']);
                                $trainer = $display->getTrainer($class['trainer_id']);

                                echo '<tr>
                                    <td>'.$class['title'].'</td>
                                    <td>'.(($trainer != 'null')? $trainer['fname'].' '.$trainer['lname']:'null').'</td>
                                    <td>'.$class['schedule_class'].'</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#viewDetails'.$row['id'].'">View Workout Routine</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteOrder'.$row['id'].'">Remove</button>
                                    </td>
                                </tr>';
                            }
                        }
                    ?>
                    
                </table>
            </div>
        
        </div>

        <?php
            //Modals of Order Class

            if($modalRes = mysqli_query($display->conn, $stm)){
                while($mod = mysqli_fetch_assoc($modalRes)){
                    $cl = $display->getClassService($mod['class_id']);
                    $tr = $display->getTrainer($cl['trainer_id']);

                    echo '<div id="viewDetails'.$mod['id'].'" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">View Class Details</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center">
                                        <img src="images/extra.jpg" style="width:auto; height:250px;">
                                        <h3 class="service-title">'.$cl['title'].'</h3>
                                        <h4 style="color:red;">Php '.$cl['price'].'</h4>
                                    </div>

                                    <div class="row" style="text-align:left;">
                                        <div class="col-sm-3"><strong>Schedule</strong></div>
                                        <div class="col-sm-9">'.$cl['schedule_class'].'</div>
                                    </div>
                                    <div class="row" style="text-align:left;">
                                        <div class="col-sm-3"><strong>Date Start</strong></div>
                                        <div class="col-sm-9">'.$cl['date_created'].'</div>
                                    </div>
                                    <div class="row" style="text-align:left;">
                                        <div class="col-sm-3"><strong>Description</strong></div>
                                        <div class="col-sm-9">'.$cl['description'].'</div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                        </div>';

                        echo '<div id="deleteOrder'.$mod['id'].'" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Remove Subscription</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="?delete='.$mod['id'].'"><button class="btn btn-danger">Delete</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        
                            </div>
                        </div>';
                }
            }

        ?>
	</div>
    <?php //include('views/footer.php'); ?>

	</body>
</html>

