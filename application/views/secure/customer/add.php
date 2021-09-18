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
				
<?=form_open_multipart('secure/customer/add', array('class'=>'form-horizontal','id'=>'customerform')); ?>
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
												<label class="col-lg-3 control-label">Product:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php foreach($Productlist as $s):?>
                                                    <option value="<?=$s['id'];?>"><?=$s['product_name'];?></option>
                                                    <?php endforeach;?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Service Type:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php foreach($servicelist as $s):?>
                                                    <option value="<?=$s['id'];?>"><?=$s['service_name'];?></option>
                                                    <?php endforeach;?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
											<div class="form-group">
                                            <input type="hidden" class="form-control" placeholder="Customer Id"  id="hideid" name="hideid" >
												<label class="col-lg-3 control-label">Name of the Customer:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Name of the Customer" name="customer_name" id="customer_name" onkeyup="ajaxSearch()" value="<?=set_value('customer_name');?>" autocomplete="off">
                                                    <span class="text-danger"><?=form_error('customer_name');?></span>
                                                    <div id="suggestions">
                                    				<div id="autoSuggestionsList">
                                    				</div>	
                                					</div>
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
												<label class="col-lg-3 control-label">Mobile</label>
												<div class="col-lg-9">
													<input type="number" placeholder="+91-99-9999-9999" class="form-control" id="mobile" name="mobile" value="<?=set_value('mobile');?>">
                                                    <span class="text-danger"><?=form_error('mobile');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Email</label>
												<div class="col-lg-9">
													<input type="text" placeholder="example@domain.com" class="form-control" id="mobile" name="email" value="<?=set_value('email');?>">
                                                    <span class="text-danger"><?=form_error('mobile');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Alternate Mobile</label>
												<div class="col-lg-9">
													<input type="text" placeholder="+91-99-9999-9999" class="form-control" id="alternate_mobile" name="alternate_mobile" value="<?=set_value('alternate_mobile');?>">
                                                    <span class="text-danger"><?=form_error('alternate_mobile');?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Landline Number</label>
												<div class="col-lg-9">
													<input type="text" placeholder="000-00000" class="form-control" name="landline_no" id="landline_no" value="<?=set_value('landline_no');?>">
                                                    <span class="text-danger"><?=form_error('landline_no');?></span>
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
							url:'<?php echo base_url('secure/customer/getCustomerAllData');?>',
							data:'getId='+getId,
							dataType: 'json',
							success:function(data){
								console.log(data)
								  if(data.msg != 'ADD'){
								  $('#customer_name').val(data.customer_name);
								  $('#GSTIN').val(data.GSTIN);
								  $('#mobile').val(data.mobile);
								  $('#email').val(data.email);
								  $('#address').val(data.address);
								  $('#zip_code').val(data.zip_code);
								  $('#landline_no').val(data.landline_no);
								  $('#alternate_mobile').val(data.alternate_mobile);
								  $('#bt').val('Update');
								  $("#country_id option").each(function()
								  {
									if($(this).val() == data.country_id){
									$('#country_id option').prop('selected', true);}
								 });
								  $('#city_id').html('<option value='+data.city_id+'>'+data.city_name+'</option>');
								  $('#state_id').html('<option value='+data.state_id+'>'+data.state_name+'</option>');
								 $("#status option").each(function()
								  {
									if($(this).val() == data.status){
									$('#status option').prop('selected', true);}
								 });
								 $("#service_id option").each(function()
								  {
									if($(this).val() == data.service_id){
									$('#service_id option').prop('selected', true);}
								 });
								  $("#product_id option").each(function()
								  {
									if($(this).val() == data.product_id){
									$('#product_id option').prop('selected', true);}
								 });
								  
									  
									  
								  
								  }
								
								  
							}
							
						}); 
        		}
		}
		function ajaxSearch()
        {
                var input_data = $('#customer_name').val();

                if (input_data.length === 0)
                {
                    $('#suggestions').hide();
					document.getElementById("customerform").reset();
					
                }
                else
                {

                    var post_data = {
                        'customer_name': input_data
                    };

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url('secure/customer/getCustomerSearch');?>',
                        data: post_data,
                        success: function (data) {
                            // return success
                            if (data.length > 0) {
                                $('#suggestions').show();
								$('#suggestions').css('height', '150px');
								$('#suggestions').css('overflow', 'scroll');
                                $('#autoSuggestionsList').addClass('auto_list');
                                $('#autoSuggestionsList').html(data);
                            }else{
									$('#suggestions').hide();
									document.getElementById("customerform").reset();
								 }
                        }
                    });

                }
      }	
      </script>

</div>
