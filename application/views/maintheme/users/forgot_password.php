<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<h3>Lupa Password</h3>
		<hr>
		<p>Isikan alamat valid email Anda</p>
		<?php echo form_open();  ?>
		<div class="form-group">
			<div class="col-md-1"><label for="email">Email</label></div>
			<div class="col-md-3"><?php echo form_input('email', '', 'placeholder="Email" class="form-control input-sedang"'); ?></div>
			<div class="col-md-2"><?php echo form_submit('send', 'Kirim', 'class="btn btn-primary btn-sm"'); ?></div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
