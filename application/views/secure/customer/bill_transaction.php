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
                            <?=form_open_multipart('secure/loader/transaction/'.$totalamount['id']);?>
								<div class="row">
                   <div class="col-xl-12 col-lg-12">
                   <div class="col-md-12">
                             <?php echo $this->session->flashdata('msg'); ?>
                            </div> 
                             <div class="col-md-6">
                                 <div class="form-group">
								<?php echo form_label('Loader Name'); ?>
                                <?php $name = $this->Loader_model->get_data('tbl_loader',array('id'=>$totalamount['loader_id']));?>
                                <input type="text" class="form-control" readonly   value="<?php echo $name['loader_name']?>" />
								<?php echo form_error('loader_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Bill Number'); ?>
                                <input type="text" class="form-control" readonly name="agentBillId"  value="<?php echo 'SR-00'.$totalamount['id']?>" />
								<?php echo form_error('clientBillId', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Total Amount'); ?>
                                <input type="text" class="form-control" readonly name="total_amount" id="totalamt" value="<?php echo $totalamount['total_billing_amount']?>" />
								<?php echo form_error('total_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Paid Amount'); ?>
                                <input type="text" class="form-control" readonly name="paid_amount"  value="<?php echo $totalamount['paid']?>" id="paidamt"/>
								<?php echo form_error('paid_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <div class="form-group">
								<?php echo form_label('Due Amount'); ?>
                                <input type="text" class="form-control" readonly name="due_amount"  value="<?php echo $totalamount['due']?>" id="dueamt"/>
								<?php echo form_error('due_amount', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            <input type="hidden" value="<?php echo $totalamount['due']?>"  id="damount">
                            <input type="hidden" value="<?php echo $loader_id;?>" name="loader_id">
                            
                             </div>
                            
                    
                            <div class="col-md-6">
                         
                           <div class="form-group">
								<?php echo form_label('Payment Mode'); ?>
                                <select class="form-control" name="paymentmode" onchange="jsFunction(this.value);" id="paymentmode">
                                <option value="">--select--</option>
                                <option value="1">By Cash</option>
                                <option value="2">By Cheque</option>
                                <option value="3">Online</option>
                                </select>
								<?php echo form_error('paymentmode', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                                <div class="form-group" id="tdstxt" style="display:none;" >
                                    <?php echo form_label('TDS Amount'); ?>
                                    <input type="number" class="form-control tdsamt"  name="tdsamount"  placeholder="TDS Amount" id="tdsPayAmount" onChange="checkData()" />
                                </div>

                                <div class="form-group" id="paytxt" style="display:none;" >
                                    <?php echo form_label('Pay Amount'); ?>
                                    <input type="text" class="form-control payamt"  name="payamount"  placeholder="Pay Amount" id="paybalAmount" onChange="checkData()" />
                                    <?php echo form_error('payamount', '<p class="text-danger">', '</p>'); ?>
                                </div>

                                <div id="cash">
                                    <div class="form-group">
                                    <?php echo form_label('Payment Date'); ?>
                                    <input type="date" class="form-control"  name="payment_date"  placeholder="Payment Date"  value="<?php echo date('Y-m-d');?>"/>
                                    <?php echo form_error('payment_date', '<p class="text-danger">', '</p>'); ?>
                                    </div>
                                </div>

                            <div id="cheque" style="display:none;">
                                
                                <div class="form-group">
								<?php echo form_label('Cheque Number'); ?>
                                <input type="text" class="form-control"  name="cheque_no"  placeholder="Cheque Number"/>
								<?php echo form_error('cheque_no', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                 <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                                <input type="text" class="form-control"  name="bank"  placeholder="Bank Name"/>
								<?php echo form_error('bank', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                 <div class="form-group">
								<?php echo form_label('Cheque Date'); ?>
                                <input type="text" class="form-control"  name="cleardate" id="date"  placeholder="Cheque Date"/>
								<?php echo form_error('cleardate', '<p class="text-danger">', '</p>'); ?>
                                </div>
                                
                            </div>
                            <div id="online" style="display:none;">
                              
                                <div class="form-group">
								<?php echo form_label('Transaction Id'); ?>
                                <input type="text" class="form-control"  name="onlinetransactionid"  placeholder="Transaction Id"/>
								<?php echo form_error('onlinetransactionid', '<p class="text-danger">', '</p>'); ?>
                                </div>

                                <div class="form-group">
								<?php echo form_label('Bank Name'); ?>
                                <input type="text" class="form-control"  name="onlinebank"  placeholder="Bank Name"/>
								<?php echo form_error('onlinebank', '<p class="text-danger">', '</p>'); ?>
                                </div>

                            </div>
                            <br>
                            <?php if($totalamount['status'] != 2){?>
                               <?php echo form_submit(array('value' => 'Submit', 'name'=>'submit', 'class'=>'btn btn-success pull-right btn-lg')); ?>
							<?php } ?>
                              
                  
                  </div>
                  </div>
                  
                  
                  </div>
							<?=form_close();?>
								
							</div>
						</div>

</div>

</div>
<script>
                    
                $(document).ready(function(e) {
					var result = 0; 
				   $(".payamt").blur(function(){
					 
					 var dueamt = $('#damount').val();
                     
					 var payamt = $(".payamt").val();
					 var tdsamount = $(".tdsamt").val();
					 if(tdsamount == "" )
					 {
						tdsamount = 0.00; 
					 }
					 var totalcut = parseFloat(payamt) + parseFloat(tdsamount);
					 result = parseFloat(dueamt) - parseFloat(totalcut);
					 
				     $('#dueamt').val(result.toFixed(2));
					  
					});
					
					
				});

                function checkData(){
                            var paybalAmount    =   parseFloat(document.getElementById('paybalAmount').value);
                            var tdsPayAmount    =   parseFloat(document.getElementById('tdsPayAmount').value);
                            var total           =   paybalAmount + tdsPayAmount;
                            var getDueAmount    =   parseFloat(document.getElementById('damount').value);
                            if(total > getDueAmount){
                                     alert('Paybal Amount Is Greater Compare To Due Amount..');
                            }

                }
               </script>
               <script>
				   function jsFunction(value)
					{
						if(value == 1)
						{
						   document.getElementById("cash").style.display = 'block';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 2)
						{
						   document.getElementById("cheque").style.display = 'block';
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 3)
						{
						   document.getElementById("online").style.display = 'block';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'block';
						   document.getElementById("tdstxt").style.display = 'block';
						}
						if(value == 0)
						{
						   document.getElementById("online").style.display = 'none';
						   document.getElementById("cash").style.display = 'none';
						   document.getElementById("cheque").style.display = 'none';
						   document.getElementById("paytxt").style.display = 'none';
						   document.getElementById("tdstxt").style.display = 'none';
						}
					}
					

               </script>