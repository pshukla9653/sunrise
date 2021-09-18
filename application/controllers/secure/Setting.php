<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller {

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
		$this->load->model('secure/Setting_model');
		
	}
	
	public function configuration(){
		$per = $this->check_permission();
		$data['setting'] = $this->Setting_model->get_setting(1);
		$this->load->library('form_validation');
		//set validations
			$this->form_validation->set_rules("title", "Title", "trim|required");
			$this->form_validation->set_rules("keyword", "Keyword", "trim|required");
			$this->form_validation->set_rules("description", "description", "trim|required");
			//$this->form_validation->set_rules("analytics_code", "analytics_code", "trim|required");
			$this->form_validation->set_rules("site_name", "site_name", "trim|required");
			$this->form_validation->set_rules("keyword", "Keyword", "trim|required");
		
        if($this->form_validation->run())     
        {   
            $params = array(
			'title'			=> $this->input->post("title"),
			'keyword'			=> $this->input->post("keyword"),
			'description'		=> $this->input->post("description"),
			'analytics_code'	=> $this->input->post("analytics_code"),
			'site_name'			=> $this->input->post("site_name"),
			'site_url'			=> $this->input->post("site_url"),
			'address'			=> $this->input->post("address"),
			'phone'				=> $this->input->post("phone"),
			'email'				=> $this->input->post("email"),
			'live_mode'			=> $this->input->post("live_mode"),
			
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
					if (!$is_file_error) {
						$this->Setting_model->save_file_info($file, array('id'=>1), 'tbl_setting', 'logo');
					}
					}
					if($_FILES['favicon']['name']!=''){
					$config['upload_path'] = 'uploads/logo/';
					$config['allowed_types'] = 'png|ico';
					$config['max_size'] = '0';
					$config['max_filename'] = '255';
					$config['encrypt_name'] = TRUE;
					$file = array();
					$is_file_error = FALSE;
					if (!$is_file_error) {
						$s =  $this->upload->initialize($config);
						if (!$this->upload->do_upload('favicon')) {
							//echo $this->upload->display_errors();
							$is_file_error = TRUE;
						} else {
							$file = $this->upload->data();
						}
					}	
					if (!$is_file_error) {
						$this->Setting_model->save_file_info($file, array('id'=>1), 'tbl_setting', 'favicon');
					}
					}
            $setting_id = $this->Setting_model->update_setting(1, $params);
			if($setting_id){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record Updated!</div>');
            redirect('secure/setting/configuration');
			}
        }
        else
        {            
            
		$this->render_template('secure/setting/configuration',  $data);
        }
        
    }
	
	public function GSTMaster() {
		
			    $data['title'] 	 				= 'admin | GST';
				$cgst					= $this->input->post('cgst');
				$sgst					= $this->input->post('sgst');
				$igst					= $this->input->post('igst');
				$data['editSGT'] = $this->Setting_model->get_all_list('tbl_gst_master');

			$this->form_validation->set_rules("cgst", "CGST", "trim");
			$this->form_validation->set_rules("sgst", "SGST", "trim");
			$this->form_validation->set_rules("igst", "IGST", "trim");
			$this->form_validation->set_message('is_unique', '%s Already Register! Try Another');
			$this->form_validation->set_message('required', '%s is required!');
	
			  if ($this->form_validation->run() == FALSE) {
				  $this->render_template('secure/setting/GSTmaster',  $data);
			  } else {
				  		 //validation succeeds
						
				  		 if ($this->input->post('btn') == "Update") {
							 for($i=1; $i<= 4; $i++){
								 
								 $updata['cgst'] = $cgst[$i];
								 $updata['sgst'] = $sgst[$i];
								 $updata['igst'] = $igst[$i];
								 
								$update = $this->Setting_model->update_data('tbl_gst_master', array('id'=>$i),$updata); 
								
							 }
					  			
									if($update) {
										$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
										redirect('secure/setting/GSTMaster');
									}
									else{
										$this->session->set_flashdata('msg', '<div class="alert alert-danger">Invalid! Error Occured.</div>');
										redirect('secure/setting/GSTMaster');			
										}
				  	      }
		 		    }
		
    }
    

	
	

    
	
}
