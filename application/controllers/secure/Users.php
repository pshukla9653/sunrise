<?php

 
class Users extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
        $this->load->model('secure/Users_model');
		$this->load->model('secure/Group_model');
		$this->load->model('secure/Countries_model');
		
		
    } 

    /*
     * Listing of grouplist
     */
    function index()
    {
        $per = $this->check_permission();
		
		
		if($per=='All'){
        $data['userslist'] = $this->Users_model->get_all_userslist();
		}
		elseif($per=='Own'){
		$data['userslist'] = $this->Users_model->get_own_userslist();
		}
		$data['grouplist'] = $this->Group_model->get_all_grouplist();
		
		
		
		//	var_dump($data['userslist'][0]); exit;
		
		$this->render_template('secure/users/index', $data);
    }

    /*
     * Adding a new group
     */
    function add()
    {   
        $this->check_permission();
		
		$data['title'] = 'Add User';
		
		if($this->session->userdata('group_id') == '1'){
		$data['grouplist'] 		= $this->Group_model->get_all_grouplist();
		}
		elseif($this->session->userdata('group_id') == '2'){
		$data['grouplist'] 		= $this->Group_model->get_group_list(3);
		}
		elseif($this->session->userdata('group_id') == '3'){
		$data['grouplist'] 		= $this->Group_model->get_group_list(4);
		}
		else{
			$data['grouplist'] 		= $this->Group_model->get_all_grouplist();
		}
		$data['countrieslist'] 	= $this->Countries_model->get_all_countrieslist();
		$this->load->library('form_validation');

		//$this->form_validation->set_rules('group_title','Group Title','required|max_length[255]|is_unique[tbl_group.group_title]');
		$this->form_validation->set_rules('group_id','Group','required');
		$this->form_validation->set_rules('status','Status','required|integer');
		$this->form_validation->set_rules('mobile','Mobile','required|integer|is_unique[tbl_users.mobile]');
		$this->form_validation->set_rules('username','Username','required|is_unique[tbl_users.username]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('date_of_birth','DOB','required');
		$this->form_validation->set_rules('country_id','Country','required');
		$this->form_validation->set_rules('state_id','State','required');
		$this->form_validation->set_rules('city_id','City','required');
		$this->form_validation->set_message('is_unique', 'Username is already register! Try another');
		
		if($this->form_validation->run())     
        {   
				$salt = md5(rand(0000,9999));
				$password= hash("sha256", $this->input->post('password').$salt);
            	$params = array(
				'group_id' => $this->input->post('group_id'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'salt' => $salt,
				'passkey' => $password,
				'status' => $this->input->post('status'),
				'createdby' => $this->session->userdata('id'),
				'company_id' => $this->session->userdata('company_id'),
				'branch_id' => $this->session->userdata('branch_id'),
				'createdon' => date_timestamp_get(date_create()),
            );
			
            $params2 = array(
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'address' => $this->input->post('address'),
				'country_id' => $this->input->post('country_id'),
				'state_id' => $this->input->post('state_id'),
				'city_id' => $this->input->post('city_id'),
				'zipcode' => $this->input->post('zip_code'),
				
            );
			if(!empty($_FILES['profile_photo']))
			{
				$config['upload_path'] = 'uploads/profile/';
				$config['allowed_types'] = '*';
				$config['max_size'] = '0';
				$config['max_filename'] = '255';
				$config['encrypt_name'] = TRUE;
				$file = array();
				$is_file_error = FALSE;
				if (!$is_file_error) {
				$s =  $this->upload->initialize($config);
				if (!$this->upload->do_upload('profile_photo'))
				{
					echo $this->upload->display_errors();
					$is_file_error = TRUE;
				}
				else
					{
					$file = $this->upload->data();
					}
				}	
				if (!$is_file_error) {
						
					}
				}
            $user_id = $this->Users_model->add_users('tbl_users', $params);
			if($user_id){
				
			$params2['user_id']=$user_id;
			$user_id = $this->Users_model->add_users('tbl_users_details', $params2);
			$this->Users_model->save_file_info($file, array('user_id'=>$insert_id),'tbl_users_details','profile_photo');
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record Added!</div>');
            redirect('secure/users/index');
			}
        }
        else
        {            
            
			$this->render_template('secure/users/add',$data);
        }
    }  

    /*
     * Editing a group
     */
    function edit($id)
    {   
        // check if the group exists before trying to edit it
        $data['user'] = $this->Users_model->get_user('*', $id);
		//var_dump($data['user']); exit;
        $per = $this->check_permission();
		$data['grouplist'] = $this->Group_model->get_all_grouplist();
		$data['countrieslist'] = $this->Countries_model->get_all_countrieslist();
		
		if($per=='Own'){
		if(!$data['user']['createdby']==$this->session->userdata('id')){
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
        if(isset($data['user']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('status','Status','required|integer');
		
			if($this->form_validation->run())     
            {   
                $salt = md5(rand(0000,9999));
				$password= hash("sha256", $this->input->post('password').$salt);
            	$params = array(
				'group_id' => $this->input->post('group_id'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'salt' => $salt,
				'passkey' => $password,
				'status' => $this->input->post('status'),
				'createdby' => $this->session->userdata('id'),
				'createdon' => date_timestamp_get(date_create()),
            );
			
            $params2 = array(
				'name' => $this->input->post('name'),
				'gender' => $this->input->post('gender'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'address' => $this->input->post('address'),
				'country_id' => $this->input->post('country_id'),
				'state_id' => $this->input->post('state_id'),
				'city_id' => $this->input->post('city_id'),
				'zipcode' => $this->input->post('zip_code'),
				
            );
			if(!empty($_FILES['profile_photo']))
			{
									$config['upload_path'] = 'uploads/profile/';
									$config['allowed_types'] = '*';
									$config['max_size'] = '0';
									$config['max_filename'] = '255';
									$config['encrypt_name'] = TRUE;
									$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) {
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('profile_photo'))
										{
									      echo $this->upload->display_errors();
									      $is_file_error = TRUE;
						                }
									    else
										{
							               $file = $this->upload->data();
						                }
					            }	
							    if (!$is_file_error) {
							    
						
						
					}
							}

               
				if($this->Group_model->update_group($id,$params)){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record updated!</div>');            
                redirect('secure/group/index');
				}
            }
            else
            {
                
				$this->render_template('secure/users/edit', $data);
            }
        }
        else
            
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">The group you are trying to edit does not exist.</div>');
    } 

    /*
     * Deleting group
     */
    function delete($id)
    {
        $group = $this->Group_model->get_group($id);
		$per = $this->check_permission();
		
		
		if($per=='Own'){
		if(!$group['group']['createdby']==$this->session->userdata('id')){
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
        // check if the group exists before trying to delete it
        if(isset($group['id']))
        {
            $this->Group_model->delete_group($id);
            redirect('secure/group/index');
        }
        else
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">The group you are trying to delete does not exist.</div>');
    }
    
}
