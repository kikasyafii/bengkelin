<?php $this->load->view('admin/header'); ?>
<div class="box">
	<div class="box-content">
		<ul class="nav nav-tabs">
			<li class="active"><?php echo anchor('configuration', 'Konfigurasi Utama'); ?></li>
			<li><?php echo anchor('configuration/index/content', 'Konfigurasi Konten'); ?></li>
			<li><?php echo anchor('configuration/index/socmed', 'Kontak &amp; Sosial Media'); ?></li>
		</ul>
		<h3>Konfigurasi</h3>
		<hr>
		<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'configuration/save_config'));
		echo $form->textFieldRow('title', 'Judul Web', array('placeholder' => 'Judul Web', 'value' => $result['title']));
		echo $form->textFieldRow('website_name', 'Nama Website', array('placeholder' => 'Judul Web', 'value' => $result['website_name']));
		echo $form->textFieldRow('company_name', 'Nama Perusahaan', array('placeholder' => 'Nama Perusahaan', 'value' => $result['company_name']));
		echo $form->textFieldRow('slogan', 'Slogan', array('placeholder' => 'Slogan', 'value' => $result['slogan']));
		echo '<div class="form-group"><div class="col-lg-4 center">'.form_submit('save', 'Update', 'class="btn btn-sm btn-primary"' ).'</div></div>';
		$form->end();
		?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>
