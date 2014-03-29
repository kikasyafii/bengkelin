<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Upload Foto Profile</h1>
</div>
<div class="row">
	<div class="col-sm-6 col-md-6">
		<?php echo form_open_multipart('gallery/save_profile_gallery'); ?>
		<div class="col-md-12 form-inline">
			
			<?php if ($resGallery[0]->name_file != '' && isset($resGallery)): ?>
				<img src="<?php echo base_url().'assets/images/galleries/users/'.$resGallery[0]->name_file; ?>" style="text-align:left;width:400px;border:1pt solid #CFCFCF;padding:10px;">
			<?php else : ?>
				<img src="<?php echo base_url().'assets/images/galleries/user-icon-128.png'; ?>" style="text-align:left;width:400px;border:1pt solid #CFCFCF;padding:10px;">
			<?php endif; ?>
			<?php echo form_upload('gambar','','class="form-control" style="width:400px;" id="gambar"'); ?> 
			&nbsp;&nbsp;
			<?php echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"'); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer');
