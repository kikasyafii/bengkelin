<?php $this->load->view('admin/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<div class="page-header">
	<h1>Edit Layanan</h1>
</div>
<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'services/save_edit_service'));
echo form_hidden('service_id', $result[0]->service_id);
echo form_hidden('bengkel_id', $result[0]->bengkel_id);
echo $form->textFieldRow('judul_layanan', 'Nama Layanan', array('placeholder' => 'Nama Layanan', 'class' => 'input-sedang', 'value' => $result[0]->judul_layanan));
echo $form->textAreaRow('konten', 'Konten Layanan', array('rows' => 5, 'cols' => 60, 'value' => $result[0]->konten));
echo '<div class="col-lg-4 center">';
echo form_submit('save', 'Simpan', 'class="btn btn-info btn-sm"');
echo '</div>';
echo '&nbsp;&nbsp;';
$form->end();
?>
<?php $this->load->view('admin/footer'); 
