<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url().'assets/css/custom.css'; ?>" rel="stylesheet">
<div class="page-header">
	<h1>Tambah Gambar Produk</h1>
</div>
<div class="row">
	<?php echo form_open_multipart('gallery/save_produk'); ?>
	<?php echo form_hidden('bengkel_id', $bengkel_id); ?>
	<?php echo form_hidden('produk_id', $produk_id); ?>
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
				&nbsp;&nbsp;
				<?php echo anchor('bengkel/user_product/'.$bengkel_id, '<i class="clip-arrow-left"></i> Kembali ke List Produk', 'class="btn btn-info btn-sm"'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
</div>
<hr>
<div class="row">
<?php if ($result): ?>
	<?php foreach($result as $row): ?>
		<div class="col-md-3 col-sm-4 gallery-img">
			<div class="wrap-image">
				<img src="<?php echo base_url().'assets/images/galleries/product/thumb/'.$row->thumb_produk; ?>" class="image-list col-md-12">
				<div class="tools tools-bottom">
					<?php echo anchor('gallery/delete_produk/'.$row->id, '<i class="clip-close-2"></i> Hapus', 'onclick="javascript:x=confirm(\'Apakah Anda yakin ingin menghapus gambar ini?\');if (x == true) { return true; } else { return false; } "'); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>
<?php $this->load->view('admin/footer'); 
