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
									<div class="col-md-4">
										<fieldset>
											<legend class="text-semibold"> Add <?=ucfirst($this->uri->segment(2));?></legend>
                                            <?php echo form_open_multipart('secure/expenses/index', array('class'=>'form-horizontal')); ?>
                               <?php echo $this->session->flashdata('msg'); ?>            
                                           
											<div class="form-group">
                                <label class="col-lg-3 control-label">Person Name</label>
												<div class="col-lg-9">
                                <input type="text" id="person_name" class="form-control" name="person_name" placeholder="Person Name" value="<?php echo set_value('person_name'); ?>" >
                                <input type="hidden" id="expenses_id" class="form-control" name="expenses_id" >
                                <span class="text-danger"><?php echo form_error('person_name'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Description</label>
								<div class="col-lg-9">
                                <textarea id="description" class="form-control" name="description"><?php echo set_value('description'); ?></textarea>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Amount</label>
								<div class="col-lg-9">
                                <input type="text" id="amount" class="form-control" name="amount" placeholder="Amount" value="<?php echo set_value('amount'); ?>" >
                                <span class="text-danger"><?php echo form_error('amount'); ?></span>
								</div>
                            </div>
                            <div class="form-group">
												<label class="col-lg-3 control-label">Date</label>
												<div class="col-lg-9">
													<input type="date" id="fdate" class="form-control" name="fdate" value="<?=set_value('fdate');?>">
                                                    <span class="text-danger"><?=form_error('fdate');?></span>
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
                            
                            
                            <div class="text-right">
									<input type="submit" class="btn btn-primary" name="btn" value="Submit" id="bt">
								</div>
                                <?php echo form_close(); ?>
                            
                           
										</fieldset>
									</div>
                                    <div class="col-md-8">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Person Name</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                    <?php foreach($getExpenses as $item) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $item['person_name']; ?></td>
                                        <td><?php echo $item['description']; ?></td>
                                        <td><?php echo $item['amount']; ?></td>
                                        <td><?php echo $item['fdate']; ?></td>
                                        <td><?php echo ($item['status'] == 1) ? '<span class="tag tag-default tag-success">Active</span>':'<span class="tag tag-default tag-danger">Inactive</span>'; ?></td>
                                        <td>
                                        
                                        
        	<?php if(in_array('expenses-edit', $this->GroupPermission)){$showedit = true;}elseif(in_array('expenses-edit-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showedit = true;} if($showedit == true){ ?>
            <a  class="text-info" onClick="editExpenses('<?php echo $item['id']; ?>')">Edit</a>
            <?php }?>
            <?php if(in_array('expenses-delete', $this->GroupPermission)){$showdelete = true;}elseif(in_array('expenses-delete-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showdelete = true;} if($showdelete == true){ ?>
            <a  class="text-info" href="<?=base_url('secure/expenses/view/'.$item['id']);?>" target="_blank">Print</a>
        	<?php }?>
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