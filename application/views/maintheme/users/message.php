<?php $this->load->view('maintheme/header'); ?>
<div id="content" class="article-page">
	<div class="section gray-light">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="main">
						<div class="row">
							<div class="col-md-12">
								<article class="block white block-margin block-shadow">
								<div class="block-inner">
									<div class="text">
										<?php if (substr($pesan, 0, 4) == 'Erro'): ?>
											<div class="alert alert-danger"><?php echo $pesan; ?></div>
										<?php else: ?>
											<div class="alert alert-info"><?php echo $pesan; ?></div>
										<?php endif; ?>
									</div>
								</div>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('maintheme/footer'); ?>
