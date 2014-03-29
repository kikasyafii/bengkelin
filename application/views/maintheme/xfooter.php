			</div>
		</div>
	</div>
</div>
<div class="col-md-12" style="background-color:#585858;color:#FFFFFF;">
	<div class="before-footer container">
		<div class="col-md-3">
			<h4>Selayang Pandang</h4>
			<p><?php echo $this->bengkelin->config['describe']; ?></p>
		</div>
		<div class="col-md-3">
			<h4>Informasi terkait</h4>
			<ul>
				<li><?php echo anchor('config/content/faq', 'FAQ'); ?></li>
				<li><?php echo anchor('config/content/kontak', 'Kontak'); ?></li>
			</ul>
		</div>
		<div class="col-md-3">
			<h4>Akun Saya</h4>
			<ul>
				<li>Bengkel</li>
				<li>ShowRoom</li>
				<li>Promo</li>
				<li>Layanan</li>
			</ul>
		</div>
		<div class="col-md-3">
			<h4>Get In Touch</h4>
			<ul>
				<li><i class="glyphicon glyphicon-home"></i> Alamat kami: <?php echo $this->bengkelin->config['address']; ?></li>
				<li><i class="glyphicon glyphicon-envelope"></i> Email kami: <?php echo $this->bengkelin->config['email']; ?></li>
				<li><i class="glyphicon glyphicon-earphone"></i> Telepon kami: <?php echo $this->bengkelin->config['phone']; ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<footer>
	<div class="col-md-12">
			<p align="pull-left">&copy;Bengkelin.com <?php echo date('Y'); ?>
			&nbsp;&nbsp;
			<?php echo anchor('content/pages/about', 'About'); ?> | <?php echo anchor('content/pages/api', 'API'); ?> | <?php echo anchor('content/pages/developer', 'Developer'); ?> | <?php echo anchor('content/pages/policy','Policy'); ?> | <?php echo anchor('content/pages/terms_of_use','Terms of Use'); ?>
			</p>
	</div>
</footer>
		<?php 
		if (isset($footer_content)){
			echo $footer_content;
		}
		?>
	</body>
</html>
