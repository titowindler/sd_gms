<nav class="fh5co-nav" role="navigation">
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-right menu-1">
					<?php
						if(isset($_SESSION['email'])){
							$fname = $_SESSION['fname'];
							echo '<p class="num">'.$fname.'</p>';
							echo '<ul class="fh5co-social">';
							echo '<li><a href="http://localhost/staminaGym/profile_member.php"><button class="btn btn-navbar-cus btn-outline btn-sm">Profile</button></a></li>';
							echo '<li><a href="http://localhost/staminaGym/includes/logoutMember.php"><button class="btn btn-navbar-cus btn-outline btn-sm">Logout</button></a></li>';
							echo '</ul>';
						}else{
							echo '<p class="num">Become a Member</p>';
							echo '<ul class="fh5co-social">';
							echo '<li><a href="http://localhost/staminagym/login.php"><button class="btn btn-navbar-cus btn-outline btn-sm">Login</button></a></li>';
							echo '<li><a href="http://localhost/staminagym/signup.php"><button class="btn btn-navbar-cus btn-outline btn-sm">Signup</button></a></li>';
							echo '</ul>';
						}
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="#">Stamina<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li class="has-dropdown"><a href="class_category.php">Workout Routine</a>
							</li>

							<?php
								if (isset($_SESSION['email'])) {
									echo '<li><a href="purchase.php">Subscribe</a></li>';
									echo '</ul>';
								}else{
									//echo '<li><a href="http://localhost/staminagym/blog.php">Blog</a></li>';
								    //echo '<li><a href="#">About Us</a></li>';
								}
							?>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</nav>