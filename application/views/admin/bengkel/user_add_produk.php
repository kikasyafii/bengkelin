<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Tambah Produk 
	<?php if ($result) : ?>
		<small><?php echo $result[0]->nama_bengkel; ?></small>
	<?php endif; ?>
	</h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_add_product_user/', 'enctype' => 'multipart/form-data'));

$arrBengkel = array();
if ($resBengkel){
	foreach($resBengkel as $row){
		$arrBengkel[$row->bengkel_id] = $row->nama_bengkel;
	}
}

if ($resBengkel){
	echo $form->dropDownListRow('Nama Bengkel','bengkel_id','',$arrBengkel, array('class' => 'input-sedang'));
}else{
	echo form_hidden('bengkel_id', $result[0]->bengkel_id);
}
echo $form->textFieldRow('nama_produk', 'Nama Produk', array('placeholder' => 'Nama Produk', 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi','Deskripsi',array('style' => 'width:500px;height:80px;'));
echo $form->fileFieldRow('gambar','Gambar Produk', array('class' => 'form-control input-sedang'));
echo '<div class="col-md-4 center">'.form_submit('save','Simpan', 'class="btn btn-primary btn-sm"').'&nbsp;&nbsp;'.anchor('bengkel/user_product', 'Kembali ke list produk', 'class="btn btn-default btn-sm"').'</div>';
$form->end();
?>
<?php $this->load->view('admin/footer');
