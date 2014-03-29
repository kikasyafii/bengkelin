<?php $this->load->view('maintheme/header'); ?>
<div class="highlighted-wrapper gray">
	<div class="highlighted section">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<div id="overviews">
						<?php if ($randBengkel) : ?>
						<?php foreach($randBengkel as $key => $row): ?>
						<?php if ($key==0) { $active = 'active'; } else { $active = '';} ?>
						<div class="overview <?php echo $active; ?>">
							<div class="overview-table">
								<div class="item title">
									<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><h3><?php echo $row->nama_bengkel; ?></h3></a>
									<span class="subtitle">
									<?php echo (isset($arrJenis[$row->jenis_id]) ? $arrJenis[$row->jenis_id] : 'Belum didefiniskan'); ?>
									</span>
								</div><!-- /.item -->
								
								<div class="item line">
									<span class="property">Alamat</span>
									<span class="value"><?php echo (empty($row->alamat_bengkel) ? '-' : $row->alamat_bengkel); ?></span>
								</div><!-- /.item -->
								
								<div class="item line">
									<span class="property">Kota</span>
									<span class="value"><?php echo (empty($row->city) ? '-' : $row->city); ?></span>
								</div><!-- /.item -->
								
								<div class="item line">
									<span class="property">Propinsi</span>
									<span class="value"><?php echo (empty($row->propinsi) ? '-' : $row->propinsi); ?></span>
								</div><!-- /.item -->
								
								<div class="item line">
									<span class="property">Negara</span>
									<span class="value"><?php echo (empty($row->country) ? '-' : $row->country); ?></span>
								</div><!-- /.item -->
								
								<div class="item line">
									<span class="property">Phone</span>
									<span class="value"><?php echo (empty($row->telp) ? '-' : $row->telp); ?></span>
								</div><!-- /.item -->

							</div><!-- /.overview-table -->
						</div><!-- /.overview -->
						<?php endforeach; ?>
						<?php endif; ?>
						<div id="slider-navigation">
							<div class="prev"></div><!-- /.prev -->
							<div class="next"></div><!-- /.next -->
						</div><!-- /.slider-navigation -->
					</div><!-- /.overviews -->
				</div>


				<div class="col-md-7 col-sm-7">
					<div id="slider">
						<?php if ($randBengkel): ?>
						<?php foreach($randBengkel as $row): ?>
							<?php if ($key==0) { $active = 'active'; } else { $active = '';} ?>
							<div class="slide <?php echo $active; ?>">
								<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>">
								<?php if ($arrGallery[$row->bengkel_id] != ''): ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel/<?php echo $arrGallery[$row->bengkel_id][0]->name_file; ?>" alt="<?php echo $row->nama_bengkel; ?>" title="<?php echo $row->nama_bengkel; ?>" width="650" height="410"></a>
								<?php else: ?>
								<img src="<?php echo base_url(); ?>assets/images/galleries/bengkel.png" alt="<?php echo $row->nama_bengkel; ?>" title="<?php echo $row->nama_bengkel; ?>" width="650" height="410"></a>
								<?php endif; ?>
								<div class="color-overlay"></div><!-- /.color-overlay -->
							</div><!-- /.slide -->
						<?php endforeach; ?>
						<?php endif; ?>
					</div><!-- /#slider -->
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.highligted -->

	<div class="filter-wrapper">
		<div class="container">
			<div class="row">           
				<div class="col-md-3 col-xs-12 pull-right">
					<div class="filter-block">
						<div class="block">

							<div class="content">
								<div class="inner">
									<div class="tab-content">
										<div class="tab-pane active" id="search-sales">
											<?php echo form_open('bengkel/list_bengkel'); ?>
												<div class="row">

													<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
														<?php echo form_input('nama_bengkel', '', 'placeholder="Nama Bengkel / Show Room" class="form-control"'); ?>
													</div><!-- /.form-group -->

													<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
														<?php echo form_dropdown('jenis_id', $arrJenis, '', 'class="form-control"'); ?>
													</div><!-- /.form-group -->

													<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6 year-from">
														<?php echo form_input('alamat_bengkel', '', 'placeholder="Alamat" class="form-control"'); ?>
													</div><!-- /.form-group -->
													
													<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6 year-from">
														<?php echo form_input('telp', '', 'placeholder="Telp" class="form-control"'); ?>
													</div><!-- /.form-group -->
													
													<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6 year-from">
														<?php echo form_input('city', '', 'placeholder="Kota" class="form-control"'); ?>
													</div><!-- /.form-group -->

													<div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-6 year-to">
														<?php echo form_input('propinsi', '', 'placeholder="Propinsi" class="form-control"'); ?>
													</div><!-- /.form-group -->

													<div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
														<?php echo form_input('country', '', 'placeholder="Negara" class="form-control"'); ?>
													</div><!-- /.form-group -->

												</div><!-- /.row -->

												<div class="form-group">
													<button class="send btn btn-primary btn-primary-color" type="submit">
														Cari <i class="icon icon-normal-right-arrow-small"></i>
													</button>
												</div><!-- /.form-group -->
											<?php echo form_close(); ?>
										</div><!-- /.tab-pane -->

									</div><!-- /.tab-content -->
								</div><!-- /.inner -->
							</div><!-- /.content -->                                
						</div><!-- /.block -->
					</div><!-- /.filter-block -->
				</div><!-- /.col-md-3 -->
			</div><!-- /.row -->
		</div><!-- /.highlighted -->
	</div><!-- /.slider-filter -->
