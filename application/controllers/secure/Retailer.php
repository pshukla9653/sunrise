<?php
 
class Retailer extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Retailer_model');
		$this->load->model('secure/Countries_model');
		$this->load->library('Mycalendar');
		
    } 

    
    function index()
    {
        //$per = $this->check_permission();
		$data['title'] = 'Retailer List';
		$data['retailerlist'] = $this->Retailer_model->get_all_list('tbl_retailer', array('company_id' => $this->session->userdata('company_id'),'branch_id' => $this->session->userdata('branch_id')));;
		$this->render_template('secure/retailer/index', $data);
		
		
		
		
    }
	
	public function add(){
		 //$per = $this->check_permission();		 is_unique
						$data['title']		= 	'Add Retailer';
						$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
						$this->form_validation->set_rules('retailer_name','Retailer Name ','required|trim');
						$this->form_validation->set_rules('Contact_person_name','Contact Person Name ','required|trim');
						$this->form_validation->set_rules('Contact_person_mobile','Contact Person Mobile ','required|trim');
						 if($this->input->post('submit') == 'Submit')
						{
						$this->form_validation->set_rules('GSTIN','GSTIN','trim|is_unique[tbl_retailer.GSTIN]');
						}
						$this->form_validation->set_rules('country_id','Country','required|trim');
						$this->form_validation->set_rules('state_id','State','required|trim');
						$this->form_validation->set_rules('city_id','City','required|trim');
						if($this->form_validation->run() == false) {
									$this->render_template('secure/retailer/add', $data);
								    }else{
												 if($this->input->post('submit') == 'Submit')
												 {
												$salt = md5(rand(0000,9999));
												$password= hash("sha256", date_timestamp_get(date_create()).$salt);
            									$params1 = array(
												'company_id' 	   		 		=> $this->session->userdata('company_id'),
												'branch_id' 	   		 		=> $this->session->userdata('branch_id'),
												'group_id' => 6,
												'username' => date_timestamp_get(date_create()),
												'salt' => $salt,
												'passkey' => $password,
												'status' => 1,
												'createdby' => $this->session->userdata('id'),
												'createdon' => date_timestamp_get(date_create())
            									);
													 $params =array(
													 	'company_id' 	   		 		=> $this->session->userdata('company_id'),
														'branch_id' 	   		 		=> $this->session->userdata('branch_id'),
														'retailer_name' 		   		     => $this->input->post('retailer_name'),
														'reg_no' 		    		     => $this->input->post('reg_no'),
														'GSTIN' 		 			     => $this->input->post('GSTIN'),
														'Contact_person_name' 	 	     => $this->input->post('Contact_person_name'),
														'Contact_person_mobile' 		 => $this->input->post('Contact_person_mobile'),
														'address' 	   					 => $this->input->post('address'),
														'zip_code' 	   					 => $this->input->post('zip_code'),
														'country_id' 		  			 => $this->input->post('country_id'),
														'state_id' 		  				 => $this->input->post('state_id'),
														'city_id' 	   					 => $this->input->post('city_id'),
														'gst'							 => implode(',', $this->input->post('gst')),
														'pan_no'						=> $this->input->post('pan_no'),
														'hsn_sac_no'					=> $this->input->post('hsn_sac_no'),
														'status'						 => $this->input->post('status'),
														'createdby' 					 => $this->session->userdata('id'),
														'createdon' 					 => date_timestamp_get(date_create())
													 );
													//  var_dump($params);exit;
													$user_id = $this->Retailer_model->insert_data('tbl_users',$params1);
													$params['user_id'] = $user_id;
													$insert_id = $this->Retailer_model->insert_data('tbl_retailer',$params);
													 if($insert_id) {
																 			 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
																			 redirect('secure/retailer/add');
																    }
																	else {
																		$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
																		redirect('secure/retailer/add');			
																	}
												
												}
												if($this->input->post('submit') == 'Update')
												 {
													//echo var_dump($_POST); exit;
													 $params =array(
														'retailer_name' 		   		     => $this->input->post('retailer_name'),
														'reg_no' 		    		     => $this->input->post('reg_no'),
														'GSTIN' 		 			     => $this->input->post('GSTIN'),
														'Contact_person_name' 	 	     => $this->input->post('Contact_person_name'),
														'Contact_person_mobile' 		 => $this->input->post('Contact_person_mobile'),
														'address' 	   					 => $this->input->post('address'),
														'zip_code' 	   					 => $this->input->post('zip_code'),
														'country_id' 		  			 => $this->input->post('country_id'),
														'state_id' 		  				 => $this->input->post('state_id'),
														'city_id' 	   					 => $this->input->post('city_id'),
														'gst'							 => implode(',', $this->input->post('gst')),
														'pan_no'						=> $this->input->post('pan_no'),
														'hsn_sac_no'					=> $this->input->post('hsn_sac_no'),
														'status'						 => $this->input->post('status'),
														
													 );
													 
													 			$params['updatedby']	=	$this->session->userdata('id');
																$params['updatedon']	=	date_timestamp_get(date_create());
														 		$insert_c_id = $this->Retailer_model->update_data('tbl_retailer', array('id'=>$this->input->post('hideid')),$params);
														  		if($insert_c_id) {
																	 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
																	redirect('secure/retailer/add');
																}else {
																		$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
																		redirect('secure/retailer/add');			
																	}
												
												}
										  }
					
				 
	  }
	  
	public function sell(){
		$data['title']				= 'Sell Bill';
		$data['retailerList'] 		= $this->Retailer_model->get_all_list('tbl_retailer', array('status'=>1));
		$data['gst'] 	 = 	  $this->Retailer_model->get_data('tbl_gst_master', array('id'=>1));
		$data['productList'] = $this->Retailer_model->get_all_list('tbl_products', array('status'=>1));
		$data['productPartList'] = $this->Retailer_model->get_all_list('tbl_products_part', array('status'=>1));
		
		$this->form_validation->set_rules('btn','Subit','required|trim');
		
		array_splice($_POST['rowdata'], 0, 0);
		 		
		//var_dump($data['customer']); exit;
		if($this->form_validation->run() == false) {
		$this->render_template('secure/retailer/createbill', $data);
		}
		else{
			if($this->input->post('grand_total') =='0'){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">Total Grand Amount can not be 0.</div>');
				redirect('secure/retailer/sell');
			}
			///var_dump($_POST); exit;
			 $invoice = array(
					'retailer_id' => $this->input->post('retailer_id'),
					'bill_no' => $this->input->post('bill_no'),
					'bill_date' => $this->input->post('bill_date'),
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
					'bill_status' => 1,
					'createdon' => date_timestamp_get(date_create()),
					'createdby' 		=> $this->session->userdata('id')
			 );
			  $rowdata = $this->input->post('rowdata');
			
			if($this->input->post('btn') == 'Generate Bill'){
				$insert_invovice = $this->Retailer_model->insert_data('tbl_vender_bill', $invoice);
				$updateInvocie['invoice_no'] = 'BILL-00'.$insert_invovice;
				$update_invocie_id = $this->Retailer_model->update_data('tbl_vender_bill', array('id'=>$insert_invovice), $updateInvocie);
				 for($i = 0; $i < count($rowdata); $i++){
					 
					 if($rowdata[$i]['data'] == 'Product'){
						 $service = array(
								'product_id'=>$rowdata[$i]['product_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'bill_no'=>$this->input->post('bill_no'),
								'bill_date'=>$this->input->post('bill_date'),
								'unit'=>$rowdata[$i]['unit'],
								'purchage_price'=>$rowdata[$i]['purchage_price'],
								'retailer_price'=>$rowdata[$i]['retailer_price'],
								'total_purchase_price'=>$rowdata[$i]['total_purchase_price'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						
						 
						 
						$insert_service = $this->Retailer_model->insert_data('tbl_vendor_product', $service);
						$product_part = $this->Retailer_model->get_data('tbl_products', array('id'=>$service['product_id']));
						$product_unit_part['stock_unit'] = (int)$product_part['stock_unit'] + (int)$service['unit'];
						$update_prouct_part = $this->Retailer_model->update_data('tbl_products', array('id'=>$service['product_id']), $product_unit_part);
						 
					 }
					 if($rowdata[$i]['data'] == 'Part'){
						 $service = array(
								'product_id'=>$rowdata[$i]['product_part_id'],
								'invoice_id'=>$insert_invovice,
								'invoice_no'=>$updateInvocie['invoice_no'],
								'bill_no'=>$this->input->post('bill_no'),
								'bill_date'=>$this->input->post('bill_date'),
								'unit'=>$rowdata[$i]['unit'],
								'purchage_price'=>$rowdata[$i]['purchage_price'],
								'retailer_price'=>$rowdata[$i]['retailer_price'],
								'total_purchase_price'=>$rowdata[$i]['total_purchase_price'],
								'createdon' => date_timestamp_get(date_create()),
								'createdby' 		=> $this->session->userdata('id')
						 );
						
						 
						 
						$insert_service = $this->Retailer_model->insert_data('tbl_vendor_product_part', $service);
						$product_part = $this->Retailer_model->get_data('tbl_products_part', array('id'=>$service['product_id']));
						$product_unit_part['stock_unit'] = (int)$product_part['stock_unit'] - (int)$service['unit'];
						$update_prouct_part = $this->Retailer_model->update_data('tbl_products_part', array('id'=>$service['product_id']), $product_unit_part);
						 
					 }
					 
					 
				 }
				$invoce_status = $this->Retailer_model->update_data('tbl_vender_bill', array('id'=>$id), array('bill_status'=>1));
				 if($invoce_status){
				 $this->session->set_flashdata('msg', '<div class="alert alert-success">Record added!</div>');
            	  redirect('secure/retailer/billList');
				 }
			}
			
		}
		
	} 
	
	public function changeproductamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['price']) && !empty($_POST['retailer_price'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'id' => $_POST['product_id'],
				);
				
				$params['retailer_price'] = $_POST['retailer_price'];
				$params['purchage_price'] = $_POST['price'];
				$update    = $this->Retailer_model->update_data('tbl_products', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function changeproductpartamount(){
		if(!empty($_POST['product_id']) && !empty($_POST['price']) && !empty($_POST['retailer_price'])){
			//var_dump($_POST['product_id']); exit;
				$where = array(
					'id' => $_POST['product_id'],
				);
				
				$params['retailer_price'] = $_POST['retailer_price'];
				$params['purchage_price'] = $_POST['price'];
				$update    = $this->Retailer_model->update_data('tbl_products_part', $where, $params);
				$finadata = array('dataupdate'=>'Yes','status'=>$update);
				echo json_encode($finadata);
				}
			
	}
	
	public function getproductdetails(){
		if(!empty($_POST['product_id'])){
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$product    = $this->Retailer_model->get_data('tbl_products', array('id'=>$_POST['product_id']));
				
				$finadata = array(
								'product_id' => $product['id'],
								'product_name' => $product['product_name'],
								'purchage_price' => $product['purchage_price'],
								'retailer_price' => $product['retailer_price'],
								'stock_unit' => $product['stock_unit'],
								'successdata'=> true
							);
				
				echo json_encode($finadata);
				
				
	}
	}
	
	public function getproductpartdetail(){
		if(!empty($_POST['product_part_id'])){ 
			//var_dump($_POST['product_id']); exit;
				$date = $_POST['bill_date']; 
				$product    = $this->Retailer_model->get_data('tbl_products_part', array('id'=>$_POST['product_part_id']));
				
				
				$finadata = array(
								'product_part_id' => $product['id'],
								'part_name' => $product['part_name'],
								'purchage_price' => $product['purchage_price'],
								'retailer_price' => $product['retailer_price'],
								'stock_unit' => $product['stock_unit'],
								'successdata'=> true
							);
				
				echo json_encode($finadata);
	}
	}
	
	public function billList(){
		$data['billList'] = $this->Retailer_model->get_bill_list();
		///var_dump($data['billList']); exit;
		$this->render_template('secure/vendor/invoiceList', $data);
	}
}
