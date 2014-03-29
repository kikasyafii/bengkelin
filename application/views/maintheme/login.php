<?php 
$data['header_content'] = '
<style>
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
';
$this->load->view('maintheme/header', $data); ?>
<div class="box">
	<div class="box-content">
		<div class="center">
			<h3>.: Silakan Login :.</h3>
		<?php 
		$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'class' => 'form-signin'));
		echo $form->textFieldRow('username', 'Username', array('placeholder' => 'Username'));
		echo $form->passwordFieldRow('password', 'Password');
		echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> &nbsp;&nbsp;<br>';
		echo anchor('users/forgot_password', 'Lupa password?');
		echo $form->end();
		?>
		</div>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
