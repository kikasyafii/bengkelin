<?php 
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'groups/save_add'));
echo $form->textFieldRow('group_name', 'Group Name', array('placeholder' => 'Group Name', 'class' => 'input-sedang'));
echo $form->textFieldRow('description', 'Description', array('placeholder' => 'Description'));
echo '<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').'&nbsp;&nbsp;'.anchor('cancel', 'Cancel', 'class="btn btn-default btn-sm" data-dismiss="modal"').'</div>';
echo $form->end();
?>
