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
									<div class="pull-right">
<?php if(in_array('product-addproductPart', $this->GroupPermission)){?>
	<a href="<?php echo site_url('secure/product/addproductPart'); ?>" class="btn btn-success">Add <?=ucfirst($this->uri->segment(2));?> Part</a> 
    <?php }?>
    <br><br>
</div>
                                    <div class="col-md-12">
                                     <?php echo $this->session->flashdata('msg'); ?>    
										<fieldset>
						                	<legend class="text-semibold"> <?=ucfirst($this->uri->segment(2));?> List</legend>
											<table class="table datatable-basic">
                      <thead>
                      <th>Product Part Name</th>
                      <th>Purchage Price</th>
                      <th>Sell Price</th>
                      <th>Retailer Price</th>
                      <th>HSN Code</th>
                      <th>Stock Unit</th>
                      <th>Status</th>
                      <th>Action</th>
                      </thead>
                                        <tbody>
                                    <?php foreach($getProductList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['part_name']; ?></td>
                                        <td><?php echo $item['purchage_price']; ?></td>
                                        <td><?php echo $item['sell_price']; ?></td>
                                        <td><?php echo $item['retailer_price']; ?></td>
                                        <td><?php echo $item['hsn_code']; ?></td>
                                        <td><?php echo $item['stock_unit']; ?></td>
                                        
                                        <td><?php echo ($item['status'] == 1) ? '<span class="tag tag-default tag-success">Active</span>':'<span class="tag tag-default tag-danger">Inactive</span>'; ?></td>
                                        <td>
                                        
                                        
        	<?php if(in_array('services-edit', $this->GroupPermission)){$showedit = true;}elseif(in_array('services-edit-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showedit = true;} if($showedit == true){ ?>
            <a  class="text-info" onClick="editExpenses('<?php echo $item['id']; ?>')">Edit</a>
            <?php }?>
            <?php if(in_array('services-delete', $this->GroupPermission)){$showdelete = true;}elseif(in_array('services-delete-own', $this->GroupPermission) && $t['createdby']==$this->session->userdata('id')){$showdelete = true;} if($showdelete == true){ ?>
            <a  class="text-info" href="<?=base_url('secure/services/view/'.$item['id']);?>" target="_blank">Print</a>
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
							url:'<?php echo base_url('secure/services/getservicesDetail');?>',
							data:'getId='+getId,
							dataType:'json',
							success:function(response){
								//console.log(response);
								$('#service_name').val(response.founddata.service_name);
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