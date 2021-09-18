<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller {

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
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('secure/auth_model', 'auth');

		
	}

	
	public function login()
	{
		$this->logged_in();
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
        {
			$this->load->view('secure/login');
		}
		else{
				
				if($this->input->post('submit')=='login'){
					if($this->auth->check_username($this->input->post('username'))){
						$login= $this->auth->login($this->input->post('username'), $this->input->post('password'));
						
						if($login!=NULL){
							$sessiondata = array(
									'id' => $login['id'],
									'username' 		=> $login['username'],
									'email'     	=> $login['email'],
									'company_id'    => $login['company_id'],
									'branch_id'     => $login['branch_id'],
									'group_id'     	=> $login['group_id'],
									'logged_in' => TRUE);
									$this->session->set_userdata($sessiondata);
									if($this->session->userdata('logged_in')==TRUE){
									redirect('secure/dashboard', 'refresh');
									
									}
						}
						else{
							$this->session->set_flashdata('msg', '<div class="alert alert-danger">Username not invalid!</div>');
							redirect('secure/auth/login');
						}
						
					}
					else{
						$this->session->set_flashdata('msg', '<div class="alert alert-danger">Username not invalid!</div>');
						redirect('secure/auth/login');
					}
				}
		}
               
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('secure/auth/login', 'refresh');
	}
}
