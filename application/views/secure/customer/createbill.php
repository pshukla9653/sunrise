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
<div class="row">
<div class="col-lg-4">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Customer Details</h6>
									<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>	
									</div>
								</div>

								<div class="container-fluid">
									<div class="row">
										<table class="table">
                      						<tbody>
                                            <tr><th>Customer Name : </th> <td><?=$customer['customer_name'];?></td></tr>
                                            <tr><th>Mobile Number : </th> <td><?=$customer['mobile'];?></td></tr>
                                            <tr><th>GSTIN : </th> <td><?=$customer['GSTIN'];?></td></tr>
                                            <tr><th>Address : </th> <td><?=$customer['address'];?>, <?=$customer['city_name'];?>, <?=$customer['state_name'];?>, <?=$customer['country_name'];?>-<?=$customer['zip_code'];?></td></tr>
                                            </tbody>
                                        
                    						</table>
									</div>
								</div>

								
							</div>
							<!-- /traffic sources -->

						</div>	
                        
<div class="col-lg-4">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Product Details</h6>
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
                                <?php echo $this->session->flashdata('msg'); ?>
									<div class="row">
                                    <form class="form-horizontal" action="#">
                                    <fieldset class="content-group">
										<div class="form-group">
												<label class="col-lg-4 control-label">Product List:</label>
												<div class="col-lg-8">
													<select class="form-control select2" name="product_id" id="product_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['product_id']==$p['id']?'selected':'';?>><?=$p['product_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_id');?></span>
												</div>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-lg-4 control-label">Service List:</label>
												<div class="col-lg-8">
													<select class="form-control select2" name="service_id" id="service_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($serviceList as $p){?>
                                                    <option value="<?=$p['id'];?>" <?=$customer['service_id']==$p['id']?'selected':'';?>><?=$p['service_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('service_id');?></span>
												</div>
											</div>
                                            
                                             <div class="form-group" id="amcoption" style="display:<?=$amcyear[0]['id'] !=''?'display':'none';?>;">
												<label class="col-lg-4 control-label">AMC Duration:</label>
												<div class="col-lg-8">
													<select class="form-control select2" name="amc_duration" id="amc_duration">
                                                    <option value="">Select</option>
                                                    <?php  foreach($amcyear as $amc){?>
                                                    <option value="<?=$amc['id'];?>"><?=$amc['amc_duration'];?> Year</option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('amc_duration');?></span>
												</div>
											</div>
                                            
                                            
                                            </fieldset>
                                            </form>
                                            <div class="form-group">
												
												<div class="col-lg-8 text-right">
													<button onClick="addproduct()" class="btn btn-info">Add Product</button>
												</div>
											</div>
									</div>
								</div>

								
							</div>
							<!-- /traffic sources -->

						</div>	

<div class="col-lg-4">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Product Part Details</h6>
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
                                    <form class="form-horizontal" action="#">
                                    <fieldset class="content-group">
										<div class="form-group">
												<label class="col-lg-4 control-label">Product Part List:</label>
												<div class="col-lg-8">
													<select class="form-control select2" name="product_part_id" id="product_part_id">
                                                    <option value="">Select</option>
                                                    <?php  foreach($productPartList as $p){?>
                                                    <option value="<?=$p['id'];?>"><?=$p['part_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('product_part_id');?></span>
												</div>
											</div>
                                            
                                             
                                            </fieldset>
                                            </form>
                                            <div class="form-group">
												
												<div class="col-lg-8 text-right">
													<button onClick="addproductpart()" class="btn btn-info">Add Product Part</button>
												</div>
											</div>
									</div>
								</div>

								
							</div>
							<!-- /traffic sources -->

						</div>	 
                        
<div class="col-lg-12">

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Bill Details</h6>
									<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
                                        <li><a data-action="expand"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>	
									</div>
								</div>

								<div class="container-fluid">
                                <?=form_open_multipart('secure/customer/generatebill/'.$customer['id'], array('class'=>'form-horizontal'));?>
									<div class="row">
                                    <div class="col-lg-8">
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Invoice Date</label>
                                            <div class="col-lg-8">
                                            <input type="date" class="form-control" name="bill_date" id="bill_date" value="<?php echo date('Y-m-d');?>" />
											<span class='text-danger'><?=form_error('bill_date');?></span>
                                            <input type="hidden" id="newsrnuber" value="0"/>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                    <div class="row">    
										<table class="table">
                      					<thead>
                                        <tr>
                                        <th>Sr.</th>
                                        <th>Product Name</th>
                                        
                                        <th>Service Details</th>
                                        <th style="width:40% !important;">Address</th>
                                        <th style="width:15% !important;">Discount (Percentage)</th>
                                        <th style="width:15% !important;">Discount (Amount)</th>
                                       
                                        <th style="width:15% !important;">Amount (Before Discount)</th>
                                        <th style="width:15% !important;">Amount (After Discount)</th>
                                        <th>Action</th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody id="productdetails"></tbody>	
                                        <tfoot>
                                        <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        
                                        <th>&nbsp;</th>
                                        </tr>
                                         <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        
                                        
                                        <th>Sub Total (Before Discount):</th>
                                        <th><input type="text" name="sub_total" class="form-control" id="sub_total" value="0" readonly/></th>
                                        <th>&nbsp;</th>
                                        </tr>
                                        	<tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        
                                        
                                        <th>Total Discount:</th>
                                        <th><input type="text" name="total_discount" class="form-control" id="total_discount" value="0" readonly/></th>
                                        <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        
                                        
                                        <th>Final Sub Total (Before Tax):</th>
                                        <th><input type="text" name="final_sub_total" class="form-control" id="final_sub_total" value="0" readonly/></th>
                                        <th>&nbsp;</th>
                                        </tr>
                                        <tr>
                                        <th></th>
                                        
                                        <th colspan="2">
                                        GST : 
                                        <select class="form-control" id="gst" name="gst">
                                        <option value="">Select</option>
                                        <option value="1">SGST (<?=$gst['sgst'];?>%) &amp; CGST (<?=$gst['cgst'];?>%)</option>
                                        <option value="2">IGST (<?=$gst['igst'];?>%)</option>
                                        		</select>
                                         <input type="hidden" id="gst_per" name="gst_per" value=""/>       
                                        </th>
                                        
                                        
                                        
                                        <th> GST Type: 
                                        <select class="form-control" id="gst_type" name="gst_type">
                                        <option value="">Select</option>
                                        <option value="1">Inclusive</option>
                                        <option value="2">Exclusive</option>
                                        		</select></th>
                                        
                                       
                                         <th>SGST<input type="text" name="sgst_value" class="form-control" id="sgst_value" value="0" readonly/></th>
                                        
                                       <th>CGST<input type="text" name="cgst_value" class="form-control" id="cgst_value" value="0" readonly/></th>
                                        <th>IGST<input type="text" name="igst_value" class="form-control" id="igst_value" value="0" readonly/></th>
                                        <th>Total GST<input type="text" name="total_gst" class="form-control" id="total_gst" value="0" readonly/></th>
                                        <th></th>
                                        </tr>
                                        <tr>
                                        <th>&nbsp;</th>
                                        
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                         
                                        
                                        <th>Grand Total:</th>
                                        <th><input type="text" name="grand_total" class="form-control" id="grand_total" value="0" readonly/></th>
                                        <th>&nbsp;</th>
                                        </tr>
                                         <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                         
                                        
                                        <th></th>
                                        <th></th>
                                        </tr>
                                        </tfoot>
                    					</table>
									</div>
                                    <div style="text-align:right">
                                    <input type="submit"  value="Save Invoice" name="btn" class="btn btn-info"/>
                                    <input type="submit" value="Generate Invoice" name="btn" class="btn btn-success"/>
                                    <br><br>
                                    </div>
                                    <?=form_close();?>
								</div>

								
							</div>
							<!-- /traffic sources -->

						</div>     

</div>

</div>
<script type="application/javascript">
function addproduct(){
 var product_id = $('#product_id').val();
 var service_id = $('#service_id').val();
 var amc_duration = $('#amc_duration').val();
 if(product_id ==''){
	 new PNotify({title: 'Warning!',text: 'Please Select Product!',icon: 'icon-warning',addclass: 'bg-warning'});
 }
 else if(service_id ==''){
	 new PNotify({title: 'Warning!',text: 'Please Select Service!',icon: 'icon-warning',addclass: 'bg-warning'});
 }
 else if(service_id =='1'){
	 if(amc_duration ==''){
	 new PNotify({title: 'Warning!',text: 'Please Select AMC Duration for AMC Service!',icon: 'icon-warning',addclass: 'bg-warning'});
 	}
 }
	
	if (product_id !='' && service_id !=''){
		if(service_id == '1'){
			if(amc_duration !=''){
				var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add AMC Record! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getproductamcdetails');?>',
                data:'product_id='+product_id+'&amc_duration='+amc_duration+'&service_id='+service_id+'&bill_date='+bill_date,
				dataType:'JSON',
                success:function(data){
					if(data.successdata == true){
						console.log(data);
					var srnu = parseInt($('#newsrnuber').val());
					var newsrno = parseInt(srnu + 1);
					$('#newsrnuber').val(newsrno);
				  var html = '';
				  html += '<tr id="inputFormRow">';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][data]" value="Product" id="rowid_'+newsrno+'"/>'+newsrno+'</td>';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][amc_duration]" value="'+data.amc_duration+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_start_date]" value="'+data.amc_start_date+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_dates]" value="'+data.ms_dates+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_duration]" value="'+data.ms_duration+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_no]" value="'+data.ms_no+'"/><input type="hidden" name="rowdata['+newsrno+'][product_id]" value="'+data.product_id+'"/><input type="hidden" name="rowdata['+newsrno+'][service_id]" value="'+data.service_id+'"/>'+data.product_name+'</td>';
				 
				  html += '<td>'+data.service_name+'</td>';
				  html += '<td><textarea name="rowdata['+newsrno+'][address]"  class="form-control"></textarea></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discount_percent]" id="dis_percent_id_'+newsrno+'" onChange="discountpercentage('+newsrno+')" class="form-control" placeholder="Dis. Percent" value="0"/></td>';
				   html += '<td><input type="text" name="rowdata['+newsrno+'][discount_amount]" id="dis_amount_id_'+newsrno+'" onChange="discountaount('+newsrno+')" class="form-control" placeholder="Dis. Amount" value="0"/><input type="hidden" name="discount_amount[]" id="hidden_discount_amount_'+newsrno+'" value="0"/></td>';
				  
				 html += '<td><input type="text" name="rowdata['+newsrno+'][amount]" id="amount_'+newsrno+'" class="form-control" value="'+data.amount+'"  onChange="changeamcamount('+newsrno+')"/><input type="hidden" name="amount[]" id="hidden_amount_'+newsrno+'" value="'+data.amount+'"/></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discounted_amount]" id="discount_amount_'+newsrno+'" class="form-control" value="0" readonly/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				     
       
        
        $('#productdetails').append(html);
		
		$("#gst option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$('#sgst_value').val(0);
		$('#cgst_value').val(0);
		$('#igst_value').val(0);
		$('#total_gst').val(0);
		getGrandTotal();
						
						
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Invalid Error',icon: 'icon-close',addclass: 'bg-danger'});	
					}
                 
                }
				
            }); 
				new PNotify({title: 'Success!',text: 'Product Add Successfully',icon: 'icon-check',addclass: 'bg-success'});
				}
			}
		}
		
		else{
			$('#amcoption').hide();
			if(service_id == '3'){
			if(product_id !=''){
				var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add new Product! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getproductdetails');?>',
                data:'product_id='+product_id+'&service_id='+service_id+'&bill_date='+bill_date,
				dataType:'JSON',
                success:function(data){
					if(data.successdata == true){
						console.log(data);
					var srnu = parseInt($('#newsrnuber').val());
					var newsrno = parseInt(srnu + 1);
					$('#newsrnuber').val(newsrno);
				  var html = '';
				  html += '<tr id="inputFormRow">';
				 html += '<td><input type="hidden" name="rowdata['+newsrno+'][data]" value="Product" id="rowid_'+newsrno+'"/>'+newsrno+'</td>';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][amc_duration]" value="'+data.amc_duration+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_start_date]" value="'+data.amc_start_date+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_dates]" value="'+data.ms_dates+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_duration]" value="'+data.ms_duration+'"/><input type="hidden" name="rowdata['+newsrno+'][ms_no]" value="'+data.ms_no+'"/><input type="hidden" name="rowdata['+newsrno+'][product_id]" value="'+data.product_id+'"/><input type="hidden" name="rowdata['+newsrno+'][service_id]" value="'+data.service_id+'"/>'+data.product_name+'</td>';
				 
				  html += '<td>Sale</td>';
				  html += '<td><textarea name="rowdata['+newsrno+'][address]"  class="form-control"></textarea></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][discount_percent]" id="dis_percent_id_'+newsrno+'" onChange="discountpercentage('+newsrno+')" class="form-control" placeholder="Dis. Percent" value="0"/></td>';
				   html += '<td><input type="text" name="rowdata['+newsrno+'][discount_amount]" id="dis_amount_id_'+newsrno+'" onChange="discountaount('+newsrno+')" class="form-control" placeholder="Dis. Amount" value="0"/><input type="hidden" name="discount_amount[]" id="hidden_discount_amount_'+newsrno+'" value="0"/></td>';
				  
				 html += '<td><input type="text" name="rowdata['+newsrno+'][amount]" id="amount_'+newsrno+'" class="form-control" value="'+data.amount+'" onChange="changesaleamount('+newsrno+')"/><input type="hidden" name="amount[]" id="hidden_amount_'+newsrno+'" value="'+data.amount+'"/></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discounted_amount]" id="discount_amount_'+newsrno+'" class="form-control" value="0" readonly/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				 
       
        
        $('#productdetails').append(html);
		$("#gst option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$('#sgst_value').val(0);
		$('#cgst_value').val(0);
		$('#igst_value').val(0);
		$('#total_gst').val(0);
		$('#igst_value').val(0);
		getGrandTotal();
						
						
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Invalid Error',icon: 'icon-close',addclass: 'bg-danger'});		
					}
                 
                }
				
            }); 
				new PNotify({title: 'Success!',text: 'Product Add Successfully',icon: 'icon-check',addclass: 'bg-success'});
				}
			}
			
		}
			else{
				if(product_id !=''){
				var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add new Product! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getotherservicedetails');?>',
                data:'product_id='+product_id+'&service_id='+service_id+'&bill_date='+bill_date,
				dataType:'JSON',
                success:function(data){
					if(data.successdata == true){
						console.log(data);
					var srnu = parseInt($('#newsrnuber').val());
					var newsrno = parseInt(srnu + 1);
					$('#newsrnuber').val(newsrno);
				  var html = '';
				  html += '<tr id="inputFormRow">';
				 html += '<td><input type="hidden" name="rowdata['+newsrno+'][data]" value="Product" id="rowid_'+newsrno+'"/>'+newsrno+'</td>';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_end_date]" value="'+data.amc_end_date+'"/><input type="hidden" name="rowdata['+newsrno+'][amc_start_date]" value="'+data.amc_start_date+'"/><input type="hidden" name="rowdata['+newsrno+'][product_id]" value="'+data.product_id+'"/><input type="hidden" name="rowdata['+newsrno+'][service_id]" value="'+data.service_id+'"/>'+data.product_name+'</td>';
				 
				  html += '<td>'+data.service_name+'</td>';
				  html += '<td><textarea name="rowdata['+newsrno+'][address]"  class="form-control"></textarea></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][discount_percent]" id="dis_percent_id_'+newsrno+'" onChange="discountpercentage('+newsrno+')" class="form-control" placeholder="Dis. Percent" value="0"/></td>';
				    html += '<td><input type="text" name="rowdata['+newsrno+'][discount_amount]" id="dis_amount_id_'+newsrno+'" onChange="discountaount('+newsrno+')" class="form-control" placeholder="Dis. Amount" value="0"/><input type="hidden" name="discount_amount[]" id="hidden_discount_amount_'+newsrno+'" value="0"/></td>';
				  
				 html += '<td><input type="text" name="rowdata['+newsrno+'][amount]" id="amount_'+newsrno+'" class="form-control" value="'+data.amount+'" onChange="changeserviceamount('+newsrno+')"/><input type="hidden" name="amount[]" id="hidden_amount_'+newsrno+'" value="'+data.amount+'"/></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discounted_amount]" id="discount_amount_'+newsrno+'" class="form-control" value="0" readonly/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				 
       
        
        $('#productdetails').append(html);
		$("#gst option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$('#sgst_value').val(0);
		$('#cgst_value').val(0);
		$('#igst_value').val(0);
		$('#total_gst').val(0);
		getGrandTotal();
						
						
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Invalid Error',icon: 'icon-close',addclass: 'bg-danger'});		
					}
                 
                }
				
            }); 
				new PNotify({title: 'Success!',text: 'Product Add Successfully',icon: 'icon-check',addclass: 'bg-success'});
				}
			}
			}
			
		}
	}

}
$(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
		getGrandTotal();
    });


