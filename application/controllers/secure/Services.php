<?php
 
class Services extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Services_model');
		$this->load->library('Mycalendar');
		
    } 

    /*
     * Listing of Countries
     */
    function index()
    {
        $per = $this->check_permission();
		$data = array();
			    $data['title']		= 'ADD | Services';
			   
		
			   $this->form_validation->set_rules("service_name", "Service Name", "trim|required");
			  
			   $data['getExpenses'] 	 = 	  $this->Services_model->get_all_list('tbl_services', array('company_id' => $this->session->userdata('company_id'),'branch_id' => $this->session->userdata('branch_id')));
				  //echo '<pre>';var_dump($data['getsubService'][1]['subservicename'] );exit;
				   if ($this->form_validation->run() == FALSE) {
					   $this->render_template('secure/services/index', $data);
					}
				   else
				   {
					   if($this->input->post("btn")  == 'Submit')
					   { 
								$params =array(
								'company_id' 	   		 		=> $this->session->userdata('company_id'),
								'branch_id' 	   		 		=> $this->session->userdata('branch_id'),
									'service_name' 	   			 => $this->input->post('service_name'),
									'status'			   		 => $this->input->post('status'),
									'createdby' 				 => $this->session->userdata('id'),
									'createdon' 				 => date_timestamp_get(date_create())
							   );
							  
								$getdate =  $this->Services_model->get_data('tbl_services', array('service_name'=>$params['service_name']));
								  if($getdate==''){
									  $insert_id = $this->Services_model->insert_data('tbl_services', $params);
								  if($insert_id) {
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
												redirect('secure/services/index');	
									}else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/services/index');			
										 }
								  }
								  else{
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Exist!</div>');
												redirect('secure/services/index');				
										 }
							
					   }
					   
					   if($this->input->post("btn")  == 'Update')
					   { 
					   			$id = $this->input->post('services_id');
								$params =array(
									'service_name' 	   			 => $this->input->post('service_name'),
									'status'			   		 => $this->input->post('status'),
									'updatedby' 				 => $this->session->userdata('id'),
									'updatedon' 				 => date_timestamp_get(date_create())
							   );
							  
								$getdate =  $this->Services_model->get_data('tbl_services', array('service_name'=>$params['service_name'],'id!='=>$id));
								  if($getdate==''){
									  $insert_id = $this->Services_model->update_data('tbl_services', array('id'=>$id), $params);
								  if($insert_id) {
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
												redirect('secure/services/index');	
									}else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/services/index');			
										 }
								  }
								  else{
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Exist!</div>');
												redirect('secure/services/index');				
										 }
							
					   }
				   }
		
		
		
		
    }
	public function getservicesDetail() {
		
			      $data = array('success' => false, 'messages' => array(),'founddata' => "");
				   if(!empty($_POST['getId'])){
						$datafound =  $this->Services_model->get_data('tbl_services', array('id'=>$_POST['getId']));
						if($datafound != ''){
							$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    public function view($id){
		$data['expense'] =  $this->Services_model->get_data('tbl_services', array('id'=>$id));
		 $this->render_template('secure/services/view', $data);
	}
}
