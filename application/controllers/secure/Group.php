<?php

 
class Group extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
        $this->load->model('secure/Group_model');
		$this->load->model('secure/Menu_model');
    } 

    /*
     * Listing of grouplist
     */
    function index()
    {
        $per = $this->check_permission();
		
		
		if($per=='All'){
        $data['grouplist'] = $this->Group_model->get_all_grouplist();
		}
		elseif($per=='Own'){
		$data['grouplist'] = $this->Group_model->get_own_grouplist();
		}
		
		
		//var_dump($per); exit;
		
		$this->render_template('secure/group/index', $data);
    }

    /*
     * Adding a new group
     */
    function add()
    {   
        $this->check_permission();
		$data['main_menu_list'] = $this->Menu_model->get_main_menulist();
		$this->load->library('form_validation');

		$this->form_validation->set_rules('group_title','Group Title','required|max_length[255]|is_unique[tbl_group.group_title]');
		$this->form_validation->set_rules('status','Status','required|integer');
		$this->form_validation->set_rules('permission[]','Group Permission','required');
		
		if($this->form_validation->run())     
        {   
				$permission = $this->input->post('permission');
				$permission = array_diff($permission, array("0"));
            	$params = array(
				'group_title' => $this->input->post('group_title'),
				'status' => $this->input->post('status'),
				'group_permission' => implode(',', $permission),
				'createdby' => $this->session->userdata('id'),
				'createdon' => date_timestamp_get(date_create()),
            );
            
            $group_id = $this->Group_model->add_group($params);
			if($group_id){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record Added!</div>');
            redirect('secure/group/index');
			}
        }
        else
        {            
            
			$this->render_template('secure/group/add',$data);
        }
    }  

    /*
     * Editing a group
     */
    function edit($id)
    {   
        // check if the group exists before trying to edit it
        $data['group'] = $this->Group_model->get_group($id);
		$data['main_menu_list'] = $this->Menu_model->get_main_menulist();
        $per = $this->check_permission();
		
		
		if($per=='Own'){
		if(!$data['group']['createdby']==$this->session->userdata('id')){
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
        if(isset($data['group']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('group_title','Group Title','required|max_length[255]');
			$this->form_validation->set_rules('status','Status','required|integer');
			$this->form_validation->set_rules('permission[]','Group Permission','required');
		
			if($this->form_validation->run())     
            {   
                $permission = $this->input->post('permission');
				$permission = array_diff($permission, array("0"));
				$params = array(
					'group_title' => $this->input->post('group_title'),
					'status' => $this->input->post('status'),
					'group_permission' => implode(',', $permission),
					'updatedby' => $this->session->userdata('id'),
					'updatedon' => date_timestamp_get(date_create()),
                );

               
				if($this->Group_model->update_group($id,$params)){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record updated!</div>');            
                redirect('secure/group/index');
				}
            }
            else
            {
                
				$this->render_template('secure/group/edit',$data);
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
