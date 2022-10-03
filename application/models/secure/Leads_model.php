<?php
class Leads_model extends CI_Model
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
	function get_all_leadreminder_list($table, $where)
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get_where($table, $where)->result_array();
	}
	function insert_data($table, $params)
	{
		$this->db->insert($table, $params);
		return $this->db->insert_id();
	}


	function update_data($table, $where, $params)
	{
		$this->db->where($where);
		return $this->db->update($table, $params);
	}


	function delete_data($table, $where)
	{
		return $this->db->delete($table, $where);
	}
	function get_user_where($value, $where)
	{
		$this->db->select($value);
		$this->db->from('tbl_users');
		$this->db->join('tbl_users_details', 'tbl_users.id=tbl_users_details.user_id');
		$this->db->where($where);
		$this->db->where('tbl_users.branch_id', $this->session->userdata('branch_id'));
		$this->db->where('tbl_users.company_id', $this->session->userdata('company_id'));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_autocomplete($search_data)
	{
		$this->db->select('customer_name, id');
		$this->db->like('customer_name', $search_data);
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		return $this->db->get('tbl_leads')->result();
	}
	function get_customer_details($id)
	{

		$this->db->select('tbl_leads.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
		$this->db->from('tbl_leads');
		$this->db->join('tbl_countries', 'tbl_leads.country_id=tbl_countries.country_id');
		$this->db->join('tbl_states', 'tbl_leads.state_id=tbl_states.state_id');
		$this->db->join('tbl_cities', 'tbl_leads.city_id=tbl_cities.city_id');
		$this->db->where('tbl_leads.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_data_or()
	{
		$this->db->select('*');
		$this->db->from('tbl_leads');
		//$this->db->where('tbl_leads.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_invoice_list()
	{

		$this->db->select('tbl_leads_invoice.*,tbl_leads.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
		$this->db->from('tbl_leads_invoice');
		$this->db->join('tbl_leads', 'tbl_leads.id=tbl_leads_invoice.customer_id');
		$this->db->join('tbl_countries', 'tbl_leads.country_id=tbl_countries.country_id');
		$this->db->join('tbl_states', 'tbl_leads.state_id=tbl_states.state_id');
		$this->db->join('tbl_cities', 'tbl_leads.city_id=tbl_cities.city_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_product_service_list()
	{

		$this->db->select('tbl_leads_product_service.*,tbl_leads.*,tbl_products.product_name,tbl_services.service_name');
		$this->db->from('tbl_leads_product_service');
		$this->db->join('tbl_leads', 'tbl_leads.id=tbl_leads_product_service.customer_id');
		$this->db->join('tbl_products', 'tbl_products.id=tbl_leads_product_service.product_id');
		$this->db->join('tbl_services', 'tbl_services.id=tbl_leads_product_service.service_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_oldinvoice_list()
	{

		$this->db->select('tbl_leads_invoice_old.*,tbl_leads.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name');
		$this->db->from('tbl_leads_invoice_old');
		$this->db->join('tbl_leads', 'tbl_leads.id=tbl_leads_invoice_old.customer_id');
		$this->db->join('tbl_countries', 'tbl_leads.country_id=tbl_countries.country_id');
		$this->db->join('tbl_states', 'tbl_leads.state_id=tbl_states.state_id');
		$this->db->join('tbl_cities', 'tbl_leads.city_id=tbl_cities.city_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_lead_list()
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('*');
			$this->db->from('tbl_leads');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('*');
			$this->db->from('tbl_leads');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.followup_assigned', $this->session->userdata('id'));
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_today_reminder_list($date)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads_reminder.reminder_on', $date);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.followup_assigned', $this->session->userdata('id'));
			$this->db->where('tbl_leads_reminder.reminder_on', $date);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_today_reminder_list_between($datefrom, $dateto)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads_reminder.reminder_on>=', $datefrom);
			$this->db->where('tbl_leads_reminder.reminder_on<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.followup_assigned', $this->session->userdata('id'));
			$this->db->where('tbl_leads_reminder.reminder_on>=', $datefrom);
			$this->db->where('tbl_leads_reminder.reminder_on<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_today_assignlead_list($date)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on,tbl_leads.work_assigned,tbl_leads.work_status');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.work_assign_on', $date);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on,tbl_leads.work_assigned');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.work_assigned', $this->session->userdata('id'));
			$this->db->where('tbl_leads.work_status', 0);
			$this->db->where('tbl_leads.work_assign_on', $date);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_today_assignlead_list_between($datefrom, $dateto, $workassignedu)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on,tbl_leads.work_assigned,tbl_leads.work_status');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			if ($workassignedu != '') {
				$this->db->where('tbl_leads.work_assigned', $workassignedu);
			}
			$this->db->where('tbl_leads.work_assign_on>=', $datefrom);
			$this->db->where('tbl_leads.work_assign_on<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_leads.id,tbl_leads.product_id,tbl_leads.service_id,tbl_leads.followup_assigned,tbl_leads.mobile,tbl_leads.alternate_mobile,tbl_leads.customer_name,tbl_leads.address,tbl_leads_reminder.description,tbl_leads_reminder.reminder_on,tbl_leads.work_assigned');
			$this->db->from('tbl_leads');
			$this->db->join('tbl_leads_reminder', 'tbl_leads.id=tbl_leads_reminder.lead_id');
			$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
			$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
			$this->db->where('tbl_leads.work_assigned', $this->session->userdata('id'));
			$this->db->where('tbl_leads.work_assign_on>=', $datefrom);
			$this->db->where('tbl_leads.work_assign_on<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_customer_list()
	{

		$this->db->select('tbl_leads.*,tbl_countries.country_name,tbl_states.state_name,tbl_cities.city_name,tbl_services.service_name,tbl_products.product_name');
		$this->db->from('tbl_leads');
		$this->db->join('tbl_countries', 'tbl_leads.country_id=tbl_countries.country_id');
		$this->db->join('tbl_states', 'tbl_leads.state_id=tbl_states.state_id');
		$this->db->join('tbl_cities', 'tbl_leads.city_id=tbl_cities.city_id');
		$this->db->join('tbl_services', 'tbl_leads.service_id=tbl_services.id');
		$this->db->join('tbl_products', 'tbl_leads.product_id=tbl_products.id');
		$this->db->where('tbl_leads.company_id', $this->session->userdata('company_id'));
		$this->db->where('tbl_leads.branch_id', $this->session->userdata('branch_id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_selected_data($value, $table, $where)
	{
		$this->db->select($value);
		return $this->db->get_where($table, $where)->row_array();
	}
	function serachmanifestbydate($value, $customer_id, $from_date, $date_to)
	{
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

		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	function get_today_ms_list($date)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_customer_ms_service.id,tbl_customer_ms_service.product_id,tbl_customer_ms_service.ms_date,tbl_customer_ms_service.service_id,tbl_customer_ms_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_ms_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_ms_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_ms_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_ms_service.service_id');
			$this->db->where('tbl_customer_ms_service.ms_date', $date);
			$this->db->where('tbl_customer_ms_service.ms_status', 0);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_customer_ms_service.id,tbl_customer_ms_service.product_id,tbl_customer_ms_service.service_id,tbl_customer_ms_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer_ms_service.ms_date,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_ms_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_ms_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_ms_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_ms_service.service_id');
			$this->db->where('tbl_customer_ms_service.ms_date', $date);
			$this->db->where('tbl_customer_ms_service.ms_status', 0);
			$this->db->where('tbl_customer_ms_service.ms_by', $this->session->userdata('id'));
			$query = $this->db->get();
			return $query->result_array();
		}
	}
	function get_today_ms_list_between($datefrom, $dateto, $workassignedu)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_customer_ms_service.id,tbl_customer_ms_service.product_id,tbl_customer_ms_service.service_id,tbl_customer_ms_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer_ms_service.ms_date,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_ms_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_ms_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_ms_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_ms_service.service_id');
			$this->db->where('tbl_customer_ms_service.ms_status', 0);
			if ($workassignedu != '') {
				$this->db->where('tbl_customer_ms_service.ms_by', $workassignedu);
			}
			$this->db->where('tbl_customer_ms_service.ms_date>=', $datefrom);
			$this->db->where('tbl_customer_ms_service.ms_date<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_customer_ms_service.id,tbl_customer_ms_service.product_id,tbl_customer_ms_service.service_id,tbl_customer_ms_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer_ms_service.ms_date,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_ms_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_ms_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_ms_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_ms_service.service_id');
			$this->db->where('tbl_customer_ms_service.ms_status', 0);
			$this->db->where('tbl_customer_ms_service.ms_by', $this->session->userdata('id'));
			$this->db->where('tbl_customer_ms_service.ms_date>=', $datefrom);
			$this->db->where('tbl_customer_ms_service.ms_date<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		}
	}

	function get_today_expire_list($date)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_customer_product_service.id,tbl_customer_product_service.product_id,tbl_customer_product_service.amc_end_date,tbl_customer_product_service.service_id,tbl_customer_product_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_product_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_product_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_product_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_product_service.service_id');
			$this->db->where('tbl_customer_product_service.amc_end_date', $date);
			//$this->db->where('tbl_customer_ms_service.ms_status', 0);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_customer_product_service.id,tbl_customer_product_service.product_id,tbl_customer_product_service.amc_end_date,tbl_customer_product_service.service_id,tbl_customer_product_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_product_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_product_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_product_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_product_service.service_id');
			$this->db->where('tbl_customer_product_service.amc_end_date', $date);
			//$this->db->where('tbl_customer_ms_service.ms_status', 0);
			//$this->db->where('tbl_customer_ms_service.ms_by', $this->session->userdata('id'));
			$query = $this->db->get();
			return $query->result_array();
		}
	}
	function get_today_expire_list_between($datefrom, $dateto, $workassignedu)
	{
		if ($this->session->userdata('group_id') <= 4) {
			$this->db->select('tbl_customer_product_service.id,tbl_customer_product_service.product_id,tbl_customer_product_service.amc_end_date,tbl_customer_product_service.service_id,tbl_customer_product_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_product_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_product_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_product_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_product_service.service_id');
			$this->db->where('tbl_customer_product_service.status', 0);
			//if($workassignedu !=''){
			//			$this->db->where('tbl_customer_ms_service.ms_by', $workassignedu);
			//			}
			$this->db->where('tbl_customer_ms_service.amc_end_date>=', $datefrom);
			$this->db->where('tbl_customer_ms_service.amc_end_date<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		} elseif ($this->session->userdata('group_id') >= 8) {
			$this->db->select('tbl_customer_product_service.id,tbl_customer_product_service.product_id,tbl_customer_product_service.amc_end_date,tbl_customer_product_service.service_id,tbl_customer_product_service.customer_id,tbl_customer.customer_name,tbl_customer.address,tbl_customer.mobile,tbl_customer.customer_code,tbl_products.product_name,tbl_services.service_name');
			$this->db->from('tbl_customer_product_service');
			$this->db->join('tbl_customer', 'tbl_customer.id=tbl_customer_product_service.customer_id');
			$this->db->join('tbl_products', 'tbl_products.id=tbl_customer_product_service.product_id');
			$this->db->join('tbl_services', 'tbl_services.id=tbl_customer_product_service.service_id');
			$this->db->where('tbl_customer_product_service.status', 0);
			//$this->db->where('tbl_customer_ms_service.ms_by', $this->session->userdata('id'));
			$this->db->where('tbl_customer_ms_service.amc_end_date>=', $datefrom);
			$this->db->where('tbl_customer_ms_service.amc_end_date<=', $dateto);
			$query = $this->db->get();
			return $query->result_array();
		}
	}
}
