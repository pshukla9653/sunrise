
<!-- Start main content -->
	<main>
		<!-- Start Contact -->
		<section id="mu-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
								<div class="col-md-12">
									<div class="mu-title">
										<h2>Track Your Shipment</h2>
										<p>Enter Your AWB Number For Tracking.</p>
									</div>
								</div>
							</div>
					</div>
				</div>
				 <div class="row">
                 <?php for($i=0; $i < count($awbdetail); $i++){
					 if($awbdetail[$i] == false){?>
                     <div class="col-md-12">
                     <h4 class="text-danger">No Records found for <?=$awbcode[$i];?></h4>
                     </div>
                	<?php }else{
						 $shippemtdetail = $this->Web_model->get_all_list('tbl_shippment_trans', array('shippment_id'=>$awbdetail[$i]['id']));
						
						 ?>
						<div class="col-md-12">
                        Details for <?php echo $awbcode[$i];?>
							<table class="table">
								<thead>
								<th>Awbcode No</th>
								<th>Description</th>
								<th>Status</th>
								<th>Date &amp; Time</th>
								</thead>
									<tbody>
											<?php foreach($shippemtdetail as $item):?>
												<tr>
													<td><?php echo $awbcode[$i];?></td>
													<td><?php 
														if($item['status'] == 'Reached'){
														$branch = $this->Web_model->get_branch_details($awbdetail[$i]['branch_id']);
														//var_dump($branch);
														echo 'Reached at '.$branch['branch_name'].' Hub, '.$branch['address'].', '.$branch['city_name'];
														}
														elseif($item['status'] == 'Out for delivery'){
														$user = $this->Web_model->get_user('tbl_users.mobile,tbl_users_details.name', $awbdetail[$i]['emp_id']);
														//var_dump($branch);
														echo 'Out for delivery by '.$user['name'].' ('.$user['mobile'].')';
														}
														else{ echo $item['description'];}?></td>
													<td>
														<?=$item['status'];?>
                                                        <?php if($item['status']=='Delivered' && $awbdetail[$i]['reciving']!=''){?>
                                                        <a style="color:#0D468A" href="<?=base_url('uploads/reciving/'.$awbdetail[$i]['reciving']);?>" target="_blank">Show Reciving</a>
                                                        <?php }?>
													</td>
													<td>
															<?php 
															$tieee = $item['createdon'] + 19800;
															echo gmdate("d-m-Y H:i:s ", $tieee);
														?>
													</td>
												</tr>
											<?php endforeach;?>
									</tbody>
							</table>
						</div>
                        <?php } }?>
				</div>
			</div>
		</section>
		<!-- End Contact -->

		

	</main>
	
	<!-- End main content -->
	<script>
		window.setTimeout(function () {
			$(".alert-success").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    	window.setTimeout(function () {
			$(".alert-info").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 3000);
		window.setTimeout(function () {
			$(".alert-danger").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    
		window.setTimeout(function () {
			$(".alert-warning").fadeTo(300, 0).slideUp(300, function () {
				$(this).remove();
			});
		}, 10000);
    $('[data-rel="chosen"],[rel="chosen"]').chosen();
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			  checkboxClass: 'icheckbox_minimal-blue',
			  radioClass: 'iradio_minimal-blue'
			});
    </script>