$( "#service_id" ).change(function() {
 var service_id = $( "#service_id" ).val();
 if(service_id == '1'){
	 var product_id = $('#product_id').val();
	 $('#amcoption').show();
	 if(product_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getproductamc');?>',
                data:'product_id='+product_id,
                success:function(html){
                  $('#amc_duration').html(html);
                }
				
            }); 
	 }
 }
 else{
	 $('#amcoption').hide();
 }
});
$( "#product_id" ).change(function() {
 var service_id = $( "#service_id" ).val();
 if(service_id == '1'){
	 var product_id = $('#product_id').val();
	 $('#amcoption').show();
	 if(product_id){
            $.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getproductamc');?>',
                data:'product_id='+product_id,
                success:function(html){
                  $('#amc_duration').html(html);
                }
				
            }); 
	 }
 }
 else{
	 $('#amcoption').hide();
 }
});
function addproductpart(){
		var product_part_id = $('#product_part_id').val();
		if(product_part_id !=''){
				var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add New Product Part! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/getproductpartdetail');?>',
                data:'product_part_id='+product_part_id+'&bill_date='+bill_date,
				dataType:'JSON',
                success:function(data){
					if(data.successdata == true){
						console.log(data);
					var srnu = parseInt($('#newsrnuber').val());
					var newsrno = parseInt(srnu + 1);
					$('#newsrnuber').val(newsrno);
				  var html = '';
				  html += '<tr id="inputFormRow">';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][data]" value="Part" id="rowid_'+newsrno+'"/>'+newsrno+'</td>';
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][product_id]" value="'+data.product_part_id+'"/>'+data.part_name+'</td>';
				 
				  html += '<td>New Part</td>';
				  html += '<td><textarea name="rowdata['+newsrno+'][address]"  class="form-control"></textarea></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discount_percent]" id="dis_percent_id_'+newsrno+'" onChange="discountpercentage('+newsrno+')" class="form-control" placeholder="Dis. Percent" value="0"/></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discount_amount]" id="dis_amount_id_'+newsrno+'" onChange="discountaount('+newsrno+')" class="form-control" placeholder="Dis. Amount" value="0"/><input type="hidden" name="discount_amount[]" id="hidden_discount_amount_'+newsrno+'" value="0"/></td>';
				  
				 html += '<td><input type="text" name="rowdata['+newsrno+'][amount]" id="amount_'+newsrno+'" class="form-control" value="'+data.amount+'" onChange="changepartamount('+newsrno+')"/><input type="hidden" name="amount[]" id="hidden_amount_'+newsrno+'" value="'+data.amount+'"/></td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][discounted_amount]" id="discount_amount_'+newsrno+'" class="form-control" value="0" readonly/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				 
       
        
        $('#productdetails').append(html);
		$("#gst option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() === 0){
		$(this).prop('selected', true);
		}	 
		});
		$('#sgst_value').val(0);
		$('#cgst_value').val(0);
		$('#igst_value').val(0);
		$('#total_gst').val(0);
		getGrandTotal();
						
						
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Invalid Error',icon: 'icon-close',addclass: 'bg-danger'});	
					}
                 
                }
				
            }); 
				new PNotify({title: 'Success!',text: 'Product Part Add Successfully',icon: 'icon-check',addclass: 'bg-success'});
				}
			}
			else{
				new PNotify({title: 'Warrning!',text: 'Select Product Part',icon: 'icon-close',addclass: 'bg-danger'});
			}
}



