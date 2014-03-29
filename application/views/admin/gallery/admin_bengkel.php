<?php 
$data['header_content'] = '<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/colorbox/example2/colorbox.css">';
$this->load->view('admin/header',$data); ?>
	<div class="page-header">
		<h1>Gallery</h1>
	</div>
	<div class="inner">
		<div class="col-md-12">
			<?php if ($resBengkel): ?>
				<?php echo form_open_multipart('gallery/admin_save_bengkel'); ?>
				<?php echo form_hidden('id', $bengkel_id); ?>
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
					<?php $namafile = ($row->name_file == '') ? base_url().'assets/images/galleries/bengkel.png' : base_url().'assets/images/galleries/bengkel/'.$row->name_file; ?>
						<a class="group1" href="<?php echo $namafile; ?>">
							<?php if ($row->name_file): ?>
								<img src="<?php echo $namafile; ?>" alt="" class="img-responsive">
							<?php else:  ?>
								<img src="<?php echo base_url().'assets/images/galleries/bengkel.png'; ?>" alt="" class="img-responsive">
							<?php endif; ?>
						</a>
						<!--div class="chkbox"></div-->
						<div class="tools tools-bottom">
							<a href="<?php echo site_url('gallery/admin_delete?gallery_id='.$row->gallery_id.'&bengkel_id='.$row->bengkel_id); ?>" title="DELETE" onclick="javascript:xconfirm=confirm('Apakah Anda yakin mau menghapus gambar ini?');if (xconfirm==true) { return true; } else { return false;}">
								<i class="clip-close"></i>
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
