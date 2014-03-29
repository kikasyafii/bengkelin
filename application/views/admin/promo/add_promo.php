<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Penambahan Promo</h1>
	</div>
	<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'promo/save_add', 'enctype' => 'multipart/form-data'));
	echo $form->textFieldRow('judul_promo', 'Judul Promo', array('placeholder' => 'Judul Promo', 'class' => 'input-sedang'));
	echo $form->textFieldRow('sinopsis', 'Sinopsis', array('placeholder' => 'Sinopsis', 'class' => 'input-sedang'));
	echo $form->textAreaRow('content', 'Content', array('style' => 'width:500px;height:150px;'));
	echo $form->fileFieldRow('gambar', 'Gambar Promo', array('class' => 'form-control input-sedang')); 
	echo '<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').'&nbsp;&nbsp;'.anchor('promo/dashboard', 'Back', 'class="btn btn-default btn-sm"').'</div>';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
