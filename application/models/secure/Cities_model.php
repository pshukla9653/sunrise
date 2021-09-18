<?php

 
class Cities_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get group by id
     */
    function get_group($id)
    {
        return $this->db->get_where('tbl_group',array('id'=>$id))->row_array();
    }
	
	function get_city_by_state($state_id)
    {
        return $this->db->get_where('tbl_cities',array('state_id'=>$state_id))->result_array();
    }
     function get_all_cities()
    {
        $this->db->order_by('city_name', 'asc');
		return $this->db->get('tbl_cities')->result_array();
    }   
    /*
     * Get all grouplist
     */
    function get_all_grouplist()
    {
        if($this->session->userdata('id')==1){
		$this->db->order_by('id', 'desc');
        return $this->db->get('tbl_group')->result_array();
		}
		else{
			$this->db->order_by('id', 'desc');
        return $this->db->get_where('tbl_group', array('id >'=>$this->session->userdata('group_id')))->result_array();
		}
    }
      
	 function get_own_grouplist()
    {
        if($this->session->userdata('id')==1){
		$this->db->order_by('id', 'asc');
        return $this->db->get('tbl_group')->result_array();
		}
		else{
			$this->db->order_by('id', 'asc');
        return $this->db->get_where('tbl_group', array('id >'=>$this->session->userdata('group_id'), 'createdby'=>$this->session->userdata('id')))->result_array();
		}
	}   
    /*
     * function to add new group
     */
    function add_group($params)
    {
        $this->db->insert('tbl_group',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update group
     */
    function update_group($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('tbl_group',$params);
    }
    
    /*
     * function to delete group
     */
    function delete_group($id)
    {
        return $this->db->delete('tbl_group',array('id'=>$id));
    }
}
