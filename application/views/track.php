
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
										<h2>Track Your Shipment</h2>
										<p>Enter Your AWB Number For Tracking.</p>
									</div>
								</div>
							</div>
								<!-- Start Contact Content -->
							<div class="mu-contact-content">
								<div class="row">

									<div class="col-md-12">
										<div class="mu-contact-form-area">
										<?php echo $this->session->flashdata('msg'); ?>
											<form id="bar-codecheck" method="post" action="<?php echo base_url('web/track');?>" class="mu-contact-form">

												<div class="form-group">
													<span class="fa fa-pencil-square-o mu-contact-icon"></span> 
													<textarea class="form-control" name="awdeufxmeij" placeholder="awbcodes"></textarea>
                                                    
												</div>
												<button type="submit" class="mu-send-msg-btn" name="submit" value="Track"><span>Track</span></button>
								        	</form>
										</div>
									</div>
									
								</div>
								
								
								
							</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
				 
			</div>
		</section>
		<!-- End Contact -->

		

	</main>
	
	<!-- End main content -->
	<script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    	window.setTimeout(function () {
			$(".alert-info").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 3000);
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    $('[data-rel="chosen"],[rel="chosen"]').chosen();
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			  checkboxClass: 'icheckbox_minimal-blue',
			  radioClass: 'iradio_minimal-blue'
			});
    </script>



