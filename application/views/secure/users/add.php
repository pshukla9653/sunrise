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
<?=form_open_multipart('secure/users/add', array('class'=>'form-horizontal')); ?>

	<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Add User</h5>
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
											<legend class="text-semibold"><i class="icon-reading position-left"></i> Personal details</legend>
											<div class="form-group">
												<label class="col-lg-3 control-label">User Group:</label>
												<div class="col-lg-9">
													<select class="form-control" name="group_id">
                                                    <option value="">Select</option>
                                                    <?php foreach($grouplist as $g){ ?>
                                                    <option value="<?=$g['id'];?>" <?=set_select('group_id', $g['id']);?>><?=$g['group_title'];?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?=form_error('group_id');?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Enter Full Name:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Full Name" name="name" value="<?=set_value('name');?>">
                                                    <span class="text-danger"><?=form_error('name');?></span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 control-label">Enter Username:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="Username" name="username" value="<?=set_value('username');?>">
                                                    <span class="text-danger"><?=form_error('username');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Enter Password:</label>
												<div class="col-lg-9">
													<input type="text" class="form-control" placeholder="********" name="password" value="<?=set_value('password');?>">
                                                    <span class="text-danger"><?=form_error('password');?></span>
												</div>
											</div>
                                            <div class="form-group">
												<label class="col-lg-3 control-label">Email:</label>
												<div class="col-lg-9">
													<input type="email" placeholder="example@domain.com" class="form-control" name="email" value="<?=set_value('email');?>">
                                                    <span class="text-danger"><?=form_error('email');?></span>
												</div>
											</div>
												<div class="form-group">
												<label class="col-lg-3 control-label">Mobile:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="+91-99-9999-9999" class="form-control" name="mobile" value="<?=set_value('mobile');?>">
                                                    <span class="text-danger"><?=form_error('mobile');?></span>
												</div>
											</div>
                                           
											<div class="form-group">
											<label class="col-lg-3 control-label">Gender:</label>
											<div class="col-lg-9">
												<label class="radio-inline">
													<input type="radio" class="styled" name="gender" <?= set_radio('gender', 'Male', TRUE); ?> value="Male">
													Male
												</label>
												<label class="radio-inline">
													<input type="radio" class="styled" name="gender" value="Female" <?=set_radio('gender', 'Female'); ?>>
													Female
												</label>
                                                <span class="text-danger"><?=form_error('gender');?></span>
											</div>
										</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Date of Birth:</label>
												<div class="col-lg-9">
													<input type="date" class="form-control" name="date_of_birth" <?=set_value('date_of_birth');?>>
                                                    <span class="text-danger"><?=form_error('date_of_birth');?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-3 control-label">Profile Picture:</label>
												<div class="col-lg-9">
													<input type="file" class="file-styled" name="profile_photo">
												</div>
                                                 <span class="text-danger"><?=form_error('profile_photo');?></span>
											</div>

											
										</fieldset>
									</div>

									<div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="icon-truck position-left"></i> Shipping details</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">Address:</label>
												<div class="col-lg-9">
													<textarea rows="5" cols="5" class="form-control" placeholder="Street Address"  name="address"><?=set_value('address');?></textarea>
												</div>
                                                <span class="text-danger"><?=form_error('address');?></span>
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
													<input type="text" placeholder="000000" class="form-control" name="zip_code" <?=set_value('zip_code');?>>
                                                    <span class="text-danger"><?=form_error('zip_code');?></span>
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

<?=form_close();?>


</div>

</div>

</div>
</div>
