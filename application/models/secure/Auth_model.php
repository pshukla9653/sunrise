<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	function __construct(){
     
          parent::__construct();
		  
     }
	 public function check_username($username){
  		// echo $username, $password;exit;
		$this -> db -> select('*');
		$this -> db -> from('tbl_users');
		$this -> db -> where('username', $username);
		$this -> db -> where('status', '1');
		$query = $this->db->get();
		
		if($query -> num_rows() == 1) {
			return true;
		} else {
			
			return false;
		}			
     }	
	 
	 public function login($username, $password){
  		// echo $username, $password;exit;
		$this -> db -> select('*');
		$this -> db -> from('tbl_users');
		$this -> db -> where('tbl_users.username', $username);
		$this -> db -> where('tbl_users.status', '1');
		$query = $this->db->get();
		
		if($query -> num_rows() == 1) {
		//echo "hello";exit;
			$res['result'] = array_shift($query->result_array());
			//echo var_dump($res['result']);
			$h = hash("sha256", $password.$res['result']['salt']);
			//echo $h; exit;
			if($h==$res['result']['passkey'])
			//echo "hello";exit;
				return array_shift($query->result_array());
		} else {
			//echo "hiii";exit;
			return false;
		}			
     }	
}

?>