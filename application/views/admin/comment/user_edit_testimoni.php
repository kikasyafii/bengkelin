<?php $this->load->view('admin/header'); ?>
<div class="page-header">
	<h1>Manajemen Testimoni</h1>
</div>
<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'comments/save_user_edit_testimoni')); 
echo form_hidden('testimoni_id', $result[0]->testimoni_id);
echo form_hidden('bengkel_id', $bengkel_id);
echo $form->textFieldRow('nama', 'Nama', array('placeholder' => 'Nama', 'value' => $result[0]->nama));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'value' => $result[0]->email));
echo $form->textFieldRow('website', 'Website', array('placeholder' => 'http://', 'value' => $result[0]->website));
echo $form->textAreaRow('konten', 'Konten', array('value' => $result[0]->konten));
echo $form->dropDownListRow('Diijinkan', 'approved', $result[0]->approved, array('0' => 'Tidak', '1' => 'Ya'), array('style' => 'width:100px;')); 
echo '<div class="form-group">
	<div class="col-md-5 center">'.form_submit('save', 'Simpan Perubahan', 'class="btn btn-primary btn-sm"');
echo '&nbsp;&nbsp;'.anchor('comments/user_testimoni/'.$bengkel_id, 'Back', 'class="btn btn-default btn-sm"').'</div>
</div>';
$form->end();

?>
<?php $this->load->view('admin/footer'); 
