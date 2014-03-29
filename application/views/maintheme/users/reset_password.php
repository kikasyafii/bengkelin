<?php $this->load->view('maintheme/header'); ?>
<div class="box">
	<div class="box-content">
		<h3>Reset Password</h3>
		<hr>
		<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'users/edit_password' )); 
		echo form_hidden('username', $username); 
		echo $form->passwordFieldRow('password1', 'Password Baru', array('placeholder' => 'Password Baru'));
		echo $form->passwordFieldRow('password2', 'Ulang Password', array('placeholder' => 'Ulang Password'));
		echo '<div class="col-lg-4 center">'.form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"').'</div>';
		$form->end();
		?>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
