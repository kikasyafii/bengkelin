<?php 
$data['header_content'] = 
'		<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
		<link rel="stylesheet" href="'.base_url().'assets/clipone/plugins/bootstrap-social-buttons/social-buttons-3.css">';

$this->load->view('admin/header',$data); ?>
	<div class="page-header">
		<h1>User Profile</h1>
	</div>
	<div class="row">
		<div class="col-sm-7 col-md-6">
			<div class="user-left">
				<div class="center">
					<span style="float:right;"><?php echo anchor('users/profile/edit', '<i class="glyphicon glyphicon-edit"></i> Edit', 'class="btn btn-sm btn-primary"'); ?></span>
					<div class="fileupload fileupload-new" data-provides="file-upload">
						<div class="user-image">
							<h4><?php echo $profile->first_name.' '.$profile->last_name; ?></h4>
							<div class="fileupload-new thumbnail">
								<?php if ($resGallery && $resGallery[0]->name_file != ''): ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/users/<?php echo $resGallery[0]->name_file;?>" width="150" align="center">
								<?php else: ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/user-icon-128.png" width="150"  class="center">
								<?php endif; ?>
							</div>
							<br>
							<?php echo anchor('gallery/gallery_profile', Tb::icon(Tb::ICON_EDIT).' Ubah Foto Diri', 'class="btn btn-primary btn-sm center"'); ?>
						</div>
					</div>
					<br>
				</div>
				<table class="table table-condensed table-hover">
					<tr>
						<th colspan="3">Informasi User</th>
					</tr>
					<tr>
						<td>Username</td>
						<td><?php echo $profile->username; ?></td>
					</tr>
					<tr>
						<td>Nama Depan</td>
						<td><?php echo $profile->first_name; ?></td>
					</tr>
					<tr>
						<td>Nama Belakang</td>
						<td><?php echo $profile->last_name; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php 
						if ($profile->sex == 1){
							echo 'Pria';
						}else if ($profile->sex == 2){
							echo 'Wanita';
						}else{
							echo 'Tidak bilang';
						}
						 ?></td>
					</tr>
				</table>
				<table class="table table-condensed table-hover">
					<tr>
						<th colspan="2">Detail Informasi</th>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td><?php
					 	$bdate = (empty($profile->bdate) ? '0000-00-00' : $profile->bdate); 
						if ($bdate != '0000-00-00'){
							list($y,$m,$d) = explode('-',$bdate);
							echo $d.' '.the_month($m).' '.$y;
						}else{
							echo '-';
						}
						 ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $profile->email; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><?php echo (empty($profile->alamat) ? '-' : $profile->alamat); ?></td>
					</tr>
					<tr>
						<td>Kota</td>
						<td><?php echo (empty($profile->kota) ? '-' : $profile->kota); ?></td>
					</tr>
					<tr>
						<td>Propinsi</td>
						<td><?php echo (empty($profile->propinsi) ? '-' : $profile->propinsi); ?></td>
					</tr>
					<tr>
						<td>Negara</td>
						<td><?php echo (empty($profile->negara) ? '-' : $profile->negara); ?></td>
					</tr>
					<tr>
						<td>Kodepos</td>
						<td><?php echo (empty($profile->zippostal) ? '-' : $profile->zippostal); ?></td>
					</tr>
					<tr>
						<td>Telp</td>
						<td><?php echo (empty($profile->phone) ? '-' : $profile->phone); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-sm-5 col-md-5">
			<table class="table table-condensed table-hover">
				<tr>
					<th colspan="2">Informasi Tambahan</th>
				</tr>
				<tr>
					<td><i class="clip-facebook"></i></td>
					<td><?php echo (empty($profile->facebook) ? '-' : $profile->facebook); ?></td>
				</tr>
				<tr>
					<td><i class="clip-twitter"></i></td>
					<td><?php echo (empty($profile->twitter) ? '-' : $profile->twitter); ?></td>
				</tr>
				<tr>
					<td><i class="clip-google-plus"></i></td>
					<td><?php echo (empty($profile->gplus) ? '-' : $profile->gplus); ?></td>
				</tr>
				<tr>
					<td><i class="clip-pinterest"></i></td>
					<td><?php echo (empty($profile->path) ? '-' : $profile->path); ?></td>
				</tr>
				<tr>
					<td><i class="clip-linkedin"></i></td>
					<td><?php echo (empty($profile->linkedin) ? '-' : $profile->linkedin); ?></td>
				</tr>
			</table>
		</div>
	</div>
<?php 
$data['footer_content'] = '
<script src="'.base_url().'assets/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="'.base_url().'assets/clipone/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
<script src="'.base_url().'assets/clipone/js/pages-user-profile.js"></script>';
$this->load->view('admin/footer',$data); 
