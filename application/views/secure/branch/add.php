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
										<h5 class="panel-title"><?=ucfirst($this->uri->segment(2));?></h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									</div>

<div class="panel-body">
<?php echo form_open_multipart('secure/branch/add', array('class'=>'form-horizontal')); ?>

	<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Add</h5>
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
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-truck position-left"></i> Main details</legend>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Company Name:</label>
												<div class="col-lg-9">
													<select class="form-control" name="company_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($companylist as $g){ ?>
                                                    <option value="<?=$g['id'];?>" <?=set_select('company_id', $g['id']);?>><?=$g['company_name'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('company_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Branch Admin:</label>
												<div class="col-lg-9">
													<select class="form-control" name="user_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($Userslist as $g){ ?>
                                                    <option value="<?=$g['id'];?>" <?=set_select('user_id', $g['id']);?>><?=$g['name'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('user_id');?></span>
												</div>
											</div>
											<div class="form-group">
                                <label class="col-lg-3 control-label">Branch Name</label>
												<div class="col-lg-9">
                                <input type="text" id="title" class="form-control" name="branch_name" placeholder="Branch Name" value="<?=set_value('branch_name');?>"/>
                                <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
								</div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Phone</label>
												<div class="col-lg-9">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?=set_value('phone');?>"/>
                                 <span class="text-danger"><?php echo form_error('phone'); ?></span>
                            </div></div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Email</label>
												<div class="col-lg-9">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?=set_value('email');?>"/>
                                 <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div></div>
                            
                            
                            
                            
                           
										</fieldset>
									</div>
                                    <div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="icon-truck position-left"></i> Shipping details</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">Address:</label>
												<div class="col-lg-9">
													<textarea rows="5" cols="5" class="form-control" placeholder="Street Address"  name="address"><?=set_value('address');?></textarea>
													<span class="text-danger"><?=form_error('address');?></span>
                                                </div>
                                                
											</div>
                                           

											<div class="form-group">
												<label class="col-lg-3 control-label">Country:</label>
												<div class="col-lg-9">
													<select class="form-control" name="country_id" id="country_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($countrieslist as $c){ ?>
                                                    <option value="<?=$c['country_id'];?>" ><?=$c['country_name'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('country_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">State:</label>
												<div class="col-lg-9">
													<select class="form-control" name="state_id" id="state_id">
                                                    </select>
                                                    <span class="text-danger"><?=form_error('state_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">City:</label>
												<div class="col-lg-9">
													<select class="form-control" name="city_id" id="city_id">
                                                   
                                                    
                                                    </select>
                                                    <span class="text-danger"><?=form_error('city_id');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">PIN Code:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="000000" class="form-control" name="pincode" <?=set_value('pincode');?>>
                                                    <span class="text-danger"><?=form_error('pincode');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Status:</label>
												<div class="col-lg-9">
													<select class="form-control" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('status');?></span>
												</div>
											</div>
										</fieldset>
									</div>
								</div>

								<div class="text-right">
									<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
								</div>
							</div>
						</div>

<?php echo form_close(); ?>


</div>
                        
                        
	
</div></div>

</div>
</div>