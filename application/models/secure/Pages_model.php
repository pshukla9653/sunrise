<?php

 
class Pages_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get page by id
	 
     */
    	function get_page($id)
    {
        return $this->db->get_where('tbl_pages', array('id'=>$id))->row_array();
    }
        
    /*
     * Get all pagelist
     */
    function get_all_pageslist()
    {
        
		$this->db->select('*');
		$this->db->from('tbl_pages');
		$this->db->order_by('tbl_pages.id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
        
		
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
	 function get_own_pagelist()
    {
        
			$this->db->select('*');
			$this->db->from('tbl_pages');
			$this->db->where('tbl_pages.createdby', $this->session->userdata('id'));
			$this->db->order_by('tbl_pages.id', 'desc');
			$query = $this->db->get();
			return $query->row_array();
		
	}   
    /*
     * function to add new page
     */
    function add_page($params)
    {
        $this->db->insert('tbl_pages',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update page
     */
    function update_page($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('tbl_pages',$params);
    }
    
    /*
     * function to delete page
     */
    function delete_page($id)
    {
        
		return $this->db->delete('tbl_pages',array('id'=>$id));
    }
}
