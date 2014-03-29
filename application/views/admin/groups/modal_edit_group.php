<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'groups/save_edit'));
echo form_hidden('group_id', $group_id); 
echo $form->textFieldRow('group_name', 'Group Name', array('placeholder' => 'Group Name', 'class' => 'input-sedang', 'value' => $result[0]->group_name, 'readonly' => 'readonly'));
echo $form->textFieldRow('description', 'Description', array('placeholder' => 'Description', 'value' => $result[0]->description));
echo '<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').'</div>';
$form->end();
?>
