<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<h4>Gallery Profile</h4>
		
		<?php echo form_open_multipart('gallery/save_profile_gallery'); ?>
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-md-1">
					<label for="gambar" class="label-control">File Gambar</label>
				</div>
				<div class="col-md-9 form-inline">
					<?php echo form_upload('gambar','','class="form-control input-sedang" id="gambar"'); ?> 
					&nbsp;&nbsp;
					<?php echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"'); ?>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<hr>
		<br>
		<?php if ($resGallery): ?>
		<?php foreach($resGallery as $row): ?>
			<div class="col-md-2">
				<div style="border:1pt solid #cccccc;padding:5px;">
					<img src="<?php echo base_url().'assets/images/galleries/users/thumb/'.$row->thumb_file; ?>" class="image-list">
					<br>
					<div class="center">
					<?php echo anchor('gallery/set_active?gallery_id='.$row->gallery_id, '<i class="glyphicon glyphicon-saved"></i>', 'class="btn btn-success btn-sm" title="SET ACTIVE GALLERY"'); ?> &nbsp; <?php 
					echo anchor('gallery/delete?gallery_id='.$row->gallery_id, '<i class="glyphicon glyphicon-trash"></i>', 'class="btn btn-danger btn-sm" title="DELETE" onclick="javascript:xconfirm=confirm(\'Apakah anda yakin mau menghapus?\');if (xconfirm==true){return true;}else{return false;}"'); ?>
					<br>
					<br>
					<?php echo anchor('gallery/rotate_image/'.$row->gallery_id.'/90', '<img src="'.base_url().'assets/images/icons/left-rotate.png">', 'title="ROTATE ANTICLOCKWISE" class="btn btn-info btn-sm"'); ?>
					<?php echo anchor('gallery/rotate_image/'.$row->gallery_id.'/270', '<img src="'.base_url().'assets/images/icons/right-rotate.png">', 'title="ROTATE CLOCKWISE" class="btn btn-info btn-sm"'); ?>
					<?php if ($row->is_active == 1): ?>
						<span class="notification red">Used</span>
					<?php endif; ?>
					</div>
				</div>
				<br>
				<br>
			</div>
		<?php endforeach; ?>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div>
<?php $this->load->view('maintheme/footer');
