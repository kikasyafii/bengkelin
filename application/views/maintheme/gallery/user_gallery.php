<?php 
$data['header_content'] = '<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/colorbox/example2/colorbox.css">';
$this->load->view('admin/header',$data); ?>
	<div class="page-header">
		<h1>Gallery User</h1>
	</div>
	<div class="inner">
		<div class="col-md-12">
			<?php if ($resGallery): ?>
				<?php echo form_open_multipart('gallery/save_profile_gallery'); ?>
				<div class="form-horizontal">
					<div class="form-group form-inline">
						<label for="gambar" class="label-control">File Gambar</label>
						<?php echo form_upload('gambar','','class="form-control" style="width:220px;" id="gambar"'); ?> 
							&nbsp;&nbsp;
						<?php echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"'); ?>
					</div>
				</div>
				<?php echo form_close(); ?>
			<?php endif; ?>
		</div>
	</div>
	<hr>
	<br>
	<div class="row">
	<?php if ($resGallery): ?>
		<?php foreach($resGallery as $row): ?>
				<div class="col-md-3 col-sm-4 gallery-img">
					<div class="wrap-image">
						<?php if ($row->is_active == 1) : ?>
						<div class="tools tools-right">
						<span class="badge badge-success"><i class="clip-checkmark-2"></i></span>
						</div>
						<?php endif; ?>
						<?php $namafile = ($row->name_file == '') ? base_url().'assets/images/galleries/user-icon-128.png' : base_url().'assets/images/galleries/users/'.$row->name_file; ?>
						<a class="group1" href="<?php echo $namafile; ?>">
							<?php if ($row->name_file): ?>
								<img src="<?php echo $namafile; ?>" alt="" class="img-responsive">
							<?php else:  ?>
								<img src="<?php echo base_url().'assets/images/galleries/user-icon-128.png'; ?>" alt="" class="img-responsive">
							<?php endif; ?>
						</a>
						<div class="tools tools-bottom">
							<a href="<?php echo site_url('gallery/rotate_image/'.$row->gallery_id.'/90'); ?>">
								<i class="clip-rotate-2"></i>
							</a>
							<a href="<?php echo site_url('gallery/set_active?gallery_id='.$row->gallery_id); ?>">
								<i class="clip-checkmark-circle"></i>
							</a>
							<a href="<?php echo site_url('gallery/set_crop?gallery_id='.$row->gallery_id);?>" title="CROPPING IMAGE">
								<i class="clip-pencil"></i>
							</a>
							<a href="<?php echo site_url('gallery/delete?gallery_id='.$row->gallery_id); ?>" title="DELETE" onclick="javascript:xconfirm=confirm('Apakah Anda yakin mau menghapus gambar ini?');if (xconfirm==true) { return true; } else { return false;}">
								<i class="clip-close"></i>
							</a>
							<a href="<?php echo site_url('gallery/rotate_image/'.$row->gallery_id.'/270'); ?>">
								<i class="clip-rotate"></i>
							</a>
						</div>
					</div>
				</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
<?php 
$data['footer_content'] = '<script src="'.base_url().'assets/clipone/plugins/colorbox/jquery.colorbox-min.js"></script>
		<script src="'.base_url().'assets/clipone/js/pages-gallery.js"></script>';
$data['footer_init'] = 'PagesGallery.init();';
$this->load->view('admin/footer',$data);
