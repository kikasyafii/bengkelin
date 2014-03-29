<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo $this->bengkelin->config['website_name']; ?></title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: JAVASCRIPT FIRST -->
		<!-- end; JAVASCRIPT FIRST -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/font-awesome/css/font-awesome.min.css">
		<link href="<?php echo base_url(); ?>assets/css/jquery.ui.all.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/print.css" type="text/css" media="print"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<link rel="shortcut icon" href="<?php echo base_url().'assets/images/icons/favicon.png'; ?>" />
		<?php if (isset($header_content)): ?>
			<?php echo $header_content; ?>
		<?php endif; ?>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="footer-fixed navigation-small">
		<!-- start: HEADER -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->
			<div class="container">
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->
					<a class="navbar-brand" href="<?php echo base_url(); ?>">
						<img src="<?php echo base_url(); ?>assets/images/icons/Logo-Bengkelin-Small.png" width="100">
					</a>
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<?php if (isset($this->bengkelin_auth->user) && $this->bengkelin_auth->user[0]->username != ''): ?>
					<ul class="nav navbar-right">
						<!-- start: TO-DO DROPDOWN -->
						<!-- end: NOTIFICATION DROPDOWN -->
						
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<img src="<?php echo $this->bengkelin_auth->avatar(); ?>" class="circle-img" alt="">
								<span class="username"><?php echo $this->bengkelin_auth->user[0]->username; ?></span>
								<i class="clip-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo site_url('users/profile')?>">
										<i class="clip-user-2"></i>
										&nbsp;Setting
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('bengkel/bengkel_profile'); ?>">
										<i class="clip-calendar"></i>
										&nbsp;Profile
									</a>
								<li>
									<a href="<?php echo site_url('auth/logout'); ?>">
										<i class="clip-exit"></i>
										&nbsp;Log Out
									</a>
								</li>
							</ul>
						</li>
						<!-- end: USER DROPDOWN -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
					<?php endif;?>
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<?php if (isset($this->bengkelin_auth->user) && $this->bengkelin_auth->user[0]->username != ''): ?>
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu">
						<?php if ($this->bengkelin_auth->user[0]->group_id == 1): ?>
							<?php echo $this->bengkelin->menu_admin(); ?>
						<?php else: ?>
							<?php echo $this->bengkelin->menu_bengkel(); ?>
						<?php endif; ?>
					</ul>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<?php endif; ?>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
						<?php 
							$flashmsg = flashmsg_get();
							if (!empty($flashmsg)){
								if (substr($flashmsg, 0, 4) == 'Erro'): ?>
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $flashmsg; ?>
									</div>
								<?php else: ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<?php echo $flashmsg; ?>
									</div>
								<?php endif; 
							} ?>
