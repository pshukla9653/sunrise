<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                            <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - 
                            <a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?></a></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?></a></li>
						</ul>

						
					</div>
				</div>
				<!-- /page header -->
<!-- Content area -->
				<div class="content">

					<!-- Horizontal form options -->
				
<?=form_open_multipart('secure/retailer/add', array('class'=>'form-horizontal','id'=>'retailerform')); ?>
<?php echo $this->session->flashdata('msg'); ?>
	<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Add <?=ucfirst($this->uri->segment(2));?></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-reading position-left"></i> <?=ucfirst($this->uri->segment(2));?> details</legend>
											
											<div class="form-group">
                                            <input type="hidden" class="form-control" placeholder="Retailer Id"  id="hideid" name="hideid" >
												<label class="col-lg-3 control-label">Name of the Retailer:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Name of the Retailer" name="retailer_name" id="retailer_name" onkeyup="ajaxSearch()" value="<?=set_value('retailer_name');?>">
                                                    <span class="text-danger"><?=form_error('retailer_name');?></span>
                                                    <div id="suggestions">
                                    				<div id="autoSuggestionsList">
                                    				</div>	
                                					</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 control-label">Company/Firm Reg. No.</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Company/Firm Reg. No." name="reg_no" id="reg_no" value="<?=set_value('reg_no');?>">
                                                    <span class="text-danger"><?=form_error('reg_no');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">GSTIN No.</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="GSTIN" name="GSTIN" id="GSTIN" value="<?=set_value('GSTIN');?>">
                                                    <span class="text-danger"><?=form_error('GSTIN');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">PAN No.</label>
												<div class="col-lg-9">
													<input type="text" placeholder="PAN" class="form-control" name="pan_no" id="pan_no" value="<?=set_value('pan_no');?>">
                                                    <span class="text-danger"><?=form_error('pan_no');?></span>
												</div>
											</div>
                                             
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Contact Person Name</label>
												<div class="col-lg-9">
													<input type="text" placeholder="Contact person name" class="form-control" id="Contact_person_name" name="Contact_person_name" value="<?=set_value('Contact_person_name');?>">
                                                    <span class="text-danger"><?=form_error('Contact_person_name');?></span>
												</div>
											</div>
												<div class="form-group">
												<label class="col-lg-3 control-label">Contact Person Mobile</label>
												<div class="col-lg-9">
													<input type="text" placeholder="+91-99-9999-9999" class="form-control" id="Contact_person_mobile" name="Contact_person_mobile" value="<?=set_value('Contact_person_mobile');?>">
                                                    <span class="text-danger"><?=form_error('Contact_person_mobile');?></span>
												</div>
											</div>
											
											
										
                                        
										</fieldset>
									</div>

									<div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="icon-truck position-left"></i> Shipping details</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">Address:</label>
												<div class="col-lg-9">
													<textarea rows="5" cols="5" class="form-control" placeholder="Street Address" id="address" name="address"><?=set_value('address');?></textarea>
												</div>
                                                <span class="text-danger"><?=form_error('address');?></span>
											</div>
                                           

											<div class="form-group">
												<label class="col-lg-3 control-label">Country:</label>
												<div class="col-lg-9">
													<select class="form-control" name="country_id" id="country_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($countrieslist as $c){ ?>
                                                    <option value="<?=$c['country_id'];?>" ><?=$c['country_name'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('country_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">State:</label>
												<div class="col-lg-9">
													<select class="form-control" name="state_id" id="state_id">
                                                    </select>
                                                    <span class="text-danger"><?=form_error('state_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">City:</label>
												<div class="col-lg-9">
													<select class="form-control" name="city_id" id="city_id">
                                                   
                                                    
                                                    </select>
                                                    <span class="text-danger"><?=form_error('city_id');?></span>
												</div>
											</div>
                                           <div class="form-group">
												<label class="col-lg-3 control-label">PIN Code:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="000000" class="form-control" id="zip_code" name="zip_code" <?=set_value('zip_code');?>>
                                                    <span class="text-danger"><?=form_error('zip_code');?></span>
												</div>
											</div>
                                            
                                            
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Status:</label>
												<div class="col-lg-9">
													<select class="form-control" name="status" id="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('status');?></span>
												</div>
											</div>
										</fieldset>
									</div>
								</div>

								 <div class="text-right">
									<input type="submit" class="btn btn-primary" name="submit" value="Submit" id="bt">
								</div>
							</div>
						</div>

<?=form_close();?>
<script>
            function thirdDisable()
			{
				
					
					var pro=document.getElementById("third").disabled;
					if(pro==false)
					{
						document.getElementById("third").disabled=true;
					}else
					{
						document.getElementById("third").disabled=false;
					}
				
			}
			function twoDisable()
			{
				
				var pro1=document.getElementById("first").disabled;
				var pro2=document.getElementById("second").disabled;
				if(pro1==false && pro2==false)
				{
					document.getElementById("first").disabled=true;
					document.getElementById("second").disabled=true;
				}else
				{
					document.getElementById("first").disabled=false;
					document.getElementById("second").disabled=false;
				}
			}
	function getDetail(getId)
		{	
				$('#suggestions').hide();
				$('#hideid').val(getId);
		   		if(getId){
						$.ajax({
							type:'POST',
							url:'<?php echo base_url('secure/retailer/getRetailerAllData');?>',
							data:'getId='+getId,
							dataType: 'json',
							success:function(data){
								
								  if(data.msg != 'ADD'){
								  $('#retailer_name').val(data.retailer_name);
								  $('#reg_no').val(data.reg_no);
								  $('#GSTIN').val(data.GSTIN);
								  $('#Contact_person_name').val(data.Contact_person_name);
								  $('#Contact_person_mobile').val(data.Contact_person_mobile);
								  $('#address').val(data.address);
								  $('#zip_code').val(data.zip_code);
								  $('#pan_no').val(data.pan_no);
								  $('#hsn_sac_no').val(data.hsn_sac_no);
								  $('#bt').val('Update');
								  $("#country_id option").each(function()
								  {
									if($(this).val() == data.country_id){
									$('#country_id option').prop('selected', true);}
								 });
								  $('#city_id').html('<option value='+data.city_id+'>'+data.city_name+'</option>');
								  $('#state_id').html('<option value='+data.state_id+'>'+data.state_name+'</option>');
								 var gstData = JSON.parse("[" + data.gst + "]");
								  if(gstData.length == 1){
								      if(gstData[0] == 1){
											document.getElementById("first").checked  = true;
											document.getElementById("third").disabled=true;
									  }
									   if(gstData[0] == 2){
											document.getElementById("second").checked  = true;
											document.getElementById("third").disabled=true;
									   }
									   
									  if(gstData[0] == 3){
										  		document.getElementById("first").disabled=true;
												document.getElementById("second").disabled=true;
												document.getElementById("third").checked  = true;	
										   }
								  }
								  if(gstData.length == 2){
								      if(gstData[0] == 1){
											document.getElementById("first").checked  = true;
											document.getElementById("third").disabled=true;
									  }
									   if(gstData[1] == 2){
											document.getElementById("second").checked  = true;
											document.getElementById("third").disabled=true;
									   }
									   
									  
								  }
								  
									  
									  
								  
								  }
								
								  
							}
							
						}); 
        		}
		}
		function ajaxSearch()
        {
                var input_data = $('#retailer_name').val();

                if (input_data.length === 0)
                {
                    $('#suggestions').hide();
					document.getElementById("retailerform").reset();
					
                }
                else
                {

                    var post_data = {
                        'retailer_name': input_data
                    };

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url('secure/retailer/getRetailerSearch');?>',
                        data: post_data,
                        success: function (data) {
                            // return success
                            if (data.length > 0) {
                                $('#suggestions').show();
                                $('#autoSuggestionsList').addClass('auto_list');
                                $('#autoSuggestionsList').html(data);
                            }else{
									$('#suggestions').hide();
									document.getElementById("retailerform").reset();
								 }
                        }
                    });

                }
      }	
      </script>

</div>