</div><!-- /.highlighted-wrapper -->

<div id="content" class="frontpage">
	<div class="section gray-light">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="recent-cars" class="grid-block block">
	<div class="page-header center">
		<div class="page-header-inner">
			<div class="line">
				<hr/>
			</div><!-- /.line -->

			<div class="heading">
				<h2>Bengkel Terbaru</h2>
			</div><!-- /.heading -->

			<div class="line">
				<hr/>
			</div><!-- /.line -->
		</div><!-- /.page-header-inner -->
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-md-12">
			<div class="inner-block white">
				<div class="grid-carousel">
				<?php if ($terbaru) : ?>
				<?php foreach($terbaru as $row): ?>
					<div class="inner">
						<div class="grid-item">
							<div class="inner">
								<div class="picture">
									<div class="image-slider">
										<?php
										$images = $this->bengkelin->gallery_bengkel_by_id($row->bengkel_id);
										if ($images):
										foreach($images as $img): ?>
											<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
											<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$img->thumb_file; ?>" style="width:254px;height:191px;" alt="<?php echo $row->nama_bengkel; ?>" title="<?php echo $row->nama_bengkel; ?>">
											</a>
										<?php endforeach; ?>
										<?php else: ?>
											<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
											<img src="<?php echo base_url().'assets/images/galleries/bengkel.png'; ?>" style="width:254px;height:191px;" alt="<?php echo $row->nama_bengkel; ?>" title="<?php echo $row->nama_bengkel; ?>">
											</a>
										<?php endif; ?>
										<div class="cycle-pager"></div>
									</div> <!-- image slider-->
								</div> <!-- picture -->
								<div class="like">
									<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><i class="icon icon-outline-thumb-up"></i></a>
								</div>
								<h3>
									<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><?php echo $row->nama_bengkel?></a>
								</h3>
								<div class="subtitle"><?php echo (isset($arrJenis[$row->jenis_id]) ? $arrJenis[$row->jenis_id] : 'Belum didefinisikan'); ?></div><!-- /.subtitle -->
								<div class="price"><i class="clip-phone"></i><?php echo $row->telp; ?></div><!-- /.price -->
								<div class="meta">
									<div align="center">
									<?php echo $row->city; ?>
									</div>
								</div>
							</div><!-- inner -->
						</div><!-- grid-item -->
					</div><!-- inner -->
					<?php endforeach; ?>
				<?php endif; ?>
				</div><!--grid-carousel -->
			</div><!-- inner block-->
		</div><!-- col-md 12-->
	</div><!-- row -->

	<div class="row">
		<div class="col-md-12">
			<div id="grid-carousel-pager">
				<div class="prev"></div><!-- /.prev -->
				<div class="next"></div><!-- /.next -->
			</div><!-- /.grid-carousel-pager -->
		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.grid-block -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.section -->
