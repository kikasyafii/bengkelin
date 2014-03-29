<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="form-horizontal">
		<div class="form-group">
		<div class="col-md-2">
		<h4>Profile Users</h4>
		</div>
		<div class="clearfix"></div>
		</div>
		<hr>
		<?php if (empty($profile) || !isset($profile)): ?>
		<div class="col-md-12">
			<p class="center"><h3><strong>User Not Found</strong></h3>
		</div>
		<?php else: ?>
		<div class="col-md-2">
			<?php if ($resGallery): ?>
				<img src="<?php echo base_url(); ?>assets/images/galleries/users/<?php echo $resGallery[0]->name_file;?>" width="150">
			<?php else: ?>
				<img src="<?php echo base_url(); ?>assets/images/galleries/user-icon-128.png">
			<?php endif; ?>
			<br>
			<br>
			<?php if ($profile->group_id == 3): ?>
			<?php echo anchor('bengkel/show_profile/'.$profile->username, 'Show Profile Bengkel', 'class="btn btn-info btn-sm"'); ?>
			<?php endif; ?>
		</div>
		<div class="col-md-9">
			<div class="form-group">
				<div class="col-md-2"><strong>Username</strong></div>
				<div class="col-md-8"><?php echo $profile->username; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Nama Depan</strong></div>
				<div class="col-md-8"><?php echo $profile->first_name; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Nama Belakang</strong></div>
				<div class="col-md-8"><?php echo $profile->last_name; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Email</strong></div>
				<div class="col-md-8"><?php echo $profile->email; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Alamat</strong></div>
				<div class="col-md-8"><?php echo $profile->alamat; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Kota</strong></div>
				<div class="col-md-8"><?php echo $profile->kota; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Propinsi</strong></div>
				<div class="col-md-8"><?php echo $profile->propinsi; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Negara</strong></div>
				<div class="col-md-8"><?php echo $profile->negara; ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="form-group">
				<div class="col-md-2"><strong>Phone</strong></div>
				<div class="col-md-8"><?php echo $profile->phone; ?></div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-12">
			
		</div>
		<?php endif; ?>
		&nbsp;
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
