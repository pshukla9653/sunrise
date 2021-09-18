<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title;?></title>
	<link rel="shortcut icon" type="image/png" href="<?=base_url('uploads/logo/favicon.png');?>"/>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/backend/assets/css/icons/fontawesome/styles.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/bootstrap.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/core.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/components.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('assets/backend/assets/css/colors.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/backend/assets/css/croppie.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/loaders/pace.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/libraries/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/libraries/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/loaders/blockui.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/editors/summernote/summernote.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/croppie.min.js');?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/datatables.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/extensions/buttons.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/extensions/responsive.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/selects/select2.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/visualization/d3/d3.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/visualization/d3/d3_tooltip.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/styling/switchery.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/styling/uniform.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/selects/bootstrap_multiselect.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/ui/moment/moment.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/pickers/daterangepicker.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/inputs/duallistbox.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/forms/inputs/formatter.min.js');?>"></script>
    

    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/plugins/notifications/pnotify.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/pages/form_layouts.js');?>"></script>
    
    	
	<script type="text/javascript" src="<?=base_url('assets/backend/assets/js/core/app.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/pages/components_modals.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/backend/assets/js/pages/datatables_data_sources.js');?>"></script>
	
    
   
    
	<!-- /theme JS files -->

</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?=base_url('admin');?>"><img src="<?=base_url('uploads/logo/'.$this->CompanyDetail['company_logo']);?>" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>
            
			<ul class="nav navbar-nav navbar-right">
				

				

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?=base_url('assets/backend/assets/images/placeholder.jpg');?>" alt="">
						<span><?=$this->session->userdata('name');?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						
						<li><a href="<?=base_url('secure/auth/logout');?>"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
            <ul class="nav navbar-nav navbar-right">
				<li><a onclick="window.history.go(1); return false;"><i class="fa fa-arrow-right"></i> Forword</a></li>
			</ul>
            <ul class="nav navbar-nav navbar-right">
				<li><a onClick="window.location.href=window.location.href"><i class="fa fa-refresh"></i> Refresh</a></li>
			</ul>
            <ul class="nav navbar-nav navbar-right">
				<li><a onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Back</a></li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-fixed">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?=base_url('assets/backend/assets/images/placeholder.jpg');?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?=$this->GroupName;?></span>
                                    
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="#"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->