<!--div class="section gray-light">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12">
				<div id="main">
										<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
				</div>
			</div>
		</div>
	</div>
</div-->
	<div class="section gray-light">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-12">
					<div id="main">
						<div class="row-block block" id="best-deals">
	<div class="page-header">
		<div class="page-header-inner">
			<div class="heading">
				<h2>Baru</h2>
			</div><!-- /.heading -->

			<div class="line">
				<hr/>
			</div><!-- /.line -->
		</div><!-- /.page-header-inner -->
	</div><!-- /.page-header -->


	<div class="row">
		<div class="col-md-12">
			<div class="content white">
				<div class="inner">
					<?php if ($baru): ?>
					<?php foreach($baru as $row):?>
					<?php if ($row->nama_bengkel == '') continue; ?>
					<div class="row-item">
						<div class="inner">
							<div class="row">
								<div class="col-lg-4 col-md-5 col-sm-5">
									<div class="picture">
										<div class="image-slider">
											<?php $imagesbaru = $this->bengkelin->gallery_bengkel_by_id($row->bengkel_id);
											
											if ($imagesbaru):
												foreach($imagesbaru as $img): ?>
													<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
														<img src="<?php echo base_url().'assets/images/galleries/bengkel/thumb/'.$img->thumb_file; ?>" alt="#" style="width:252px;height:190px;" class="slide" title="<?php echo $row->nama_bengkel; ?>" alt="<?php echo $row->nama_bengkel; ?>">
													</a><!-- /.slide -->
												<?php endforeach; ?>
											<?php else: ?>
													<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" class="slide">
														<img src="<?php echo base_url().'assets/images/galleries/bengkel.png'; ?>"  title="<?php echo $row->nama_bengkel; ?>" alt="<?php echo $row->nama_bengkel; ?>" style="width:252px;height:190px;">
													</a><!-- /.slide -->
											<?php endif; ?>
											<div class="cycle-pager"></div><!-- /.cycle-pager -->
										</div><!-- /.image-slider -->
									</div><!-- /.picture -->
								</div><!-- /.col-md-4 -->
								<div class="col-lg-8 col-md-7 col-sm-7">
									<div class="content-inner">
										<h3>
											<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>" ><?php echo $row->nama_bengkel; ?></a>
										</h3>
										<div class="subtitle"><?php echo (isset($arrJenis[$row->jenis_id]) ? $arrJenis[$row->jenis_id] : 'Belum didefinisikan'); ?></div><!-- /.subtitle -->
										<div class="description">
											<p><?php echo $row->alamat_bengkel; ?></p>
											<p><?php echo $row->deskripsi; ?></p>
										</div><!-- /.description -->
										<div class="price"><i class="clip-phone"></i><?php echo $row->telp; ?></div><!-- /.price -->
										<div class="meta">
											<ul>
												<?php if ($row->city): ?>
												<li><?php 
												if (in_array($row->jenis_id, array(1,2))){
													echo anchor('bengkel/list_bengkel/'.$row->jenis_id.'/-/-/'.$row->city.'/-/-/-/go/0',  $row->city);
												}else{
													echo anchor('bengkel/list_showroom/'.$row->jenis_id.'/-/-/'.$row->city.'/-/-/-/go/0',  $row->city);
												}
												 ?></li>
												<?php endif; ?>
												<?php if ($row->propinsi): ?>
												<li><?php 
												if (in_array($row->jenis_id, array(1,2))){
													echo anchor('bengkel/list_bengkel/'.$row->jenis_id.'/-/-/-/'.$row->propinsi.'/-/-/go/0', $row->propinsi); 
												}else{
													echo anchor('bengkel/list_showroom/'.$row->jenis_id.'/-/-/-/'.$row->propinsi.'/-/-/go/0', $row->propinsi); 
												}
												?></li>
												<?php endif; ?>
											</ul>
										</div><!-- /.meta -->
									</div><!-- /.content-inner -->
								</div><!-- /.col-md-8 -->
							</div><!-- /.row -->
						</div><!-- /.inner -->
					</div><!-- /.row-item -->
					<?php endforeach; ?>
					<?php endif; ?>
				</div><!-- /.inner -->
			</div><!-- /.content -->
		</div><!-- /.col-md-12 -->
	</div><!-- /.row -->
