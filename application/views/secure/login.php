<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Login</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/colors.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/loaders/pace.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/libraries/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/libraries/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/styling/uniform.min.js');?>"></script>

	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/app.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/pages/login.js');?>"></script>
	<!-- /theme JS files -->
    <link rel="shortcut icon" type="image/png" href="<?=base_url('uploads/logo/favicon.png');?>"/>
     <link rel="manifest" href="manifest.webmanifest">
    <script src="index.js"></script>
    

</head>

<body class="login-container bg-slate-800">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
				
					<!-- Advanced login -->
                    <?=form_open('secure/auth/login');?>
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div><img src="<?=base_url('uploads/logo/sunrise_small.png');?>"/></div>
								<h5 class="content-group-lg"><small class="display-block">Enter your credentials</small></h5>
							</div>
<?php echo $this->session->flashdata('msg'); ?>
							<div class="form-group has-feedback has-feedback-left">
				<?=form_input(array('class'=>'form-control', 'name'=>'username', 'autofocus'=>'autofocus','placeholder'=>'Username','value'=>set_value('username')));?>
                              
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
                                <?=form_error('username', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group has-feedback has-feedback-left">
           <?=form_password(array('class'=>'form-control', 'name'=>'password','placeholder'=>'Password','value'=>set_value('password')));?>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
                                    
								</div>
                                <?=form_error('password', '<p class="text-danger">', '</p>'); ?>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled">
											Remember
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<a href="#">Forgot password?</a>
										
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="submit" class="btn bg-blue btn-block" value="login">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

							
						</div>
					<?=form_close();?>
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
<script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    	window.setTimeout(function () {
			$(".alert-info").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 3000);
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 5000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
    </script>
</body>
</html>
