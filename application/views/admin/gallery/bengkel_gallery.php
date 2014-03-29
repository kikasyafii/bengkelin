<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url().'assets/css/custom.css'; ?>" rel="stylesheet">
<div class="page-header">
	<h1>Gallery Bengkel</h1>
</div>
<div class="row">
<?php if ($resBengkel && $resBengkel[0]->username == $this->bengkelin_auth->user[0]->username): ?>
<?php echo form_open_multipart('gallery/save_bengkel_gallery'); ?>
<?php echo form_hidden('bengkel_id', $bengkel_id); ?>
	<div class="form-group">
		<div class="col-md-1">
			<label for="gambar" class="label-control">File Gambar</label>
		</div>
		<div class="col-md-10 form-inline">
			<?php echo form_upload('gambar','','class="form-control input-sedang" id="gambar"'); ?> 
			&nbsp;&nbsp;
			<?php echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"'); ?>
			&nbsp;&nbsp;
			<?php echo anchor('bengkel/bengkel_profile/', '<i class="clip-arrow-left"></i> Kembali ke List Bengkel / Show Room', 'class="btn btn-info btn-sm"'); ?>
		</div>
	</div>
<?php echo form_close(); ?>
<?php endif; ?>
</div>
<hr>
<div class="row">
<?php if ($resGallery): ?>
	<?php foreach($resGallery as $row): ?>
		<div class="col-md-3 col-sm-4 gallery-img">
			<div class="wrap-image">
				<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$row->thumb_file; ?>" class="image-list col-md-12">
				<div class="tools tools-bottom">
					<?php echo anchor('gallery/user_delete_bengkel/'.$row->bengkel_id.'/'.$row->gallery_id, '<i class="clip-close-2"></i> Hapus'); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>
<?php $this->load->view('admin/footer');
