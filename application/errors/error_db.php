<!doctype html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Pragmatic Mate s.r.o. - http://pragmaticmates.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
	.: DATABASE ERROR :.
	</title>
	<?php $config =& get_config(); ?>
	<?php $base_url = $config['base_url']; ?>
	
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/assets/css/bootstrap.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/libraries/chosen/chosen.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/libraries/pictopro-outline/pictopro-outline.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/libraries/pictopro-normal/pictopro-normal.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/libraries/colorbox/colorbox.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/libraries/jslider/bin/jquery.slider.min.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/carat/assets/css/carat.css" media="screen, projection">

	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">
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
								<!--ul class="social-links">
									<li class="social-icon google-plus"><a href="http://plus.google.com/">Google+</a></li>
									<li class="social-icon twitter"><a href="http://www.twitter.com/ahmad_muslim">Twitter</a></li>
									<li class="social-icon pinterest"><a href="http://www.path.com">Pinterest</a></li>
									<li class="social-icon facebook"><a href="http://www.facebook.com/romadhoni">Facebook</a></li>
								</ul><!-- /.social-links -->
						</div><!-- /.inner -->
					</div><!-- /.social -->

					<!--div class="languages">
						<ul>
							<li><a href="#"><img src="<?php echo $base_url; ?>assets/carat/assets/img/flags/en.png" alt="#"></a></li>
							<li><a href="#"><img src="<?php echo $base_url; ?>assets/carat/assets/img/flags/ru.png" alt="#"></a></li>
						</ul>
					</div><!-- /.languages -->

					<form action="<?php echo $base_url; ?>index.php/bengkel" method="post" accept-charset="utf-8" class="navbar-form search-form" role="search">						<div class="input-group">
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
								<img src="<?php echo $base_url; ?>assets/images/icons/Logo-Bengkelin-Small.png" alt="Carat HTML Template">
							</a>
						</div><!-- /.logo -->

						<div class="slogan">Mbengkel, Nyowroom, de-el-el</div><!-- /.slogan -->
					</div><!-- /.brand -->
					
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<nav class="collapse navbar-collapse navbar-collapse" role="navigation">
						<ul class="navigation">
							<li><a href="<?php echo $base_url; ?>">Beranda</a></li>
							<li><a href="<?php echo $base_url.'index.php/bengkel/list_bengkel'; ?>">Bengkel</a></li>
							<li><a href="<?php echo $base_url.'index.php/bengkel/list_showroom'; ?>">Show Room</a></li>
							<li><a href="<?php echo $base_url; ?>index.php/dashboard">Dashboard</a></li>
							<li><a href="<?php echo $base_url; ?>index.php/auth/logout">Logout</a></li>
						</ul><!-- /.nav -->
					</nav>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.header-inner -->
</header><!-- /#header -->

<div id="content" class="frontpage">
	<div class="section gray-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
					<h1><?php echo $heading; ?></h1>
					</div>
					<div style="min-height:400px;">
					<?php echo $message; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 <footer id="footer">
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<div class="copyright">
						2014 &copy; Bengkelin.com <span class="separator">/</span> Bagian dari <a href="http://www.alurkria.com">Alurkria.com</a> <span class="separator">/</span> Hak Cipta dilindungi Undang-undang
					</div><!-- /.pull-left -->

					<ul class="nav nav-pills">
						<li><a href="#">Beranda</a></li>
						<li><a href="#">Tentang Kami</a></li>
						<li><a href="#">Bengkel</a></li>
						<li><a href="#">ShowRoom</a></li>
						<li><a href="#">Developer</a></li>
						<li><a href="#">API</a></li>
						<li><a href="#">Policy</a></li>
					</ul><!-- /.nav -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.footer-bottom -->
</footer><!-- /#footer -->

<script src="<?php echo $base_url; ?>assets/carat/assets/js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/assets/js/jquery.ui.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/assets/js/bootstrap.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/assets/js/cycle.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/jquery.bxslider/jquery.bxslider.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/easy-tabs/lib/jquery.easytabs.min.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/chosen/chosen.jquery.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/star-rating/jquery.rating.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/jslider/bin/jquery.slider.min.js"></script>
<script src="<?php echo $base_url; ?>assets/carat/libraries/ezMark/js/jquer	y.ezmark.js"></script>

<script type="text/javascript" src="<?php echo $base_url; ?>assets/carat/libraries/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/carat/libraries/flot/jquery.flot.canvas.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/carat/libraries/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/carat/libraries/flot/jquery.flot.time.js"></script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;v=3.13"></script>
<script src="<?php echo $base_url; ?>assets/carat/assets/js/carat.js"></script></body>
</html>
