<?php 
$data['header_content'] = '
<script type="text/javascript" src="'.base_url().'assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	mode: "specific_textareas",
	editor_selector: "mceEditor",
	plugins: "image",
	toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image ", 
	menubar: false, 
});
</script>
';
$this->load->view('admin/header',$data); ?>
<div class="box">
	<div class="box-content">
		<ul class="nav nav-tabs">
			<li><?php echo anchor('configuration/', 'Konfigurasi Utama'); ?></li>
			<li class="active"><?php echo anchor('configuration/index/content', 'Konfigurasi Konten'); ?></li>
			<li><?php echo anchor('configuration/index/socmed', 'Kontak &amp; Sosial Media'); ?></li>
		</ul>
		<h3>Konfigurasi Konten</h3>
		<hr>
		<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'configuration/save_config'));
		echo $form->textFieldRow('describe', 'Deskripsi Singkat', array('placeholder' => 'Desckripsi Singkat', 'value' => $result['describe']));
		echo $form->textAreaRow('forbidden_words', 'Kata-kata Terlarang (pisah dengan spasi)', array('value' => $result['forbidden_words'])); 
		echo $form->textAreaRow('about', 'About This Website', array('id' => 'about', 'class' => 'mceEditor',  'value' => $result['about']));
		echo $form->textAreaRow('faq', 'FAQ', array('id' => 'faq', 'class' => 'mceEditor', 'value' => $result['faq']));
		echo $form->textAreaRow('kontak', 'Kontak', array('id' => 'Kontak Kami', 'class' => 'mceEditor', 'value' => $result['kontak']));
		echo $form->textAreaRow('api', 'API', array('id' => 'api', 'class' => 'mceEditor', 'value' => $result['api']));
		echo $form->textAreaRow('developer', 'Developer', array('id' => 'developer', 'class' => 'mceEditor', 'value' => $result['developer']));
		echo $form->textAreaRow('policy', 'Policy', array('id' => 'policy', 'class' => 'mceEditor', 'value' => $result['policy']));
		echo $form->textAreaRow('terms_of_use', 'Terms of Use', array('id' => 'tou', 'class' => 'mceEditor', 'value' => $result['terms_of_use']));
		echo '<div class="form-group"><div class="col-lg-4 center">'.form_submit('save', 'Update', 'class="btn btn-sm btn-primary"' ).'</div></div>';
		$form->end();
		?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>
