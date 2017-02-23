<html>
	<head>
		<link href="<?php echo base_url("assets/ui/vendors/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
		<link href="<?php echo base_url("assets/css/admin-login.css") ?>" rel="stylesheet">

    	<link href="<?php echo base_url("assets/ui/vendors/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet">
		<script src="<?php echo base_url("assets/js/jquery-1.11.3.min.js") ?>"></script>
		<script src="<?php echo base_url("assets/ui/vendors/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
	</head>
	<body>
		<nav class="navbar" style="background:#1e88e5 ">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Marva Security Checkpoint</a>				
			</div>
			<div class="navbar navbar-nav navbar-right" style="margin-right:20px">
				<a href="#" class="navbar-brand">PT Super Sinar Abadi</a>
			</div>
		</nav>
		<article>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-lg-8 col-xs-12 col-lg-offset-2">
						<blockquote>
						Login to <b>Marva Security Checkpoint</b> Admin panel to manage data, transactions and reports
						</blockquote>
					</div>
					<div class="col-md12 col-lg-8 col-xs-12 col-lg-offset-2">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">
									<img src="<?php echo base_url("assets/images/logo-sm.png") ?>" alt="" id="img-logo">
									Enter your login information in the form below
								</h3>
							</div>
							<div class="panel-body">
								<?php if (isset($has_error) && $has_error == true): ?>
									<div class="alert alert-danger" role="alert"><strong>Error</strong>	<?php echo $errormsg ?></div>
								<?php endif ?>
								<form action="<?php echo site_url('home/executelogin') ?>" method="POST">
									<div class="row margin20">
										<div class="col-xs-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-group"></i></span>
												<input type="text" class="form-control" name="form-username" placeholder="Username">
											</div>
										</div>	
									</div>								
									<div class="row margin20">
										<div class="col-xs-12">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-key"></i></span>
												<input type="password" class="form-control" name="form-password" placeholder="Password">
											</div>
										</div>
									</div>
									<button class="btn btn-success margin20 right"><i class="fa fa-sign-in"></i> Log In</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-8 col-xs-12 col-lg-offset-2">
						<p class="text-center">Copyright &copy; 2017 Marva Cipta Indonesia | Licensed for PT Super Sinar Abadi</p>
					</div>
				</div>				
			</div>
		</article>
	</body>
</html>