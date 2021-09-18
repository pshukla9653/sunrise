<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                            <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - 
                            <a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Part</a></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Part</a></li>
						</ul>

						
					</div>
				</div>
				<!-- /page header -->
<!-- Content area -->
				<div class="content">

					<!-- Horizontal form options -->
					<div class="row">
<div class="panel panel-flat col-md-6">
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
                            <?php echo form_open_multipart('secure/product/addproductPart', array('class'=>'form-horizontal')); ?>
                               <?php echo $this->session->flashdata('msg'); ?>    
								<div class="row">
							<div class="col-md-12">
							<fieldset>
							<legend class="text-semibold"> Add <?=ucfirst($this->uri->segment(2));?> Part </legend>
                                                    
                                           
							<div class="form-group">
                                <label class="col-lg-3 control-label">Product Part Name</label>
								<div class="col-lg-9">
                                <input type="text"  class="form-control" name="part_name" placeholder="Product Part Name" value="<?php echo set_value('part_name'); ?>" >
                                <span class="text-danger"><?php echo form_error('part_name'); ?></span>
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
                                <input type="text"  class="form-control" name="hsn_code" placeholder="HSN Code" value="<?php echo set_value('hsn_code'); ?>" >
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
                               
                                     <div class="text-right col-lg-12">
									<input type="submit" class="btn btn-primary" name="btn" value="Submit" id="bt">
								</div>
                                <?php echo form_close(); ?>
								</div>

								
							</div>
						</div>

</div>

</div>							
   
                                