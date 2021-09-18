<?php

 
class Company_model extends CI_Model
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
	function get_company_list(){
			$this->db->select('tbl_company.*,tbl_users_details.name');
			$this->db->from('tbl_company');
			$this->db->join('tbl_users_details', 'tbl_company.user_id=tbl_users_details.user_id');
			$this->db->order_by('tbl_company.id', 'desc');
			$query = $this->db->get();
			return $query->result_array();
	}
    /*
     * Get menu by id
     */
    function get_company($id)
    {
        return $this->db->get_where('tbl_company',array('id'=>$id))->row_array();	
    }
	function get_company_details($id)
    {
        
		$this->db->select('tbl_company.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_company');
			$this->db->join('tbl_countries', 'tbl_company.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_company.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_company.city_id=tbl_cities.city_id');
			$this->db->where('tbl_company.id', $id);
			$this->db->order_by('tbl_company.id', 'desc');
			$query = $this->db->get();
			return $query->row_array();
    }
        
    function update_data($table, $id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update($table,$params);
    }
    
	
	function insert_data($table,$params)
    {
        
        $this->db->insert($table,$params);
        return $this->db->insert_id();
    }
    /*
     * function to delete menu
     */
    function delete_menu($id)
    {
        return $this->db->delete('tbl_menu',array('id'=>$id));
    }
}
