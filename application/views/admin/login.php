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
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				
				<h3>Masuk ke Akun</h3>
				<p>
					Isikan username dan Password
				</p>
				<form class="form-login" method="post" action="<?php echo site_url('auth/login'); ?>">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> Ada kesalahan (error).
						<?php $flashmsg = flashmsg_get(); ?>
						<?php echo $flashmsg; ?>
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="Username">
								<i class="fa fa-user"></i> </span>
							<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
							<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i>
								<a class="forgot" href="#">
									I forgot my password
								</a> </span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Keep me signed in
							</label>
							<button type="submit" class="btn btn-bricky pull-right" type="submit">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Don't have an account yet?
							<a href="#" class="register">
								Create an account
							</a>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			<div class="box-forgot">
				<h3>Forget Password?</h3>
				<p>
					Masukan email Anda 
				</p>
				<form action="<?php echo site_url('users/forgot_password'); ?>" class="form-forgot">
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="Email">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<button class="btn btn-light-grey go-back">
								<i class="fa fa-circle-arrow-left"></i> Back
							</button>
							<button type="submit" class="btn btn-bricky pull-right">
								Submit <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			<div class="box-register">
				<h3>Pendaftaran</h3>
				
				<?php echo form_open('users/register', array('class' => 'form-registration')); ?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
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
								<input type="password" class="form-control" id="password1" name="password" placeholder="Password">
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
									<input type="checkbox" class="grey agree" id="setuju" name="setuju" value="1">
									Menyetujui
								</label><?php echo anchor('content/terms_of_use', 'Terms of Use dan Privacy Policy'); ?>
							</div>
						</div>
						<div class="form-actions">
							<?php echo anchor('auth/login', '<i class="fa fa-circle-arrow-left"></i> Kembali', 'class="btn btn-light-grey"'); ?>
							<button type="submit" class="btn btn-bricky pull-right">
								Submit <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- end: REGISTER BOX -->
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				<?php echo date('Y'); ?> &copy; Bengkelin.com
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
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url().'assets/clipone'; ?>/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url().'assets/clipone'; ?>/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>
