
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
										<h2>Query/complaint</h2>
										
									</div>
								</div>
							</div>
								<!-- Start Contact Content -->
							<div class="mu-contact-content">
								<div class="row">

									<div class="col-md-12">
										<div class="mu-contact-form-area">
											<div id="form-messages"></div>
											<form id="ajax-contact" method="post" action="mailer.php" class="mu-contact-form">

												<div class="form-group">  
													<span class="fa fa-user mu-contact-icon"></span>              
													<input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
												</div>

												<div class="form-group">  
													<span class="fa fa-envelope mu-contact-icon"></span>              
													<input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
												</div>    

												<div class="form-group"> 
													<span class="fa fa-folder-open-o mu-contact-icon"></span>                
													<input type="text" class="form-control" placeholder="Your Subject" id="subject" name="subject" required>
												</div>

												<div class="form-group">
													<span class="fa fa-pencil-square-o mu-contact-icon"></span> 
													<textarea class="form-control" placeholder="Message" id="message" name="message" required></textarea>
												</div>
												<button type="submit" class="mu-send-msg-btn"><span>Send Message</span></button>
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