<?php $this->load->view('maintheme/header'); ?>
<div id="content" class="article-page">
	<div class="section gray-light">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="main">
						<div class="row">
							<div class="col-md-8">
								<article class="block white block-margin block-shadow">
								<div class="block-inner">
									<div class="text">
										<?php echo $content; ?>
									</div>
								</div>
								</article>
							</div>
							<div class="col-md-4 col-sm-10">
								<div class="sidebar">
									<div class="block block-shadow white">
										<div class="block-inner">
											<div class="block-title">
												<h3>Bengkel Terbaru</h3>
											</div>
											<?php if ($baru): ?>
											<?php foreach($baru as $row): ?>
												<div class="row-item">
													<div class="inner">
														<div class="row">
															<div class="item-wrapper col-md-12 col-sm-5">
																<div class="title">
															<h4><?php echo anchor('bengkel/view/'.$row->slug, $row->nama_bengkel); ?></h4>
																</div>
																<div class="picture" align="center">
																	<div class="image-slider">
																		<?php $imagesbaru = $this->bengkelin->gallery_bengkel_by_id($row->bengkel_id);
																		if ($imagesbaru): ?>
																			
																				<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
																					<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$imagesbaru[0]->thumb_file; ?>" alt="#" style="width:252px;height:190px;" class="slide">
																				</a><!-- /.slide -->
																		<?php else: ?>
																				<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
																					<img src="<?php echo base_url().'assets/images/galleries/bengkel.png'; ?>" alt="#" style="width:252px;height:190px;">
																				</a><!-- /.slide -->
																		<?php endif; ?>
																	</div><!-- /.image-slider -->
															</div><!-- /.picture -->
																<div class="description">
																<?php echo $row->deskripsi; ?>
																</div>
																<?php if (!empty($row->city)): ?>
																	<p><?php echo anchor('bengkel/list_bengkel/'.$row->jenis_id.'/-/-/'.$row->city.'/-/-/-/go/0',  $row->city); ?></p>
																<?php endif; ?>
																<?php if ($row->telp != ''): ?>
																<div class="price"><span class="btn btn-danger btn-sm"><?php echo $row->telp; ?></span></div>
																<?php endif; ?>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