function discountpercentage(rowid){
		var discountpercent = $('#dis_percent_id_'+rowid).val();
		var discountamount = $('#dis_amount_id_'+rowid).val();
		var amount = $('#amount_'+rowid).val();
		var discount_amount = $('#discount_amount_'+rowid).val();
		
		if(parseFloat(discountpercent) < 51){
			
			var discount_amount = parseFloat(amount * discountpercent / 100);
			var finaldis = amount - discount_amount.toFixed(2);
			$('#dis_amount_id_'+rowid).val(discount_amount);
			$('#discount_amount_'+rowid).val(finaldis);
			$('#hidden_discount_amount_'+rowid).val(discount_amount);
			getGrandTotal();
		}
		else{
			new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		}
}
function discountaount(rowid){
		var discountpercent = $('#dis_percent_id_'+rowid).val();
		var discountamount = $('#dis_amount_id_'+rowid).val();
		var amount = $('#amount_'+rowid).val();
		var discount_amount = $('#discount_amount_'+rowid).val();
		
		var discount_amount = parseFloat(amount * 51 / 100);
		if(parseFloat(discountamount) < discount_amount){
			
			
			var finaldis = amount - discountamount;
				
			var discount_percentage = 100 - parseFloat(finaldis / amount * 100);
			discount_percentage = discount_percentage.toFixed(2);
			finaldis = finaldis.toFixed(2);
			$('#dis_percent_id_'+rowid).val(discount_percentage);
			$('#discount_amount_'+rowid).val(finaldis);
			$('#hidden_discount_amount_'+rowid).val(discountamount);
			getGrandTotal();
		}
		else{
			new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		}
}

