<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Upload Foto Profile</h1>
</div>
<div class="row">
	<div class="col-sm-8 col-md-8">
		<?php echo form_open_multipart('gallery/admin_save_profile'); ?>
		<?php echo form_hidden('user_id',$user_id); ?>
		<div class="col-md-12 form-inline">
			<?php if ($resGallery): ?>
				<img src="<?php echo base_url().'assets/images/galleries/users/'.$resGallery[0]->name_file; ?>" style="text-align:left;width:400px;border:1pt solid #CFCFCF;padding:10px;">
			<?php else : ?>
				<img src="<?php echo base_url().'assets/images/galleries/user-icon-128.png'; ?>" style="text-align:left;width:400px;border:1pt solid #CFCFCF;padding:10px;">
			<?php endif; ?>
			<?php echo form_upload('gambar','','class="form-control" style="width:400px;" id="gambar"'); ?> 
			&nbsp;&nbsp;
			<?php echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"'); ?>
			&nbsp;&nbsp;
			<?php if ($resGallery): ?>
				<?php echo anchor('gallery/admin_profile_delete?gallery_id='.$resGallery[0]->gallery_id.'&user_id='.$resGallery[0]->user_id, Tb::icon(Tb::ICON_TRASH).' Hapus Foto', 'class="btn btn-danger btn-sm"'); ?>
			<?php endif; ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer');
