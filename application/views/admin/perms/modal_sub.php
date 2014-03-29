<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'perms/save_sub')); 
echo $form->textFieldRow('class_name', 'Name Perms', array('placeholder' => 'Name Perms'));
echo $form->textFieldRow('class_path', 'Path Perms', array('placeholder' => 'Path Perms'));
echo $form->textFieldRow('ordering', 'Ordering', array('placeholder' => 'Ordering', 'class' => 'input-pendek'));
echo $form->dropDownListRow('Active', 'is_active', '', array('1' => 'Aktif', '0' => 'Non Aktif'), array('class' => 'input-pendek'));
echo '<div class="col-lg-4">'.form_submit('save', 'Save', 'class="btn btn-primary btn-sm"').'&nbsp;&nbsp;';
echo anchor(current_url().'#', 'Close', 'class="btn btn-default btn-sm" data-dismiss="modal"').'</div>';
echo form_hidden('parent_id');
$form->end();
?>
