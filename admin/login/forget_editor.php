<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="../vendor/animate/animate.css">

		<link rel="stylesheet" href="../vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../css/custom.css">

		<!-- Head Libs -->
		<script src="../vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="..//" class="logo float-left">
					<img src="../img/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-right">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Recover Password</h2>
					</div>
					<div class="card-body">
						<div class="alert alert-info">
							<p class="m-0">Enter your e-mail below and we will send you reset instructions!</p>
						</div>
                        <?php
							  if(isset($message))
							  {
								echo '<code>'.$message.'</code>';	  
							  }
						 ?>

						<form>
							<div class="form-group mb-0">
								<div class="input-group">
									<input name="username" type="email" placeholder="E-mail" class="form-control form-control-lg" />
									<span class="input-group-append">
                                        <input type="hidden" name="cmd" value="forget_pass">
										<button class="btn btn-primary btn-lg" type="submit">Reset!</button>
									</span>
								</div>
							</div>

							<p class="text-center mt-3">Remembered? <a  href="javascript:void();" onClick="location.href='index.php'">Sign In!</a></p>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="../vendor/jquery/jquery.js"></script>
		<script src="../vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../vendor/popper/umd/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../vendor/common/common.js"></script>
		<script src="../vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="../vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../js/theme.init.js"></script>

	</body>
</html>