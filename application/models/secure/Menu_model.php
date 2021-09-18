<?php

 
class Menu_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    
	/*
     * Get menu by id
     */
	 
	 
	 
    function get_data($where)
    {
        return $this->db->get_where('tbl_menu', $where)->row_array();
    }
	/*
     * Get menu by id
     */
	 
	 
	 
    function get_menu($id)
    {
        return $this->db->get_where('tbl_menu',array('id'=>$id))->row_array();
    }
    
	function get_main_menulist()
    {
		$this->db->order_by('id', 'asc');
        return $this->db->get_where('tbl_menu',array('menu_parent_id'=>0,'display_in_menu'=>1,'status'=>1))->result_array();
    }
	function get_sub_menulist($id)
    {
		$this->db->order_by('id', 'asc');
        return $this->db->get_where('tbl_menu',array('menu_parent_id'=>$id,'display_in_menu'=>1,'status'=>1))->result_array();
    }
	
	function get_all_sub_menulist($id, $f)
    {
		$this->db->order_by('id', 'asc');
		$this->db->not_like('menu_function', $f);
        return $this->db->get_where('tbl_menu',array('menu_parent_id'=>$id))->result_array();
    }
    /*
     * Get all menulist count
     */
    function get_all_menulist_count()
    {
        $this->db->from('tbl_menu');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all menulist
     */
    function get_all_menulist()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('tbl_menu')->result_array();
    }
     function get_own_menulist()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get_where('tbl_menu', array('createdby'=>$this->session->userdata('id')))->result_array();
    }   
    /*
     * function to add new menu
     */
    function add_menu($params)
    {
        $this->db->insert('tbl_menu',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update menu
     */
    function update_menu($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('tbl_menu',$params);
    }
    
    /*
     * function to delete menu
     */
    function delete_menu($id)
    {
        return $this->db->delete('tbl_menu',array('id'=>$id));
    }
}
