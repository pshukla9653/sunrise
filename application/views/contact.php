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
										<h2></h2>
										
									</div>
								</div>
							</div>
								<!-- Start Contact Content -->
							<!-- <div class="mu-contact-content"> -->
								<div class="row">

									<div class="col-md-6">
									<h2 class="title1 upper"><i class="ico-pencil5"></i>Contact US</h2>
											<?php echo $this->session->flashdata('msg');?>
											<form method="post" action="<?php echo base_url('Web/contact');?>" class="mu-contact-form">
												

												<div class="form-group">               
													<input type="hidden" class="form-control" placeholder="Current Address" id="txtlat" name="temp_lat">
												</div>
												<div class="form-group">              
													<input type="hidden" class="form-control" placeholder="Current Address" id="txtlog" name="temp_log">
												</div>

												<div class="form-group">  
													<span class="fa fa-user mu-contact-icon"></span>              
													<input type="text" class="form-control" placeholder="Name" id="name" name="e_name" >
													<span style="color:red;"><?php echo form_error('e_name');?></span>
												</div>

												<div class="form-group">  
													<span class="fa fa-envelope mu-contact-icon"></span>              
													<input type="email" class="form-control" placeholder="Enter Email" id="email" name="e_email" >
													<span style="color:red;"><?php echo form_error('e_email');?></span>
												</div>    

												<div class="form-group"> 
													<span class="fa fa-folder-open-o mu-contact-icon"></span>                
													<input type="text" class="form-control" placeholder="Your Subject" id="subject" name="e_subject" >
													
												</div>

												<div class="form-group">
													<span class="fa fa-pencil-square-o mu-contact-icon"></span> 
													<textarea class="form-control" placeholder="Message" id="message" name="e_msg" ></textarea>
													<span style="color:red;"><?php echo form_error('e_msg');?></span>
												</div>
												<button type="submit" class="mu-send-msg-btn" name="submit" value="Submit" ><span>Send Message</span></button>
								        	</form>
									</div>
								    <div class="col-md-6">
									<h2 class="title1 upper"><i class="ico-pencil5"></i>Contact Information</h2>

					<div class="contact_details_row clearfix" style="padding:1.5em;">
						
						<div class="c_con">*
								<h4><center>Head Office </center></h4>
								<span class="c_desc"><span style="font-weight:bold">Address</span> -  F-115 B,Ganj Plaza,-42,Hazratganj, Lucknow, Uttar Pradesh 226001</span>
								<p class="c_desc"><span style="font-weight:bold">Contact No.</span> - 0522-410-8532 </p>
							</span>
							</br></br></br>
							<span class="c_detail">
							<h4><center class="c_name">Branch Office</center></h4>
								<span class="c_desc"> <span style="font-weight:bold">Address</span>- S - 463 Transport Nagar near Oneup Motors Lucknow </span>
								<p class="c_desc"><span style="font-weight:bold">Contact No.</span> - 0522-410-8532 </p>
							</span>
						</div>
					</div>
					
					
				</div><!-- Grid -->


								<!-- </div> -->
							</div>
							<!-- End Contact Content -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Contact -->

		<!-- Google map -->
		<div id="mu-google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14238.814052057563!2d80.9437898!3d26.8493809!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4f62b13045fe1794!2sS.R.International!5e0!3m2!1sen!2sin!4v1538125772812" width="850" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>


	</main>
	
	<!-- End main content -->
	