$('#gst').on('change', function(){
	
	var gst = $('#gst').val();
	var gst_type = $('#gst_type').val();
	var amount = $('#final_sub_total').val();
	
	if(gst_type ==''){
		new PNotify({title: 'Warrning!',text: 'Please Select GST Type!',icon: 'icon-close',addclass: 'bg-danger'});
	}
	if(gst ==''){
		new PNotify({title: 'Warrning!',text: 'Please Select GST!',icon: 'icon-close',addclass: 'bg-danger'});
	}
	if(gst !='' && gst_type !=''){
		if(gst =='1'){
			var sgst = parseFloat('<?=$gst['sgst'];?>');
			var cgst = parseFloat('<?=$gst['cgst'];?>');
			var totalgst = sgst + cgst;
			$('#gst_per').val(sgst+'-'+cgst);
			
		}
		if(gst =='2'){
			var totalgst = parseFloat('<?=$gst['igst'];?>');
			$('#gst_per').val(totalgst);
		}
		if(gst_type =='1'){
			//GST Amount = GST Inclusive Price * GST Rate /(100 + GST Rate Percentage)
			//Original Cost =  GST Inclusive Price * 100/(100 + GST Rate Percentage)
			var gst_amount = parseFloat(amount * totalgst / (100 + totalgst));
			gst_amount = gst_amount.toFixed(2);
			var grand_total = parseFloat(amount * 100 / (100 + totalgst));
			grand_total = grand_total.toFixed(2);
			$('#final_sub_total').val(0);
			$('#final_sub_total').val(grand_total);
			
		}
		if(gst_type =='2'){
			
			//GST Amount = (Original Cost*GST Rate Percentage) / 100
			//Net Price = Original Cost + GST Amount
			
			var gst_amount = parseFloat(amount * totalgst / 100);
			gst_amount = gst_amount.toFixed(2);
			var grand_total = parseFloat(amount) + parseFloat(gst_amount);
			grand_total = grand_total.toFixed(2);
			$('#grand_total').val(0);
			$('#grand_total').val(grand_total);
		}
		if(gst == '1'){
			var part_gst = parseFloat(gst_amount / 2);
			part_gst = part_gst.toFixed(2);
			$('#sgst_value').val(part_gst);
			$('#cgst_value').val(part_gst);
			$('#igst_value').val(0);
			$('#total_gst').val(gst_amount);
		}
		if(gst == '2'){
			$('#sgst_value').val(0);
			$('#cgst_value').val(0);
			$('#igst_value').val(gst_amount);
			$('#total_gst').val(gst_amount);
		}
	}
	
});

