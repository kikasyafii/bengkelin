<?php $this->load->view('admin/header'); ?>
	<div class="page-header">
		<h1>Bengkel / Showroom</h1>
	</div>
		<?php 
		$form = Tb::form(array('type' => Tb::FORM_TYPE_INLINE, 'action' => 'bengkel/dashboard'));
		echo $form->textFieldRow('query', 'Query', array('placeholder' => 'Kueri Pencarian', 'value' => $query));
		$arrPilihan = array(' ' => 'Tampilkan Semua Jenis');
		foreach($arrJenis as $key => $val){
			$arrPilihan[$key] = $val;
		}
		echo $form->dropDownListRow('jenis_id', 'jenis_id', $jenis_id, $arrPilihan); 
		
		echo form_submit('show', 'Tampilkan', 'class="btn btn-info btn-sm"');
		echo '&nbsp;&nbsp;';
		echo anchor(current_url().'#', Tb::icon(Tb::ICON_PLUS).' Bengkel / Showroom Baru', 'title="Penambahan Bengkel" class="btn btn-primary btn-sm" id="addbengkel"'); 
		$form->end();
		?>
		<br>
		<table class="table table-condensed table-bordered">
			<thead>
				<tr bgcolor="#ADCCC9">
					<th class="center">Nama</th>
					<th class="center">Username</th>
					<th class="center">Jenis</th>
					<th class="center">Alamat</th>
					<th class="center">Email</th>
					<th class="center">Telp</th>
					<th class="center">Setting</th>
					<th class="center">Hapus</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($result): ?>
				<?php foreach($result as $row): ?>
				<tr>
					<td class='center'><?php echo $row->nama_bengkel; ?></td>
					<td class='center'><?php echo $row->username; ?></td>
					<td class='center'><?php
					if (!isset($arrJenis[$row->jenis_id])): 
						echo 'Belum didefinisikan';
					else: 
						echo ucwords($arrJenis[$row->jenis_id]); 
					endif; 
					 ?></td>
					<td class='center'>
						<?php echo $row->alamat_bengkel; ?><br>
						<?php if (!empty($row->city)): ?>
							<?php echo $row->city; ?><br>
						<?php endif; ?>
						<?php if ($row->zippostal > 0): ?>
							<?php echo $row->zippostal; ?><br>
						<?php endif; ?>
						<?php echo $row->propinsi; ?>
					</td>
					<td class='center'><?php echo $row->email; ?></td>
					<td class='center'><?php echo $row->telp; ?></td>
					<td class='center'>
						<?php echo anchor(current_url().'#',Tb::icon(Tb::ICON_EDIT), 'title="EDIT '.$row->nama_bengkel.'" class="btn btn-primary btn-sm" onclick="javascript:editbengkel('.$row->bengkel_id.')"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('bengkel/product_dashboard/'.$row->bengkel_id,'<span class="clip-tag-2"></span>', 'title="Produk  '.$row->nama_bengkel.'" class="btn btn-info btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('services/layanan_bengkel_admin/'.$row->bengkel_id,'<span class="clip-wrench-2"></span>', 'title="Layanan  '.$row->nama_bengkel.'" class="btn btn-info btn-sm"'); ?>
						&nbsp;&nbsp;
						<?php echo anchor('gallery/admin_bengkel?id='.$row->bengkel_id,Tb::icon(Tb::ICON_PICTURE), 'title="EDIT GALLERY '.$row->nama_bengkel.'" class="btn btn-primary btn-sm"'); ?>
						&nbsp;&nbsp;<br><br>
						<?php echo anchor('bengkel/bengkel_venue?bengkel_id='.$row->bengkel_id, Tb::icon(Tb::ICON_GLOBE), 'class="btn btn-primary btn-sm" title="Setting LOCATION"'); ?>&nbsp;&nbsp;
					</td>
					<td class="center">
						<?php echo anchor('bengkel/delete?bengkel_id='.$row->bengkel_id, Tb::icon(Tb::ICON_TRASH), 'title="DELETE '.$row->nama_bengkel.'" class="btn btn-danger btn-sm" onclick="javascript:xconfirm=confirm(\'Apakah Anda ingin menghapus bengkel '.$row->nama_bengkel.'?\');if(xconfirm==true){return true;}else{return false;}"'); ?>
					</td>
				</tr>
				<tr id="tableDetail<?php echo $row->bengkel_id; ?>" class="hidden">
					<td colspan="9">
					<div id="contentdetail<?php echo $row->bengkel_id; ?>"></div>
					</td>
				</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td class="center" colspan="9"> No Result </td>
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
<?php 
$data['footer_content'] = '<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.position.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.menu.js"></script>
<script type="text/javascript" src="'.base_url().'assets/js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
<script type="text/javascript" src="'.base_url().'index.pph/users/get_user_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/cities_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/states_json"></script>
<script type="text/javascript" src="'.base_url().'index.php/users/countries_json"></script>
<script type="text/javascript" src="'.base_url().'assets/js/admin/bengkel.js"></script>
';
$this->load->view('admin/footer',$data); 
