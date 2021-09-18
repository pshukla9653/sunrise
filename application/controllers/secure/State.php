<?php
 
class State extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Countries_model');
		$this->load->model('secure/States_model');
		
    } 

    /*
     * Listing of Countries
     */
    function index()
    {
        //$per = $this->check_permission();
		
		
		 		$data['title']		= 'ADD | State';
			   $this->form_validation->set_rules("country_id", "Country Name", "trim|required");
			   if($this->input->post('btn') == 'Submit'){
			   $this->form_validation->set_rules("state_name", "State Name", "trim|required|is_unique[tbl_states.state_name]");
			   }
			   else{
				 $this->form_validation->set_rules("state_name", "State Name", "trim|required");  
				   }
			   $data['getCountry'] 	 = 	  $this->Countries_model->get_all_countrieslist();
			   $data['getState'] 	 = 	  $this->States_model->get_all_states();
				//echo '<pre>';var_dump($data['getState']);exit;
				   if ($this->form_validation->run() == FALSE){
					  $this->render_template('secure/state/index', $data);
					}
				   else
				   {
								$params =array(
									'country_id' 	    => $this->input->post('country_id'),
									'state_name' 	    => $this->input->post('state_name'),
									'status'			=> $this->input->post('status')
							     );
							  $getCountry = $this->States_model->get_state($this->input->post('state_id'));
							  if($getCountry == ''){
								  $this->States_model->add_state($params);
								 	$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
									redirect('secure/state/index');
								  
							  }else{
								  			 $update = $this->States_model->update_state($this->input->post('state_id'),$params);
											  if(empty($update) == false){
												  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
															redirect('secure/state/index');
												}else{
															$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
															redirect('secure/state/index');			
													 } 
								  		
								   }
					   
				   }
		
		
    }
	public function getStateDetail() {
		
		$data = array('success' => false, 'messages' => array(),'founddata' => "");
		 if(!empty($_POST['getId'])){
		$datafound =  $this->States_model->get_state($_POST['getId']);
		if($datafound != ''){
		$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    
}
