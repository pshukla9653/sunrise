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
									  <?php echo $this->session->flashdata('msg'); ?>
                                    <div class="col-md-12">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Vendor Name</th>
                      <th>Reg. No.</th>
                      <th>GSTIN</th>
                      <th>Contact Person Name</th>
                      <th>Contact Person Mobile</th>
                     
                      
                      <th>Status</th>
                      
                      </thead>
                                        <tbody>
                                    <?php foreach($vendorlist as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['vendor_name']; ?></td>
                                        <td><?php echo $item['reg_no']; ?></td>
                                        <td><?php echo $item['GSTIN']; ?></td>
                                        <td><?php echo $item['Contact_person_name']; ?></td>
                                        <td><?php echo $item['Contact_person_mobile']; ?></td>
                                       
                                        <td><?php echo ($item['status'] == 1) ? '<span class="tag tag-default tag-success">Active</span>':'<span class="tag tag-default tag-danger">Inactive</span>'; ?></td>
                                        
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
<script type="text/javascript"> 
		
		
		function editExpenses(getId){
				$.ajax({
							type:'POST',
							url:'<?php echo base_url('secure/expenses/getexpensesDetail');?>',
							data:'getId='+getId,
							dataType:'json',
							success:function(response){
								//console.log(response);
								$('#person_name').val(response.founddata.person_name);
								$('#expenses_id').val(response.founddata.id);
								$('#description').val(response.founddata.description);
								$('#amount').val(response.founddata.amount);
								$('#fdate').val(response.founddata.fdate);
								$('#bt').val('Update');
								$("#status option").each(function(){
									 if($(this).val() === response.founddata.status){
										$(this).prop('selected', true);
									 }	 
								});
							}
					}); 
		}
		
		
</script>