<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
	<h3>Add Group</h3>
	</div>
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'groups/save_add'));
	echo $form->textFieldRow('group_name', 'Group Name', array('placeholder' => 'Group Name', 'class' => 'input-sedang'));
	echo $form->textFieldRow('description', 'Description', array('placeholder' => 'Description'));
	echo '<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').'</div>';
	$form->end();
	?>
<?php $this->load->view('admin/footer'); 
