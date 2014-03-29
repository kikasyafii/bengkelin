<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Manajemen Partner</h1>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'partners/save_edit', 'mode' => 'multi'));
	echo form_hidden('partner_id', $result[0]->partner_id);
	echo $form->textFieldRow('nama_partner', 'Nama Partner', array('placeholder' => 'Nama Partner', 'value' => $result[0]->nama_partner));
	echo $form->textAreaRow('deskripsi', 'Deskripsi SIngkat', array('value' => $result[0]->deskripsi));
	echo '<div class="form-group">';
	echo '<div class="col-lg-4 center">'.img(base_url().'assets/images/galleries/partner/thumb/'.$result[0]->thumb_file).'</div></div>';
	echo $form->fileFieldRow('gambar', 'Logo Partner', array('class' => 'form-control')); 
	echo $form->dropDownListRow('Aktif','is_active', $result[0]->is_active, array('1' => 'Aktif', '0' => 'Tidak Aktif'), array('class' => 'input-pendek', 'style' => 'width:100px;')); 
	echo '<div class="col-lg-4 center">';
	echo form_submit('save', 'Simpan', 'class="btn btn-info btn-sm"');
	echo '</div>';
	echo '&nbsp;&nbsp;';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
