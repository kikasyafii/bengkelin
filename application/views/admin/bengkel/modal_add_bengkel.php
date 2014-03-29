<link href="<?php echo base_url(); ?>assets/css/jquery.ui.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_add'));
echo $form->textFieldRow('username', 'Username', array('placeholder' => 'username', 'id' => 'username', 'class' => 'input-sedang'));
echo $form->textFieldRow('nama_bengkel', 'Nama Bengkel', array('placeholder' => 'Nama Bengkel', 'class' => 'input-sedang'));
echo $form->dropDownListRow('jenis_id', 'jenis_id', '',$arrJenis); 
echo $form->textFieldRow('alamat_bengkel', 'Alamat Bengkel', array('placeholder' => 'Alamat', 'class' => 'input-sedang'));
echo $form->textFieldRow('city', 'Kota', array('placeholder' => 'Kota', 'id' => 'kota', 'class' => 'input-sedang'));
echo $form->textFieldRow('propinsi', 'Propinsi', array('placeholder' => 'Propinsi', 'id' => 'propinsi', 'class' => 'input-sedang'));
echo $form->textFieldRow('zippostal', 'Kodepos', array('placeholder' => 'KodePos', 'class' => 'input-sedang'));
echo $form->textFieldRow('country', 'Negara', array('placeholder' => 'Negara', 'id' => 'negara', 'class' => 'input-sedang'));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'class' => 'input-sedang'));
echo $form->textFieldRow('telp', 'Telp', array('placeholder' => 'Telp', 'class' => 'input-sedang'));
echo $form->textFieldRow('fax', 'Fax', array('placeholder' => 'Fax', 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi', 'Deskripsi Singkat', array('style' => 'height:70px;')); 
echo form_submit('save', 'Simpan', 'class="btn btn-primary btn-sm"');
$form->end();
?>
<script type="text/javascript">
	var BASE_URL = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/cities_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/states_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/countries_json"></script>
<script type="text/javascript" src="<?php echo base_url()?>index.php/users/get_user_json"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#username").autocomplete({
		source: Users,
		minLength: 2
	});
	
	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + 'index.php/users/get_state?city=' + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
});
</script>
