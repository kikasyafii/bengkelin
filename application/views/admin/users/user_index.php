<?php $this->load->view('admin/header'); ?>
<div class="page-header">
<h1>Users</h1>
</div>
	
	<?php 
	$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE));
	echo '<div class="form-group">Pencarian&nbsp;&nbsp;</div>';
	echo $form->textFieldRow('query', 'Query', array('placeholder' => 'Kueri Pencarian', 'class' => 'input-sedang', 'value' => $query));
	//echo $form->dropDownListRow('group_id', 'Group', $group_id, $arrGroups, array('class' => 'input-pendek'));
	$arrGroups[''] = 'All Groups';
	asort($arrGroups);
	echo $form->dropDownListRow('Group', 'group_id', $group_id, $arrGroups, array('class' => 'input-pendek'));
	echo '&nbsp;'.form_submit('show', 'Cari', 'class="btn btn-sm btn-primary"').'&nbsp;&nbsp;'.anchor(current_url().'#', Tb::icon(Tb::ICON_PLUS) . 'Add New','id="adduser" class="btn btn-primary btn-sm"');
	$form->end();
	?>
	<br>
	<table class="table table-stripped table-condensed table-bordered">
		<thead>
			<tr bgcolor="#CFCFCF">
				<th class="center">Username</th>
				<th class="center">First Name</th>
				<th class="center">Last Name</th>
				<th class="center">Email</th>
				<th class="center">Alamat</th>
				<th class="center">Kota</th>
				<th class="center">Phone</th>
				<th class="center">Group</th>
				<th class="center">Aktif</th>
				<th class="center">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($result): ?>
		<?php foreach($result as $row): ?>
			<tr>
				<td class="center"><?php echo $row->username; ?></td>
				<td class="center"><?php echo $row->first_name; ?></td>
				<td class="center"><?php echo $row->last_name; ?></td>
				<td class="center"><?php echo $row->email; ?></td>
				<td class="center"><?php echo $row->alamat; ?></td>
				<td class="center"><?php echo $row->kota; ?></td>
				<td class="center"><?php echo $row->phone; ?></td>
				<td class="center"><?php echo (!isset($arrGroups[$row->group_id]) ? 'Belum dimasukkan ke group' : $arrGroups[$row->group_id]); ?></td>
				<td class="center"><?php echo ($row->is_active==1) ? 'Aktif' : 'Tidak Aktif';  ?></td>
				<td class="center">
					<?php echo anchor(current_url().'#', Tb::icon(Tb::ICON_EDIT), 'class="btn btn-success btn-sm" title="Edit" onclick="javascript:edit_user('.$row->user_id.');"'); ?>&nbsp;&nbsp;
					<?php echo anchor('gallery/admin_user?id='.$row->user_id, Tb::icon(Tb::ICON_PICTURE), 'class="btn btn-success btn-sm" title="Edit Avatar"'); ?>&nbsp;&nbsp;
					<?php echo anchor('users/delete?user_id='.$row->user_id, Tb::icon(Tb::ICON_TRASH), 'class="btn btn-danger btn-sm" title="Edit" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus user '.$row->username.'?\');if (xconfirm == true) {return true;} else {return false;}"'); ?>
					</td>
			</tr>
		<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td class="center" colspan="9">No Result</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
	<div class="row">
		<div class="center">
		<div class="dataTables_paginate paging_bootstrap">
			<ul class="pagination">
		<?php echo $links; ?>
		</ul>
		</div>
		</div>
	</div>
	<?php 
	$datamodal['content'] = '<div id="modalform"></div>';
	$this->load->view('modal', $datamodal); 
	?>
</div>
</div>
<?php 
$data['footer_content'] = 
'<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.menu.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">var BASE_URL = "'.base_url().'"; </script>
<script type="text/javascript" src="'.base_url().'index.php/users/cities_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/countries_json"></script>
<script type="text/javascript" src="'.base_url().'assets/js/admin/users.js"></script>
';
$this->load->view('admin/footer', $data); 
