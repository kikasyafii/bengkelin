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
	<?php echo link_tag(base_url().'assets/css/flatly-bootstrap.min.css'); ?>
	<?php echo link_tag(base_url().'assets/css/jquery.ui.all.css'); ?>
	<?php echo link_tag(base_url().'assets/css/custom.css'); ?>
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
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand"><?php echo $this->bengkelin->config['website_name']; ?> </a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
						<?php echo anchor('auth/logout', 'Logout'); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
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
				<!-- untuk menu, sementara ini kosongi dulu -->
