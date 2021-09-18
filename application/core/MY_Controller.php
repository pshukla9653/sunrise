
<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_controller extends CI_Controller
{
 public $site_setting;
  function __construct()
  {
    parent::__construct();
	$this->load->model('secure/Setting_model');
	$this->site_setting = $this->Setting_model->get_setting(1);
	
  }
  
}
 
class Admin_Controller extends MY_controller 
{

	var $GroupPermission = array();
	var $GroupName = '';
	var $Setting = '';
	var $CompanyDetail = '';
	var $BranchDetail = '';

	public function __construct() 
	{
		parent::__construct();
		
		//var_dump($this->session->userdata('company_id')); exit;
		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
		else {
			
			$this->load->model('secure/Group_model');
			$this->load->model('secure/Company_model');
			$this->load->model('secure/Branch_model');
			$this->load->model('secure/Users_model');
			 $group_data = $this->Group_model->get_group($this->session->userdata('group_id'));
			 $this->CompanyDetail= $this->Company_model->get_company_details($this->session->userdata('company_id'));
			 $this->BranchDetail= $this->Branch_model->get_branch_details($this->session->userdata('branch_id'));
			
			$this->GroupName = $group_data['group_title'];
			$this->GroupPermission = explode(',', $group_data['group_permission']);
		//var_dump($this->session->userdata());exit;
		if($this->session->userdata('name')==''){$get_name = $this->Users_model->get_data('name','tbl_users_details',array('user_id'=>$this->session->userdata('id')));
				$this->session->set_userdata(array('name'=>$get_name['name']));
			//if($this->session->userdata('group_id')==4){
//				$get_name = $this->Users_model->get_data('loader_name','tbl_loader',array('user_id'=>$this->session->userdata('id')));
//				$this->session->set_userdata(array('name'=>$get_name['loader_name']));
//			}
//			elseif($this->session->userdata('group_id')==5){
//				$get_name = $this->Users_model->get_data('client_name','tbl_client',array('user_id'=>$this->session->userdata('id')));
//				$this->session->set_userdata(array('name'=>$get_name['client_name']));
//			}
//			elseif($this->session->userdata('group_id')==6){
//				$get_name = $this->Users_model->get_data('agent_name','tbl_agent_in',array('user_id'=>$this->session->userdata('id')));
//				$this->session->set_userdata(array('name'=>$get_name['agent_name']));
//			}
//			elseif($this->session->userdata('group_id')==7){
//				$get_name = $this->Users_model->get_data('agent_name','tbl_agent_out',array('user_id'=>$this->session->userdata('id')));
//				$this->session->set_userdata(array('name'=>$get_name['agent_name']));
//			}else{
//				$get_name = $this->Users_model->get_data('name','tbl_users_details',array('user_id'=>$this->session->userdata('id')));
//				$this->session->set_userdata(array('name'=>$get_name['name']));
//			}
				
		}//$this->session->set_userdata($sessiondata);
		}
	}

public function objToArray($obj)
{
    // Not an object or array
    if (!is_object($obj) && !is_array($obj)) {
        return $obj;
    }

    // Parse array
    foreach ($obj as $key => $value) {
        $arr[$key] = $this->objToArray($value);
    }

    // Return parsed array
    return $arr;
}
	public function logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('secure/dashboard', 'refresh');
		}
		
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('secure/auth/login', 'refresh');
		}
	}
	public function convertDatetoMysqlDate($date){
		$d	= explode('/', $date);
		return $date;
		}
		
		function get_first_num_of_words($string, $num_of_words)
    {
        $string = preg_replace('/\s+/', ' ', trim($string));
        $words = explode(" ", $string); // an array

        // if number of words you want to get is greater than number of words in the string
        if ($num_of_words > count($words)) {
            // then use number of words in the string
            $num_of_words = count($words);
        }

        $new_string = "";
        for ($i = 0; $i < $num_of_words; $i++) {
            $new_string .= $words[$i] . " ";
        }

        return trim($new_string);
    }
	
	public function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		$file = Zend_Barcode::draw('code39', 'image', array('text' => $code, 'barHeight'=>20,'fontSize'=>4,'factor'=>1), array());
		//$code = $code;
		$store_image = imagepng($file, "./uploads/barcode/{$code}.png");
		return $code . '.png';
	}
		
	public function render_template($page = null, $data = array())
	{
		
		$this->load->model('secure/Menu_model');
		$data['menu_order'] = $this->objToArray(json_decode($this->site_setting['admin_menu_order'], true));
		$this->load->view('secure/template/header', $data);
		$this->load->view('secure/template/side_menu', $data);
		$this->load->view($page, $data);
		$this->load->view('secure/template/footer', $data);
	}

	public function check_permission()
	{
		if($this->session->userdata('logged_in')==true){
		$checkallpermission = $this->uri->segment(2).'-'.$this->uri->segment(3);
		$checkownpermission = $this->uri->segment(2).'-'.$this->uri->segment(3).'-own';
		
		if(in_array($checkallpermission, $this->GroupPermission) || in_array($checkownpermission, $this->GroupPermission)){
			
			if(in_array($checkallpermission, $this->GroupPermission)){
				return 'All';
			}
			elseif(in_array($checkownpermission, $this->GroupPermission)){
				return 'Own';
			}
		}
		else{
			echo '<script> alert("Access Denied! You do not have permission to access this page");</script>';
			echo '<script> window.history.back();</script>';
		}
		}
		else{
				$this->not_logged_in();
		}

	}

	
}
 
