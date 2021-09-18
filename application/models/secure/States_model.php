<?php
class States_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_state($id)
    {
        return $this->db->get_where('tbl_states', array('state_id'=>$id))->row_array();
    }
	
	function get_state_by_country($country_id)
    {
        return $this->db->get_where('tbl_states', array('country_id'=>$country_id))->result_array();
    }
        
    function get_all_states()
    {
        $this->db->select('tbl_states.state_id,tbl_states.state_name,tbl_states.status,tbl_countries.country_name');
		$this->db->from('tbl_states');
		$this->db->join('tbl_countries', 'tbl_states.country_id=tbl_countries.country_id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function getstatelist(){
		$this->db->order_by('state_name', 'asc');
		return $this->db->get('tbl_states')->result_array();
	}
	
    function add_state($params)
    {
        $this->db->insert('tbl_states',$params);
        return $this->db->insert_id();
    }
    
    
    function update_state($id,$params)
    {
        $this->db->where('state_id',$id);
        return $this->db->update('tbl_states',$params);
    }
    
    
    function delete_state($id)
    {
        return $this->db->delete('tbl_states',array('id'=>$id));
    }
}
