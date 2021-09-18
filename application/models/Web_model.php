<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_model extends CI_Model
{

    function __construct(){
     
          parent::__construct();
		  
     }
function get_site_setting(){
	return $this->db->get_where('tbl_setting',array('id'=>1))->row_array();
}

function get_page_by_slug($slug){
	return $this->db->get_where('tbl_pages',array('slug'=>$slug,'status'=>1))->row_array();
}

function get_page_by_template($parent, $template){
	return $this->db->get_where('tbl_pages',array('parent'=>$parent,'template'=>$template,'status'=>1))->row_array();
}
function get_page_list_by_template($parent, $template){
	$this->db->order_by('id', 'asc');
	return $this->db->get_where('tbl_pages',array('parent'=>$parent,'template'=>$template,'status'=>1))->result_array();
}
function get_page_count_by_template($parent, $template){
	$this->db->order_by('id', 'asc');
	return $this->db->get_where('tbl_pages',array('parent'=>$parent,'template'=>$template,'status'=>1))->num_rows();
}
function get_page_list_by_template_limit($parent, $template, $limit){
	$this->db->order_by('id', 'asc');
	return $this->db->get_where('tbl_pages', array('parent'=>$parent,'template'=>$template,'status'=>1), $limit)->result_array();
}

function get_more_gallery_limit($id, $limit){
	$this->db->order_by('id', 'desc');
	return $this->db->get_where('tbl_pages', array('id>'=>$id,'parent'=>'default','template'=>'gallery','status'=>1), $limit)->result_array();
}
function get_count_gallery($id){
	$this->db->order_by('id', 'desc');
	return $this->db->get_where('tbl_pages', array('id>'=>$id,'parent'=>'default','template'=>'gallery','status'=>1))->num_rows();
}	

function InsertData($table, $params)
    {
        $this->db->insert($table,$params);
        return $this->db->insert_id();
    }
function get_all_list($table, $where)
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get_where($table, $where)->result_array();
    }
	function get_branch_details($id)
    {
        
		$this->db->select('tbl_branch.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_branch');
			$this->db->join('tbl_countries', 'tbl_branch.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_branch.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_branch.city_id=tbl_cities.city_id');
			$this->db->where('tbl_branch.id', $id);
			$query = $this->db->get();
			return $query->row_array();
    }
function get_data($table, $where)
    {
        return $this->db->get_where($table, $where)->row_array();
    }
function get_user($value, $id)
    {
        $this->db->select($value);
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->where('tbl_users.id', $id);
		$query = $this->db->get();
		return $query->row_array();
    }
function findshippment($barcode)
		{
			$this->db->select('id,branch_id,emp_id,reciving');
			$this->db->from('tbl_shippment');
			$this->db->where('company_id', 1);
			$this->db->where('awbcode', $barcode);
			$query = $this->db->get();
			if($query->num_rows()!=0){
			return $query->row_array();
			}
			else{
			return false;	
			}
			
		}
}

?>