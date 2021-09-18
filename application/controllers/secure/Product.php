<?php
 
class Product extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Product_model');
		$this->load->model('secure/Group_model');
		$this->load->library('Mycalendar');
		
    } 

    /*
     * Listing of Countries
     */
    public function index()
    {
       // $per = $this->check_permission();
				$data = array();
			    $data['title']		= 'Prodct List';
			   
		
			  
			   $data['getProductList'] 	 = 	  $this->Product_model->get_all_list('tbl_products', array('company_id' => $this->session->userdata('company_id')));
				 
				///var_dump($data['getProductList']); exit;
				$this->render_template('secure/product/index', $data);
		
		
		
    }
	
	public function add()
    {
        //$per = $this->check_permission();
		$data = array();
			    $data['title']		= 'ADD | Product';
			   
		
			   $this->form_validation->set_rules("product_name", "Product Name", "trim|required|is_unique[tbl_products.product_name]");
			   $this->form_validation->set_rules("purchage_price", "Purchage Price", "trim|required");
			   $this->form_validation->set_rules("sell_price", "Sell Price", "trim|required");
			   $this->form_validation->set_rules("retailer_price", "Retailer Price", "trim|required");
			   $this->form_validation->set_rules("stock_unit", "Stock Unit", "trim|required");
			   
			  $data['grouplist'] 		= $this->Group_model->get_all_grouplist();
			  $data['servicelist'] 		= $this->Product_model->get_all_list('tbl_services', array('status'=>1,'id>'=>3));
				  //echo '<pre>';var_dump($data['getsubService'][1]['subservicename'] );exit;
				   if ($this->form_validation->run() == FALSE) {
					   $this->render_template('secure/product/add', $data);
					}
				   else
				   {
					   if($this->input->post("btn")  == 'Submit')
					   { //var_dump($_POST); exit;
								$product =array(
									'company_id' 	   		=> $this->session->userdata('company_id'),
									'product_name' 	   		=> $this->input->post('product_name'),
									'purchage_price'		=> $this->input->post('purchage_price'),
									'sell_price'			=> $this->input->post('sell_price'),
									'retailer_price'		=> $this->input->post('retailer_price'),
									'stock_unit'			=> $this->input->post('stock_unit'),
									'hsn_code'			   	=> $this->input->post('hsn_code'),
									'amc_duration'			=> $this->input->post('amc_duration'),
									'mandtory_service'		=> $this->input->post('mandtory_service'),
									'status'			   	=> $this->input->post('status'),
									'createdby' 			=> $this->session->userdata('id'),
									'createdon' 			=> date_timestamp_get(date_create())
							   );
							  
								$insert_id = $this->Product_model->insert_data('tbl_products', $product);
								  if($insert_id) {
									 
									  foreach($_POST['amc'] as $sk=>$sv){
										  if($sv !=''){
										  $amc['product_id'] = $insert_id;
										  $amc['amc_duration'] = $sk;
										  $amc['amount'] = $sv;
										  
										  $this->Product_model->insert_data('tbl_product_amc', $amc);
										  }
									  }
									  foreach($_POST['service'] as $sk=>$sv){
										  if($sv !=''){
										  $service['product_id'] = $insert_id;
										  $service['service_id'] = $sk;
										  $service['amount'] = $sv;
										  $this->Product_model->insert_data('tbl_product_service', $service);
										  }
									  }
									  
									  
									  
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
												redirect('secure/product/index');	
									}
									else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/product/add');			
										 }
							
					   }
					   
					   
				   }
		
		
		
		
    }
	
	
	public function productPartList()
    {
       // $per = $this->check_permission();
				$data = array();
			    $data['title']		= 'Prodct List';
			   
		
			  
			   $data['getProductList'] 	 = 	  $this->Product_model->get_all_list('tbl_products_part', array('company_id' => $this->session->userdata('company_id')));
				 
				///var_dump($data['getProductList']); exit;
				$this->render_template('secure/product/productPartlist', $data);
		
		
		
    }
	
	public function addproductPart()
    {
        //$per = $this->check_permission();
		$data = array();
			    $data['title']		= 'ADD | Product';
			   
		
			   $this->form_validation->set_rules("part_name", "Product Part Name", "trim|required|is_unique[tbl_products_part.part_name]");
			   $this->form_validation->set_rules("purchage_price", "Purchage Price", "trim|required");
			   $this->form_validation->set_rules("sell_price", "Sell Price", "trim|required");
			   $this->form_validation->set_rules("retailer_price", "Retailer Price", "trim|required");
			   $this->form_validation->set_rules("stock_unit", "Stock Unit", "trim|required");
			   
			  
				  //echo '<pre>';var_dump($data['getsubService'][1]['subservicename'] );exit;
				   if ($this->form_validation->run() == FALSE) {
					   $this->render_template('secure/product/addproductPart', $data);
					}
				   else
				   {
					   if($this->input->post("btn")  == 'Submit')
					   { //var_dump($_POST); exit;
								$product =array(
								'company_id' 	   		 		=> $this->session->userdata('company_id'),
									'part_name' 	   			 => $this->input->post('part_name'),
									'purchage_price'			   		 => $this->input->post('purchage_price'),
									'sell_price'			   		 => $this->input->post('sell_price'),
									'retailer_price'			   		 => $this->input->post('retailer_price'),
									'stock_unit'			   		 => $this->input->post('stock_unit'),
									'hsn_code'			   		 => $this->input->post('hsn_code'),
									'status'			   		 => $this->input->post('status'),
									'createdby' 				 => $this->session->userdata('id'),
									'createdon' 				 => date_timestamp_get(date_create())
							   );
							  
								$insert_id = $this->Product_model->insert_data('tbl_products_part', $product);
								  if($insert_id) {
									 
									  
									  
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
												redirect('secure/product/productPartList');	
									}
									else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/product/addproductPart');			
										 }
							
					   }
					   
					   
				   }
		
		
		
		
    }
	
	public function getservicesDetail() {
		
			      $data = array('success' => false, 'messages' => array(),'founddata' => "");
				   if(!empty($_POST['getId'])){
						$datafound =  $this->Product_model->get_data('tbl_services', array('id'=>$_POST['getId']));
						if($datafound != ''){
							$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    public function view($id){
		$data['expense'] =  $this->Product_model->get_data('tbl_services', array('id'=>$id));
		 $this->render_template('secure/services/view', $data);
	}
}
