<style>

.form-control {
 
  width: auto;
}
  </style>
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
<?php echo form_open_multipart('secure/setting/GSTMaster', array('class'=>'form-horizontal')); ?>
<?php echo $this->session->flashdata('msg'); ?>
	<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Update GST</h5>
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
										<table width="100%" cellpadding="10" cellspacing="10" style="padding:20px">
                             <tr>
                             <td> GST Percent For Client</td>
                              <td> 
                              <div class="form-group">
								<?php echo form_label('CGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['cgst'], 'placeholder'=>'CGST', 'name' => 'cgst[1]','autofocus'=>'autofocus')); ?>
								<?php echo form_error('cgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                               <td>
                               <div class="form-group">
								<?php echo form_label('SGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['sgst'], 'placeholder'=>'SGST', 'name' => 'sgst[1]')); ?>
								<?php echo form_error('sgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                                <td>
                                <div class="form-group">
								<?php echo form_label('IGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[0]['igst'], 'placeholder'=>'IGST', 'name' => 'igst[1]')); ?>
								<?php echo form_error('igst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                                </td>
                                 
                             </tr>
                             <tr>
                             <td> GST Percent For Agent <span class="btn btn-info">(IN)</span></td>
                              <td> 
                              <div class="form-group">
								<?php echo form_label('CGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[1]['cgst'], 'placeholder'=>'CGST', 'name' => 'cgst[2]')); ?>
								<?php echo form_error('cgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                               <td>
                               <div class="form-group">
								<?php echo form_label('SGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[1]['sgst'], 'placeholder'=>'SGST', 'name' => 'sgst[2]')); ?>
								<?php echo form_error('sgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                                <td>
                                <div class="form-group">
								<?php echo form_label('IGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[1]['igst'], 'placeholder'=>'IGST', 'name' => 'igst[2]')); ?>
								<?php echo form_error('igst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                                </td>
                                 
                             </tr>
                             <tr>
                              <td> GST Percent For Agent <span class="btn btn-info">(OUT)</span></td>
                              <td> 
                              <div class="form-group">
								<?php echo form_label('CGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[2]['cgst'], 'placeholder'=>'CGST', 'name' => 'cgst[3]')); ?>
								<?php echo form_error('cgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                               <td>
                               <div class="form-group">
								<?php echo form_label('SGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[2]['sgst'], 'placeholder'=>'SGST', 'name' => 'sgst[3]')); ?>
								<?php echo form_error('sgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                                <td>
                                <div class="form-group">
								<?php echo form_label('IGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[2]['igst'], 'placeholder'=>'IGST', 'name' => 'igst[3]')); ?>
								<?php echo form_error('igst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                                </td>
                                 
                             </tr>
                             <tr>
                              <td> GST Percent For Loader</td>
                              <td> 
                              <div class="form-group">
								<?php echo form_label('CGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[3]['cgst'], 'placeholder'=>'CGST', 'name' => 'cgst[4]')); ?>
								<?php echo form_error('cgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                               <td>
                               <div class="form-group">
								<?php echo form_label('SGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[3]['sgst'], 'placeholder'=>'SGST', 'name' => 'sgst[4]')); ?>
								<?php echo form_error('sgst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                            </td>
                                <td>
                                <div class="form-group">
								<?php echo form_label('IGST'); ?>
                                <?php echo form_input(array('class'=>'form-control', 'value'=>$editSGT[3]['igst'], 'placeholder'=>'IGST', 'name' => 'igst[4]')); ?>
								<?php echo form_error('igst', '<p class="text-danger">', '</p>'); ?>
                            </div>
                                </td>
                                 
                             </tr>
                             </table>
									</div>
								</div>

								<div class="text-right">
									<input type="submit" class="btn btn-primary" name="btn" value="Update">
								</div>
							</div>
						</div>

<?php echo form_close(); ?>


</div>
                        
                        
	
</div></div>

</div>
</div>