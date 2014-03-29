<?php $this->load->view('admin/header'); ?>
			<div class="page-header">
				<h1>Dashboard</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p class="alert alert-info">Selamat Datang di Bengkelin.com.</p>
			<div class="page-header">
			<h3>Quick Launch</h3>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-icon btn-block">
					<i class="clip-user-3"></i>
					<a href="<?php echo site_url('users/profile');?>">Profile</a>
				</button>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-icon btn-block">
					<i class="clip-wrench"></i>
					<a href="<?php echo site_url('bengkel/profile'); ?>">Bengkelku</a>
				</button>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-icon btn-block">
					<i class="clip-images-3"></i>
					<a href="<?php echo site_url('gallery/gallery_profile'); ?>">Galleryku</a>
				</button>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-icon btn-block">
					<i class="clip-images-3"></i>
					<a href="<?php echo site_url('gallery/gallery_bengkel'); ?>">Gallery Bengkelku</a>
				</button>
			</div>
		</div>
	</div>
<?php $this->load->view('admin/footer'); 
