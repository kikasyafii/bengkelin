<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Layanan</h1>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'services/save_add_service'));
	echo form_hidden('bengkel_id',$bengkel_id);
	echo $form->textFieldRow('judul_layanan', 'Nama Layanan', array('placeholder' => 'Nama Layanan'));
	echo $form->textAreaRow('konten', 'Konten Layanan', array('rows' => 5, 'cols' => 60));
	echo '<div class="col-lg-4 center">';
	echo form_submit('save', 'Simpan', 'class="btn btn-info btn-sm"');
	echo '</div>';
	echo '&nbsp;&nbsp;';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
