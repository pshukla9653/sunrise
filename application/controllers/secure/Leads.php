<?php
 
class Leads extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Leads_model');
		$this->load->model('secure/Countries_model');
		$this->load->model('secure/States_model');
		$this->load->model('secure/City_model');
		$this->load->library('Mycalendar');
		
    } 

    
    public function index(){
    
        //$per = $this->check_permission();
		$data['title'] = 'Leads List';
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['statelist'] 	= $this->States_model->getstatelist();
		$data['citylist'] 	= $this->City_model->getcitylist();
		$data['servicelist'] 	= $this->Leads_model->get_all_list('tbl_services', array('status'=>1,'id!='=>2));
		$data['Productlist'] 	= $this->Leads_model->get_all_list('tbl_products', array('status'=>1));
		$data['sourceslist'] 	= $this->Leads_model->get_all_list('tbl_leads_sources', array('status'=>1));
		$data['Statuslist'] 	= $this->Leads_model->get_all_list('tbl_leads_status', array('status'=>1));
		$data['Userlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>='=>8,'tbl_users.id<>'=>$this->session->userdata('id')));
		$data['workuserlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>'=>8));
		$data['customerlist'] = $this->Leads_model->get_lead_list();
		$this->render_template('secure/leads/index', $data);
		
		//var_dump($data['workuserlist']); exit;
		
		
    }
	
	public function add(){
		 		$status['info'] ='';							
		$params =array(
					'company_id' 	   		 		=> 	$this->session->userdata('company_id'),
					'branch_id' 	   		 		=> 	$this->session->userdata('branch_id'),
					'service_id' 	   		 		=> 	$this->input->post('service_id'),
					'product_id' 	   		 		=> 	$this->input->post('product_id'),
					'source_id' 	   		 		=> 	$this->input->post('source_id'),
					'status_id' 	   		 		=> 	$this->input->post('status_id'),
					'customer_name' 		   		 => $this->input->post('customer_name'),
					'mobile' 						 => $this->input->post('mobile'),
					'email' 				 		 => $this->input->post('email'),
					'description' 				 	=> $this->input->post('description'),
					'alternate_mobile' 				 => $this->input->post('alternate_mobile'),
					'landline_no' 					 => $this->input->post('landline_no'),
					'address' 	   					 => $this->input->post('address'),
					'zip_code' 	   					 => $this->input->post('zip_code'),
					'country_id' 		  			 => $this->input->post('country_id'),
					'state_id' 		  				 => $this->input->post('state_id'),
					'city_id' 	   					 => $this->input->post('city_id'),
					'createdby' 					 => $this->session->userdata('id'),
					'createdon' 					 => date_timestamp_get(date_create())
					);
		if($this->session->userdata('group_id') == 4){
			$params['followup_assigned'] = $this->input->post('followup_assigned');
		}
		else{
			$params['followup_assigned'] = $this->session->userdata('id');
		}
				/////var_dump($params); exit;									
		
		///*$check_mobile =  $this->Leads_model->get_data('tbl_customer', "('mobile' = '".$this->input->post('mobile')."' or 'alternate_mobile' = '".$this->input->post('mobile')."')");		*/
		$insert_id = $this->Leads_model->insert_data('tbl_leads', $params);
		if($insert_id) {
			$reminder['lead_id'] = $insert_id;
			$reminder['reminder_on'] = $this->input->post('reminder_date');
			$reminder['description'] = $this->input->post('description');
			$reminder['createdby'] = $this->session->userdata('id');
			$reminder['createdon'] = date_timestamp_get(date_create());
			$reminder_id = $this->Leads_model->insert_data('tbl_leads_reminder', $reminder);
			if($reminder_id){
				return true;
			}
		}
		else {
			return false;	
		}
												
				 
	  }
	  
	public function addreminder(){
		if($this->input->post('btn') == 'Submit'){
					$params =array(
					'lead_id' 	   		 			=> 	$this->input->post('lead_id'),
					'reminder_on' 	   		 		=> 	$this->input->post('reminder_data'),
					'description' 	   		 		=> 	$this->input->post('reminder_description'),
					'createdby' 					 => $this->session->userdata('id'),
					'createdon' 					 => date_timestamp_get(date_create())
					);
		
		$insert_id = $this->Leads_model->insert_data('tbl_leads_reminder', $params);
		if($insert_id) {
			return true;
		}
		else {
			return false;	
		}
		}
		elseif($this->input->post('btn') == 'Update'){
					$params =array(
					'reminder_on' 	   		 		=> 	$this->input->post('reminder_data'),
					'description' 	   		 		=> 	$this->input->post('reminder_description'),
					'updatedby' 					 => $this->session->userdata('id'),
					'updatedon' 					 => date_timestamp_get(date_create())
					);
		
		$insert_id = $this->Leads_model->update_data('tbl_leads_reminder', array('id'=>$this->input->post('id')), $params);
		if($insert_id) {
			return true;
		}
		else {
			return false;	
		}
		}
				 
	  }  
	  
	public function leadreminderlist(){
		
		if($_POST['id']){
			$data = $this->Leads_model->get_all_leadreminder_list('tbl_leads_reminder', array('lead_id'=>$_POST['id']));
			
			foreach($data as $item){
				if(in_array('leads-editremider', $this->GroupPermission)){
			$editreminderbtn = '<a onClick="editreminder('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-deletereminder', $this->GroupPermission)){
			$deletereminderbtn = '&nbsp;<a onClick="deletereminder('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
			}
				echo '<tr>';
				echo '<td><strong>'.$item['description'].'</strong></td>';
				echo '<td><strong>'.date_format(date_create($item['reminder_on']),"d-m-Y").'</strong></td>';
				echo '<td>'.$editreminderbtn.$deletereminderbtn.'</td>';
				echo '</tr>';
			}
		}
		
	}
	
	public function leadlist(){
		$data = $this->Leads_model->get_lead_list();
		$newdata =  array();
		foreach($data as $item){
			$product =''; $services=''; $user='';
			
			$product = $this->Leads_model->get_data('tbl_products', array('id'=>$item['product_id']));
			$services = $this->Leads_model->get_data('tbl_services', array('id'=>$item['service_id']));
			
			$pr = $item['product_id']==0?'Other':$product['product_name'];
			$sr = $item['service_id']==0?'Other':$services['service_name'];
			$user = $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$item['followup_assigned'])); 
			$name = $item['customer_name'];
			
			if(in_array('leads-show', $this->GroupPermission)){
			$showbtn = '<a onClick="showdetail('.$item['id'].')"><i class="fa fa-eye fa-1x" style="color:green; font-size:18px;"></i></a>';
			}
			if(in_array('leads-addreminder', $this->GroupPermission)){
			$addreminderbtn = '&nbsp;<a onClick="addreminder('.$item['id'].')"><i class="fa fa-bell" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-edit', $this->GroupPermission)){
			$editleadbtn = '&nbsp;<a onClick="editdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-delete', $this->GroupPermission)){
			$deleteleadbtn = '&nbsp;<a onClick="deleterow('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
			}
			
			 array_push($newdata, array(
			$item['customer_name'],
			$pr,  
			$sr,
			'<a href="tel:'.$item['mobile'].'">'.$item['mobile'].'</a>', 
			'<a href="tel:'.$item['alternate_mobile'].'">'.$item['alternate_mobile'].'</a>',
			$item['address'].'-'.$item['zipcode'],
			$user['name'],
			$showbtn.$addreminderbtn.$editleadbtn.$deleteleadbtn
			));
			
		}
		echo json_encode(array('data' => $newdata));
			
	}
	
	public function gettodayleadreminder(){
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['statelist'] 	= $this->States_model->getstatelist();
		$data['citylist'] 	= $this->City_model->getcitylist();
		$data['servicelist'] 	= $this->Leads_model->get_all_list('tbl_services', array('status'=>1,'id!='=>2));
		$data['Productlist'] 	= $this->Leads_model->get_all_list('tbl_products', array('status'=>1));
		$data['sourceslist'] 	= $this->Leads_model->get_all_list('tbl_leads_sources', array('status'=>1));
		$data['Statuslist'] 	= $this->Leads_model->get_all_list('tbl_leads_status', array('status'=>1));
		$data['Userlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>='=>8,'tbl_users.id<>'=>$this->session->userdata('id')));
		$data['workuserlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>'=>8));
		$data['customerlist'] = $this->Leads_model->get_lead_list();
		
		if($this->input->post('btn') == 'Search'){
			$datefrom = $this->input->post('datefrom');
			$dateto = $this->input->post('dateto');
			$udata = $this->Leads_model->get_today_reminder_list_between($datefrom, $dateto);
		}
		else{
			
			$udata = $this->Leads_model->get_today_reminder_list(date("Y-m-d"));
		}
		
		
		$newdata =  array();
		foreach($udata as $item){
			$product =''; $services=''; $user='';
			
			$product = $this->Leads_model->get_data('tbl_products', array('id'=>$item['product_id']));
			$services = $this->Leads_model->get_data('tbl_services', array('id'=>$item['service_id']));
			
			$pr = $item['product_id']==0?'Other':$product['product_name'];
			$sr = $item['service_id']==0?'Other':$services['service_name'];
			$user = $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$item['followup_assigned'])); 
			$name = $item['customer_name'];
			
			if(in_array('leads-show', $this->GroupPermission)){
			$showbtn = '<a onClick="showdetail('.$item['id'].')"><i class="fa fa-eye fa-1x" style="color:green; font-size:18px;"></i></a>';
			}
			if(in_array('leads-addreminder', $this->GroupPermission)){
			$addreminderbtn = '&nbsp;<a onClick="addreminder('.$item['id'].')"><i class="fa fa-bell" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-edit', $this->GroupPermission)){
			$editleadbtn = '&nbsp;<a onClick="editdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-delete', $this->GroupPermission)){
			$deleteleadbtn = '&nbsp;<a onClick="deleterow('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
			}
			
			 array_push($newdata, array(
			'cutomer_name'=>$item['customer_name'],
			'product'=>$pr,  
			'service'=>$sr,
			'mobile'=>'<a href="tel:'.$item['mobile'].'">'.$item['mobile'].'</a>', 
			'alternate_mobile'=>'<a href="tel:'.$item['alternate_mobile'].'">'.$item['alternate_mobile'].'</a>',
			'description'=>$item['description'],
			'reminder_on'=>$item['reminder_on'],
			'address'=>$item['address'],
			'username'=>$user['name'],
			'action'=>$showbtn.$addreminderbtn.$editleadbtn.$deleteleadbtn
			));
			
		}
		$data['leadList'] = $newdata;
		///var_dump(array('leadList'=>$newdata)); exit;
		$this->render_template('secure/leads/leads_reminder', $data);
			
	}
	
	public function update(){
		 		$status['info'] ='';							
		$params =array(
					'service_id' 	   		 		=> 	$this->input->post('service_id'),
					'product_id' 	   		 		=> 	$this->input->post('product_id'),
					'source_id' 	   		 		=> 	$this->input->post('source_id'),
					'status_id' 	   		 		=> 	$this->input->post('status_id'),
					'customer_name' 		   		 => $this->input->post('customer_name'),
					'mobile' 						 => $this->input->post('mobile'),
					'email' 				 		 => $this->input->post('email'),
					'work_status' 				 	=> $this->input->post('work_status'),
					'description' 				 	=> $this->input->post('description'),
					'alternate_mobile' 				 => $this->input->post('alternate_mobile'),
					'landline_no' 					 => $this->input->post('landline_no'),
					'address' 	   					 => $this->input->post('address'),
					'zip_code' 	   					 => $this->input->post('zip_code'),
					'country_id' 		  			 => $this->input->post('country_id'),
					'state_id' 		  				 => $this->input->post('state_id'),
					'city_id' 	   					 => $this->input->post('city_id'),
					'updatedby' 					 => $this->session->userdata('id'),
					'updatedon' 					 => date_timestamp_get(date_create())
					);
		if($this->session->userdata('group_id') == 4){
			$params['followup_assigned'] = $this->input->post('followup_assigned');
		}
		else{
			$params['followup_assigned'] = $this->session->userdata('id');
		}
													
		$insert_id = $this->Leads_model->update_data('tbl_leads', array('id'=>$this->input->post('id')), $params);
		if($insert_id) {
			return true;
		}
		else {
			return false;	
		}
												
			//return $status;									
				 
	  } 
	  
	public function workassgned(){
		 		$status['info'] ='';							
		$params =array(
					'work_assigned' 	   		 => 	$this->input->post('userwork'),
					'work_assign_on' 	   		 => 	$this->input->post('work_assign_on'),
					'assignon' 					 => date_timestamp_get(date_create()),
					'assignby' 					 => $this->session->userdata('id')
					);
		
													
		$insert_id = $this->Leads_model->update_data('tbl_leads', array('id'=>$this->input->post('id')), $params);
		if($insert_id) {
			return true;
		}
		else {
			return false;	
		}
												
	  }    
	  
	public function getleads(){
		if($_POST['id']){
			$status = array();
				$check_user = $this->Leads_model->get_data('tbl_leads', array('id'=>$_POST['id']));
				if($check_user['id'] ==''){
					$status['status'] = false;
					
					
				}
				else{
					$status['status'] = true;
					$status['data'] = $check_user;
				}
				echo json_encode($status);
			}
	}
	
	public function getleadsreminder(){
		if($_POST['id']){
			$status = array();
				$check_user = $this->Leads_model->get_data('tbl_leads_reminder', array('id'=>$_POST['id']));
				if($check_user['id'] ==''){
					$status['status'] = false;
					
					
				}
				else{
					$status['status'] = true;
					$status['data'] = $check_user;
				}
				echo json_encode($status);
			}
	}
	
	public function getleadsdetail(){
		if($_POST['id']){
			$responce = array();
				$check_user = $this->Leads_model->get_data('tbl_leads', array('id'=>$_POST['id']));
				if($check_user['id'] ==''){
					
					$responce['status'] = false;
					
					
				}
				else{
					$product =  $this->Leads_model->get_data('tbl_products', array('id'=>$check_user['product_id']));
					$service =  $this->Leads_model->get_data('tbl_services', array('id'=>$check_user['service_id']));
					$sources =  $this->Leads_model->get_data('tbl_leads_sources', array('id'=>$check_user['source_id']));
					$status =  $this->Leads_model->get_data('tbl_leads_status', array('id'=>$check_user['status_id']));
					$user =  $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$check_user['followup_assigned']));
					$country =  $this->Leads_model->get_data('tbl_countries', array('country_id'=>$check_user['country_id']));
					$state =  $this->Leads_model->get_data('tbl_states', array('state_id'=>$check_user['state_id']));
					$city =  $this->Leads_model->get_data('tbl_cities', array('city_id'=>$check_user['city_id']));
					$createdby =  $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$check_user['createdby']));
					$workassign =  $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$check_user['work_assigned']));
					$leadremindr =  $this->Leads_model->get_all_list('tbl_leads_reminder', array('lead_id'=>$check_user['id']));
					$workassignby =  $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$check_user['assignby']));
					if($check_user['updatedby'] !=''){
					$updatedby =  $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$check_user['updatedby']));
					$up = gmdate("d-m-Y", $check_user['updatedon']);
					}
					
					$c = $check_user['city_id']==''?'':', '.$city['city_name'];
					$s = $check_user['state_id']==''?'':', '.$state['state_name'];
					$co = $check_user['country_id']==''?'':', '.$country['country_name'];
					$zip = $check_user['zip_code']==''?'':'-'.$check_user['zip_code'];
					$pr = $product['product_name']==''?'Other':$product['product_name'];
					$sr = $service['service_name']==''?'Other':$service['service_name'];
					
					$address = $check_user['address'].$c.$s.$co.$zip;
					
					$data = array(
						'id'=>$check_user['id'],
						'customer_name'=>$check_user['customer_name'],
						'mobile'=>$check_user['mobile'],
						'alternate_mobile'=>$check_user['alternate_mobile'],
						'landline_no'=>$check_user['landline_no'],
						'email'=>$check_user['email'],
						'description'=>$check_user['description'],
						'address'=>$address,
						'product'=>$pr,
						'service'=>$sr,
						'source'=>$sources['sources_name'],
						'status'=>$status['status_name'],
						'followed'=>$user['name'],
						'createdon'=>gmdate("d-m-Y", $check_user['createdon']),
						'createdby'=>$createdby['name'],
						'updatedon'=>$up,
						'updatedby'=>$updatedby['name'],
						'remindercount'=>count($leadremindr)
					);
					if($workassign['name'] ==''){
						$data['workassign']= '';
						$data['workassignid']= '';
						$data['workassigndatem']= '';
						$data['workassigndate']= '';
						$data['assignon']= '';
						$data['assignby']= '';
					}
					else{
						$data['workassign']= $workassign['name'];
						$data['workassignid']= $check_user['work_assigned'];
						$data['workassigndatem']= $check_user['work_assign_on'];
						$data['workassigndate']= date_format(date_create($check_user['work_assign_on']),"d-m-Y");
						$data['assignon']= gmdate("d-m-Y", $check_user['assignon']);
						$data['assignby']= $workassignby['name'];
					}
					
					
					$responce['status'] = true;
					$responce['data'] = $data;
				}
				echo json_encode($responce);
			}
	}
	
	public function deletelead(){
		if($_POST['id']){
			$status = array();
				if($this->Leads_model->delete_data('tbl_leads', array('id'=>$_POST['id']))){
					$status['status'] = true;
				}
				else{
					$status['status'] = false;
				}
				echo json_encode($status);
			}
	}
	
	public function deleteleadreminder(){
		if($_POST['id']){
			$status = array();
				if($this->Leads_model->delete_data('tbl_leads_reminder', array('id'=>$_POST['id']))){
					$status['status'] = true;
				}
				else{
					$status['status'] = false;
				}
				echo json_encode($status);
			}
	}
	
	public function gettodayassignlead(){
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['statelist'] 	= $this->States_model->getstatelist();
		$data['citylist'] 	= $this->City_model->getcitylist();
		$data['servicelist'] 	= $this->Leads_model->get_all_list('tbl_services', array('status'=>1,'id!='=>2));
		$data['Productlist'] 	= $this->Leads_model->get_all_list('tbl_products', array('status'=>1));
		$data['sourceslist'] 	= $this->Leads_model->get_all_list('tbl_leads_sources', array('status'=>1));
		$data['Statuslist'] 	= $this->Leads_model->get_all_list('tbl_leads_status', array('status'=>1));
		$data['Userlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>='=>8,'tbl_users.id<>'=>$this->session->userdata('id')));
		$data['workuserlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>'=>8));
		$data['customerlist'] = $this->Leads_model->get_lead_list();
		
		if($this->input->post('btn') == 'Search'){
			$datefrom = $this->input->post('datefrom');
			$dateto = $this->input->post('dateto');
			if($this->input->post('workassignedu') !=''){
			$workassignedu = $this->input->post('workassignedu');
			}
			$udata = $this->Leads_model->get_today_assignlead_list_between($datefrom, $dateto, $workassignedu);
		}
		else{
			
			$udata = $this->Leads_model->get_today_assignlead_list(date("Y-m-d"));
		}
		
		
		$newdata =  array();
		foreach($udata as $item){
			$product =''; $services=''; $user='';
			
			$product = $this->Leads_model->get_data('tbl_products', array('id'=>$item['product_id']));
			$services = $this->Leads_model->get_data('tbl_services', array('id'=>$item['service_id']));
			
			$pr = $item['product_id']==0?'Other':$product['product_name'];
			$sr = $item['service_id']==0?'Other':$services['service_name'];
			$user = $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$item['followup_assigned']));
			$work_assigned = $this->Leads_model->get_data('tbl_users_details', array('user_id'=>$item['work_assigned'])); 
			$name = $item['customer_name'];
			
			if(in_array('leads-show', $this->GroupPermission)){
			$showbtn = '<a onClick="showdetail('.$item['id'].')"><i class="fa fa-eye fa-1x" style="color:green; font-size:18px;"></i></a>';
			}
			if(in_array('leads-addreminder', $this->GroupPermission)){
			$addreminderbtn = '&nbsp;<a onClick="addreminder('.$item['id'].')"><i class="fa fa-bell" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-edit', $this->GroupPermission)){
			$editleadbtn = '&nbsp;<a onClick="editdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
			}
			if(in_array('leads-delete', $this->GroupPermission)){
			$deleteleadbtn = '&nbsp;<a onClick="deleterow('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
			}
			if($item['work_status'] == 0){
				$work_status = '<span class="btn btn-info">Assigned</span>';
			}
			elseif($item['work_status'] == 1){
				$work_status = '<span class="btn btn-success">Done</span>';
			}
			elseif($item['work_status'] == 2){
				$work_status = '<span class="btn btn-danger">Not Done</span>';
			}
			 array_push($newdata, array(
			'cutomer_name'=>$item['customer_name'],
			'product'=>$pr,  
			'service'=>$sr,
			'mobile'=>'<a href="tel:'.$item['mobile'].'">'.$item['mobile'].'</a>', 
			'alternate_mobile'=>'<a href="tel:'.$item['alternate_mobile'].'">'.$item['alternate_mobile'].'</a>',
			'description'=>$item['description'],
			'reminder_on'=>$item['reminder_on'],
			'address'=>$item['address'],
			'username'=>$user['name'],
			'work_assigned'=>$work_assigned['name'],
			'work_status'=>$work_status,
			'action'=>$showbtn.$addreminderbtn.$editleadbtn.$deleteleadbtn
			));
			
		}
		$data['leadList'] = $newdata;
		///////var_dump(array('leadList'=>$newdata)); exit;
		$this->render_template('secure/leads/leads_assign', $data);
			
	}
	
	
	public function gettodaymslist(){
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['statelist'] 	= $this->States_model->getstatelist();
		$data['citylist'] 	= $this->City_model->getcitylist();
		$data['workuserlist'] 		= $this->Leads_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.group_id>'=>8));
		
		if($this->input->post('btn') == 'Search'){
			$datefrom = $this->input->post('datefrom');
			$dateto = $this->input->post('dateto');
			$udata = $this->Leads_model->get_today_ms_list_between($datefrom, $dateto);
		}
		else{
			
			$udata = $this->Leads_model->get_today_ms_list(date("Y-m-d"));
		}
		
		
		$newdata =  array();
		foreach($udata as $item){
			
			
			
			//if(in_array('leads-show', $this->GroupPermission)){
//			$showbtn = '<a onClick="showdetail('.$item['id'].')"><i class="fa fa-eye fa-1x" style="color:green; font-size:18px;"></i></a>';
//			}
//			if(in_array('leads-addreminder', $this->GroupPermission)){
//			$addreminderbtn = '&nbsp;<a onClick="addreminder('.$item['id'].')"><i class="fa fa-bell" style="font-size:18px;"></i></a>';
//			}
//			if(in_array('leads-edit', $this->GroupPermission)){
//			$editleadbtn = '&nbsp;<a onClick="editdetail('.$item['id'].')"><i class="fa fa-edit fa-1x" style="font-size:18px;"></i></a>';
//			}
//			if(in_array('leads-delete', $this->GroupPermission)){
//			$deleteleadbtn = '&nbsp;<a onClick="deleterow('.$item['id'].');"><i class="fa fa-trash fa-1x" style="color:red; font-size:18px;"></i></a>';
//			}
//			
			 
			
		}
		
		$data['leadList'] = $udata;
		///var_dump(array($data['leadList'])); exit;
		$this->render_template('secure/leads/ms_reminder', $data);
			
	}
	
	
}
