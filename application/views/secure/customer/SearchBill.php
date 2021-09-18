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
                            <?=form_open_multipart('secure/loader/searchbill');?>
								<div class="row">
                                <?php echo $this->session->flashdata('msg'); ?>
									<div class="col-md-3">
                    		        
                             <div class="form-group">
								<?php echo form_label('Loader'); ?>
                                <select class="form-control select2" name="loader_id" autofocus>
                                <option value="">Select</option>
                                <option value="-1">All</option>
                                <?php foreach($loaderList as $loader){?>
                                <option value="<?php echo $loader['id'];?>"><?php echo $loader['loader_name'];?></option>
                                <?php }?>
                                </select>
								<?php echo form_error('loader_id', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            
                              
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
								<?php echo form_label('Date From'); ?>
                                <input type="date" class="form-control" name="date_from" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('date_from');?></span>
                            </div>
                             </div> 
                             <div class="col-md-3">
                            <div class="form-group">
								<?php echo form_label('Date To'); ?>
                                <input type="date" class="form-control" name="date_to" value="<?php echo date('Y-m-d');?>" />
								<span class='text-danger'><?=form_error('date_to');?></span>
                            </div>
                             </div> 
                        <div class="col-md-3">
                               <div class="form-group">
                              
                        		<input type="submit" name="btn" value="Generate" class="btn btn-success" style="margin-top:11%"/>
                                </div>
                        </div>
                                    
								</div>
							<?=form_close();?>
								
							</div>
						</div>

</div>

</div>
