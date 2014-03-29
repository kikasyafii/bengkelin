<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3 Version: 1.2.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>.:: <?php echo $this->bengkelin->config['website_name']; ?> Login ::.</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo base_url().'assets/clipone'; ?>/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login example1">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo"><img src="<?php echo base_url().'assets/images/icons/Logo-Bengkelin-Small.png'; ?>"></div>
			<div class="box-login">
			<h3>Pendaftaran</h3>
			<?php echo form_open('users/register', array('class' => 'form-registration')); ?>
			
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

				<fieldset>
					<p>
						Isi form berikut:
					</p>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username">
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" name="email" placeholder="Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" name="email2" placeholder="Konfirmasi Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
							<i class="fa fa-lock"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" name="password2" placeholder="Konfirmasi Password">
							<i class="fa fa-lock"></i> </span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<?php echo $html; ?><i class="fa fa-lock"></i>
						</span>
					</div>
					<div class="form-group">
						<div>
							<label for="setuju" class="checkbox-inline">
								<input type="checkbox" class="grey agree" id="setuju" name="setuju" value='1'>
							</label>Menyetujui <?php echo anchor('content/terms_of_use', 'Terms of Use dan Privacy Policy'); ?>
						</div>
					</div>
					<div class="form-actions">
						<?php echo form_submit('save', 'Simpan Pendaftaran', 'class="btn btn-danger btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor(base_url(), 'Kembali ke Beranda', 'class="btn btn-info btn-sm"');  ?>
					</div>
				</fieldset>
			<?php echo form_close(); ?>

			</div>
<!-- start: COPYRIGHT -->
			<div class="copyright">
				<?php date('Y-m-d') ?> &copy; Bengkelin.com | Bagian dari <?php echo anchor('http://alurkria.com', 'Alurkria.com'); ?> | Hak Cipta dilindungi Undang-undang
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/respond.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>
