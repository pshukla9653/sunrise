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
								<div class="row">
									
                                    <div class="col-md-12">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Bill No</th>
                      <th>Agent Name</th>
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Total Weight</th>
                      <th>Bill Amount</th>
                      <th>Total Taxable Amount</th>
                      <th>Total GST</th>
                      <th>Total Billing Amount</th>
                      <th>Due</th>
                      <th>Paid</th>
                      <th>Billing Date</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                    <?php foreach($BillList as $item) { ?>
                                    <tr style="text-align:center;">
                                    <td><?php echo 'SR-00'.$item['id']; ?></td>
                                        <td><?php
										$client = $this->Loader_model->get_data('tbl_loader', array('id'=>$item['loader_id']));
										 echo $client['loader_name']; ?></td>
                                        <td><?php echo $item['date_from']; ?></td>
                                        <td><?php echo $item['date_to']; ?></td>
                                        <td><?php echo $item['weightforbilling']; ?></td>
                                        <td><?php echo $item['amountforbilling']; ?></td>
                                        <td><?php echo $item['TotalTaxableamount']; ?></td>
                                        <td><?php echo $item['total_gst']; ?></td>
                                        <td><?php echo $item['total_billing_amount']; ?></td>
                                        <td><?php echo $item['due']; ?></td>
                                        <td><?php echo $item['paid']; ?></td>
                                        <td><?php echo $item['bill_date']; ?></td>
                                        <td><?php if($item['status'] == 0) { echo '<span class="btn btn-danger">Unpaid</span>';}
										if($item['status'] == 1) { echo '<span class="btn btn-warning">Due</span>';}
										if($item['status'] == 2) { echo '<span class="btn btn-success">Paid</span>';}
										?></td>
                                        <td><a href="<?=base_url('secure/loader/print_bill/'.$item['id']);?>" class="btn btn-info" target="_blank">Print</a> | <a href="<?=base_url('secure/loader/transaction/'.$item['id']);?>" class="btn btn-info" target="_blank">Get Payment</a></td>
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
