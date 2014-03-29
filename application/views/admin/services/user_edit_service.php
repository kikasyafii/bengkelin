<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Edit Layanan</h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'services/save_user_edit_service', 'enctype' => 'multipart/form-data'));
echo form_hidden('service_id', $result[0]->service_id);
echo form_hidden('bengkel_id', $result[0]->bengkel_id);
echo $form->textFieldRow('judul_layanan', 'Nama Layanan', array('placeholder' => 'Nama Layanan', 'class' => 'input-sedang', 'value' => $result[0]->judul_layanan));
echo $form->textAreaRow('konten', 'Konten Layanan', array('style' => 'width:500px;height:80px;', 'rows' => 5, 'cols' => 60, 'value' => $result[0]->konten));
echo $form->fileFieldRow('gambar','Gambar Produk', array('class' => 'form-control input-sedang'));
echo '<div class="col-lg-4 center">';
echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;';
echo anchor('services/layanan_bengkel', 'Kembali ke Layanan', 'class="btn btn-default btn-sm"');
echo '</div>';
$form->end();
?>
<div class="page-header">
	<h3>Gallery Produk</h3>
</div>
<div class="row">
<?php if ($resGallery): ?>
	<?php foreach($resGallery as $row): ?>
		<div class="col-md-3 col-sm-4 gallery-img">
			<div class="wrap-image">
				<img src="<?php echo base_url().'assets/images/galleries/service/thumb/'.$row->thumb_layanan; ?>" class="image-list col-md-12">
				<div class="tools tools-bottom">
					<?php echo anchor('gallery/delete_layanan/'.$row->id, '<i class="clip-close-2"></i> Hapus', 'onclick="javascript:x=confirm(\'Apakah Anda yakin ingin menghapus gambar ini?\');if (x == true) { return true; } else { return false; } "'); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
</div>
<?php $this->load->view('admin/footer'); 
