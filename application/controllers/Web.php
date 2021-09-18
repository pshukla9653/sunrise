<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Web extends Admin_Controller
{
 
  function __construct()
  {
    
	parent::__construct();
	$this->load->model('Web_model');
  }
  
  	public function index() {
		
     
	$this->load->view('secure/login');
       
    }

	
}
    

