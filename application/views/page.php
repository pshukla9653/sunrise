<!-- Start main content -->
	<main>
		<!-- Start Contact -->
		<section id="mu-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="mu-contact-area">
							<!-- Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2><?=$pagedata['page_title'];?></h2>
										
									</div>
								</div>
							</div>
								<!-- Start Contact Content -->
							<!-- <div class="mu-contact-content"> -->
								<div class="row">
            <?php if($pagedata['upload_file']==''){?>
            <div class="col-md-12">
					<?=$pagedata['description'];?>
				</div>
            <?php }else{?>
				<div class="col-md-4">
				<a href="<?=base_url();?>">
              <img src="<?php echo base_url('uploads/page/'.$pagedata['upload_file']);?>" class="img-responsive" alt="logo" title="<?=$pagedata['page_title'];?>"/></a>	
					
					
				</div>
				<div class="col-md-8">
					<?=$pagedata['description'];?>
				</div>
                <?php }?>
				</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->

		


	</main>
	<!-- //contact -->