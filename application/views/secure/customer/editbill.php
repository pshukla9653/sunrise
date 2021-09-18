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
					<div class="panel panel-flat col-md-4">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
                                     
										<fieldset>
						                	<legend class="text-semibold">Customer Details</legend>
                                            
											<table class="table">
                      						<tbody>
                                            <tr><th>Customer Name : </th> <td><?=$customer['customer_name'];?></td></tr>
                                            <tr><th>Mobile Number : </th> <td><?=$customer['mobile'];?></td></tr>
                                            <tr><th>GSTIN : </th> <td><?=$customer['GSTIN'];?></td></tr>
                                            <tr><th>Address : </th> <td><?=$customer['address'];?>, <?=$customer['city_name'];?>, <?=$customer['state_name'];?>, <?=$customer['country_name'];?>-<?=$customer['zip_code'];?></td></tr>
                                            </tbody>
                                        
                    						</table>
										</fieldset>
									</div>
                                    <br><br>
                                    <div class="col-md-12">
                                    <fieldset>
						                	<legend class="text-semibold">Product Details</legend>
                                     <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Product List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['product_id']==$p['id']?'selected':'';?>><?=$p['product_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Service List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php  foreach($serviceList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['service_id']==$p['id']?'selected':'';?>><?=$p['service_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
                                            <button id="addproduct" onClick="add_product()">Add Product</button>
                                            </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                    <?=form_open_multipart('secure/loader/finalbill', array('class'=>'form-horizontal'));?>
										<fieldset>
						                	<legend class="text-semibold">Generate Bill</legend>
                                            <input type="hidden" id="changed_line" value=""/>
											<table class="table">
                      <thead>
                      <th>Sr.No.</th>
                      <th>Product Name</th>
                      <th>Service Name</th>
                      <th>Mode</th>
                      <th>Total Price</th>
                      
                    
                      
                      </thead>
                                        <tbody>
                                    <?php for($r=0; $r < count($manifestlist); $r++) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $r + 1; ?>
                                        <td><?php echo $manifestlist[$r]['id']; ?>
                                        <input type="hidden" id="id_<?=$r;?>" name="manifestId[]" value="<?php echo $manifestlist[$r]['id']; ?>"/>
                                        </td>
                                        <td><?php echo $manifestlist[$r]['agent_name']; ?></td>
                                        <td><?php echo $manifestlist[$r]['mode_name']; ?></td>
                                        
                                        
                                        
                                        <td><input type="text" id="total_docket_price_<?=$r;?>" name="total_docket_price[]" onChange="getonerowtotal(<?=$r;?>)" value="<?=$manifestlist[$r]['total_docket_price'];?>" style="width:50px !important;"/></td>

                                       
										
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                 <th>TOTAL</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_weights" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_prices" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      
                     
                      </tfoot>
                    </table>
										</fieldset>
									</div>
                                    
                                    <div class="col-md-12">
                                    <?php
									
									
									
									
									 ?>
                                     <div class="col-md-6">
                                     
                                    </div>
                                    <div class="col-md-6 form-horizontal">
                                   
                                    
                                    
                                    		
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Bill Date</label>
                                            <div class="col-lg-6">
                                            <input type="date" class="form-control" name="bill_date" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('bill_date');?></span>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Amount for Bill</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="amountforbilling" name="amountforbilling" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            
                                            <?php if($clientdata['gst'] !=''){?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Taxable Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="TotalTaxableamount" name="TotalTaxableamount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php } $selectedGST = explode(',', $clientdata['gst']);
											
												for($t=0; $t < count($selectedGST); $t++){?>
											<?php if($selectedGST[$t] == '1'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">CGST (<?=$gst['cgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="cgst" name="cgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '2'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">SGST (<?=$gst['sgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="sgst" name="sgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '3'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">IGST (<?=$gst['igst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="igst" name="igst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php }?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Billing Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="total_billing_amount" name="total_billing_amount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Submit"/>
                                            </div>
                                            </div>
                                            <?=form_close();?>
                                    </div>
                                    </div>
								</div>

								
							</div>
						</div>
                        
                     <div class="panel panel-flat col-md-4">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
                                     
										<fieldset>
						                	<legend class="text-semibold">Customer Details</legend>
                                            
											<table class="table">
                      						<tbody>
                                            <tr><th>Customer Name : </th> <td><?=$customer['customer_name'];?></td></tr>
                                            <tr><th>Mobile Number : </th> <td><?=$customer['mobile'];?></td></tr>
                                            <tr><th>GSTIN : </th> <td><?=$customer['GSTIN'];?></td></tr>
                                            <tr><th>Address : </th> <td><?=$customer['address'];?>, <?=$customer['city_name'];?>, <?=$customer['state_name'];?>, <?=$customer['country_name'];?>-<?=$customer['zip_code'];?></td></tr>
                                            </tbody>
                                        
                    						</table>
										</fieldset>
									</div>
                                    <br><br>
                                    <div class="col-md-12">
                                    <fieldset>
						                	<legend class="text-semibold">Product Details</legend>
                                     <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Product List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['product_id']==$p['id']?'selected':'';?>><?=$p['product_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Service List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php  foreach($serviceList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['service_id']==$p['id']?'selected':'';?>><?=$p['service_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
                                            <button id="addproduct" onClick="add_product()">Add Product</button>
                                            </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                    <?=form_open_multipart('secure/loader/finalbill', array('class'=>'form-horizontal'));?>
										<fieldset>
						                	<legend class="text-semibold">Generate Bill</legend>
                                            <input type="hidden" id="changed_line" value=""/>
											<table class="table">
                      <thead>
                      <th>Sr.No.</th>
                      <th>Product Name</th>
                      <th>Service Name</th>
                      <th>Mode</th>
                      <th>Total Price</th>
                      
                    
                      
                      </thead>
                                        <tbody>
                                    <?php for($r=0; $r < count($manifestlist); $r++) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $r + 1; ?>
                                        <td><?php echo $manifestlist[$r]['id']; ?>
                                        <input type="hidden" id="id_<?=$r;?>" name="manifestId[]" value="<?php echo $manifestlist[$r]['id']; ?>"/>
                                        </td>
                                        <td><?php echo $manifestlist[$r]['agent_name']; ?></td>
                                        <td><?php echo $manifestlist[$r]['mode_name']; ?></td>
                                        
                                        
                                        
                                        <td><input type="text" id="total_docket_price_<?=$r;?>" name="total_docket_price[]" onChange="getonerowtotal(<?=$r;?>)" value="<?=$manifestlist[$r]['total_docket_price'];?>" style="width:50px !important;"/></td>

                                       
										
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                 <th>TOTAL</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_weights" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_prices" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      
                     
                      </tfoot>
                    </table>
										</fieldset>
									</div>
                                    
                                    <div class="col-md-12">
                                    <?php
									
									
									
									
									 ?>
                                     <div class="col-md-6">
                                     
                                    </div>
                                    <div class="col-md-6 form-horizontal">
                                   
                                    
                                    
                                    		
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Bill Date</label>
                                            <div class="col-lg-6">
                                            <input type="date" class="form-control" name="bill_date" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('bill_date');?></span>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Amount for Bill</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="amountforbilling" name="amountforbilling" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            
                                            <?php if($clientdata['gst'] !=''){?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Taxable Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="TotalTaxableamount" name="TotalTaxableamount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php } $selectedGST = explode(',', $clientdata['gst']);
											
												for($t=0; $t < count($selectedGST); $t++){?>
											<?php if($selectedGST[$t] == '1'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">CGST (<?=$gst['cgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="cgst" name="cgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '2'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">SGST (<?=$gst['sgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="sgst" name="sgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '3'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">IGST (<?=$gst['igst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="igst" name="igst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php }?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Billing Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="total_billing_amount" name="total_billing_amount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Submit"/>
                                            </div>
                                            </div>
                                            <?=form_close();?>
                                    </div>
                                    </div>
								</div>

								
							</div>
						</div>
                        
                     <div class="panel panel-flat col-md-4">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
                                     
										<fieldset>
						                	<legend class="text-semibold">Customer Details</legend>
                                            
											<table class="table">
                      						<tbody>
                                            <tr><th>Customer Name : </th> <td><?=$customer['customer_name'];?></td></tr>
                                            <tr><th>Mobile Number : </th> <td><?=$customer['mobile'];?></td></tr>
                                            <tr><th>GSTIN : </th> <td><?=$customer['GSTIN'];?></td></tr>
                                            <tr><th>Address : </th> <td><?=$customer['address'];?>, <?=$customer['city_name'];?>, <?=$customer['state_name'];?>, <?=$customer['country_name'];?>-<?=$customer['zip_code'];?></td></tr>
                                            </tbody>
                                        
                    						</table>
										</fieldset>
									</div>
                                    <br><br>
                                    <div class="col-md-12">
                                    <fieldset>
						                	<legend class="text-semibold">Product Details</legend>
                                     <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Product List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['product_id']==$p['id']?'selected':'';?>><?=$p['product_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Service List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php  foreach($serviceList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['service_id']==$p['id']?'selected':'';?>><?=$p['service_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
                                            <button id="addproduct" onClick="add_product()">Add Product</button>
                                            </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                    <?=form_open_multipart('secure/loader/finalbill', array('class'=>'form-horizontal'));?>
										<fieldset>
						                	<legend class="text-semibold">Generate Bill</legend>
                                            <input type="hidden" id="changed_line" value=""/>
											<table class="table">
                      <thead>
                      <th>Sr.No.</th>
                      <th>Product Name</th>
                      <th>Service Name</th>
                      <th>Mode</th>
                      <th>Total Price</th>
                      
                    
                      
                      </thead>
                                        <tbody>
                                    <?php for($r=0; $r < count($manifestlist); $r++) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $r + 1; ?>
                                        <td><?php echo $manifestlist[$r]['id']; ?>
                                        <input type="hidden" id="id_<?=$r;?>" name="manifestId[]" value="<?php echo $manifestlist[$r]['id']; ?>"/>
                                        </td>
                                        <td><?php echo $manifestlist[$r]['agent_name']; ?></td>
                                        <td><?php echo $manifestlist[$r]['mode_name']; ?></td>
                                        
                                        
                                        
                                        <td><input type="text" id="total_docket_price_<?=$r;?>" name="total_docket_price[]" onChange="getonerowtotal(<?=$r;?>)" value="<?=$manifestlist[$r]['total_docket_price'];?>" style="width:50px !important;"/></td>

                                       
										
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                 <th>TOTAL</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_weights" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_prices" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      
                     
                      </tfoot>
                    </table>
										</fieldset>
									</div>
                                    
                                    <div class="col-md-12">
                                    <?php
									
									
									
									
									 ?>
                                     <div class="col-md-6">
                                     
                                    </div>
                                    <div class="col-md-6 form-horizontal">
                                   
                                    
                                    
                                    		
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Bill Date</label>
                                            <div class="col-lg-6">
                                            <input type="date" class="form-control" name="bill_date" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('bill_date');?></span>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Amount for Bill</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="amountforbilling" name="amountforbilling" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            
                                            <?php if($clientdata['gst'] !=''){?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Taxable Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="TotalTaxableamount" name="TotalTaxableamount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php } $selectedGST = explode(',', $clientdata['gst']);
											
												for($t=0; $t < count($selectedGST); $t++){?>
											<?php if($selectedGST[$t] == '1'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">CGST (<?=$gst['cgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="cgst" name="cgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '2'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">SGST (<?=$gst['sgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="sgst" name="sgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '3'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">IGST (<?=$gst['igst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="igst" name="igst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php }?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Billing Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="total_billing_amount" name="total_billing_amount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Submit"/>
                                            </div>
                                            </div>
                                            <?=form_close();?>
                                    </div>
                                    </div>
								</div>

								
							</div>
						</div>
                        
                      <div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title"></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
                                     
										<fieldset>
						                	<legend class="text-semibold">Customer Details</legend>
                                            
											<table class="table">
                      						<tbody>
                                            <tr><th>Customer Name : </th> <td><?=$customer['customer_name'];?></td></tr>
                                            <tr><th>Mobile Number : </th> <td><?=$customer['mobile'];?></td></tr>
                                            <tr><th>GSTIN : </th> <td><?=$customer['GSTIN'];?></td></tr>
                                            <tr><th>Address : </th> <td><?=$customer['address'];?>, <?=$customer['city_name'];?>, <?=$customer['state_name'];?>, <?=$customer['country_name'];?>-<?=$customer['zip_code'];?></td></tr>
                                            </tbody>
                                        
                    						</table>
										</fieldset>
									</div>
                                    <br><br>
                                    <div class="col-md-12">
                                    <fieldset>
						                	<legend class="text-semibold">Product Details</legend>
                                     <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Product List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['product_id']==$p['id']?'selected':'';?>><?=$p['product_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            <div class="form-group col-md-4">
												<label class="col-lg-3 control-label">Service List:</label>
												<div class="col-lg-9">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    
                                                    <?php  foreach($serviceList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['service_id']==$p['id']?'selected':'';?>><?=$p['service_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
                                            <button id="addproduct" onClick="add_product()">Add Product</button>
                                            </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                    <?=form_open_multipart('secure/loader/finalbill', array('class'=>'form-horizontal'));?>
										<fieldset>
						                	<legend class="text-semibold">Generate Bill</legend>
                                            <input type="hidden" id="changed_line" value=""/>
											<table class="table">
                      <thead>
                      <th>Sr.No.</th>
                      <th>Product Name</th>
                      <th>Service Name</th>
                      <th>Mode</th>
                      <th>Total Price</th>
                      
                    
                      
                      </thead>
                                        <tbody>
                                    <?php for($r=0; $r < count($manifestlist); $r++) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $r + 1; ?>
                                        <td><?php echo $manifestlist[$r]['id']; ?>
                                        <input type="hidden" id="id_<?=$r;?>" name="manifestId[]" value="<?php echo $manifestlist[$r]['id']; ?>"/>
                                        </td>
                                        <td><?php echo $manifestlist[$r]['agent_name']; ?></td>
                                        <td><?php echo $manifestlist[$r]['mode_name']; ?></td>
                                        
                                        
                                        
                                        <td><input type="text" id="total_docket_price_<?=$r;?>" name="total_docket_price[]" onChange="getonerowtotal(<?=$r;?>)" value="<?=$manifestlist[$r]['total_docket_price'];?>" style="width:50px !important;"/></td>

                                       
										
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                 <th>TOTAL</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                 <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_weights" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="total_prices" style="width:50px !important; background-color:#BBBABA;" readonly/></th>
                      
                     
                      </tfoot>
                    </table>
										</fieldset>
									</div>
                                    
                                    <div class="col-md-12">
                                    <?php
									
									
									
									
									 ?>
                                     <div class="col-md-6">
                                     
                                    </div>
                                    <div class="col-md-6 form-horizontal">
                                   
                                    
                                    
                                    		
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Bill Date</label>
                                            <div class="col-lg-6">
                                            <input type="date" class="form-control" name="bill_date" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('bill_date');?></span>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Amount for Bill</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="amountforbilling" name="amountforbilling" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            
                                            <?php if($clientdata['gst'] !=''){?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Taxable Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="TotalTaxableamount" name="TotalTaxableamount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php } $selectedGST = explode(',', $clientdata['gst']);
											
												for($t=0; $t < count($selectedGST); $t++){?>
											<?php if($selectedGST[$t] == '1'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">CGST (<?=$gst['cgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="cgst" name="cgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '2'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">SGST (<?=$gst['sgst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="sgst" name="sgst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php if($selectedGST[$t] == '3'){?>
                                             <div class="form-group">
                                            <label class="col-lg-6 control-label">IGST (<?=$gst['igst'];?>%)</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="igst" name="igst" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <?php }?>
                                            <?php }?>
                                            <div class="form-group">
                                            <label class="col-lg-6 control-label">Total Billing Amount</label>
                                            <div class="col-lg-6">
                                            <input type="text" id="total_billing_amount" name="total_billing_amount" class="form-control" style="background-color:#BBBABA;" readonly>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="submit" class="btn btn-success" value="Submit"/>
                                            </div>
                                            </div>
                                            <?=form_close();?>
                                    </div>
                                    </div>
								</div>

								
							</div>
						</div>        

</div>

</div>
<script type="text/javascript"> 
$(document).ready(function (){
	getGrandTotal();
	
});		
		
function add_product(){
	var product_id = $('#product_id').val();
	var service_id = $('#service_id').val();
	if(product_id ==''){
		new PNotify({title: 'Warning!',text: 'Select Product Before Add',icon: 'icon-warning',addclass: 'bg-warning'});
	}
	if(service_id ==''){
		new PNotify({title: 'Warning!',text: 'Select Service Before Add',icon: 'icon-warning',addclass: 'bg-warning'});
	}
	
}
		
function getonerowtotal(getId){
	//console.log($(this).get());
				 updaterecord(getId);
				 getGrandTotal();
				
}

let getGrandTotal =	function(){
	let total_qty_value = 0;
	//agent_docket_weight
	$('#total_weights').val(0);
	$("table tbody").find('input[name="total_weight[]"]').each(function(){
		if($(this).val() == ''){ total_qty_value = total_qty_value + 0; };
		total_qty_value = total_qty_value + parseFloat($(this).val());
	});
	$('#total_weights').val(total_qty_value);
	$('#weightforbilling').val(total_qty_value);
	
	//agent_total_docket_price
	total_qty_value = 0;
	$('#total_prices').val(0);
	$("table tbody").find('input[name="total_docket_price[]"]').each(function(){
		if($(this).val() == ''){ total_qty_value = total_qty_value + 0; };
		total_qty_value = total_qty_value + parseInt($(this).val());
	});
	$('#total_prices').val(total_qty_value);
	
	
	//GST 
	
	var cgst =0;
	var sgst =0;
	var igst =0;
	$('#amountforbilling').val(total_qty_value);
	
	var totaltaxableamount = parseInt(total_qty_value);
	$('#TotalTaxableamount').val(totaltaxableamount);
	var isgst = '<?=$clientdata['gst'];?>';
	if(isgst !=''){
	<?php for($t=0; $t < count($selectedGST); $t++){?>
	<?php if($selectedGST[$t] == '1'){?>
      			cgst = totaltaxableamount * parseFloat(<?=$gst['cgst'];?>) / 100;
				$('#cgst').val(cgst);
     <?php }?>
	 <?php if($selectedGST[$t] == '2'){?>
      			sgst = totaltaxableamount * parseFloat(<?=$gst['sgst'];?>) / 100;
				$('#sgst').val(sgst);
     <?php }?>
	 <?php if($selectedGST[$t] == '3'){?>
      			igst = totaltaxableamount * parseFloat(<?=$gst['igst'];?>) / 100;
				$('#igst').val(igst);
     <?php }?>
      <?php }?>
	}
	  
	   total_billing_amount =    parseFloat(totaltaxableamount) + parseFloat(cgst) +  parseFloat(sgst)+ parseFloat(igst);
	   ///alert(total_billing_amount);                                 
      $('#total_billing_amount').val(parseInt(total_billing_amount));                                      
}

function updaterecord(getId){
								var finalData 	=   new Object();
							   finalData 	= {
								   'id'							:	$('#id_'+getId).val(),
								   'total_weight'					:	$('#total_weight_'+getId).val(),
								   'total_docket_price'				:	$('#total_docket_price_'+getId).val(),
							   }
							   console.log(finalData);
							   $.ajax({
									type:'POST',
									url:'<?php echo base_url('secure/loader/updateawbcode');?>',
									data :'finalData='+JSON.stringify(finalData),
									dataType:'JSON',
									success:function(response){
										console.log(response);
										if(response.success == true){
										
										new PNotify({title: 'Successfull',text: response.errormsg,icon: 'icon-checkmark3',addclass: 'bg-success'});
										$('#changed_line').val('');
										}
										else if(response.success == false){
										new PNotify({title: 'Warning!',text: response.errormsg,icon: 'icon-warning',addclass: 'bg-warning'});
										}
									}
							   });
		}


		
</script>