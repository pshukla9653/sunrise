<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name> #5d0306
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Company_model');
		$this->load->model('secure/Countries_model');
		$this->load->model('secure/Users_model');
		
	}
	function index(){
		$per = $this->check_permission();
		
		
		$data['companylist'] = $this->Company_model->get_company_list();
		
		
		//var_dump($per); exit;
		
		$this->render_template('secure/company/index', $data);
	}
	 function add()
    {
		$per = $this->check_permission();
		
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$data['Userslist'] 	= $this->Users_model->get_user_where('tbl_users.id,tbl_users_details.name', array('tbl_users.company_id'=>0,'tbl_users.branch_id'=>0,'tbl_users.group_id'=>3));
		//var_dump($data['Userslist']); exit;
		$this->load->library('form_validation');
		//set validations
			$this->form_validation->set_rules("user_id", "Company Admin", "trim|required");
			$this->form_validation->set_rules("company_name", "Company Name", "trim|required|is_unique[tbl_company.company_name]");
			$this->form_validation->set_rules("address", "Address", "trim|required");
			$this->form_validation->set_rules("address", "Address", "trim|required");
			$this->form_validation->set_rules("country_id", "Country", "trim|required");
			$this->form_validation->set_rules("state_id", "State", "trim|required");
			$this->form_validation->set_rules("city_id", "City", "trim|required");
			$this->form_validation->set_rules("pincode", "Pin Code", "trim|required");
			$this->form_validation->set_rules("status", "Title", "trim|required");
			
		
        if($this->form_validation->run())     
        {  // var_dump($_POST); exit;
            $params = array(
			'user_id'			=> $this->input->post("user_id"),
			'company_name'		=> $this->input->post("company_name"),
			'phone'				=> $this->input->post("phone"),
			'email'				=> $this->input->post("email"),
			'address'			=> $this->input->post("address"),
			'country_id'		=> $this->input->post("country_id"),
			'state_id'			=> $this->input->post("state_id"),
			'city_id'			=> $this->input->post("city_id"),
			'pincode'			=> $this->input->post("pincode"),
			'status'			=> $this->input->post("status"),
			'createdby' 		=> $this->session->userdata('id'),
			'createdon' 		=> date_timestamp_get(date_create()),
			
            );
			//var_dump($_FILES['logo']); exit;
            if($_FILES['logo']['name']!=''){
					$config['upload_path'] = 'uploads/logo/';
					$config['allowed_types'] = 'png|jpg|jpeg';
					$config['max_size'] = '0';
					$config['max_filename'] = '255';
					$config['encrypt_name'] = TRUE;
					$file = array();
					$is_file_error = FALSE;
					if (!$is_file_error) {
						$s =  $this->upload->initialize($config);
						if (!$this->upload->do_upload('logo')) {
							//echo $this->upload->display_errors();
							$is_file_error = TRUE;
						} else {
							$file = $this->upload->data();
						}
					}	
					
					}
					
            $company_id = $this->Company_model->insert_data('tbl_company',$params);
			
			if($company_id){
				if (!$is_file_error) {
						$this->Company_model->save_file_info($file, array('id'=>$company_id), 'tbl_company', 'company_logo');
					}
					$updateuser['company_id'] = $company_id;
				$user_id = $this->Company_model->update_data('tbl_users',$params['user_id'],$updateuser);
				if($user_id){
						$this->session->set_flashdata('msg', '<div class="alert alert-success">record added!</div>');
            			redirect('secure/company/index');
					}
			}
        }
        else
        {            
            
		$this->render_template('secure/company/add',  $data);
        }
        
    }

    
	
}
