<?php
class City_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_city($id)
    {
        return $this->db->get_where('tbl_cities', array('city_id'=>$id))->row_array();
    }
	
	function get_city_by_country($state_id)
    {
        return $this->db->get_where('tbl_cities', array('state_id'=>$state_id))->result_array();
    }
        
    function get_all_cities()
    {
        $this->db->select('tbl_cities.city_id,tbl_cities.city_name,tbl_cities.status,tbl_states.state_name');
		$this->db->from('tbl_cities');
		$this->db->join('tbl_states', 'tbl_cities.state_id=tbl_states.state_id');
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function getcitylist(){
		$this->db->order_by('city_name', 'asc');
		return $this->db->get('tbl_cities')->result_array();
	}
	
    function add_city($params)
    {
        $this->db->insert('tbl_cities',$params);
        return $this->db->insert_id();
    }
    
    
    function update_city($id,$params)
    {
        $this->db->where('city_id',$id);
        return $this->db->update('tbl_cities',$params);
    }
    
    
    function delete_city($id)
    {
        return $this->db->delete('tbl_cities',array('id'=>$id));
    }
}
