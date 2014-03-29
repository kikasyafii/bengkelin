<?php $this->load->view('admin/header'); ?>
		<div class="page-header">
		<h1>List Group</h1>
		</div>
		<?php echo anchor(current_url().'#', Tb::icon(Tb::ICON_PLUS).' Tambah Group', 'class="btn btn-primary btn-sm" id="addgroup"'); ?>
		<br>
		<br>
		<table class="table table-condensed table-stripped">
			<thead>
				<tr bgcolor="#CFCFCF">
					<th class="center">Group Name</th>
					<th class="center">Description</th>
					<th class="center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($result): ?>
				<?php foreach($result as $row): ?>
				<tr>
					<td class="center"><?php echo $row->group_name; ?></td>
					<td class="center"><?php echo $row->description; ?></td>
					<td class="center">
						<?php echo anchor(current_url().'#', Tb::icon(Tb::ICON_EDIT), 'class="btn btn-success btn-sm" onclick="javascript:editgroup('.$row->group_id.')"'); ?>
						<?php echo anchor('perms/group_perms?group_id='.$row->group_id, Tb::icon(Tb::ICON_USER), 'title="UPDATE PERMISSION GROUP" class="btn btn-warning btn-sm"'); ?>
						<?php if ($row->group_id > 1): ?>
						&nbsp;&nbsp;<?php echo anchor('groups/delete?id='.$row->group_id, Tb::icon(Tb::ICON_TRASH), 'class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus group '.$row->group_name.'?\');if (xconfirm == true) {return true;} else {return false;}"'); ?>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php else: ?>
				<tr>
					<td colspan="3" class="center">No Result</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
		<?php 
		$datamodal['content'] = '<div id="modalform"></div>';
		$this->load->view('modal', $datamodal); 
		?>
<?php 
$data['footer_content'] = '
<script type="text/javascript">
	var BASE_URL = "'.base_url().'";
</script>
<script type="text/javascript" src="'.base_url().'assets/js/admin/group.js"></script>
<script src="'.base_url().'assets/clipone/plugins/flot/jquery.flot.js"></script>
<script src="'.base_url().'assets/clipone/plugins/flot/jquery.flot.pie.js"></script>
<script src="'.base_url().'assets/clipone/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="'.base_url().'assets/clipone/js/index.js"></script>
';
$this->load->view('admin/footer',$data); 
