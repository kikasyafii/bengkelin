<!DOCTYPE html>
<html lang="en">
	<head>
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>
	.: <?php echo $this->bengkelin->config['title']; ?> :.
	</title>
	<?php echo link_tag(base_url().'assets/css/cosmo-bootstrap.min.css'); ?>
	<?php echo link_tag(base_url().'assets/css/jquery.ui.all.css'); ?>
	<?php echo link_tag(base_url().'assets/css/main-custom.css'); ?>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.2.0.2.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui.1.10.3.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.ui.core.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.ui.widget.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'; ?>"></script>
	<?php if (isset($header_content)){
		echo $header_content;
	} ?>
	</head>
	<body>
		<header>
			<div class="topbar">
				<div class="container">
					<div class="row">
					<!-- untuk menu, sementara ini kosongi dulu -->
						<div class="col-md-8">
							
						</div>
						<div class="col-md-4">
							<ul id="topsocial" class="pull-right">
								<?php if ($this->bengkelin->config['facebook'] != ''): ?>
								<li><?php echo anchor($this->bengkelin->config['facebook'], '<img src="'.base_url().'assets/images/icons/facebook.png" class="socialicon">'); ?></li>
								<?php endif; ?>
								
								<?php if ($this->bengkelin->config['twitter'] != ''): ?>
								<li><?php echo anchor($this->bengkelin->config['twitter'], '<img src="'.base_url().'assets/images/icons/twitter.png" class="socialicon">'); ?></li>
								<?php endif; ?>
								
								<?php if ($this->bengkelin->config['gplus'] != ''): ?>
								<li><?php echo anchor($this->bengkelin->config['gplus'], '<img src="'.base_url().'assets/images/icons/gplus.png" class="socialicon">'); ?></li>
								<?php endif; ?>
								
								<?php if ($this->bengkelin->config['path'] != ''): ?>
								<li><?php echo anchor($this->bengkelin->config['path'], '<img src="'.base_url().'assets/images/icons/path.png" class="socialicon">'); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="navbar navbar-inverse" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'assets/images/icons/logobengkelin.jpg'; ?>" class="logo"></a>
					</div>
					<div class="collapse navbar-collapse">
						<div class="nav navbar-nav">
							<ul class="nav navbar-nav">
								<li><?php echo anchor('#', 'Home'); ?></li>
								<li><?php echo anchor('#', 'About'); ?></li>
								<li><?php echo anchor('#', 'Kontak'); ?></li>
								<li><?php echo anchor('#', 'Artikel'); ?></li>
							</ul>
						</div>
						<div class="nav navbar-nav navbar-right">
							<ul class="nav navbar-nav">
							<?php if (isset($this->bengkel_auth->user[0]->username) && ($this->bengkel_auth->user[0]->username != '')): ?>
							<li><?php echo anchor('auth/logout', 'Logout'); ?></li>
							<?php else: ?>
							<li><?php echo anchor('auth/login', 'Login'); ?> </li> 
							<li><?php echo anchor('users/register', 'Register');  ?></li>
							<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="container">
		<div class="col-md-12">
			<div class="content">
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
