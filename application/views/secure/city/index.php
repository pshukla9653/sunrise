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
                                            <?php echo form_open_multipart('secure/city/index', array('class'=>'form-horizontal')); ?>
                               <?php echo $this->session->flashdata('msg'); ?>            
                                           <div class="form-group">
												<label class="col-lg-3 control-label">State:</label>
												<div class="col-lg-9">
													<select class="form-control" name="state_id" id="state_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($getState as $state){?>
                                                    <option value="<?=$state['state_id'];?>"><?=$state['state_name'];?></option>
                                                    <?php }?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('state_id');?></span>
												</div>
											</div>
											<div class="form-group">
                                <label class="col-lg-3 control-label">City Name</label>
												<div class="col-lg-9">
                                <input type="text" id="city_name" class="form-control" name="city_name" placeholder="City Name" value="<?php echo set_value('city_name'); ?>" >
                                <input type="hidden" id="city_id" class="form-control" name="city_id" >
                                <span class="text-danger"><?php echo form_error('city_name'); ?></span>
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
									<input type="submit" class="btn btn-primary" value="Submit" id="bt">
								</div>
                                <?php echo form_close(); ?>
                            
                           
										</fieldset>
									</div>
                                    <div class="col-md-8">
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>State Name</th>
                      <th>City Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                    <?php foreach($getCity as $item) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $item['state_name'];?></td>
                                         <td><?php echo $item['city_name'];?></td>
                                        <td><?php echo ($item['status'] == 1) ? '<span class="btn btn-success">Active</span>':'<span class="btn btn-danger">Inactive</span>'; ?></td>
                                        <td>
        	<?php if(in_array('country-edit', $this->GroupPermission)){$showedit = true;}elseif(in_array('country-edit-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showedit = true;} if($showedit == true){ ?>
            <a href="#" onClick="editCity(<?=$item['city_id'];?>)" class="text-info">Edit</a>
            <?php }?>
            <?php if(in_array('country-delete', $this->GroupPermission)){$showdelete = true;}elseif(in_array('country-delete-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showdelete = true;} if($showdelete == true){ ?>
            <a href="<?php echo site_url('secure/country/delete/'.$t['city_id']); ?>" class="text-danger" onclick="return confirm('Are you sure? You want to delete!')">Delete</a>
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
		
		
		function editCity(getId){
				$.ajax({
							type:'POST',
							url:'<?php echo base_url('secure/state/getCityDetail');?>',
							data:'getId='+getId,
							dataType:'json',
							success:function(response){
								//console.log(response);
								$('#city_name').val(response.founddata.city_name);
								$('#city_id').val(response.founddata.city_id);
								$('#bt').val('Update');
								$("#status option").each(function(){
									 if($(this).val() === response.founddata.status){
										$(this).prop('selected', true);
									 }	 
								});
								$("#state_id option").each(function(){
									 if($(this).val() === response.founddata.state_id){
										$(this).prop('selected', true);
									 }	 
								});
							}
					}); 
		}
		
		
</script>