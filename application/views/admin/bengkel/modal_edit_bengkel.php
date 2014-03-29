<link href="<?php echo base_url(); ?>assets/css/jquery.ui.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'bengkel/save_edit'));
echo form_hidden('bengkel_id', $bengkel_id);
echo $form->textFieldRow('username', 'Username', array('placeholder' => 'username', 'id' => 'username', 'value' => $result[0]->username, 'class' => 'input-sedang'));
echo $form->textFieldRow('nama_bengkel', 'Nama Bengkel', array('placeholder' => 'Nama Bengkel', 'value' => $result[0]->nama_bengkel, 'class' => 'input-sedang'));
echo $form->dropDownListRow('Jenis', 'jenis_id', $result[0]->jenis_id, $arrJenis); 
echo $form->textFieldRow('alamat_bengkel', 'Alamat Bengkel', array('placeholder' => 'Alamat', 'value' => $result[0]->alamat_bengkel, 'class' => 'input-sedang'));
echo $form->textFieldRow('city', 'Kota', array('placeholder' => 'Kota', 'id' => 'kota', 'value' => $result[0]->city, 'class' => 'input-sedang'));
echo $form->textFieldRow('propinsi', 'Propinsi', array('placeholder' => 'Propinsi', 'id' => 'propinsi', 'value' => $result[0]->propinsi, 'class' => 'input-sedang'));
echo $form->textFieldRow('zippostal', 'Kodepos', array('placeholder' => 'KodePos', 'value' => $result[0]->zippostal, 'class' => 'input-sedang'));
echo $form->textFieldRow('country', 'Negara', array('placeholder' => 'Negara', 'id' => 'negara', 'value' => $result[0]->country, 'class' => 'input-sedang'));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'value' => $result[0]->email, 'class' => 'input-sedang'));
echo $form->textFieldRow('telp', 'Telp', array('placeholder' => 'Telp', 'value' => $result[0]->telp, 'class' => 'input-sedang'));
echo $form->textFieldRow('fax', 'Fax', array('placeholder' => 'Fax', 'value' => $result[0]->fax, 'class' => 'input-sedang'));
echo $form->textAreaRow('deskripsi', 'Deskripsi Singkat', array('style' => 'height:70px;', 'value' => $result[0]->deskripsi, 'class' => 'input-sedang')); 
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
