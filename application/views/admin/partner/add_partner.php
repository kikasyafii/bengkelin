<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Manajemen Partner</h1>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'partners/save_add', 'mode' => 'multi'));
	echo $form->textFieldRow('nama_partner', 'Nama Partner', array('placeholder' => 'Nama Partner'));
	echo $form->textAreaRow('deskripsi', 'Deskripsi Singkat');
	echo $form->fileFieldRow('gambar', 'Logo Partner', array('class' => 'form-control'));
	echo $form->dropDownListRow('Aktif','is_active', '', array('1' => 'Aktif', '0' => 'Tidak Aktif'), array('class' => 'input-pendek', 'style' => 'width:100px;')); 
	echo '<div class="col-lg-4 center">';
	echo form_submit('save', 'Simpan', 'class="btn btn-info btn-sm"');
	echo '</div>';
	echo '&nbsp;&nbsp;';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
