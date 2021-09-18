<?php
class Vendor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    
    function get_data($table, $where)
    {
        return $this->db->get_where($table, $where)->row_array();
    }
	function get_all_list($table, $where)
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get_where($table, $where)->result_array();
    }
    function insert_data($table, $params)
    {
        $this->db->insert($table,$params);
        return $this->db->insert_id();
    }
    
    
    function update_data($table, $where,$params)
    {
        $this->db->where($where);
        return $this->db->update($table,$params);
    }
    
    
    function delete_data($table, $where)
    {
        return $this->db->delete($table, $where);
    }
	
	 public function get_autocomplete($search_data)
	 {
			$this->db->select('vendor_name, id');
			$this->db->like('vendor_name', $search_data);
			$this->db->where('branch_id', $this->session->userdata('branch_id'));
			$this->db->where('company_id', $this->session->userdata('company_id'));
			return $this->db->get('tbl_vendor')->result();

	 } 
	 function get_vendor_details($id)
    {
        
		$this->db->select('tbl_vendor.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_vendor');
			$this->db->join('tbl_countries', 'tbl_vendor.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_vendor.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_vendor.city_id=tbl_cities.city_id');
			$this->db->where('tbl_vendor.id', $id);
			$query = $this->db->get();
			return $query->row_array();
    }
	function get_bill_list()
    {
        
			$this->db->select('tbl_vender_bill.*,tbl_vendor.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_vender_bill');
			$this->db->join('tbl_vendor', 'tbl_vendor.id=tbl_vender_bill.vender_id');
			$this->db->join('tbl_countries', 'tbl_vendor.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_vendor.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_vendor.city_id=tbl_cities.city_id');
			$query = $this->db->get();
			return $query->result_array();
    }
	function get_selected_data($value, $table, $where)
    {
        $this->db->select($value);
		return $this->db->get_where($table, $where)->row_array();
    }
	function serachmanifestbydate($value, $vendor_id, $from_date, $date_to){
			$this->db->select($value);
			$this->db->from('tbl_manifest');
			$this->db->join('tbl_agent_out', 'tbl_agent_out.id=tbl_manifest.agent_id');
			$this->db->join('tbl_mode', 'tbl_mode.id=tbl_manifest.mode_id');
			$this->db->where('tbl_manifest.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_manifest.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_manifest.vendor_id', $vendor_id);
			$this->db->where('tbl_manifest.manifest_date>=', $from_date);
			$this->db->where('tbl_manifest.manifest_date<=', $date_to);
			$query = $this->db->get();
			
			if($query->num_rows()!=0){
			return $query->result_array();
			
			}
			else{
				return false;	
			}
			
		}
	function getmanifestdata($id){
			$this->db->select('tbl_manifest.id,tbl_manifest.agent_id,tbl_manifest.mode_id,tbl_manifest.total_pieces,tbl_manifest.manifest_date,
			tbl_manifest.no_of_consignment,tbl_manifest.total_weight,tbl_manifest.total_docket_price,tbl_agent_out.agent_name,tbl_mode.mode_name');
			$this->db->from('tbl_manifest');
			$this->db->join('tbl_agent_out', 'tbl_agent_out.id=tbl_manifest.agent_id');
			$this->db->join('tbl_mode', 'tbl_mode.id=tbl_manifest.mode_id');
			$this->db->where('tbl_manifest.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_manifest.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_manifest.id', $id);
			$query = $this->db->get();
			///var_dump($query->result_array());
			if($query->num_rows()!=0){
			return array_shift($query->result_array());
			
			}
			else{
				return false;	
			}
			
		}
}
