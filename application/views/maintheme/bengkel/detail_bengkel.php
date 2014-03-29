<?php 
$data['header_content'] = '
<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>
'.$map['js'];;
$this->load->view('maintheme/header',$data); ?>
	<div id="page-heading">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="heading">
						<div class="top-title">
							<h1><?php echo $resBengkel[0]->nama_bengkel; ?></h1>
						</div><!-- /.title -->
						<div class="top-subtitle">
							<?php echo $resBengkel[0]->alamat_bengkel; ?>
						</div><!-- /.subtitle -->
					</div><!-- /.heading -->
				</div><!-- /.col-md-8 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /#page-heading -->
	
	<div class="section gray-light">
		<div class="container">
			<div class="col-md-12">
				<div id="main">
					<div class="car car-detail">
						<div class="row">
							<div class="col-md-6">
								<!--- slider --->
									<div class="row">
										<div class="col-md-12">
											<div id="gallery-wrapper">
												<div class="gallery">
													<?php if ($resGallery) : ?>
													<?php foreach($resGallery as $row): ?>
													<div class="slide">
														<div class="picture-wrapper">
															<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel/<?php echo $row->name_file?>" alt="#">
														</div>
													</div>
													<?php endforeach; ?>
													<?php else: ?>
													<div class="slide">
														<div class="picture-wrapper">
															<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel.png" alt="#">
														</div>
													</div>
													<?php endif; ?>
												</div><!-- /.gallery -->

												<div id="gallery-pager" class="white block-shadow">
													<div class="prev">
														<i class="icon-normal-left-arrow-small"></i>
													</div>

													<div class="pager">
													</div>

													<div class="next">
														<i class="icon-normal-right-arrow-small"></i>
													</div>
												</div><!-- /#gallery-pager -->


												<div class="gallery-thumbnails">
													<?php if ($resGallery): ?>
													<?php $x = 0; ?>
													<?php foreach($resGallery as $row): ?>
													<div class="thumbnail-<?php echo $x; ?>">
														<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel/thumb/<?php echo $row->thumb_file; ?>" alt="#">
													</div>
													<?php $x++; ?>
													<?php endforeach; ?>
													<?php else: ?>
														<div class="thumbnail-0">
														<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel.png" alt="#">
													</div>
													<?php endif; ?>
												</div><!-- /.gallery-thumbnails -->

											</div> <!-- /#gallery-wrapper -->
										</div>
									</div>
								<!--- end slider-->
							</div>
							
							<div class="col-md-6">
								<div class="overview">
									<div id="tab-container" class="tab-container">

									<ul class='nav nav-tabs'>
										<li class='tab'><a href="#overview">Overview</a></li>
										<li class='tab'><a href="#service">Layanan</a></li>
										<li class='tab'><a href="#lokasi">Produk</a></li>
									</ul><!-- /.nav-tabs -->
									
									<div class="block white block-shadow">
										<div class="block-inner">
											<div id="overview" class="active">
												<div class="row">
													<div class="col-sm-5 col-md-5">
														<?php if ($resBengkel[0]->telp != ''): ?>
														<span class="btn btn-primary" href="#"><i class="clip-phone"></i><?php echo $resBengkel[0]->telp; ?></span>
														<?php endif; ?>
														<div class="actions">
															<ul>
																<li>
																	<a href="#">
																		<i class="icon icon-normal-twitter"></i>Twitter Account
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="icon icon-normal-facebook"></i>Facebook Account
																	</a>
																</li>
																<li>
																	<a href="#">
																		<i class="icon icon-normal-mail"></i>
																		Email Account
																	</a>
																</li>
															</ul>
														</div><!-- /.actions-->
													</div><!-- /.col-md-5 -->

													<div class="col-sm-7 col-md-7">
														<table class="table">
															<tbody>
																<tr>
																	<td class="property">Nama Bengkel</td>
																	<td class="value"><?php echo $resBengkel[0]->nama_bengkel; ?></td>
																</tr>
																<tr>
																	<td class="property">Alamat</td>
																	<td class="value"><?php echo $resBengkel[0]->alamat_bengkel; ?></td>
																</tr>
																<tr>
																	<td class="property">Kota</td>
																	<td class="value"><?php echo $resBengkel[0]->city; ?></td>
																</tr>
																<tr>
																	<td class="property">Propinsi</td>
																	<td class="value"><?php echo $resBengkel[0]->propinsi; ?></td>
																</tr>

																<tr>
																	<td class="property">Negara</td>
																	<td class="value"><?php echo $resBengkel[0]->country; ?></td>
																</tr>
																<tr>
																	<td class="property">Kategori</td>
																	<td class="value"><?php echo $arrJenis[$resBengkel[0]->jenis_id]; ?></td>
																</tr>
															</tbody>
														</table><!-- /.table -->
													</div><!-- /.col-md-7 -->
												</div><!-- /.row -->

												<div class="info">
													<p><?php echo $resBengkel[0]->deskripsi; ?></p>
												</div>
												<div class="info">
													<?php echo $map['html']; ?>
												</div>
												<!-- /.info -->
											</div><!-- /#overview -->
											<div id="service">
												<h3>Layanan-layanan</h3>
												<div class="row">
													<div class="col-sm-6 col-md-6">
													<?php if ($resLayanan) : ?>
													<ul>
													<?php foreach($resLayanan as $row): ?>
														<li><span class="dot"></span><?php echo $row->judul_layanan; ?>
														<?php if ($row->konten != ''): ?>
															<p><?php echo $row->konten; ?></p>
														<?php endif; ?>
														</li>
													<?php endforeach; ?>
													</ul>
													<?php else : ?>
														<p>Layanan belum didefinisikan</p>
													<?php endif; ?>
													</div>
												</div>
											</div>
											<div id="lokasi">
												
											</div>
										</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<!--- map --->
						<div class="row">
							<div class="col-md-12">
								<div class="block block-shadow white block-margin">
									<div class="block-inner">
										<div class="row" id="comment">
											<div class="col-md-12">
												<?php 
												$flashmsg = flashmsg_get();
												if ($flashmsg != ''):
												if (substr($flashmsg,0,4) == 'Erro'): ?>
													<div class="alert alert-danger">
													<button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<?php echo $flashmsg; ?>
													</div>
												<?php else: ?>
													<div class="alert alert-success">
													<button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
													<?php echo $flashmsg; ?>
													</div>
												<?php endif; ?>
												<?php endif; ?>
												<?php $form = Tb::form(array('type' => Tb::FORM_TYPE_HORIZONTAL, 'action' => 'comments/save_testimoni'));
												echo form_hidden('bengkel_id', $resBengkel[0]->bengkel_id);
												echo form_hidden('slug',$resBengkel[0]->slug);
												echo $form->textFieldRow('nama', 'Nama (wajib diisi)', array('placeholder' => 'Nama')); 
												echo $form->textFieldRow('email', 'Email (wajib diisi)', array('placeholder' => 'Email'));
												echo $form->textFieldRow('website', 'Website (optional)', array('placeholder' => 'http://'));
												echo $form->textAreaRow('konten','Komentar', array('style' => 'height:100px;')); 
												echo '<div class="form-group">
												<div class="col-md-5">'.form_submit('save', 'Posting Komentar', 'class="btn btn-primary btn-sm"').'</div>
												</div>';
												$form->end();
												?>
											</div>
											<div class="col-md-12">
												<h2>Testimoni</h2>
											</div>
											<?php if ($resTestimoni): ?>
										
												<?php foreach($resTestimoni as $row): ?>
													<div class="testimonial white">
														<div class="inner">
														<div class="col-md-1">
															<img src="<?php echo get_gravatar($row->email); ?>" alt="#">
														</div>
														<div class="col-md-11">
															<p>
														<?php echo  html_entity_decode($row->konten); ?>
															</p>
														</div>
														<br>
														<div class="clearfix"></div>
														<div class="col-md-1">&nbsp;</div>
														<div class="col-md-11">
															<?php if ($row->website != ''): ?>
																<p>Komentar Oleh : <strong><?php echo anchor($row->website, $row->nama); ?></strong></p>
															<?php else: ?>
																<p>Komentar Oleh : <strong><?php echo $row->nama; ?></strong></p>
															<?php endif; ?>
															<p>Diposting pada : <?php echo $row->tanggal; ?></p>
														</div>
														<div class="clearfix"></div>
													</div>
													</div>
													
												<?php endforeach; ?>
											<?php else: ?>
												<div class="col-md-12">
												<p>Belum Ada testimoni, jadilah yang pertama</p>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div><!-- /.block -->
							</div><!-- /.col-md-12 -->
						</div><!-- /.row -->
					<!-- end map --->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('maintheme/footer'); 
