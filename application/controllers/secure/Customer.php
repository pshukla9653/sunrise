<?php
 
class Customer extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Customer_model');
		$this->load->model('secure/Countries_model');
		$this->load->library('Mycalendar');
		
    } 

    
    function index()
    {
        //$per = $this->check_permission();
		$data['title'] = 'Customer List';
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['productlist'] 	= $this->Customer_model->get_all_list('tbl_products', array('status'=>1));
		$data['servicelist'] 	= $this->Customer_model->get_all_list('tbl_services', array('id<>'=>2));
		$this->render_template('secure/customer/index', $data);
		
		//var_dump($data['customerlist']); exit;
		
		
    }
	
	public function add(){
		$status = array();												 
	  $salt = md5(rand(0000,9999));
	  $password= $this->input->post('mobile');
	  $passkey = hash("sha256", $password.$salt);
	  
	  $params1 = array(
	  'company_id' => $this->session->userdata('company_id'),
	  'branch_id' => $this->session->userdata('branch_id'),
	  'group_id' => 7,
	  'username' => $this->input->post('mobile'),
	  'salt' => $salt,
	  'passkey' => $passkey,
	  'status' => 1,
	  'createdby' => $this->session->userdata('id'),
	  'createdon' => date_timestamp_get(date_create())
	  );
												
	 $params =array(
		'company_id' 	   		 		=> $this->session->userdata('company_id'),
		'branch_id' 	   		 		=> $this->session->userdata('branch_id'),
		'customer_name' 		   		 => $this->input->post('customer_name'),
		'GSTIN' 		 			     => $this->input->post('GSTIN'),
		'mobile' 						 => $this->input->post('mobile'),
		'email' 				 		 => $this->input->post('email'),
		'alternate_mobile' 				 => $this->input->post('alternate_mobile'),
		'landline_no' 					 => $this->input->post('landline_no'),
		'address' 	   					 => $this->input->post('address'),
		'zip_code' 	   					 => $this->input->post('zip_code'),
		'country_id' 		  			 => $this->input->post('country_id'),
		'state_id' 		  				 => $this->input->post('state_id'),
		'city_id' 	   					 => $this->input->post('city_id'),
		'status'						 => 1,
		'createdby' 					 => $this->session->userdata('id'),
		'createdon' 					 => date_timestamp_get(date_create())
	 );
													//  var_dump($params);exit;
	  $user_id = $this->Customer_model->insert_data('tbl_users',$params1);
	  $params['user_id'] = $user_id;
	  
	  $insert_id = $this->Customer_model->insert_data('tbl_customer',$params);
	   if($insert_id) {
		 $update['customer_code'] = 'SAS-0'.$insert_id;
		 $update_user = $this->Customer_model->update_data('tbl_customer', array('id'=>$insert_id), $update);
		 	if($update_user){
				$status['status'] = true;
			}
			else{
				$status['status'] = false;
			}
		  }
		echo json_encode($status);	  
		 									
	}
	
	public function customerlist(){
		$data = $this->Customer_model->get_all_list('tbl_customer', array('id<>'=>0));
		$newdata =  array();
		foreach($data as $item){
			
			
			
			if(in_array('leads-show', $this->GroupPermission)){
			$showbtn = '<a onClick="showdetail('.$item['id'].')"><i class="fa fa-eye fa-1x" style="color:green; font-size:18px;"></i></a>';
			}
			if(in_array('leads-addreminder', $this->GroupPermission)){
			$addreminderbtn = '&nbsp;<a onClick="addreminder('.$item['id'].')"><i class="fa fa-phone" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-edit', $this->GroupPermission)){
			$editleadbtn = '&nbsp;<a onClick="editdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-delete', $this->GroupPermission)){
			$deleteleadbtn = '&nbsp;<a onClick="deleterow('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
			}
			if($item['status'] == 'In-side'){
				$status = '<span class="text-success">In-side</span>';
			}
			else{
				$status = '<span class="text-danger">Out-side</span>';
			}
			
			 array_push($newdata, array(
			$item['customer_name'],
			$item['customer_code'],  
			'<a href="tel:'.$item['mobile'].'">'.$item['mobile'].'</a>', 
			'<a href="tel:'.$item['alternate_mobile'].'">'.$item['alternate_mobile'].'</a>',
			$item['address'],
			$status,
			$showbtn.$addreminderbtn.$editleadbtn.$deleteleadbtn
			));
			
		}
		echo json_encode(array('data' => $newdata));
			
	}
	
	public function getdetail(){
		if($_POST['id']){
			$responce = array();
				$check_user = $this->Customer_model->get_data('tbl_customer', array('id'=>$_POST['id']));
				if($check_user['id'] ==''){
					
					$responce['status'] = false;
					
					
				}
				else{
					$country =  $this->Customer_model->get_data('tbl_countries', array('country_id'=>$check_user['country_id']));
					$state =  $this->Customer_model->get_data('tbl_states', array('state_id'=>$check_user['state_id']));
					$city =  $this->Customer_model->get_data('tbl_cities', array('city_id'=>$check_user['city_id']));
					$createdby =  $this->Customer_model->get_data('tbl_users_details', array('user_id'=>$check_user['createdby']));
					
					$c = $check_user['city_id']==''?'':', '.$city['city_name'];
					$s = $check_user['state_id']==''?'':', '.$state['state_name'];
					$co = $check_user['country_id']==''?'':', '.$country['country_name'];
					$zip = $check_user['zip_code']==''?'':'-'.$check_user['zip_code'];
					$pr = $product['product_name']==''?'Other':$product['product_name'];
					$sr = $service['service_name']==''?'Other':$service['service_name'];
					
					$address = $check_user['address'].$c.$s.$co.$zip;
					 if($check_user['status'] == 'In-side'){
						 $status = '<span class="btn btn-success">In-side</span>';
					 }
					 else{
						$status = '<span class="btn btn-danger">Out-side</span>'; 
					 }
					
					
					
					
					$data = array(
						'id'=>$check_user['id'],
						'customer_name'=>$check_user['customer_name'],
						'customer_code'=>$check_user['customer_code'],
						'mobile'=>$check_user['mobile'],
						'alternate_mobile'=>$check_user['alternate_mobile'],
						'landline_no'=>$check_user['landline_no'],
						'email'=>$check_user['email'],
						'address'=>$address,
						'status'=>$status,
						
					);
					
					
					
					$responce['status'] = true;
					$responce['data'] = $data;
				}
				echo json_encode($responce);
			}
	}
	
	public function getservicedetail(){
		if($_POST['id']){
			$responce = array();
				$check_user = $this->Customer_model->get_data('tbl_customer_product_service', array('id'=>$_POST['id']));
				if($check_user['id'] ==''){
					
					$responce['status'] = false;
					
					
				}
				else{
					
					$data = array(
						'id'=>$check_user['id'],
						'product_id'=>$check_user['product_id'],
						'service_id'=>$check_user['service_id'],
						'amc_start_date'=>$check_user['amc_start_date'],
						'amc_end_date'=>$check_user['amc_end_date'],
						'address'=>$check_user['address'],
					);
					
					
					
					$responce['status'] = true;
					$responce['data'] = $data;
				}
				echo json_encode($responce);
			}
	}
	
	
	 
	public function productlist(){
		
		if($_POST['id']){
			$data = $this->Customer_model->get_all_list('tbl_customer_product_service', array('customer_id'=>$_POST['id']));
			
			foreach($data as $item){
				$product = $this->Customer_model->get_data('tbl_products', array('id'=>$item['product_id']));
				$service = $this->Customer_model->get_data('tbl_services', array('id'=>$item['service_id']));
				$btn = '<a onClick="editproductdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
				echo '<tr>';
				echo '<td><strong>'.$product['product_name'].'</strong></td>';
				echo '<td><strong>'.$service['service_name'].'</strong></td>';
				echo '<td><strong>'.date_format(date_create($item['amc_start_date']),"d-m-Y").'</strong></td>';
				echo '<td><strong>'.date_format(date_create($item['amc_end_date']),"d-m-Y").'</strong></td>';
				echo '<td><strong>'.$item['address'].'</strong></td>';
				echo '<td><strong>'.$item['ms_dates'].'</strong></td>';
				echo '<td>'.$btn.'</td>';
				echo '</tr>';
			}
		}
		
	} 
	  
	public function getCustomerSearch(){
	$search_data = $this->input->post('customer_name');
	$result = $this->Customer_model->get_autocomplete($search_data);
	if (!empty($result))
	{
	foreach ($result as $row):
	echo "<a href='#' onClick='getDetail(". $row->id .")' ><li id='". $row->id ."' class='border border-success' style='list-style-type:none;padding:1%;display:block;background-color: #e6e6e6;' >" . $row->customer_name . "</li></a>";
	endforeach;
	}
							
	 }
	 
	public function getCustomerAllData(){
				$notFound	=	array('msg' => '', 'dataStatus' => false);
							if(!empty($_POST['getId'])){
									  $data					=	$this->Customer_model->get_customer_details($_POST['getId']);
									  if($data != ''){
										//   var_dump($data);
									  echo json_encode($data);
									  }	  
							}
	 }
	
	public function generatebill($id){
		$data['title']				= 'Customer Generate Bill';
		$data['customer'] 		= $this->Customer_model->get_customer_details($id);
		if($data['customer']['service_id'] =='1'){
			$data['amcyear'] = $this->Customer_model->get_all_list('tbl_product_amc', array('product_id'=>$data['customer']['product_id']));
		}
		$data['gst'] 	 = 	  $this->Customer_model->get_data('tbl_gst_master', array('id'=>1));
		$data['productList'] = $this->Customer_model->get_all_list('tbl_products', array('status'=>1));
		$data['productPartList'] = $this->Customer_model->get_all_list('tbl_products_part', array('status'=>1));
		$data['serviceList'] = $this->Customer_model->get_all_list('tbl_services', array('status'=>1,'id<>'=>2));
		
		$this->form_validation->set_rules('btn','Subit','required|trim');
		
		array_splice($_POST['rowdata'], 0, 0);
		 		
		//var_dump($data['customer']); exit;
		if($this->form_validation->run() == false) {
		$this->render_template('secure/customer/createbill', $data);
		}
		else{
			if($this->input->post('grand_total') =='0'){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">Total Grand Amount can not be 0.</div>');
				redirect('secure/customer/generatebill/'.$id);
			}
			
			 $invoice = array(
			 		'customer_id' => $id,
					'invoice_date' => $this->input->post('bill_date'),
					'sub_total' => $this->input->post('sub_total'),
					'total_discount' => $this->input->post('total_discount'),
					'final_sub_total' => $this->input->post('final_sub_total'),
					'gst' => $this->input->post('gst'),
					'gst_per' => $this->input->post('gst_per'),
					'gst_type' => $this->input->post('gst_type'),
					'sgst_value' => $this->input->post('sgst_value'),
					'cgst_value' => $this->input->post('cgst_value'),
					'igst_value' => $this->input->post('igst_value'),
					'total_gst' => $this->input->post('total_gst'),
					'grand_total' => $this->input->post('grand_total'),
					'total_due' => $this->input->post('grand_total'),
					'total_paid' => 0,
					'invoice_status' => 1,
					'createdon' => date_timestamp_get(date_create()),
					'createdby' 		=> $this->session->userdata('id')
			 );
			  $rowdata = $this->input->post('rowdata');
			if($this->input->post('btn') == 'Save Invoice'){
				
				 
				$insert_invovice = $this->Customer_model->insert_data('tbl_customer_invoice_old', $invoice);
				$updateInvocie['invoice_no'] = 'PRE-INV-00'.$insert_invovice;
				$update_invocie_id = $this->Customer_model->update_data('tbl_customer_invoice_old', array('id'=>$insert_invovice), $updateInvocie);
				
				
				 
				 for($i = 0; $i < count($rowdata); $i++){
					 if($rowdata[$i]['data'] == 'Product'){
						 $service = array(
						 		'customer_id'=>$id,
								'product_id'=>$rowdata[$i]['product_id'],
								'service_id'=>$rowdata[$i]['service_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'invoice_date'=>$this->input->post('bill_date'),
								'amc_duration'=>$rowdata[$i]['amc_duration'],
								'amc_start_date'=>$rowdata[$i]['amc_start_date'],
								'amc_end_date'=>$rowdata[$i]['amc_end_date'],
								'ms_duration'=>$rowdata[$i]['ms_duration'],
								'ms_no'=>$rowdata[$i]['ms_no'],
								'ms_dates'=>$rowdata[$i]['ms_dates'],
								'address'=>$rowdata[$i]['address'],
								'discount_percent'=>$rowdata[$i]['discount_percent'],
								'discount_amount'=>$rowdata[$i]['discount_amount'],
								'amount'=>$rowdata[$i]['amount'],
								'discounted_amount'=>$rowdata[$i]['discounted_amount'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						 if($service['service_id'] == '1' || $service['service_id'] == '3'){
							 $msdate = explode(', ', $service['ms_dates']);
							 	for($r=0; $r < count($msdate); $r++){
									$msrecord = array(
										'product_id'=>$service['product_id'],
										'service_id'=>$service['service_id'],
										'customer_id'=>$id,
										'invoice_id'=>$insert_invovice,
										'invoice_no'=>$updateInvocie['invoice_no'],
										'invoice_date'=>$this->input->post('bill_date'),
										'address'=>$service['address'],
										'ms_dates'=>$msdate[$r],
										'ms_status'=>1,
										'createdon' => date_timestamp_get(date_create()),
										'createdby' 		=> $this->session->userdata('id')
									);
									$insert_ms_service = $this->Customer_model->insert_data('tbl_customer_ms_service', $msrecord);
								}
							 
						 }
						 
						 
						 $insert_service = $this->Customer_model->insert_data('tbl_customer_product_service', $service);
						 
					 }
					 if($rowdata[$i]['data'] == 'Part'){
						 $service = array(
						 		'customer_id'=>$id,
								'product_id'=>$rowdata[$i]['product_id'],
								'service_id'=>$rowdata[$i]['service_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'invoice_date'=>$this->input->post('bill_date'),
								'address'=>$rowdata[$i]['address'],
								'discount_percent'=>$rowdata[$i]['discount_percent'],
								'discount_amount'=>$rowdata[$i]['discount_amount'],
								'amount'=>$rowdata[$i]['amount'],
								'discounted_amount'=>$rowdata[$i]['discounted_amount'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						
						 
						 
						 $insert_service = $this->Customer_model->insert_data('tbl_customer_product_part', $service);
						 
					 }
					 
					 
					 
					 
				 }
				 $invoce_status = $this->Customer_model->update_data('tbl_customer', array('id'=>$id), array('invoice_status'=>1));
				 if($invoce_status){
				 $this->session->set_flashdata('msg', '<div class="alert alert-success">record added!</div>');
            	redirect('secure/customer/index');
				 }
				
				
			}
			if($this->input->post('btn') == 'Generate Invoice'){
				$insert_invovice = $this->Customer_model->insert_data('tbl_customer_invoice', $invoice);
				$updateInvocie['invoice_no'] = 'INV-00'.$insert_invovice;
				$update_invocie_id = $this->Customer_model->update_data('tbl_customer_invoice', array('id'=>$insert_invovice), $updateInvocie);
				 for($i = 0; $i < count($rowdata); $i++){
					 
					 if($rowdata[$i]['data'] == 'Product'){
						 $service = array(
						 		'customer_id'=>$id,
								'product_id'=>$rowdata[$i]['product_id'],
								'service_id'=>$rowdata[$i]['service_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'invoice_date'=>$this->input->post('bill_date'),
								'amc_duration'=>$rowdata[$i]['amc_duration'],
								'amc_start_date'=>$rowdata[$i]['amc_start_date'],
								'amc_end_date'=>$rowdata[$i]['amc_end_date'],
								'ms_duration'=>$rowdata[$i]['ms_duration'],
								'ms_no'=>$rowdata[$i]['ms_no'],
								'ms_dates'=>$rowdata[$i]['ms_dates'],
								'address'=>$rowdata[$i]['address'],
								'discount_percent'=>$rowdata[$i]['discount_percent'],
								'discount_amount'=>$rowdata[$i]['discount_amount'],
								'amount'=>$rowdata[$i]['amount'],
								'discounted_amount'=>$rowdata[$i]['discounted_amount'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						 if($service['service_id'] == '1'){
							 $msdate = explode(', ', $service['ms_dates']);
							 	for($r=0; $r < count($msdate); $r++){
									$msrecord = array(
										'product_id'=>$service['product_id'],
										'service_id'=>$service['service_id'],
										'customer_id'=>$id,
										'invoice_id'=>$insert_invovice,
										'invoice_no'=>$updateInvocie['invoice_no'],
										'invoice_date'=>$this->input->post('bill_date'),
										'address'=>$service['address'],
										'ms_dates'=>$msdate[$r],
										'ms_status'=>1,
										'createdon' => date_timestamp_get(date_create()),
										'createdby' 		=> $this->session->userdata('id')
									);
									$insert_ms_service = $this->Customer_model->insert_data('tbl_customer_ms_service', $msrecord);
								}
							 
						 }
						 if($service['service_id'] == '3'){
							 $msdate = explode(', ', $service['ms_dates']);
							 	for($r=0; $r < count($msdate); $r++){
									$msrecord = array(
										'product_id'=>$service['product_id'],
										'service_id'=>$service['service_id'],
										'customer_id'=>$id,
										'invoice_id'=>$insert_invovice,
										'invoice_no'=>$updateInvocie['invoice_no'],
										'invoice_date'=>$this->input->post('bill_date'),
										'address'=>$service['address'],
										'ms_dates'=>$msdate[$r],
										'ms_status'=>1,
										'createdon' => date_timestamp_get(date_create()),
										'createdby' => $this->session->userdata('id')
									);
									$insert_ms_service = $this->Customer_model->insert_data('tbl_customer_ms_service', $msrecord);
									$product = $this->Customer_model->get_data('tbl_products', array('id'=>$service['product_id']));
									$product_unit['stock_unit'] = (int)$product['stock_unit'] - 1;
									$update_prouct = $this->Customer_model->update_data('tbl_products', array('id'=>$service['product_id']), $product_unit);
								}
							 
						 }
						 
						 
						 $insert_service = $this->Customer_model->insert_data('tbl_customer_product_service', $service);
						 
					 }
					 if($rowdata[$i]['data'] == 'Part'){
						 $service = array(
						 		'customer_id'=>$id,
								'product_id'=>$rowdata[$i]['product_id'],
								'service_id'=>$rowdata[$i]['service_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'invoice_date'=>$this->input->post('bill_date'),
								'address'=>$rowdata[$i]['address'],
								'discount_percent'=>$rowdata[$i]['discount_percent'],
								'discount_amount'=>$rowdata[$i]['discount_amount'],
								'amount'=>$rowdata[$i]['amount'],
								'discounted_amount'=>$rowdata[$i]['discounted_amount'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						
						 
						 
						 $insert_service = $this->Customer_model->insert_data('tbl_customer_product_part', $service);
						$product_part = $this->Customer_model->get_data('tbl_products_part', array('id'=>$service['product_id']));
						$product_unit_part['stock_unit'] = (int)$product_part['stock_unit'] - 1;
					$update_prouct_part = $this->Customer_model->update_data('tbl_products_part', array('id'=>$service['product_id']), $product_unit_part);
						 
					 }
					 
					 
				 }
				$invoce_status = $this->Customer_model->update_data('tbl_customer', array('id'=>$id), array('invoice_status'=>1));
				 if($invoce_status){
				 $this->session->set_flashdata('msg', '<div class="alert alert-success">record added!</div>');
            	redirect('secure/customer/index');
				 }
			}
			
		}
		
	}
	
	public function datauploadbyexcel(){
	
	$data = $this->Customer_model->get_all_list('sunrise_data', array('id>='=>1001,'id<='=>2000, 'done'=>0));
	
	//var_dump($data); exit;
			
	foreach($data as $item){
		
		$checkdata = $this->Customer_model->get_data('tbl_customer', array('mobile'=>$item['mobile']));
			//var_dump($checkdata);
				if($checkdata['id'] ==''){
					$salt = md5(rand(0000,9999));
				  $password= $item['mobile'];
				  $passkey = hash("sha256", $password.$salt);
				  
				  $params = array(
				  'company_id' => $this->session->userdata('company_id'),
				  'branch_id' => $this->session->userdata('branch_id'),
				  'group_id' => 7,
				  'username' => $item['mobile'],
				  'salt' => $salt,
				  'passkey' => $passkey,
				  'status' => 1,
				  'createdby' => $this->session->userdata('id'),
				  'createdon' => date_timestamp_get(date_create())
				  );
				  
				  
				  //var_dump($params);
				  //$id =1;
				 $id = $this->Customer_model->insert_data('tbl_users', $params);
				  if($id){
					  $customer = array(
					  	'company_id' => $this->session->userdata('company_id'),
				  		'branch_id' => $this->session->userdata('branch_id'),
				  		'user_id' => $id,
						'customer_name' => $item['customer_name'],
						'mobile' => $item['mobile'],
						'alternate_mobile' => $item['alter_no'],
						'landline_no' => $item['landline_no'],
						'email' => '',
						'address' => $item['address'],
						'country_id' => 1,
						'state_id' => 31,
						'city_id' => 1061,
						'status' => $item['Status'],
						'createdby' => $this->session->userdata('id'),
				  		'createdon' => date_timestamp_get(date_create())
				  );
					 $cust_id = $this->Customer_model->insert_data('tbl_customer', $customer);
					 //$cust_id =1;
					 //var_dump($customer);
					  if($cust_id){
						$update_cu['customer_code'] = 'SAS-0'.$cust_id;
						//var_dump($update_cu); 
						$this->Customer_model->update_data('tbl_customer', array('id'=>$cust_id), $update_cu);
					  }
				  }
					
				}
				else{
					
					$cust_id = $checkdata['id'];
					
				}
				 
				
				$date = $item['date_from']; 
				$msdate = array();
				$product    = $this->Customer_model->get_data('tbl_products', array('id'=>$item['product_id']));
				if($item['service_id'] !='4'){
					
				$mandtory_service = $product['mandtory_service'];
				$end = date("Y-m-d", strtotime('+1 years', strtotime($date)));
				$end = date("Y-m-d", strtotime('-1 day', strtotime($end)));
				
				$newmsdate = $date;
				
				do {
  					$newmsdate  = date("Y-m-d", strtotime('+'.$mandtory_service.' months', strtotime($newmsdate)));
					if($newmsdate < $end){
					$msdate[] = $newmsdate;
					}
				} while ($end > $newmsdate);
				}
				else{
					$mandtory_service = $product['mandtory_service'];
					$end = date("Y-m-d", strtotime('+6 months', strtotime($date)));
				}
				
				 $service = array(
						 		'customer_id'=>$cust_id,
								'product_id'=>$item['product_id'],
								'service_id'=>$item['service_id'],
								'invoice_id'=>0,
								'invoice_no'=>0,
								'invoice_date'=>$item['date_from'],
								'amc_duration'=>$item['amc_duration'],
								'amc_start_date'=>$date,
								'amc_end_date'=>$end,
								'ms_duration'=>$mandtory_service,
								'ms_no'=>count($msdate),
								'ms_dates'=>implode(',', $msdate),
								'address'=>$item['address'],
								'discount_percent'=>0,
								'discount_amount'=>0,
								'amount'=>0,
								'discounted_amount'=>0,
								'createdon' => date_timestamp_get(date_create()),
								'createdby' => $this->session->userdata('id')
						 );
					 
						 if($service['service_id'] == '1' || $service['service_id'] == '3'){
							 $msdate = explode(',', $service['ms_dates']);
							 //var_dump($msdate);
							 $insert_service = $this->Customer_model->insert_data('tbl_customer_product_service', $service);
							 	for($r=0; $r < count($msdate); $r++){
									$msrecord = array(
										'product_id'=>$service['product_id'],
										'service_id'=>$service['service_id'],
										'customer_id'=>$cust_id,
										'record_id'=>$insert_service,
										'invoice_id'=>0,
										'invoice_no'=>0,
										'invoice_date'=>$item['date_from'],
										'address'=>$service['address'],
										'ms_date'=>$msdate[$r],
										'ms_status'=>0,
										'createdon' => date_timestamp_get(date_create()),
										'createdby' 		=> $this->session->userdata('id')
									);
									//var_dump($msrecord);
									//var_dump('ok');
									$insert_ms_service = $this->Customer_model->insert_data('tbl_customer_ms_service', $msrecord);
								}
							 
						 }
						 
						 
						 //var_dump($service);
						 
				
				 //exit;
				$this->Customer_model->update_data('sunrise_data', array('id'=>$item['id']), array('done'=>1));
				
				
	}
		 		
		
		
		
	}
	
	public function updateamcamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['amc_duration']) && !empty($_POST['amount'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'product_id' => $_POST['product_id'],
					'amc_duration' => $_POST['amc_duration'],
				);
				
				$params['amount'] = $_POST['amount'];
				$update    = $this->Customer_model->update_data('tbl_product_amc', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function changesaleamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['amount'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'id' => $_POST['product_id'],
				);
				
				$params['sell_price'] = $_POST['amount'];
				$update    = $this->Customer_model->update_data('tbl_products', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function changeserviceamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['amount']) && !empty($_POST['service_id'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'product_id' => $_POST['product_id'],
					'service_id' => $_POST['service_id']
				);
				
				$params['amount'] = $_POST['amount'];
				$update    = $this->Customer_model->update_data('tbl_product_service', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function changepartamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['amount'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'id' => $_POST['product_id'],
				);
				
				$params['sell_price'] = $_POST['amount'];
				$update    = $this->Customer_model->update_data('tbl_products_part', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function getproductamc(){
		if(!empty($_POST['product_id'])){
			//var_dump($_POST['product_id']); exit;
				
				$query    = $this->Customer_model->get_all_list('tbl_product_amc', array('product_id'=>$_POST['product_id']));
				if($query > 0 && $query!=0){
				if($query==1){
				foreach($query as $row){ 
				echo '<option value="">Select</option>';
				echo '<option value="'.$row['id'].'">'.$row['amc_duration'].' Year</option>';
						}
					}
				else{
				echo '<option value="">Select</option>';
				foreach($query as $row){ 
				echo '<option value="'.$row['id'].'">'.$row['amc_duration'].' Year</option>';
							}
						}
					}
				}
			else{
				echo '<option value="">No AMC For This Product</option>';
				}
	}
	
	public function getproductamcdetails(){
		if(!empty($_POST['product_id']) && !empty($_POST['service_id']) && !empty($_POST['amc_duration'])){
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$amc    = $this->Customer_model->get_data('tbl_product_amc', array('id'=>$_POST['amc_duration']));
				$product    = $this->Customer_model->get_data('tbl_products', array('id'=>$_POST['product_id']));
				$mandtory_service = $product['mandtory_service'];
				$end = date("Y-m-d", strtotime('+'.$amc['amc_duration'].' years', strtotime($date)));
				$end = date("Y-m-d", strtotime('-1 day', strtotime($end)));
				
				$newmsdate = $date;
				
				do {
  					$newmsdate  = date("Y-m-d", strtotime('+'.$mandtory_service.' months', strtotime($newmsdate)));
					if($newmsdate < $end){
					$msdate[] = $newmsdate;
					}
				} while ($end > $newmsdate);
				
				$finadata = array(
								'product_id' => $product['id'],
								'service_id' => $_POST['service_id'],
								'product_name' => $product['product_name'],
								'hsn' => $product['hsn_code'],
								'service_name' => 'AMC',
								'amc_duration' => $amc['amc_duration'],
								'amount' => $amc['amount'],
								'ms_duration' => $product['mandtory_service'],
								'ms_dates' => implode(', ', $msdate),
								'ms_no' => count($msdate),
								'amc_start_date'=> $date,
								'amc_end_date'=> $end,
								'successdata'=> true
							);
				
				echo json_encode($finadata);
	}
	}
	
	public function getproductdetails(){
		if(!empty($_POST['product_id']) && !empty($_POST['service_id'])){
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$product    = $this->Customer_model->get_data('tbl_products', array('id'=>$_POST['product_id']));
				$mandtory_service = $product['mandtory_service'];
				$end = date("Y-m-d", strtotime('+1 years', strtotime($date)));
				$end = date("Y-m-d", strtotime('-1 day', strtotime($end)));
				
				$newmsdate = $date;
				
				do {
  					$newmsdate  = date("Y-m-d", strtotime('+'.$mandtory_service.' months', strtotime($newmsdate)));
					if($newmsdate < $end){
					$msdate[] = $newmsdate;
					}
				} while ($end > $newmsdate);
				
				$finadata = array(
								'product_id' => $product['id'],
								'service_id' => $_POST['service_id'],
								'product_name' => $product['product_name'],
								'hsn' => $product['hsn_code'],
								'amc_duration' => '1',
								'amount' => $product['sell_price'],
								'ms_duration' => $product['mandtory_service'],
								'ms_dates' => implode(', ', $msdate),
								'ms_no' => count($msdate),
								'amc_start_date'=> $date,
								'amc_end_date'=> $end,
								'successdata'=> true
							);
				
				echo json_encode($finadata);
	}
	}
	
	public function getotherservicedetails(){
		if(!empty($_POST['product_id']) && !empty($_POST['service_id'])){
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$product    = $this->Customer_model->get_data('tbl_products', array('id'=>$_POST['product_id']));
				$service_details    = $this->Customer_model->get_data('tbl_services', array('id'=>$_POST['service_id']));
				$service    = $this->Customer_model->get_data('tbl_product_service', array('product_id'=>$_POST['product_id'],'service_id'=>$_POST['service_id']));
				$mandtory_service = $product['mandtory_service'];
				$end = date("Y-m-d", strtotime('+1 years', strtotime($date)));
				
				
				$newmsdate = $date;
				
				do {
  					$newmsdate  = date("Y-m-d", strtotime('+'.$mandtory_service.' months', strtotime($newmsdate)));
					if($newmsdate !== $end){
					$msdate[] = $newmsdate;
					}
				} while ($end > $newmsdate);
				
				$finadata = array(
								'product_id' => $product['id'],
								'service_id' => $_POST['service_id'],
								'product_name' => $product['product_name'],
								'service_name' => $service_details['service_name'],
								'hsn' => $product['hsn_code'],
								'amount' => $service['amount'],
								'amc_start_date'=> $date,
								'amc_end_date'=> $end,
								'successdata'=> true
							);
				
				echo json_encode($finadata);
	}
	}
	
	public function getproductpartdetail(){
		if(!empty($_POST['product_part_id'])){
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$product    = $this->Customer_model->get_data('tbl_products_part', array('id'=>$_POST['product_part_id']));
				
				
				$finadata = array(
								'product_part_id' => $product['id'],
								'part_name' => $product['part_name'],
								'hsn' => $product['hsn_code'],
								'amount' => $product['sell_price'],
								'date'=> $_POST['bill_date'],
								'successdata'=> true
							);
				
				echo json_encode($finadata);
	}
	}
	
	public function invoiceList(){
		$data['invoiceList'] = $this->Customer_model->get_invoice_list();
		///var_dump($data['invoiceList']); exit;
		$this->render_template('secure/customer/invoiceList', $data);
	}
	
	public function oldinvoiceList(){
		$data['invoiceList'] = $this->Customer_model->get_oldinvoice_list();
		///var_dump($data['invoiceList']); exit;
		$this->render_template('secure/customer/invoiceList', $data);
	}
	
	public function product_service_list(){
		$data['invoiceList'] = $this->Customer_model->get_product_service_list();
		//var_dump($data['invoiceList']); exit;
		$this->render_template('secure/customer/productserviceList', $data);
	}
	
	public function print_bill($id){
			$data['billdata'] = $this->Customer_model->get_data('tbl_customer_invoice', array('id'=>$id));
			$data['productlist'] = $this->Customer_model->get_all_list('tbl_customer_product_service', array('invoice_id'=>$data['billdata']['id']));
			$data['productpartlist'] = $this->Customer_model->get_all_list('tbl_customer_product_part', array('invoice_id'=>$data['billdata']['id']));
			$data['customer_data'] =  $this->Customer_model->get_data('tbl_customer', array('id'=>$data['billdata']['customer_id']));
			$data['gst'] =  $this->Customer_model->get_data('tbl_gst_master', array('id'=>3));
			
			
			//var_dump($data);
			$this->render_template('secure/customer/print_bill', $data);

	}
	
	
}
