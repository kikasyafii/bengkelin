<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Tambah Produk <small><?php echo $resBengkel[0]->nama_bengkel; ?></small></h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_add_product_admin/'.$bengkel_id, 'enctype' => 'multipart/form-data'));
echo form_hidden('bengkel_id',$bengkel_id);
echo $form->textFieldRow('nama_produk', 'Nama Produk', array('placeholder' => 'Nama Produk', 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi','Deskripsi',array('style' => 'width:500px;height:80px;'));
echo $form->fileFieldRow('gambar','Gambar Produk', array('class' => 'form-control input-sedang'));
echo '<div class="col-md-4 center">'.form_submit('save','Simpan', 'class="btn btn-primary btn-sm"').'</div>';
$form->end();
?>
<?php $this->load->view('admin/footer');
