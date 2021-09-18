<?php

 
class Pages extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
		$this->not_logged_in();
		$this->load->model('secure/Pages_model');
		
    } 

    /*
     * Listing of pageslist
     */
    function index()
    {
        $per = $this->check_permission();
		
		
		if($per=='All'){
        $data['pageslist'] = $this->Pages_model->get_all_pageslist();
		}
		elseif($per=='Own'){
		$data['pageslist'] = $this->Pages_model->get_own_pagelist();
		}
		
		//var_dump($data['categorylist']); exit;
		
		$this->render_template('secure/pages/index', $data);
    }

    /*
     * Adding a new page
     */
    function add()
    {   
        $this->check_permission();
		
		//var_dump($data['categorylist']); exit;
		
		$this->load->library('form_validation');
		
		if($_FILES['upload_file']['name']!='')
		{$_POST['upload_file'] = $_FILES['upload_file'];
				$config['upload_path'] = 'uploads/page/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';
									
									$config['max_filename'] = '255';
									$config['encrypt_name'] = TRUE;
									//$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) {
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('upload_file'))
										{
											//$this->form_validation->set_rules('upload_type','Upload Type','required',$this->upload->display_errors());
									      $this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
            							redirect('secure/pages/add');
										 // echo $this->upload->display_errors();
									      $is_file_error = TRUE;
						                }
									    else
										{
							               $file = $this->upload->data('file_name');
						                }
					            }	
							    
							}
		
		
		$this->form_validation->set_rules('page_title','Post Title','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('slug','Page Title','required|is_unique[tbl_pages.slug]');
		$this->form_validation->set_rules('status','Status','required|integer');
		
		if($this->form_validation->run())     
        {   
				
            	$params = array(
				'page_title' => $this->input->post('page_title'),
				'description' => $this->input->post('description'),
				'upload_file' => $file,
				'slug' => $this->input->post('slug'),
				'parent' => $this->input->post('parent'),
				'template' => $this->input->post('template'),
				'status' => $this->input->post('status'),
				'createdby' => $this->session->userdata('id'),
				'createdon' => date_timestamp_get(date_create()),
            );
			
            $user_id = $this->Pages_model->add_page($params);
			if($user_id){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record Added!</div>');
            redirect('secure/pages/index');
			}
        }
        else
        {            
            
			$this->render_template('secure/pages/add',$data);
        }
    }  

    /*
     * Editing a page
     */
    function edit($id)
    {   
        // check if the page exists before trying to edit it
        $data['page'] = $this->Pages_model->get_page($id);
        $per = $this->check_permission();
		
		if($per=='Own'){
		if(!$data['page']['createdby']==$this->session->userdata('id')){
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
		//var_dump($data['page']);
        if(isset($data['page']['id']))
        {
            $this->load->library('form_validation');

			if($_FILES['upload_file']['name']!='')
			{$_POST['upload_file'] = $_FILES['upload_file'];
				$config['upload_path'] = 'uploads/page/';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';
									
									$config['max_filename'] = '255';
									$config['encrypt_name'] = TRUE;
									//$file = array();
									$is_file_error = FALSE;
									if (!$is_file_error) {
										$s =  $this->upload->initialize($config);
										if (!$this->upload->do_upload('upload_file'))
										{
											//$this->form_validation->set_rules('upload_type','Upload Type','required',$this->upload->display_errors());
									      $this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
            							redirect('secure/pages/add');
										 // echo $this->upload->display_errors();
									      $is_file_error = TRUE;
						                }
									    else
										{
							               $file = $this->upload->data('file_name');
						                }
					            }	
							    
							}
		
		
		$this->form_validation->set_rules('page_title','Post Title','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('status','Status','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
				'page_title' => $this->input->post('page_title'),
				'description' => $this->input->post('description'),
				'upload_file' => $file,
				'slug' => $this->input->post('slug'),
				'parent' => $this->input->post('parent'),
				'template' => $this->input->post('template'),
				'status' => $this->input->post('status'),
				'createdby' => $this->session->userdata('id'),
				'createdon' => date_timestamp_get(date_create()),
            );
			
            
			

               
				if($this->Pages_model->update_page($id, $params)){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">record updated!</div>');            
                redirect('secure/pages/index');
				}
            }
            else
            {
                
				$this->render_template('secure/pages/edit', $data);
            }
        }
        else
            
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">The page you are trying to edit does not exist.</div>');
    } 

    /*
     * Deleting page
     */
    function delete($id)
    {
        $page = $this->Pages_model->get_page($id);
		$per = $this->check_permission();
		
		
		if($per=='Own'){
		if(!$page['createdby']==$this->session->userdata('id')){
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
        // check if the page exists before trying to delete it
        if(isset($page['id']))
        {
            $this->Pages_model->delete_page($id);
            redirect('secure/pages/index');
        }
        else
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">The page you are trying to delete does not exist.</div>');
    }
    
}
