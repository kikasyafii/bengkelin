<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<div class="form-horizontal">
		<div class="form-group">
		<div class="col-md-2">
		<h4>Profile</h4>
		</div>
		<div class="col-md-8">
			<div class="pull-right">
				<?php echo anchor('users/profile/edit', '<i class="glyphicon glyphicon-edit"></i> Edit', 'class="btn btn-sm btn-primary"'); ?>
			</div>
		</div>
		<div class="clearfix"></div>
		</div>
		<hr>
		<div class="col-md-2">
			<?php if ($resGallery): ?>
				<a href="<?php echo base_url();?>assets/images/galleries/users/<?php echo $resGallery[0]->name_file; ?>"><img src="<?php echo base_url(); ?>assets/images/galleries/users/<?php echo $resGallery[0]->name_file;?>" width="150"></a>
			<?php else: ?>
				<img src="<?php echo base_url(); ?>assets/images/galleries/user-icon-128.png">
			<?php endif; ?>
			<br>
			<br>
			<?php echo anchor('gallery/gallery_profile', 'Ubah Foto Profile', 'class="btn btn-info btn-md"'); ?>
			<br>
			<br>
			<?php echo anchor('users/edit_password_profile', 'Ubah Password', 'class="btn btn-info btn-md"'); ?>
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
				<div class="col-md-2"><strong>Tanggal Lahir</strong></div>
				<div class="col-md-8"><?php 
				$bdate = $profile->bdate; 
				if ($bdate != '0000-00-00'){
					list($y,$m,$d) = explode('-',$bdate);
					echo $d.' '.the_month($m).' '.$y;
				}else{
					echo '-';
				}
				?></div>
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
		&nbsp;
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
