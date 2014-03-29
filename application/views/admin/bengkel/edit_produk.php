<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Edit Produk <small><?php echo $resBengkel[0]->nama_bengkel; ?></small></h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_edit_product_user', 'enctype' => 'multipart/form-data'));
echo form_hidden('bengkel_id', $bengkel_id);
echo form_hidden('produk_id', $produk_id);
echo $form->textFieldRow('nama_produk', 'Nama Produk', array('placeholder' => 'Nama Produk', 'value' => $result[0]->nama_produk, 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi','Deskripsi',array('style' => 'width:500px;height:80px;', 'value' => $result[0]->deskripsi));
echo $form->fileFieldRow('gambar','Tambah Gambar Produk', array('class' => 'form-control input-sedang'));
echo '<div class="col-md-4 center">'.form_submit('save','Simpan', 'class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;';
echo anchor('bengkel/user_product', 'Kembali ke Daftar Produk', 'class="btn btn-default btn-sm"');
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
