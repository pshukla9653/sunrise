<?php

 
class Setting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
    /*
     * Get menu by id
     */
    function get_setting($id)
    {
        return $this->db->get_where('tbl_setting',array('id'=>$id))->row_array();
    }
     function update_data($table, $where,$params)
    {
        $this->db->where($where);
        return $this->db->update($table,$params);
    }
	 function get_all_list($table, $where)
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get_where($table, $where)->result_array();
    }
	   
    function update_setting($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('tbl_setting',$params);
    }
    
    /*
     * function to delete menu
     */
    function delete_menu($id)
    {
        return $this->db->delete('tbl_menu',array('id'=>$id));
    }
}
