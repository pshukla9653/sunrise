<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:window.history.back();"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">
                            <a href="<?=base_url('dashboard');?>">Dashboard</a></span> - 
                            <a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Product Service</a></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?=base_url('dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?=base_url($this->uri->segment(2));?>"><?=ucfirst($this->uri->segment(2));?> Product Service</a></li>
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
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> Product Service List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Customer Name</th>
                       <th>Mobile</th>
                      <th>Invoice No.</th>
                      <th>Invoice Date</th>
                      <th>Product Name</th>
                      <th>Service Type</th>
                      <th>AMC Duration/Warranty</th>
                      <th>AMC/Warranty Start Date</th>
                      <th>AMC/Warranty Expired Date</th>
                      <th>No. of Mandatory Service</th>
                      <th>Mandatory Service Date</th>
                       <th>Sell Amount</th>
                       <th>Discount Percent</th>
                       <th>Discount Amount</th>
                       <th>Amount After Discount</th>
                      
                      
                      
                      <th>Actions</th>
                      
                      </thead>
                                        <tbody>
                                    <?php foreach($invoiceList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['customer_name']; ?></td>
                                        <td><?php echo $item['mobile']; ?></td>
                                        <td><?php echo $item['invoice_no']; ?></td>
                                        <td><?php echo $item['invoice_date']; ?></td>
                                        <td><?php echo $item['product_name']; ?></td>
                                        <td><?php echo $item['service_name']; ?></td>
                                        <td><?php echo $item['amc_duration']; ?> Year</td>
                                        <td><?php echo $item['amc_start_date']; ?></td>
                                        <td><?php echo $item['amc_end_date']; ?></td>
                                        <td><?php echo $item['ms_duration']; ?> </td>
                                        <td><?php echo $item['ms_dates']; ?></td>
                                        <td><?php echo $item['amount']; ?></td>
                                        <td><?php echo $item['discount_percent']; ?></td>
                                        <td><?php echo $item['discount_amount']; ?></td>
                                        <td><?php echo $item['discounted_amount']; ?></td>
                                        
                                        
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
