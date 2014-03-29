<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="keywords" content="bengkel, Car-Dealer, auto-salon, automobile, business, car, car-gallery, car-selling-template, cars, dealer, marketplace, mobile, real estate, responsive, sell, vehicle" />
	<meta name="description" content="Auto Dealer HTML - Responsive HTML Auto Dealer Template" />

	<!-- Open Graph -->
	<meta property="og:site_name" content="Bengkelin.com"/>
	<meta property="og:title" content="Home" />
	<meta property="og:url" content="http://www.bengkelin.com/" />
	<meta property="og:description" content="Segala hal yang berbau bengkel, dealer, showroom" />

	<!-- Page Title -->
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/autodealer/'; ?>css/style.css" />
	<?php echo link_tag(base_url().'assets/css/jquery.ui.all.css'); ?>
	<link href="<?php echo base_url();?>assets/autodealer/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/autodealer/'; ?>css/jquery.fancybox-1.3.4.css" media="screen" />
	<!--[if IE]>
	<link href="<?php echo base_url().'assets/autodealer/'; ?>css/style_ie.css" rel="stylesheet" type="text/css">
	<![endif]-->
	<link rel="shortcut icon" href="<?php echo base_url().'assets/images/icons/favicon.png"'; ?>">
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.2.0.2.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui.1.10.3.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.bxslider.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.selectik.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.countdown.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/jquery.checkbox.js"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/autodealer/'; ?>js/js.js"></script>
	
	<?php 
	 if (isset($header_content)){
		 echo $header_content;
	 }
	?>
</head>
<body class="page">
	<!--BEGIN HEADER-->
		<div id="header">
			<div class="top_info">
				<div class="logo">
					<a href="#"><img src="<?php echo base_url(); ?>assets/images/icons/Logo-Bengkelin-Medium.png" width="120" style="background-color:#FFF;-moz-border-radius:10px;border-radius:10px;padding:5px;"></a>
				</div>
				<div class="header_contacts">
				</div>
				<div class="socials">
					<a href="<?php echo $this->bengkelin->config['facebook']; ?>"><img src="<?php echo base_url().'assets/autodealer/'; ?>images/fb_icon.png" alt=""></a>
					<a href="<?php echo $this->bengkelin->config['twitter']; ?>"><img src="<?php echo base_url().'assets/autodealer/'; ?>images/twitter_icon.png" alt=""></a>
					<a href="#"><img src="<?php echo base_url().'assets/autodealer/'; ?>images/in_icon.png" alt=""></a>
				</div>
			</div>
			<div class="bg_navigation">
				<div class="navigation_wrapper">
					<div id="navigation">
						<span>Home</span>
						<ul>
							<li><?php echo anchor(base_url(), 'Home');?></li>
							<li><?php echo anchor('content/pages/about', 'Tentang Kami') ?></li>
							<li><?php echo anchor('bengkel/list_bengkel', 'Bengkel'); ?></li>
							<li><?php echo anchor('content/pages/kontak', 'Kontak'); ?></li>
						</ul>
					</div>
					<div id="login_form">
						<?php
						 if (isset($this->bengkelin_auth->user[0]->username) && ($this->bengkelin_auth->user[0]->username != '')): ?>
							<?php if ($this->bengkelin_auth->user[0]->group_id == 1): ?>
							<?php echo anchor('dasboard', 'Dashboard Admin'); ?>
							<?php endif;  ?>
						<?php echo anchor('users/profile', 'Profile'); ?> &nbsp;&nbsp;
						<?php echo anchor('bengkel/profile', 'My Bengkel'); ?> &nbsp;&nbsp;
						<?php echo anchor('auth/logout', 'Logout'); ?>
						<?php else: ?>
						<?php echo anchor('auth/login', 'Login'); ?> &nbsp;&nbsp;
						<?php echo anchor('users/register', 'Register');  ?>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	<!--EOF HEADER-->
	<div id="content">
		<div class="content">
		<?php $flashmsg = flashmsg_get();
				if (!empty($flashmsg)){
					if (substr($flashmsg, 0, 4) == 'Erro'): ?>
						<div class="alert alert-danger">
						<?php echo $flashmsg; ?>
						</div>
					<?php else: ?>
						<div class="alert alert-success">
						<?php echo $flashmsg; ?>
						</div>
					<?php endif; 
				} ?>
