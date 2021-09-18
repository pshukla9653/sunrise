<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold"> <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - <a href="<?=base_url($this->uri->segment(2));?>">
        <?=ucfirst($this->uri->segment(2));?>
        </a></h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
      <li class="active"><a href="<?=base_url($this->uri->segment(2));?>">
        <?=ucfirst($this->uri->segment(2));?>
        </a></li>
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
        
      </div>
      <div class="panel-body">
      <div class="row">
      <div class="pull-right">
          <?php if(in_array('leads-add', $this->GroupPermission)){?>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_default">Add
          <?=ucfirst($this->uri->segment(2));?>
          </button>
          <?php }?>
          <br>
          <br> 
         <!-- 036419372212--->
        </div>
      </div>
        <div class="row">
        <?php echo $this->session->flashdata('msg'); ?>
          <div class="col-md-12">
            <fieldset>
              <legend class="text-semibold">
              <?=ucfirst($this->uri->segment(2));?>
              List</legend>
              <!-- Ajax sourced data -->
              <table class="table datatable-cutomerlist">
                <thead>
                <th>Customer Name</th>
                  <th>Customer Code</th>
                  <th>Mobile</th>
                  <th>Alternate Mobile</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th style="width:120px;">Actions</th>
                    </thead>
              </table>
              <!-- /ajax sourced data -->
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Customer modal -->
<div id="modal_default" class="modal fade" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info">Add
          <?=ucfirst($this->uri->segment(2));?>
        </h5>
      </div>
      <?=form_open_multipart('secure/customer/add', array('class'=>'form-horizontal','id'=>'addcustomer')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Name:</label>
              <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Name of the Customer" name="customer_name" id="customer_name" value="<?=set_value('customer_name');?>" autocomplete="off">
                <span class="text-danger">
                <?=form_error('customer_name');?>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" max="9999999999" min="6666666666" class="form-control" id="mobile" name="mobile" value="<?=set_value('mobile');?>"/>
                <span class="text-danger">
                <span id="mobile_error"></span>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email</label>
              <div class="col-lg-9">
                <input type="email" placeholder="example@domain.com" class="form-control" id="email" name="email" value="<?=set_value('email');?>"/>
                <span class="text-danger">
                <?=form_error('email');?>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Alternate Mobile</label>
              <div class="col-lg-9">
                <input type="number" placeholder="9999999999" class="form-control" max="9999999999" min="6666666666" id="alternate_mobile" name="alternate_mobile" value="<?=set_value('alternate_mobile');?>"/>
                <span class="text-danger">
                <span id="alternate_mobile_error"></span>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Landline Number</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000-00000" class="form-control" name="landline_no" id="landline_no" value="<?=set_value('landline_no');?>">
                <span class="text-danger">
                <?=form_error('landline_no');?>
                </span> </div>
            </div>
             <div class="form-group">
              <label class="col-lg-3 control-label">GSTIN:</label>
              <div class="col-lg-9">
                <input type="text" id="gstin" name="GSTIN" class="form-control" placeholder="GSTIN" required/>
              </div>
              </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Description:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Description" id="description" name="description"><?=set_value('description');?>
</textarea>
              </div>
              <span class="text-danger">
              <?=form_error('description');?>
              </span> </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-9">
                <textarea rows="5" cols="5" class="form-control" placeholder="Street Address" id="address" name="address"><?=set_value('address');?>
</textarea>
              </div>
              <span class="text-danger">
              <?=form_error('address');?>
              </span> </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Country:</label>
              <div class="col-lg-9">
                <select class="form-control" name="country_id" id="country_id">
                  <option value="">Select</option>
                  <?php foreach($countrieslist as $c){ ?>
                  <option value="<?=$c['country_id'];?>" >
                  <?=$c['country_name'];?>
                  </option>
                  <?php } ?>
                </select>
                <span class="text-danger">
                <?=form_error('country_id');?>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">State:</label>
              <div class="col-lg-9">
                <select class="form-control" name="state_id" id="state_id">
                </select>
                <span class="text-danger">
                <?=form_error('state_id');?>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">City:</label>
              <div class="col-lg-9">
                <select class="form-control" name="city_id" id="city_id">
                </select>
                <span class="text-danger">
                <?=form_error('city_id');?>
                </span> </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">PIN Code:</label>
              <div class="col-lg-9">
                <input type="text" placeholder="000000" class="form-control" id="zip_code" name="zip_code" <?=set_value('zip_code');?>>
                <span class="text-danger">
                <?=form_error('zip_code');?>
                </span> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" value="Save"/>
        <?=form_close();?>
      </div>
    </div>
  </div>
</div>
<!-- /Add Customer modal --> 


<!-- Show data modal -->
<div id="modal_show" class="modal fade" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info" id="cuto">
          
        </h5>
      </div>
     
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
      <div class="row">
        	<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight">
											<li class="active"><a href="#justified-badges-tab1" data-toggle="tab">Customer Detail</a></li>
                                            <?php if(in_array('lead-followupremider', $this->GroupPermission)){?>
											<li><a href="#justified-badges-tab2" data-toggle="tab" onClick="getreminderlist();">Followup Reminders <span class="badge bg-info position-right" id="remindercount"></span></a></li>
                                            <?php }?>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="justified-badges-tab1">
												<div class="row">
          <div class="pull-left" id="restbtn" style="padding:5px;">
          
          </div>
          <div class="pull-right" id="convertbtn" style="padding:5px;">
          
          </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                <div class="col-sm-12">
                                                <h6 class="bg-info">&nbsp;Customer Information</h6>
                                                <div class="col-sm-6">
                                                <p>Name : <strong><span id="showname"></span></strong></p>
                                                <p>Mobile : <strong><span id="showmobile"></span></strong></p>
                                                <p>Email : <strong><span id="showemail"></span></strong></p>
                                                </div>
                                                <div class="col-sm-6">
                                                <p>Alternate Mobile : <strong><span id="showalternate"></span></strong></p>
                                                <p>Landline Number : <strong><span id="showlandline"></span></strong></p>
                                                <p>Address : <strong><span id="showaddress"></span></strong></p>
                                                <p>Status : <strong><span id="showstatus"></span></strong></p>
                                                </div>
                                                </div>
                                                <div class="col-sm-12">
                                                <h6 class="bg-info">&nbsp;Product Information</h6>
                                                <table class="table">
                      <thead>
                      <tr>
                      <th>Product Name</th>
                      <th>Service</th>
                      <th>AMC/Warrany Start Date</th>
                      <th>AMC/Warrany End Date</th>
                      <th>Address</th>
                      <th>MS Dates</th>
                      <th>Action</th>
                      </tr>
                      </thead>
                           <tbody id="productlist">
                                    
                          </tbody>
                    </table>
                                                </div>
                                                </div>
											</div>

											<div class="tab-pane" id="justified-badges-tab2" onClick="getreminderlist();">
												<div class="row">
                                                <div class="pull-left" id="reminderbtn" style="padding:5px;">
          
          										</div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                <input type="hidden" id="showdataid"/>
                                                <table class="table">
                      <thead>
                      <tr>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Action</th>
                      </tr>
                      </thead>
                           <tbody id="remiderlistb">
                                    
                          </tbody>
                    </table>
                                                </div>
											</div>
                                            

											
										</div>
									</div>
					</div>
					<!-- /badges --> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
       
      </div>
    </div>
  </div>
</div>
<!-- /Show data modal --> 
<!-- Product Details modal -->
<div id="modal_productdetail" class="modal fade" data-backdrop="false" style="z-index:99999;">
  <div class="modal-dialog modal-ms" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px 20px; height:35px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title btn btn-info"> Update Product Details
        </h5>
      </div>
      <?=form_open_multipart('secure/leads/addreminder', array('class'=>'form-horizontal','id'=>'editproductdetail')); ?>
      <?php echo $this->session->flashdata('msg'); ?>
      <div class="modal-body">
        <div class="row">
        <div class="form-group">
              <label class="col-lg-3 control-label">Product:</label>
              <div class="col-lg-9">
                <select name="product_id" id="editproduct_id" class="form-control">
                <?php foreach($productlist as $product){?>
                <option value="<?=$product['id'];?>"><?=$product['product_name'];?></option>
                <?php }?>
                </select>
              </div>
              </div>
               <div class="form-group">
              <label class="col-lg-3 control-label">Service:</label>
              <div class="col-lg-9">
                <select name="service_id" id="editservice_id" class="form-control">
                <?php foreach($servicelist as $service){?>
                <option value="<?=$service['id'];?>"><?=$service['service_name'];?></option>
                <?php }?>
                </select>
              </div>
              </div>
        <div class="form-group">
              <label class="col-lg-3 control-label">AMC/Warrany Start Date:</label>
              <div class="col-lg-9">
                <input type="date" id="wreminder_start_date" name="wreminder_start_date" class="form-control" required/>
				
              </div>
              </div>
                <div class="form-group">
              <label class="col-lg-3 control-label">AMC/Warrany End Date:</label>
              <div class="col-lg-9">
                <input type="date" id="wreminder_end_date" name="wreminder_end_date" class="form-control" required/>
				
              </div>
              </div>
        	<div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-9">
 <textarea rows="5" cols="5" class="form-control" placeholder="Address" id="paddress" name="paddress" required>
</textarea>
              </div>
             </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="btn" id="reminder_btn" value="Submit"/>
        <?=form_close();?>
      </div>
    </div>
  </div>
</div>
<!-- /Product Details modal --> 


<script type="application/x-javascript">

	$("#addcustomer").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
	var customer_id = $('#customer_name').val();
	var mobile = $('#mobile').val();
	
	if(customer_id ==''){
		new PNotify({
            title: 'Error!',
            text: 'Please Fill Customer Name',
            addclass: 'bg-danger'
        });
	}
   else	if(mobile ==''){
		new PNotify({
            title: 'Error!',
            text: 'Please Fill Mobile',
            addclass: 'bg-danger'
        });
	}
	else{
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
		   dataType:'json',
           success: function(response)
           {
		 $('#modal_default').modal('toggle');
new PNotify({title: 'Success!',
            text: 'Lead Generated!',
            addclass: 'bg-success'
       					 });
			addreminder(id);			 
			location.reload();	
           },
		   error: function(response) {
			   new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
        });
		   }
         });
	}

    
});

	function showdetail(id){
		$('#modal_show').modal('toggle');
		$.ajax({
                    url:'<?=base_url("secure/customer/getdetail");?>',
                    type:'post',
                    data:'id='+id,
					dataType:'json',
                    success:function(result){
                      console.log(result);
					   if(result.status == true){
						   $('#showdataid').val(result.data.id);
						   $('#cuto').html('#'+ result.data.customer_code+' - '+result.data.customer_name);
						   $('#showname').html(result.data.customer_name);
						   $('#showmobile').html(result.data.mobile);
						   $('#showemail').html(result.data.email);
						   $('#showalternate').html(result.data.alternate_mobile);
						   $('#showlandline').html(result.data.landline_no);
						   $('#showaddress').html(result.data.address);
						   $('#showstatus').html(result.data.status);
						   
						  $('#convertbtn').html('<?php if(in_array('leads-assign', $this->GroupPermission)){?><a onClick="workassign('+result.data.id+')" class="btn btn-info"><i class="fa fa-mail-forward"></i> Work Assign</a><?php } ?>'); 
						  
						  $('#restbtn').html('<?php if(in_array('leads-edit', $this->GroupPermission)){?><a onClick="editdetail('+result.data.id+')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i> Edit</a><?php } if(in_array('leads-delete', $this->GroupPermission)){?>&nbsp;<a onClick="deleterow('+result.data.id+');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i>Delete</a><?php }?>');
						  $('#reminderbtn').html('<?php if(in_array('leads-addreminder', $this->GroupPermission)){?><a onClick="addreminder('+result.data.id+')" class="btn btn-info"><i class="fa fa-bell"></i> Add Lead Reminder</a><?php }?>');
						 productlist(id);
					   }
					   else if(result.status == false){
						  new PNotify({
            title: 'Error!',
            text: 'Try Again',
            addclass: 'bg-danger'
        });
		location.reload();
					   }

                    }

            });
	}
	
	function productlist(id){
		$.ajax({
                    url:'<?=base_url("secure/customer/productlist");?>',
                    type:'post',
                    data:'id='+id,
                    success:function(html){
                      console.log(html);
					    $('#productlist').html(html);

                    }

            });
	}
	
	
	function editproductdetail(id){
		$('#modal_productdetail').modal('toggle');
		$.ajax({
                    url:'<?=base_url("secure/customer/getservicedetail");?>',
                    type:'post',
                    data:'id='+id,
					dataType:'json',
                    success:function(result){
                      console.log(result);
					   if(result.status == true){
						   $("#editproduct_id option").each(function(){
								if($(this).val() === result.data.product_id){
								$(this).prop('selected', true);
								}	 
							});
							$("#editservice_id option").each(function(){
								if($(this).val() === result.data.service_id){
								$(this).prop('selected', true);
								}	 
							});
							$('#wreminder_start_date').val(result.data.amc_start_date);
							$('#wreminder_end_date').val(result.data.amc_end_date);
							$('#paddress').html(result.data.address);
					   }
					   else if(result.status == false){
						new PNotify({
            			title: 'Error!',
            			text: 'Try Again',
            			addclass: 'bg-danger'
       					 });
								location.reload();
					   }

                    }

            });
	}
	
	
</script> 
