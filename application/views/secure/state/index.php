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
                                            <?php echo form_open_multipart('secure/country/index', array('class'=>'form-horizontal')); ?>
                               <?php echo $this->session->flashdata('msg'); ?>            
                                           
											<div class="form-group">
                                <label class="col-lg-3 control-label">Country Name</label>
												<div class="col-lg-9">
                                <input type="text" id="country_name" class="form-control" name="country_name" placeholder="Country Name" value="<?php echo set_value('country_name'); ?>" >
                                <input type="hidden" id="country_id" class="form-control" name="country_id" >
                                <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
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
                      <th>Country Name</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                    <?php foreach($getCountry as $item) { ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $item['country_name']; ?></td>
                                        <td><?php echo ($item['status'] == 1) ? '<span class="tag tag-default tag-success">Active</span>':'<span class="tag tag-default tag-danger">Inactive</span>'; ?></td>
                                        <td>
        	<?php if(in_array('country-edit', $this->GroupPermission)){$showedit = true;}elseif(in_array('country-edit-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showedit = true;} if($showedit == true){ ?>
            <a href="<?php echo site_url('secure/country/edit/'.$t['id']); ?>" class="text-info">Edit</a>
            <?php }?>
            <?php if(in_array('country-delete', $this->GroupPermission)){$showdelete = true;}elseif(in_array('country-delete-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showdelete = true;} if($showdelete == true){ ?>
            <a href="<?php echo site_url('secure/country/delete/'.$t['id']); ?>" class="text-danger" onclick="return confirm('Are you sure? You want to delete!')">Delete</a>
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
		
		
		function editCountry(getId){
				$.ajax({
							type:'POST',
							url:'<?php echo base_url('secure/country/getCountryDetail');?>',
							data:'getId='+getId,
							dataType:'json',
							success:function(response){
								//console.log(response);
								$('#country_name').val(response.founddata.country_name);
								$('#country_id').val(response.founddata.country_id);
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