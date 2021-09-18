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
					<div class="row">
<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
                            <?php echo form_open_multipart('secure/product/add', array('class'=>'form-horizontal')); ?>
                               <?php echo $this->session->flashdata('msg'); ?>    
								<div class="row">
							<div class="col-md-4">
							<fieldset>
							<legend class="text-semibold"> Add <?=ucfirst($this->uri->segment(2));?></legend>
                                                    
                                           
							<div class="form-group">
                                <label class="col-lg-3 control-label">Product Name</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="product_name" placeholder="Product Name" value="<?php echo set_value('product_name'); ?>" >
                                <span class="text-danger"><?php echo form_error('product_name'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Purchase Price</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="purchage_price" placeholder="Amount" value="<?php echo set_value('purchage_price'); ?>" >
                                <span class="text-danger"><?php echo form_error('purchage_price'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Sell Price</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="sell_price" placeholder="Amount" value="<?php echo set_value('sell_price'); ?>" >
                                <span class="text-danger"><?php echo form_error('sell_price'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Retailer Price</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="retailer_price" placeholder="Amount" value="<?php echo set_value('retailer_price'); ?>" >
                                <span class="text-danger"><?php echo form_error('retailer_price'); ?></span>
								</div>
                            </div>
                             <div class="form-group">
                                <label class="col-lg-3 control-label">HSN Code</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="hsn_code" placeholder="HSN Code" value="8421" >
                                <span class="text-danger"><?php echo form_error('hsn_code'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Stock Unit</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="stock_unit" placeholder="Stock Unit" value="<?php echo set_value('stock_unit'); ?>" >
                                <span class="text-danger"><?php echo form_error('stock_unit'); ?></span>
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
                            <div class="col-md-4">
							<fieldset>
							<legend class="text-semibold"> AMC details</legend>
                                                    
                             <div class="form-group">
							<label class="col-lg-3 control-label">AMC Duration:</label>
							<div class="col-lg-9">
							<select class="form-control" id="amc_duration" name="amc_duration">
                            <option value="">Select</option>
                             <option value="1">1 Year</option>
                             <option value="2">2 Year</option>
                             <option value="3">3 Year</option>
                             <option value="4">4 Year</option>
                             <option value="5">5 Year</option>
                             <option value="6">6 Year</option>
                             <option value="7">7 Year</option>
                              </select>
                               
							</div>
							</div> 
                            <div id="amsection">             
							
                           </div>
                            <div class="form-group">
							<label class="col-lg-3 control-label">Mandatory Servies:</label>
							<div class="col-lg-9">
							<select class="form-control" name="mandtory_service">
                             <option value="4">4 Months</option>
                             <option value="6">6 Months</option>
                              </select>
                               <span class="text-danger"><?=form_error('mandtory_service');?></span>
							</div>
							</div>
                            
                           
                            
                           
										</fieldset>
									</div>
                            <div class="col-md-4">
							<fieldset>
							<legend class="text-semibold"> Service Details</legend>
                                                    
                             <?php foreach($servicelist as $s):?>              
							<div class="form-group">
                                <label class="col-lg-3 control-label"><?=$s['service_name'];?></label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="service[<?=$s['id'];?>]" placeholder="Amount" value="<?php echo set_value('service['.$s['id'].']'); ?>" >
                                <span class="text-danger"><?php echo form_error('service['.$s['id'].']'); ?></span>
								</div>
                            </div>
                            <?php endforeach;?>
										</fieldset>
									</div>                
                                 
                                     <div class="text-right col-lg-12">
									<input type="submit" class="btn btn-primary" name="btn" value="Submit" id="bt">
								</div>
                                <?php echo form_close(); ?>
								</div>

								
							</div>
						</div>

</div>

</div>							
   <script>
   $(document).ready(function() {
    $('#amc_duration').on('change',function(){
		
        var amc_duration = $(this).val();
        if(amc_duration){
			$('#amsection').html('');
			for(var i = 1; i <= amc_duration; i++){
				
					$('#amsection').append('<div class="form-group"><label class="col-lg-3 control-label">'+i+' Year</label><div class="col-lg-9"><input type="text"  class="form-control" name="amc['+i+']" placeholder="Amount" value=""/></div></div>');
			
			}
			console.log(form_data_f);
			$('#amsection').html()
            
        }else{
            $('#amsection').html(''); 
        }
    });
   });
   </script>
                                