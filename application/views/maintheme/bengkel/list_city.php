<?php $this->load->view('maintheme/header'); ?>
<div id="content" class="page-rental">
	<div class="section gray-light">
		<div class="container">
		<div class="col-md-9">
			
			 <div class="row">
				<div class="col-md-12">
					<div class="block block-margin sort">
						<div class="block-inner gray">
							<div class="page-heading">
								<h3>List <?php echo $jenis; ?></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="main">
				<div class="row-block block block-margin">
					<div class="row">
						<div class="col-md-12">
							<div class="content white">
								<div class="inner">
									<?php if ($result): ?>
									<?php if ($links): ?>
										<div class="row-item row-item-checkout">
											<div class="center">
												<div class="dataTables_paginate paging_bootstrap">
													<ul class="pagination">
												<?php echo $links; ?>
												</ul>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<?php foreach($result as $row): ?>
										<?php if ($row->nama_bengkel == '') continue; ?>
									<div class="row-item row-item-checkout">
										<div class="inner">
											<div class="row">
												<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
													<div class="picture">
														<div class="image-slider">
															<?php $resGallery = $this->bengkelin->gallery_bengkel_by_id($row->bengkel_id); 
																if ($resGallery): 
																	foreach($resGallery as $rowgallery): ?>
																		<a href="<?php echo current_url().'#'; ?>" class="slide">
																			<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel/thumb/<?php echo $rowgallery->thumb_file; ?>" alt="#" style="width:254px;height:184px;">
																		</a><!-- /.slide -->
																	<?php endforeach; ?>
																<?php else: ?>
																	<a href="<?php echo current_url().'#'; ?>" class="slide">
																		<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel.png" alt="#" style="width:254px;height:184px;">
																	</a>
																<?php endif; ?>
															<div class="cycle-pager"></div><!-- /.cycle-pager -->
														</div><!-- /.image-slider -->
														<!--div class="favorite">
															<a href="#"><i class="icon icon-outline-thumb-up"></i> Favorite</a>
														</div><!-- /.like -->
													</div><!-- /.picture -->
												</div><!-- /.col-md-4 -->

												<div class="col-lg-8 col-md-7 cols-sm-12 col-xs-12">
													<div class="content-inner">
														<h3>
															<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><?php echo $row->nama_bengkel; ?></a>
														</h3>
														<div class="subtitle">
															<?php echo $row->alamat_bengkel; ?> &nbsp;
															<?php echo $row->city; ?> &nbsp; 
															<?php echo $row->propinsi; ?> &nbsp;
															<?php echo $row->country; ?>
															<p><?php echo $row->deskripsi; ?></p>
														</div><!-- /.subtitle -->
														<div class="price"><?php echo $row->telp; ?></div><!-- /.price -->
													</div><!-- /.content-inner -->
												</div><!-- /.col-md-8 -->
											</div><!-- /.row -->
										</div><!-- /.inner -->
									</div><!-- /.row-item -->
									<?php endforeach; ?>
								<?php endif; ?>
								<div class="row-item row-item-checkout">
									<div class="center">
										<div class="dataTables_paginate paging_bootstrap">
											<ul class="pagination">
										<?php echo $links; ?>
										</ul>
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /#main -->
		</div>
		<div class="col-md-3 sidebar">
			<div class="block block-shadow white filter-cars">
				<div class="block-inner">
					<div class="block-title">
						<h3>Pencarian</h3>
					</div>
					<!-- /.block-title -->
					<?php echo form_open('bengkel/list_bengkel'); ?>
						<div class="form-section">
							<div class="form-group">
								<input name="city" placeholder="Isikan kota" class="form-control" value="<?php echo $city; ?>">
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit" name="go">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); 
