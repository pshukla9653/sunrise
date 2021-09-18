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
<?=form_open_multipart('secure/vendor/purchase', array('class'=>'form-horizontal'));?>
								<div class="container-fluid">
									<div class="row">
                                    <div class="col-lg-4">
                                    <div class="form-group">
												<label class="col-lg-4 control-label">Vendor List:</label>
												<div class="col-lg-8">
													<select class="form-control select2" name="vender_id" id="vender_id" required>
                                                    <option value="">Select</option>
                                                    <?php  foreach($vendorList as $p){?>
                                                    <option value="<?=$p['id'];?>"><?=$p['vendor_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('vender_id');?></span>
												</div>
											</div>
                                    </div>
                                    <div class="col-lg-4">
                                     
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Bill No.</label>
                                            <div class="col-lg-8">
                                            <input type="text" class="form-control" name="bill_no" id="bill_no" value="" required/>
											<span class='text-danger'><?=form_error('bill_no');?></span>
                                           
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                    <div class="form-group">
                                            <label class="col-lg-4 control-label">Bill Date</label>
                                            <div class="col-lg-8">
                                            <input type="date" class="form-control" name="bill_date" id="bill_date" value="<?php echo date('Y-m-d');?>" required/>
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
                                        <th style="width:15% !important;">Stock Unit</th>
                                        <th style="width:15% !important;">Unit</th>
                                        <th style="width:15% !important;">Purchage Amount</th>
                                        <th style="width:15% !important;">Sell Amount(MRP)</th>
                                        <th style="width:15% !important;">Total Purchase Amount</th>
                                        <th style="width:20% !important;">Action</th>
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
                                        
                                        </tr>
                                         <!--<tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                         <th>&nbsp;</th>
                                        
                                        
                                        
                                          <th>&nbsp;</th>
                                        
                                        <th>Sub Total (Before Discount):</th>
                                        <th><input type="text" name="sub_total" class="form-control" id="sub_total" value="0" readonly/></th>
                                      
                                        </tr>
                                        	<tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                         <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                       
                                        
                                        
                                          <th>&nbsp;</th>
                                        <th>Total Discount:</th>
                                        <th><input type="text" name="total_discount" class="form-control" id="total_discount" value="0" readonly/></th>
                                      
                                        </tr>-->
                                        <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                         <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        
                                        
                                        <th>&nbsp;</th>
                                        <th>Final Sub Total (Before Tax):</th>
                                        <th><input type="text" name="final_sub_total" class="form-control" id="final_sub_total" value="0" readonly/></th>
                                        
                                        </tr>
                                        <tr>
                                        <th></th>
                                        <th>&nbsp;</th>
                                        <th>
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
                                         <th>
                                         CGST<input type="text" name="cgst_value" class="form-control" id="cgst_value" value="0" readonly/></th>
                                        
                                     
                                        <th>IGST<input type="text" name="igst_value" class="form-control" id="igst_value" value="0" readonly/></th>
                                        <th>Total GST<input type="text" name="total_gst" class="form-control" id="total_gst" value="0" readonly/></th>
                                        
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
                                        
                                        </tr>
                                         <tr>
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
                                    <input type="submit" value="Generate Bill" name="btn" class="btn btn-success"/>
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
 if(product_id ==''){
	 new PNotify({title: 'Warning!',text: 'Please Select Product!',icon: 'icon-warning',addclass: 'bg-warning'});
 }

	
	if (product_id !=''){
		var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add this Product! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/vendor/getproductdetails');?>',
                data:'product_id='+product_id,
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
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][product_id]" value="'+data.product_id+'"/>'+data.product_name+'</td>';
				 
				  html += '<td>'+data.stock_unit+'</td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][unit]" id="unit_'+newsrno+'" class="form-control" value="0" onChange="changeproductamount('+newsrno+')"/></td>';
				html += '<td><input type="text" name="rowdata['+newsrno+'][purchage_price]" id="product_price_'+newsrno+'" class="form-control" value="'+data.purchage_price+'"  onChange="changeproductamount('+newsrno+')"/></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][sell_price]" id="sell_price_'+newsrno+'" class="form-control" value="'+data.sell_price+'"  onChange="changeproductamount('+newsrno+')"/></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][total_purchase_price]" id="total_purchase_price_'+newsrno+'" class="form-control" value="0" readonly/><input type="hidden" name="total_purchase_price[]" id="hidden_total_purchase_price_'+newsrno+'" value="0"/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				     
       
        
        $('#productdetails').append(html);
		
		$("#gst option").each(function(){
		if($(this).val() == 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() == 0){
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
$(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
		getGrandTotal();
    });




function addproductpart(){
		var product_part_id = $('#product_part_id').val();
		if(product_part_id !=''){
				var bill_date = $('#bill_date').val();
				var r = confirm('Are you sure to add New Product Part! Your Bill Date is '+ bill_date);
				if(r == true){
				$.ajax({
                type:'POST',
                url:'<?=base_url('secure/vendor/getproductpartdetail');?>',
                data:'product_part_id='+product_part_id,
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
				  html += '<td><input type="hidden" name="rowdata['+newsrno+'][product_part_id]" value="'+data.product_part_id+'"/>'+data.part_name+'</td>';
				 
				  html += '<td>'+data.stock_unit+'</td>';
				  html += '<td><input type="text" name="rowdata['+newsrno+'][unit]" id="unit_'+newsrno+'" class="form-control" value="0" onChange="changeproductamount('+newsrno+')"/></td>';
				html += '<td><input type="text" name="rowdata['+newsrno+'][purchage_price]" id="product_price_'+newsrno+'" class="form-control" value="'+data.purchage_price+'"  onChange="changeproductpartamount('+newsrno+')"/></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][sell_price]" id="sell_price_'+newsrno+'" class="form-control" value="'+data.sell_price+'"  onChange="changeproductpartamount('+newsrno+')"/></td>';
				 html += '<td><input type="text" name="rowdata['+newsrno+'][total_purchase_price]" id="total_purchase_price_'+newsrno+'" class="form-control" value="0" readonly/><input type="hidden" name="total_purchase_price[]" id="hidden_total_purchase_price_'+newsrno+'" value="0"/></td>';
				  html += '<td><span class="btn btn-info" id="removeRow"><i class="fa fa-close"</span></td>';
				  html += '</tr>';
				  
				 
       
        
        $('#productdetails').append(html);
		$("#gst option").each(function(){
		if($(this).val() == 0){
		$(this).prop('selected', true);
		}	 
		});
		$("#gst_type option").each(function(){
		if($(this).val() == 0){
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


function changeproductamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var product_id = parseFloat($('input[name="rowdata['+rowid+'][product_id]"]').val());
		var stockunit = parseFloat($('#unit_'+rowid).val());
		var price = parseFloat($('#product_price_'+rowid).val());
		var sell_price = parseFloat($('#sell_price_'+rowid).val());
		var purchage_price = 0;
		
		console.log(product_id+','+stockunit+','+price+','+sell_price);
		if( stockunit !=0 && price !=0 && sell_price !=0){
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/vendor/changeproductamount');?>',
                data:'product_id='+product_id+'&price='+price+'&sell_price='+sell_price,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						var totalPrice = parseFloat(stockunit * price);
						$('#hidden_total_purchase_price_'+rowid).val(totalPrice);
						$('#total_purchase_price_'+rowid).val(totalPrice);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            });
		}
}

function changeproductpartamount(rowid){
		//new PNotify({title: 'Warrning!',text: 'Discount Percentage not more then 50%',icon: 'icon-close',addclass: 'bg-danger'});
		var product_id = parseFloat($('input[name="rowdata['+rowid+'][product_id]"]').val());
		var stockunit = parseFloat($('#unit_'+rowid).val());
		var price = parseFloat($('#product_price_'+rowid).val());
		var sell_price = parseFloat($('#sell_price_'+rowid).val());
		var purchage_price = 0;
		
		console.log(product_id+','+stockunit+','+price+','+sell_price);
		if( stockunit !=0 && price !=0 && sell_price !=0){
		$.ajax({
                type:'POST',
                url:'<?=base_url('secure/vendor/changeproductpartamount');?>',
                data:'product_id='+product_id+'&price='+price+'&sell_price='+sell_price,
				dataType:'JSON',
                success:function(data){
					console.log(data);
					if(data.status == true){
						var totalPrice = parseFloat(stockunit * price);
						$('#hidden_total_purchase_price_'+rowid).val(totalPrice);
						$('#total_purchase_price_'+rowid).val(totalPrice);
						getGrandTotal();
						new PNotify({title: 'Success!',text: 'Amount Update SuccessFully',icon: 'icon-check',addclass: 'bg-success'});
					}
					else{
						new PNotify({title: 'Warrning!',text: 'Error! Amount Not updated!',icon: 'icon-stop',addclass: 'bg-danger'});
					}
					
                 
                }
				
            });
		}
}



let getGrandTotal =	function(){
	let sub_total = 0;
	
	let total_tax = 0;
	let grand_total = 0;
	
	$("table tbody").find('input[name="total_purchase_price[]"]').each(function(){
		if($(this).val() == ''){ sub_total = sub_total + 0; };
		sub_total = sub_total + parseFloat($(this).val());
	});
	
	total_tax = $('#total_gst').val();
	grand_total = sub_total - total_tax;
	
	$('#final_sub_total').val(sub_total);
	$('#grand_total').val(grand_total);
	
	
	
	                                       
}
</script>