</div><!-- /.block -->                    
	</div><!-- /#main -->
	</div><!-- /.col-md-9 -->

				<div class="col-md-3 col-sm-12">
					<div class="sidebar">
						<div id="newsletter" class='block default'>
  <!--div class="block-inner">
	<div class="block-title">
	  <h3>Subscribe to newsletter</h3>
	</div>

	<form>
	  <div class="form-group">
		<input placeholder="Your e-mail" type="text" name="maker" class="form-control">
	  </div>

	  <div class="form-group">
		<button class="send btn btn-primary btn-primary-color">Subscribe</button>
	  </div>
	</form>
  </div-->
</div>                        <div class="latest-reviews block block-shadow white">
	<div class="block-inner">
		<div class="block-title">
			<h3>Review Terakhir</h3>
		</div><!-- /.block-title -->

		<div class="inner">
			<div class="row">
				<?php if ($reviewTerakhir): ?>
				<?php foreach($reviewTerakhir as $row): ?>
				<div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="item">
						<div class="title">
							<a href="<?php echo site_url('bengkel/view/'.$row->slug); ?>"><?php echo $row->nama_bengkel?></a>
						</div><!-- /.title -->

						<div class="date"><?php echo $row->tanggal; ?></div><!-- /.date -->

						<div class="description">
							<p>
								<?php echo htmlentities($row->konten); ?>
							</p>
						</div><!-- /.description -->
					</div><!-- /.item -->
				</div><!-- /.item-wrapper -->
				<?php endforeach; ?>
				<?php else: ?>
				<div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
					<div class="item">
						<div class="title">
							Belum ada review
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div><!-- /.row -->
		</div><!-- /.inner -->
	</div><!-- /.block-inner -->
</div><!-- /.block -->                        

				</div><!-- /.col-md-3 -->
			</div><!-- /.row -->

			<div id="content-bottom">
				<div class="row">
					<div class="col-md-12">
						<div class="testimonials-block block">
	<div class="page-header center">
		<div class="page-header-inner">
			<div class="line">
				<hr/>
			</div>

			<div class="heading">
				<h2>Testimoni</h2>
			</div><!-- /.heading -->

			<div class="line">
				<hr/>
			</div><!-- /.line -->
		</div><!-- /.page-header-inner -->
	</div><!-- /.page-header -->

	<div class="row">
	<?php if ($randomTestimoni): ?>
	<?php foreach($randomTestimoni as $row): ?>
		<div class="col-sm-12 col-md-6">
			<div class="testimonial white">
				<div class="inner">
					<div class="row">
						<div class="col-sm-3 col-md-4">
							<div class="picture">
								<img src="<?php echo get_gravatar($row->email,160); ?>"  title="<?php echo $row->nama; ?>" alt="<?php echo $row->nama; ?>">
							</div><!-- /.picture -->
						</div><!-- /.col-md-4 -->

						<div class="col-sm-9 col-md-8">
							<div class="description quote">
								<p>
									<i>
										<?php echo htmlentities($row->konten); ?>
									</i>
								</p>
							</div><!-- /.description -->

							<!--div class="star-rating">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
								<input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
							</div><!-- /.star-rating -->

							<div class="author">
								<?php if ($row->website != '' || $row->website != 'htt://'): ?>
									<strong><?php echo anchor($row->website, $row->nama); ?></strong>
								<?php else: ?>
									<strong><?php echo $row->nama; ?></strong>
								<?php endif; ?>
							</div><!-- /.author -->
						</div><!-- /.col-md-8 -->
					</div><!-- /.row -->
				</div><!-- /.inner -->
			</div><!-- /.testimonial -->
		</div><!-- /.col-md-6 -->
		
	<?php endforeach; ?>
	<?php endif; ?>
	</div><!-- /.row -->
	</div><!-- /.row -->
