<?php
 
class City extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/City_model');
		$this->load->model('secure/States_model');
		
    } 

    /*
     * Listing of Countries
     */
    function index()
    {
        //$per = $this->check_permission();
		
		
		 		$data['title']		= 'ADD | City';
			   $this->form_validation->set_rules("state_id", "State Name", "trim|required");
			   if($this->input->post('btn') == 'Submit'){
			   $this->form_validation->set_rules("city_name", "City Name", "trim|required|is_unique[tbl_cities.city_name]");
			   }
			   else{
				$this->form_validation->set_rules("city_name", "City Name", "trim|required");  
				   }
			   $data['getCity'] 	 = 	  $this->City_model->get_all_cities();
			   $data['getState'] 	 = 	  $this->States_model->get_all_states();
				//echo '<pre>';var_dump($data['getState']);exit;
				   if ($this->form_validation->run() == FALSE){
					  $this->render_template('secure/city/index', $data);
					}
				   else
				   {
								$params =array(
									'state_id' 	    => $this->input->post('state_id'),
									'city_name' 	    => $this->input->post('city_name'),
									'status'			=> $this->input->post('status')
							     );
							  $getCountry = $this->City_model->get_city($this->input->post('city_id'));
							  if($getCountry == ''){
								  $this->City_model->add_city($params);
								 	$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
									redirect('secure/city/index');
								  
							  }else{
								  			 $update = $this->City_model->update_city($this->input->post('city_id'),$params);
											  if(empty($update) == false){
												  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
															redirect('secure/city/index');
												}else{
															$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
															redirect('secure/city/index');			
													 } 
								  		
								   }
					   
				   }
		
		
    }
	public function getCityDetail() {
		
		$data = array('success' => false, 'messages' => array(),'founddata' => "");
		 if(!empty($_POST['getId'])){
		$datafound =  $this->City_model->get_city($_POST['getId']);
		if($datafound != ''){
		$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    
}
