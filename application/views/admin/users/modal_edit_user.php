<link href="<?php echo base_url(); ?>assets/css/jquery.ui.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<?php
$form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'users/save_edit'));
echo form_hidden('user_id', $result[0]->user_id);
echo $form->textFieldRow('username', 'Username', array('placeholder' => 'Username', 'value' => $result[0]->username, 'readonly' => 'readonly'));
echo $form->textFieldRow('first_name', 'Fist Name', array('placeholder' => 'First Name', 'value' => $result[0]->first_name));
echo $form->textFieldRow('last_name', 'Last Name', array('placeholder' => 'Last Name',  'value' => $result[0]->last_name));
echo $form->textFieldRow('email', 'Email', array('placeholder' => 'Email', 'class' => 'input-pendek', 'value' => $result[0]->email));
echo $form->textFieldRow('alamat', 'Alamat', array('placeholder' => 'Alamat', 'value' => $result[0]->alamat));
echo $form->textFieldRow('kota', 'Kota', array('placeholder' => 'Kota', 'class' => 'input-pendek', 'id' => 'kota', 'value' => $result[0]->kota));
echo $form->textFieldRow('propinsi', 'Propinsi', array('placeholder' => 'Propinsi', 'id' => 'propinsi', 'value' => $result[0]->propinsi));
echo $form->textFieldRow('negara', 'Negara', array('placeholder' => 'Negara', 'id' => 'negara', 'value' => $result[0]->negara));
echo $form->textFieldRow('zippostal', 'Kodepos', array('placeholder' => 'Kodepos', 'id' => 'zippostal', 'value' => $result[0]->zippostal));
echo $form->textFieldRow('phone', 'Phone', array('placeholder' => 'Phone', 'value' => $result[0]->phone));
echo $form->textFieldRow('facebook', 'Facebook', array('placeholder' => 'Facebook', 'value' => $result[0]->facebook));
echo $form->textFieldRow('twitter', 'Twitter', array('placeholder' => 'Twitter', 'value' => $result[0]->twitter));
echo $form->textFieldRow('gplus', 'Gplus', array('placeholder' => 'Gplus', 'value' => $result[0]->gplus));
echo $form->textFieldRow('linkedin', 'Linkedin', array('placeholder' => 'Linkedin', 'value' => $result[0]->linkedin));
echo $form->textFieldRow('path', 'Path', array('placeholder' => 'Path', 'value' => $result[0]->path));
echo $form->dropDownListRow('Gender', 'sex', $result[0]->sex, array('1' => 'Male', '2' => 'Female', '3' => 'Tidak Bilang'));
echo $form->passwordFieldRow('password1', 'Password');
echo $form->passwordFieldRow('password2', 'Ulang Password');
echo '<div class="form-group"><div class="col-lg-2"><label for="bdate" class="control-label pull-right">Bdate</label></div><div class="col-lg-10 form-inline">';
$y = '0000';
$m = '00';
$d = '00';
if ($result[0]->bdate != ''){
	list($y,$m,$d) = explode("-",$result[0]->bdate);
}
echo form_dropdown('d', $date, $d,'class="form-control input-pendek" id="date"' ).' - ' .form_dropdown('m', $month, $m, 'class="form-control input-pendek" id="month"').' - '. form_dropdown('y', $year, $y, 'class="form-control input-pendek" id="year"');
echo '</div></div>';
echo $form->dropDownListRow('Group', 'group_id',$result[0]->group_id, $arrGroups, array('class' => 'input-pendek'));
echo $form->dropDownListRow('Aktif', 'is_active', $result[0]->is_active, array('1' => 'Aktif', '0' => 'Tidak aktif'), array('class' => 'input-pendek'));
echo '&nbsp;'.form_submit('save', 'Save', 'class="btn btn-sm btn-primary"').'<br>';
echo 'Catatan: Kosongi password bila tidak ingin mengubah';
?>
<br>
<script type="text/javascript">var BASE_URL = "<?php echo base_url(); ?>"; </script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/cities_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/states_json"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>index.php/users/countries_json"></script>
<script type="text/javascript">

	$("#kota").autocomplete({
		source: Cities,
		minLength: 2
	});
	
	$("#propinsi").autocomplete({
		source: States,
		minLength: 2
	});
	
	$("negara").autocomplete({
		source: Countries,
		minLength: 2
	});

	$("#kota").blur(function(){
		
		$.get(BASE_URL + 'index.php/users/get_state?city=' + $("#kota").val(), function(data){
			$("#propinsi").val(data);
		});
	});
	
	$("#propinsi").blur(function(){
		$.get(BASE_URL + 'index.php/users/get_country?state=' + $('#propinsi').val(), function(data){
			$("#negara").val(data);
		});
	});
	
	$("#year").blur(function(){
		var tahun = parseInt($("#year").val());
		
		if ($("#month").val() == '02'){
			if (tahun % 4 == 0){
				if ($("#date").val() > 29){
					alert('Isian Tanggal tidak benar!');
					$("#date").focus();
				}
			}else{
				if ($("#date").val() > 28){
					alert('Isian Tanggal tidak benar!');
					$("#date").focus();
				}
			}
		}
	});
</script>