</div><!-- /.testimonials-block -->                    </div><!-- /.col-md-12 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-md-12">
						<div class="features-block block">
	<div class="row">
		<div class="feature">
			<div class="col-xs-12 col-md-4 col-sm-4">
				<div class="row">
					<div class="col-xs-12 col-md-5">
						<div class="feature-icon" style="top:32px;">
							<div class="feature-icon-inverse">
								<i class="icon-outline-car"></i>
							</div><!-- /.feature-icon-inverse -->

							<div class="feature-icon-normal">
								<i class="icon-normal-car"></i>
							</div><!-- /.feature-icon-normal -->
						</div><!-- /.feature-icon -->
					</div><!-- /.col-md-5 -->

					<div class="col-xs-12 col-md-7">
						<h3>Daftarkan Bengkel dan Showroom Anda Gratis!</h3>
						<p><?php echo anchor('users/register', 'Daftar sekarang'); ?></p>
					</div><!-- /.col-md-7 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-4 -->
		</div><!-- /.feature -->

		<div class="feature">
			<div class="col-xs-12 col-md-4 col-sm-4">
				<div class="row">
					<div class="col-xs-12 col-md-5">
						<div class="feature-icon" style="top:32px;">
							<div class="feature-icon-inverse">
								<i class="icon-outline-currency-dollar"></i>
							</div><!-- /.feature-icon-inverse -->

							<div class="feature-icon-normal">
								<i class="icon-normal-currency-dollar"></i>
							</div><!-- /.feature-icon-normal -->
						</div><!-- /.feature-icon -->
					</div><!-- /.col-md-5 -->

					<div class="col-xs-12 col-md-7">
						<h3>Bengkel-bengkel Terbaik Ada Di sini</h3>
						<p><?php echo anchor('bengkel/list_bengkel', 'Lihat'); ?></p>
					</div><!-- /.col-md-7 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-4 -->
		</div><!-- /.feature -->

		<div class="feature">
			<div class="col-xs-12 col-md-4 col-sm-4">
				<div class="row">
					<div class="col-xs-12 col-md-5">
						<div class="feature-icon" style="top:32px;">
							<div class="feature-icon-inverse">
								<i class="icon-outline-car-door"></i>
							</div><!-- /.feature-icon-inverse -->

							<div class="feature-icon-normal">
								<i class="icon-normal-car-door"></i>
							</div><!-- /.feature-icon-normal -->
						</div><!-- /.feature-icon -->
					</div><!-- /.col-md-5 -->

					<div class="col-xs-12 col-md-7">
						<h3>Dealer Terbaik Ada Di sini</h3>
						<p><?php echo anchor('bengkel/list_showroom', 'Lihat'); ?></p>
					</div><!-- /.col-md-7 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-4 -->
		</div><!-- /.feature -->		
	</div><!-- /.row -->
</div><!-- /.block -->                    </div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /#content-bottom -->
		</div><!-- /.container -->
	</div><!-- /.section -->

	<div class="section gray-light ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="partners-block block">
		<div class="page-header">
			<div class="page-header-inner">


				<div class="heading">
					<h2>Partner Kami</h2>
				</div><!-- /.heading -->

				<div class="line">
					<hr/>
				</div><!-- /.line -->
			</div><!-- /.page-header-inner -->
		</div><!-- /.page-header -->

	<div class="inner-block white block-shadow">
		<div class="row">
			<?php if ($resPartner): ?>
			<?php foreach($resPartner as $row): ?>
			<div class="col-sm-2 col-md-2">
				<div class="partner">
					<a href="#">
						<img src="<?php echo base_url(); ?>assets/images/galleries/partner/thumb/<?php echo $row->thumb_file; ?>" alt="<?php echo $row->nama_partner; ?>" title="<?php echo $row->nama_partner; ?>">
					</a>
				</div><!-- /.partner -->
			</div><!-- /.col-md-2 -->
			<?php endforeach; ?>
			<?php endif; ?>
		</div><!-- /.row -->
	</div><!-- /.inner-block -->
</div><!-- /.partners-block -->
</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.section -->
</div><!-- /#content -->

<?php $this->load->view('maintheme/footer');