$('#gst_type').on('change', function(){
	
	var gst = $('#gst').val();
	var gst_type = $('#gst_type').val();
	var amount = $('#final_sub_total').val();
	
	if(gst_type ==''){
		new PNotify({title: 'Warrning!',text: 'Please Select GST Type!',icon: 'icon-close',addclass: 'bg-danger'});
	}
	if(gst ==''){
		new PNotify({title: 'Warrning!',text: 'Please Select GST!',icon: 'icon-close',addclass: 'bg-danger'});
	}
	if(gst !='' && gst_type !=''){
		if(gst =='1'){
			var sgst = parseFloat('<?=$gst['sgst'];?>');
			var cgst = parseFloat('<?=$gst['cgst'];?>');
			var totalgst = sgst + cgst;
			$('#gst_per').val(sgst+'-'+cgst);
			
		}
		if(gst =='2'){
			var totalgst = parseFloat('<?=$gst['igst'];?>');
			$('#gst_per').val(totalgst);
		}
		if(gst_type =='1'){
			//GST Amount = GST Inclusive Price * GST Rate /(100 + GST Rate Percentage)
			//Original Cost =  GST Inclusive Price * 100/(100 + GST Rate Percentage)
			var gst_amount = parseFloat(amount * totalgst / (100 + totalgst));
			gst_amount = gst_amount.toFixed(2);
			var grand_total = parseFloat(amount * 100 / (100 + totalgst));
			grand_total = grand_total.toFixed(2);
			$('#final_sub_total').val(0);
			$('#final_sub_total').val(grand_total);
			
		}
		if(gst_type =='2'){
			
			//GST Amount = (Original Cost*GST Rate Percentage) / 100
			//Net Price = Original Cost + GST Amount
			
			var gst_amount = parseFloat(amount * totalgst / 100);
			gst_amount = gst_amount.toFixed(2);
			var grand_total = parseFloat(amount) + parseFloat(gst_amount);
			grand_total = grand_total.toFixed(2);
			$('#grand_total').val(0);
			$('#grand_total').val(grand_total);
		}
		if(gst == '1'){
			var part_gst = parseFloat(gst_amount / 2);
			part_gst = part_gst.toFixed(2);
			$('#sgst_value').val(part_gst);
			$('#cgst_value').val(part_gst);
			$('#igst_value').val(0);
			$('#total_gst').val(gst_amount);
		}
		if(gst == '2'){
			$('#sgst_value').val(0);
			$('#cgst_value').val(0);
			$('#igst_value').val(gst_amount);
			$('#total_gst').val(gst_amount);
		}
	}
	
});

function changeamcamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var amount = $('#amount_'+rowid).val();
		var product_id = $("input[name='rowdata["+rowid+"][product_id]']").val();
		var amc_duration = $("input[name='rowdata["+rowid+"][amc_duration]']").val();
		
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/updateamcamount');?>',
                data:'product_id='+product_id+'&amc_duration='+amc_duration+'&amount='+amount,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						$('#hidden_amount_'+rowid).val(amount);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            }); 
}
function changesaleamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var amount = $('#amount_'+rowid).val();
		var product_id = $("input[name='rowdata["+rowid+"][product_id]']").val();
		
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/changesaleamount');?>',
                data:'product_id='+product_id+'&amount='+amount,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						$('#hidden_amount_'+rowid).val(amount);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            }); 
}

function changeserviceamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var amount = $('#amount_'+rowid).val();
		var product_id = $("input[name='rowdata["+rowid+"][product_id]']").val();
		var service_id = $("input[name='rowdata["+rowid+"][service_id]']").val();
		
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/changeserviceamount');?>',
                data:'product_id='+product_id+'&amount='+amount+'&service_id='+service_id,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						$('#hidden_amount_'+rowid).val(amount);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            }); 
}

function changepartamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var amount = $('#amount_'+rowid).val();
		var product_id = $("input[name='rowdata["+rowid+"][product_id]']").val();
		
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/customer/changepartamount');?>',
                data:'product_id='+product_id+'&amount='+amount,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						$('#hidden_amount_'+rowid).val(amount);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            }); 
}


let getGrandTotal =	function(){
	let sub_total = 0;
	let total_discount = 0;
	let final_sub_total = 0;
	let total_tax = 0;
	let grand_total = 0;
	
	$("table tbody").find('input[name="amount[]"]').each(function(){
		if($(this).val() == ''){ sub_total = sub_total + 0; };
		sub_total = sub_total + parseFloat($(this).val());
	});
	$("table tbody").find('input[name="discount_amount[]"]').each(function(){
		if($(this).val() == '0'){ total_discount = total_discount + 0; };
		total_discount = total_discount + parseFloat($(this).val());
	});
	
	final_sub_total = sub_total - total_discount;
	total_tax = $('#total_gst').val();
	grand_total = final_sub_total - total_tax;
	$('#sub_total').val(sub_total);
	$('#total_discount').val(total_discount);
	$('#final_sub_total').val(final_sub_total);
	$('#grand_total').val(final_sub_total);
	
	
	
	                                       
}
</script>