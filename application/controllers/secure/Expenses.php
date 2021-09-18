<?php
 
class Expenses extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Expenses_model');
		$this->load->library('Mycalendar');
		
    } 

    /*
     * Listing of Countries
     */
    function index()
    {
        $per = $this->check_permission();
		$data = array();
			    $data['title']		= 'ADD | Expenses';
			   
		
			   $this->form_validation->set_rules("person_name", "Person Name", "trim|required");
			   $this->form_validation->set_rules("description", "Description", "trim|required");
			   $this->form_validation->set_rules("amount", "Amount", "trim|required");
			   $this->form_validation->set_rules("fdate", "Date", "trim|required");
			  
			   $data['getExpenses'] 	 = 	  $this->Expenses_model->get_all_list('tbl_expenses', array('company_id' => $this->session->userdata('company_id'),'branch_id' => $this->session->userdata('branch_id')));
				  //echo '<pre>';var_dump($data['getsubService'][1]['subservicename'] );exit;
				   if ($this->form_validation->run() == FALSE) {
					   $this->render_template('secure/expenses/index', $data);
					}
				   else
				   {
					   if($this->input->post("btn")  == 'Submit')
					   { 
								$params =array(
								'company_id' 	   		 		=> $this->session->userdata('company_id'),
								'branch_id' 	   		 		=> $this->session->userdata('branch_id'),
									'person_name' 	   			 => $this->input->post('person_name'),
									'description' 	   			=> $this->input->post('description'),
									'amount' 	   			 	=> $this->input->post('amount'),
									'fdate' 	   			 	=> $this->input->post('fdate'),
									'status'			   		 => $this->input->post('status'),
									'createdby' 				 => $this->session->userdata('id'),
									'createdon' 				 => date_timestamp_get(date_create())
							   );
							  
								$getdate =  $this->Expenses_model->get_data('tbl_expenses', array('person_name'=>$params['person_name'],'fdate'=>$params['fdate'],'amount'=>$params['amount']));
								  if($getdate==''){
									  $insert_id = $this->Expenses_model->insert_data('tbl_expenses', $params);
								  if($insert_id) {
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
												redirect('secure/expenses/index');	
									}else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/expenses/index');			
										 }
								  }
								  else{
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Exist!</div>');
												redirect('secure/expenses/index');				
										 }
							
					   }
					   
					   if($this->input->post("btn")  == 'Update')
					   { 
					   			$id = $this->input->post('expenses_id');
								$params =array(
									'person_name' 	   			 => $this->input->post('person_name'),
									'description' 	   			=> $this->input->post('description'),
									'amount' 	   			 	=> $this->input->post('amount'),
									'fdate' 	   			 	=> $this->input->post('fdate'),
									'status'			   		 => $this->input->post('status'),
									'updatedby' 				 => $this->session->userdata('id'),
									'updatedon' 				 => date_timestamp_get(date_create())
							   );
							  
								$getdate =  $this->Expenses_model->get_data('tbl_expenses', array('person_name'=>$params['person_name'],'fdate'=>$params['fdate'],'amount'=>$params['amount'],'id!='=>$id));
								  if($getdate==''){
									  $insert_id = $this->Expenses_model->update_data('tbl_expenses', array('id'=>$id), $params);
								  if($insert_id) {
									  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
												redirect('secure/expenses/index');	
									}else{
												$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
												redirect('secure/expenses/index');			
										 }
								  }
								  else{
												$this->session->set_flashdata('msg', '<div class="alert alert-danger">Data Already Exist!</div>');
												redirect('secure/expenses/index');				
										 }
							
					   }
				   }
		
		
		
		
    }
	public function getexpensesDetail() {
		
			      $data = array('success' => false, 'messages' => array(),'founddata' => "");
				   if(!empty($_POST['getId'])){
						$datafound =  $this->Expenses_model->get_data('tbl_expenses', array('id'=>$_POST['getId']));
						if($datafound != ''){
							$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    public function view($id){
		$data['expense'] =  $this->Expenses_model->get_data('tbl_expenses', array('id'=>$id));
		 $this->render_template('secure/expenses/view', $data);
	}
}
