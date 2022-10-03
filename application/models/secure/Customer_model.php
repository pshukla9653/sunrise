<?php
class Customer_model extends CI_Model
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
    
    
    function update_data($table, $where, $params)
    {
        $this->db->where($where);
        return $this->db->update($table,$params);
    }
    
    
    function delete_data($table, $where)
    {
        return $this->db->delete($table, $where);
    }
	
	 function get_customer_details($id)
    {
        
		$this->db->select('tbl_customer.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_customer');
			$this->db->join('tbl_countries', 'tbl_customer.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_customer.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_customer.city_id=tbl_cities.city_id');
			$this->db->where('tbl_customer.id', $id);
			$query = $this->db->get();
			return $query->row_array();
    }
	
	function get_invoice_list()
    {
        
			$this->db->select('tbl_customer_invoice.*,tbl_customer.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_customer_invoice');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_invoice.customer_id');
			$this->db->join('tbl_countries', 'tbl_customer.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_customer.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_customer.city_id=tbl_cities.city_id');
			$query = $this->db->get();
			return $query->result_array();
    }
	function get_product_service_list()
    {
        
			$this->db->select('tbl_customer_product_service.*,tbl_customer.*,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_product_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_product_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_product_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_product_service.service_id');
			$query = $this->db->get();
			return $query->result_array();
    }
	
	function get_oldinvoice_list()
    {
        
			$this->db->select('tbl_customer_invoice_old.*,tbl_customer.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
			$this->db->from('tbl_customer_invoice_old');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_invoice_old.customer_id');
			$this->db->join('tbl_countries', 'tbl_customer.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_customer.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_customer.city_id=tbl_cities.city_id');
			$query = $this->db->get();
			return $query->result_array();
    }
	
	function get_lead_list()
    {
        
		$this->db->select('tbl_customer.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name,tbl_services.service_name,tbl_products.product_name');
			$this->db->from('tbl_customer');
			$this->db->join('tbl_countries', 'tbl_customer.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_customer.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_customer.city_id=tbl_cities.city_id');
			$this->db->join('tbl_services', 'tbl_customer.service_id=tbl_services.id');
			$this->db->join('tbl_products', 'tbl_customer.product_id=tbl_products.id');
			$this->db->where('tbl_customer.invoice_status', 0);
			$this->db->where('tbl_customer.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_customer.branch_id', $this->session->userdata('branch_id'));
			$query = $this->db->get();
			return $query->result_array();
    }
	function get_customer_list()
    {
        
		$this->db->select('tbl_customer.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name,tbl_services.service_name,tbl_products.product_name');
			$this->db->from('tbl_customer');
			$this->db->join('tbl_countries', 'tbl_customer.country_id=tbl_countries.country_id');
			$this->db->join('tbl_states', 'tbl_customer.state_id=tbl_states.state_id');
			$this->db->join('tbl_cities', 'tbl_customer.city_id=tbl_cities.city_id');
			$this->db->join('tbl_services', 'tbl_customer.service_id=tbl_services.id');
			$this->db->join('tbl_products', 'tbl_customer.product_id=tbl_products.id');
			$this->db->where('tbl_customer.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_customer.branch_id', $this->session->userdata('branch_id'));
			$query = $this->db->get();
			return $query->result_array();
    }
	
	function get_selected_data($value, $table, $where)
    {
        $this->db->select($value);
		return $this->db->get_where($table, $where)->row_array();
    }
	function serachmanifestbydate($value, $customer_id, $from_date, $date_to){
			$this->db->select($value);
			$this->db->from('tbl_manifest');
			$this->db->join('tbl_agent_out', 'tbl_agent_out.id=tbl_manifest.agent_id');
			$this->db->join('tbl_mode', 'tbl_mode.id=tbl_manifest.mode_id');
			$this->db->where('tbl_manifest.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_manifest.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_manifest.customer_id', $customer_id);
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
