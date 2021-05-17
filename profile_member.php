<?php
    session_start();
    include('includes/member.php');
    
    $member = new Member();

    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        $stm = "SELECT * FROM `member` WHERE email='".$email."' AND password='".$password."'";

        if($query = mysqli_query($member->conn, $stm)){
            $member = mysqli_fetch_assoc($query);
        }
    }else{
        header('Location: http://localhost/staminaGym/');
	}
	
	$update = new Member();
	if(isset($_POST['submit'])){
		$fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $birthdate = $_POST['bday'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		$gender = $_POST['gender'];
		$id = $_POST['submit'];
		
		if($update->updateMember($id, $fname, $lname, $contact, $email, $gender, $birthdate, $password)){
			echo "Success!";
			header('Location: http://localhost/staminaGym/profile_member.php');
		}
	}

	if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$delete = new Member();

		if($delete->deleteMember($id)){
			echo "Success!";
			header('location: http://localhost/staminaGym');
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

	</head>
	
	<body>

	<div id="page">
		
		<div class="fh5co-loader"></div>
		
		<?php include('views/navbar.php'); ?>

		<div class="container">
			<div class="row jumbotron-container">
			<div class="jumbotron jumbotron-sm-padding text-center bg-white generic-shadow">
				<div class="row">
				<div class="avatar-container">
					<img class="img-circle img-thumbnail avatar" src="images/logo-admin.png" alt="Avatar">
					<span class="glyphicon glyphicon-zoom-in avatar-details avatar-details-shadow cursor-pointer"></span>
				</div>
				<div class="row name-container">
					<p><?php echo $member['fname']." ".$member['lname']; ?></p>
					<h5><?php echo $member['email']; ?></h5>
				</div>
				</div>

				<div class="row"><!-- 
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
					Edit Profile
				</button> -->
<!-- 
				<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">
					Delete Account
				</button>
 -->				</div>
			</div>
			</div>

			<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Basic Information</h3>
				</div>
				<div class="panel-body panel-container">
					<address>
					<strong>First Name</strong><br>
					<?php echo $member['fname']; ?>
					</address>

					<address>
					<strong>Last Name</strong><br>
					<?php echo $member['lname']; ?>
					</address>

					<address>
					<strong>Gender</strong><br>
					<?php echo $member['gender']; ?>
					</address>

					<address>
					<strong>Birthdate</strong><br>
					<?php echo $member['birthdate']; ?>
					</address>

					<address>
					<strong>Status</strong><br>
					<?php echo $member['status']; ?>
					</address>
				</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Contact</h3>
				</div>
				<div class="panel-body">

					<address>
					<strong>Email</strong><br>
					<?php echo $member['email']; ?>
					</address>

					<address>
					<strong>Contact Number</strong><br>
					<?php echo $member['contact_num']; ?>
					</address>
				</div>
				</div>
			</div>
			</div>
		</div>
		
		<?php include('views/footer.php'); ?>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- Modal content-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Edit Profile</h4>
			</div>
			<div class="modal-body text-center">
				<form action="" method="post">
                    <input class="input-edit" type="text" name="fname" placeholder="First Name" value="<?php echo $member['fname']; ?>" required/><br>
                    <input class="input-edit" type="text" name="lname" placeholder="Last Name" value="<?php echo $member['lname']; ?>" required/><br>
                    <input class="input-edit" type="text" name="contact" placeholder="Contact Number" value="<?php echo $member['contact_num']; ?>" required/><br>
                    <input placeholder="Birthdate" class="textbox-n input-edit" type="text" value="<?php echo $member['birthdate']; ?>" onfocus="(this.type='date')" name="bday" id="date"><br>
                    <select class="select-gender-edit" name="gender">
						<option disabled selected>Gender</option>
						<?php
							$gender = $member['gender'];

							if(strcmp($gender, "Male")==0){
								echo '<option value="Male" selected>Male</option>';
								echo '<option value="Female">Female</option>';
							}else{
								echo '<option value="Male">Male</option>';
								echo '<option value="Female" selected>Female</option>';
							}
						?>
                    </select><br>
					<input class="input-edit" type="text" name="email" value="<?php echo $member['email']; ?>" placeholder="Email" required/><br>
                    <input class="input-edit" type="password" name="password" value="<?php echo $member['password']; ?>" placeholder="Password" required/><br>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" name="submit" value="<?php echo $member['id'] ?>">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>

		</div>
		
		</div>
	</div>

	<div id="delete" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete Profile</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete your profile?</p>
				</div>
				<div class="modal-footer">
					<a href="?delete=<?php echo $member['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>

		</div>
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

