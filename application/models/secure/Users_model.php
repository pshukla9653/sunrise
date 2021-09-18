<?php

 
class Users_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by id
     */
    function get_user($value, $id)
    {
        $this->db->select($value);
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->where('tbl_users.id', $id);
		$query = $this->db->get();
		return $query->row_array();
    }
	
	function get_data($value, $table, $where)
    {
        $this->db->select($value);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row_array();
    }
	
	function get_user_where($value, $where)
    {
        $this->db->select($value);
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();
    }
        
    /*
     * Get all userlist
     */
    function get_all_userslist()
    {
        if($this->session->userdata('id')==1){
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->join('tbl_group', 'tbl_group.id=tbl_users.group_id');
		$this->db->order_by('tbl_users.id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
		}
		else{
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->join('tbl_group', 'tbl_group.id=tbl_users.group_id');
		$this->db->where('tbl_users.group_id >', $this->session->userdata('group_id'));
		$this->db->order_by('tbl_users.id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
        
		}
    }
      public function save_file_info($file, $where, $table, $field) {
		//start db traction
		$this->db->trans_start();
		
		$this->db->where($where);
		$this->db->update($table, array($field=>$file['file_name']));
		
		//complete the transaction
		$this->db->trans_complete();
		//check transaction status
		if ($this->db->trans_status() === FALSE) {
			$file_path = $file['full_path'];
			//delete the file from destination
			if (file_exists($file_path)) {
			unlink($file_path);
		}
		//rollback transaction
		$this->db->trans_rollback();
			return FALSE;
		} else {
			//commit the transaction
			$this->db->trans_commit();
			return TRUE;
		}
	}	
	 function get_own_userslist()
    {
        if($this->session->userdata('id')==1){
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->where('tbl_users.id', $id);
		$this->db->order_by('tbl_users.id', 'desc');
		$query = $this->db->get();
		return $query->row_array();
		}
		else{
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
			$this->db->where('tbl_users.id', $id);
			$this->db->where('tbl_users.group_id >', $this->session->userdata('group_id'));
			$this->db->where('tbl_users.createdby', $this->session->userdata('id'));
			$this->db->order_by('tbl_users.id', 'desc');
			$query = $this->db->get();
			return $query->row_array();
		}
	}   
    /*
     * function to add new group
     */
    function add_users($table,$params)
    {
        $this->db->insert($table,$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update group
     */
    function update_users($table, $id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update($table,$params);
    }
    
    /*
     * function to delete group
     */
    function delete_users($id)
    {
        $this->db->delete('tbl_users',array('id'=>$id));
		return $this->db->delete('tbl_users_details',array('user_id'=>$id));
    }
}
