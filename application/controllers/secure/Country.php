<?php
 
class Country extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Countries_model');
		
    } 

    /*
     * Listing of Countries
     */
    function index()
    {
        $per = $this->check_permission();
		
		
		 		$data['title']		= 'ADD | Country';
			   
		
			  
			   $this->form_validation->set_rules("country_name", "Country Name", "trim|required");
			   $data['getCountry'] 	 = 	  $this->Countries_model->get_all_countrieslist();
				  //echo '<pre>';var_dump($data['getsubService'][1]['subservicename'] );exit;
				   if ($this->form_validation->run() == FALSE) {
					  $this->render_template('secure/country/index', $data);
					}
				   else
				   {
					   
								$params =array(
									'country_name' 	    => $this->input->post('country_name'),
									'status'			=> $this->input->post('status')
							     );
							  $getCountry = $this->Countries_model->get_countries($this->input->post('country_id'));
							  if($getCountry == ''){
								  $this->Countries_model->add_countries($params);
								 	$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Add Successfully</div>');
									redirect('secure/country/index');
								  
							  }else{
								  			 $update = $this->Countries_model->update_countries($this->input->post('country_id'),$params);
											  if(empty($update) == false){
												  $this->session->set_flashdata('msg', '<div class="alert alert-success">Record Update Successfully</div>');
															redirect('secure/country/index');
												}else{
															$this->session->set_flashdata('msg', '<div class="alert alert-warning">Invalid! Error Occured.</div>');
															redirect('secure/country/index');			
													 } 
								  		
								   }
					   
				   }
		
		
    }
	public function getCountryDetail() {
		
			      $data = array('success' => false, 'messages' => array(),'founddata' => "");
				   if(!empty($_POST['getId'])){
						$datafound =  $this->Countries_model->get_countries($_POST['getId']);
						if($datafound != ''){
							$data['founddata'] = $datafound;
							$data['success'] = true;
						}
						echo json_encode($data);
				   }
		
    }

    
}
