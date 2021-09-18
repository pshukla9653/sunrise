<?php

 
class Countries_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get group by id
     */
    function get_countries($id)
    {
        return $this->db->get_where('tbl_countries',array('country_id'=>$id))->row_array();
    }
	
	
        
    /*
     * Get all grouplist
     */
    function get_all_countrieslist()
    {
        $this->db->order_by('country_id', 'desc');
        return $this->db->get('tbl_countries')->result_array();
    }
      
	    
    /*
     * function to add new group
     */
    function add_countries($params)
    {
        $this->db->insert('tbl_countries',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update group
     */
    function update_countries($id,$params)
    {
        $this->db->where('country_id',$id);
        return $this->db->update('tbl_countries',$params);
    }
    
    /*
     * function to delete group
     */
    function delete_countries($id)
    {
        return $this->db->delete('tbl_countries',array('country_id'=>$id));
    }
}
