<?php 
$data['header_content'] = '
<script type="text/javascript" src="'.base_url().'assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector: "textarea",
	plugins: "image",
	toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image ", 
	menubar: false
});
</script>
';
$this->load->view('admin/header',$data); ?>
<div class="box">
	<div class="box-content">
		<ul class="nav nav-tabs">
			<li><?php echo anchor('configuration/', 'Konfigurasi Utama'); ?></li>
			<li><?php echo anchor('configuration/index/content', 'Konfigurasi Konten'); ?></li>
			<li class="active"><?php echo anchor('configuration/index/socmed', 'Kontak &amp; Sosial Media'); ?></li>
		</ul>
		<h3>Konfigurasi Konten</h3>
		<hr>
		<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'configuration/save_config'));
		echo $form->textFieldRow('address', 'Alamat Korespondensi', array('placeholder' => 'Alamat Korespondensi', 'value' => $result['address']));
		echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'value' => $result['email']));
		echo $form->textFieldRow('phone', 'Phone', array('placeholder' => 'Phone', 'value' => $result['phone']));
		echo $form->textFieldRow('facebook', 'Facebook', array('placeholder' => 'Akun Facebook', 'value' => $result['facebook']));
		echo $form->textFieldRow('twitter', 'Twitter', array('placeholder' => 'Akun Twitter', 'value' => $result['twitter']));
		echo $form->textFieldRow('gplus', 'Gplus', array('placeholder' => 'Akun Gplus', 'value' => $result['gplus']));
		echo $form->textFieldRow('path', 'Path', array('placeholder' => 'Akun Path', 'value' => $result['path']));
		echo '<div class="form-group"><div class="col-lg-4 center">'.form_submit('save', 'Update', 'class="btn btn-sm btn-primary"' ).'</div></div>';
		$form->end();
		?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>
