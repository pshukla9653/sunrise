<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                            <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - 
                            <a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Invoice</a></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Invoice</a></li>
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
								<div class="row">
									<?php echo $this->session->flashdata('msg'); ?>
                                    <div class="col-md-12">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> Invoice List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Customer Name</th>
                       <th>Mobile</th>
                      <th>Invoice No.</th>
                      <th>Invoice Date</th>
                      <th>Sub Total</th>
                      <th>Total Discount</th>
                      <th>Final Sub Amount</th>
                      <th>GST (Details)</th>
                      <th>GST Type</th>
                      <th>SGST</th>
                      <th>CGST</th>
                      <th>IGST</th>
                      <th>Total GST</th>
                     <th>Total Payable Amount</th>
                     <th>Total Due</th>
                     <th>Total Paid</th>
                      <th>Status</th>
                      <th>Address</th>
                       <th>City</th>
                       <th>GSTIN</th>
                      
                      <th>Actions</th>
                      
                      </thead>
                                        <tbody>
                                    <?php foreach($invoiceList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['customer_name']; ?></td>
                                        <td><?php echo $item['mobile']; ?></td>
                                        <td><?php echo $item['invoice_no']; ?></td>
                                        <td><?php echo $item['invoice_date']; ?></td>
                                        <td><?php echo $item['sub_total']; ?></td>
                                        <td><?php echo $item['total_discount']; ?></td>
                                        <td><?php echo $item['final_sub_total']; ?></td>
                                        <td><?php if($item['gst']=='1'){
											$gst_per = explode('-', $item['gst_per']);
											echo 'SGST-'.$gst_per[0].'%<br>';
											echo 'CGST-'.$gst_per[1].'%<br>';
										}elseif($item['gst']=='2'){
											
											echo 'IGST-'.$item['gst_per'];
											
										}?></td>
                                        <td><?php if($item['gst_type']=='1'){
											
											echo 'Inclusive';
											
										}elseif($item['gst_type']=='2'){
											
											echo 'Exclusive';
											
										}?></td>
                                        <td><?php echo $item['sgst_value']; ?></td>
                                        <td><?php echo $item['cgst_value']; ?></td>
                                        <td><?php echo $item['igst_value']; ?></td>
                                        <td><?php echo $item['total_gst']; ?></td>
                                        <td><?php echo $item['grand_total']; ?></td>
                                        <td><?php echo $item['total_due']; ?></td>
                                        <td><?php echo $item['total_paid']; ?></td>
                                        <td><?php if($item['invoice_status']=='0'){
										echo '<span class="btn btn-danger">Due</span>';	
										}
										elseif($item['invoice_status']=='1'){
										echo '<span class="btn btn-warning">Partially Paid</span>';	
										}
										elseif($item['invoice_status']=='2'){
										echo '<span class="btn btn-sucess">Paid</span>';	
										}?></td>
                                        <td><?php echo $item['address']; ?>, <?php echo $item['city_name']; ?>, <?php echo $item['state_name']; ?>, <?php echo $item['country_name']; ?> - <?php echo $item['zip_code']; ?></td>
                                        <td><?php echo $item['city_name']; ?></td>
                                        <td><?php echo $item['GSTIN']; ?></td>
                                        
                                        <td>            
</td>
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                    </table>
										</fieldset>
									</div>
								</div>

								
							</div>
						</div>

</div>

</div>
