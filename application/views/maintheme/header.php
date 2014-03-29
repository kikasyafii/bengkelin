<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Pragmatic Mate s.r.o. - http://pragmaticmates.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="2X55Ehsp6e9A3R2AoBFXYWs9EHCKDZPXdACGxv_xVss" />
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>assets/css/bootstrap.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>libraries/chosen/chosen.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>libraries/pictopro-outline/pictopro-outline.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>libraries/pictopro-normal/pictopro-normal.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>libraries/colorbox/colorbox.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>libraries/jslider/bin/jquery.slider.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>assets/css/carat.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/carat/'; ?>assets/css/custom.css" media="screen, projection">
	
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">
	<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
	
	<link rel="shortcut icon" href="<?php echo base_url().'assets/images/icons/favicon.png'; ?>" />
	<?php 
		if (isset($header_content)){
			echo $header_content;
		}
	
	?>
	<!-- SEO -->
	<meta property="og:title" content="<?php echo $this->bengkelin->config['slogan'];?>" name="title" />
	<meta property="og:description" content="<?php echo $this->bengkelin->config['describe']; ?>" name="description" />
	<meta property="og:url" content="<?php echo current_url(); ?>" />
	<meta property="article:author" content="http://alurkria.com" />
	<meta property="article:section" content="<?php echo $this->bengkelin->config['title']; ?>" />
	<meta property="og:site_name" content="<?php echo $this->bengkelin->config['website_name']; ?>" />
	<meta name="keywords" content="bengkel showroom motor mobil" />
	<meta name="twitter:card" content="summary" />
<!-- /SEO -->

	<title><?php echo $this->bengkelin->config['title']; ?></title>
</head>
<body>
  <div class="topbar gray">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-12 header-top-left">
				<div>
					<div class="news">
						<div class="inner">
								<ul class="news-list">
									<!--li>Chrysler plans new <a href="#">product</a> at Windsor, Ontario, plant, report says</li>
									<li>Tesla retail model faces new legal challenge in Ohio</li>
									<li>Toyota revealing new model</li-->

								</ul><!-- /.news-list -->
						</div><!-- /.inner -->
					</div><!-- /.news -->
				</div>
			</div>

			<div class="col-md-6 col-xs-12 header-top-right">
				<div>
					<div class="social">
						<div class="inner">
								<ul class="social-links">
									<li class="social-icon google-plus"><a href="<?php echo $this->bengkelin->config['gplus']; ?>">Google+</a></li>
									<li class="social-icon twitter"><a href="<?php echo $this->bengkelin->config['twitter']; ?>">Twitter</a></li>
									<li class="social-icon pinterest"><a href="<?php echo $this->bengkelin->config['path']; ?>">Pinterest</a></li>
									<li class="social-icon facebook"><a href="<?php echo $this->bengkelin->config['facebook']; ?>">Facebook</a></li>
								</ul><!-- /.social-links -->
						</div><!-- /.inner -->
					</div><!-- /.social -->

					<!--div class="languages">
						<ul>
							<li><a href="#"><img src="<?php echo base_url().'assets/carat/'; ?>assets/img/flags/en.png" alt="#"></a></li>
							<li><a href="#"><img src="<?php echo base_url().'assets/carat/'; ?>assets/img/flags/ru.png" alt="#"></a></li>
						</ul>
					</div><!-- /.languages -->

					<?php echo form_open('bengkel', array('class' => 'navbar-form search-form', 'role' => 'search')); ?>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" required="required">

							<span class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="icon icon-normal-magnifier"></i></button>
							</span><!-- /.input-group-btn -->
						</div><!-- /.input-group -->                     
					</form><!-- /.search-form -->
				</div>
			</div><!-- /.col-md-5 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.topbar -->

<header id="header">
	<div class="header-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<div class="brand">
						<div class="logo">
							<a href="/">
								<img src="<?php echo base_url(); ?>assets/images/icons/Logo-Bengkelin-Small.png" alt="Bengkelin.com Logo" title="Bengkelin.com Logo">
							</a>
						</div><!-- /.logo -->

						<div class="slogan"><?php echo $this->bengkelin->config['slogan']; ?></div><!-- /.slogan -->
					</div><!-- /.brand -->
					
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<nav class="collapse navbar-collapse navbar-collapse" role="navigation">
						<ul class="navigation">
						<li><?php echo anchor(base_url(), 'Beranda' ); ?></li>
						<li><?php echo anchor('bengkel/list_bengkel', 'Bengkel'); ?></li>
						<li><?php echo anchor('bengkel/list_showroom', 'Show Room'); ?></li>
						<?php if (!isset($this->bengkelin_auth->user) || $this->bengkelin_auth->user[0]->username == '') : ?>
							<li><?php echo anchor('auth/login', 'Login'); ?></li>
							<li> <?php echo anchor('users/register', 'Register'); ?></li>
						<?php else: ?>
							<li><?php echo anchor('dashboard', 'Dashboard'); ?></li>
							<li><?php echo anchor('auth/logout', 'Logout'); ?></li>
						<?php endif; ?>
						</ul><!-- /.nav -->
					</nav>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.header-inner -->
</header><!-- /#header -->
