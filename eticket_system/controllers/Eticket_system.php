<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Eticket_system extends MX_Controller
{

function __construct() 
{
parent::__construct();
}

function index()
{
	$data['query'] = $this->get('id');
	$data['view_file'] = "eticket_main";
	$this->load->module('templates');
	$this->templates->cm_panel($data);
}

function get_label()
{
	$this->load->module('site_security');
	$this->load->library('ciqrcode'); // Load ciqrcode library
	
	$update_id = $this->uri->segment(3);
	
	// CIQRCode library parameters
	$params['data'] = base_url().'eticket_system/create/'.$update_id;
	$params['level'] = 'H';
	$params['size'] = 4;
	$params['savename'] = 'assets/img/test.png'; // DO NOT USE BASE_URL() METHOD!!!
	
	$data['qr_data'] = $this->ciqrcode->generate($params);
	$data['query'] = $this->get_where($update_id);
	$this->load->view('printout', $data);
}

function create() 
{
	$update_id = $this->uri->segment(3);
	
	$submit = $this->input->post('submit', TRUE);
	
	if (!isset($update_id)) 
	{
		$update_id = $this->input->post('update_id', TRUE); // $Get update ID from post if not present in URI segment
	}
	
	if ($submit=="Submit")
	{
			// Get the variables
			$data = $this->get_data_from_post();

			if (is_numeric($update_id))
			{
				//Update the item details if update ID is set.
				$query = $this->get_where($update_id);
				$num_rows = $query->num_rows();
				
				$this->_update($update_id,$data);
				$flash_msg = "The bug details were successfully updated!";
				$value = "<div class='alert alert-success' role='alert'>".$flash_msg."</div>";
				$this->session->set_flashdata('item', $value);
				redirect('eticket_system/create/'.$update_id);
			}
			else
			{
				// Get time and date as Unix Time Stamp.
				$data['date'] = time();
				
				// Generate ID.
				$this->load->module('site_security');
				$code_gen = $this->site_security->generate_random_string(10);
				$data['ticket_id'] = 'ESR-'.$code_gen;
				
				// Insert a new item if update ID is null.
				$this->_insert($data);
				$update_id = $this->get_max(); // Get the ID of the new item.
				$flash_msg = "The bug was successfully added!";
				$value = "<div class='alert alert-success' role='alert'>".$flash_msg."</div>";
				$this->session->set_flashdata('item', $value);
				redirect('eticket_system/create/'.$update_id);
			}
	} 
	elseif ($submit=="Cancel") 
	{
		redirect('eticket_system'); // Redirect on cancel
	}
	
	if (is_numeric($update_id)) {
		$data = $this->get_data_from_db($update_id); // Get from DB if update ID is numeric
		$data['$update_id'] = $update_id;
	}else{
		$data = $this->get_data_from_post(); // Get from post if update ID is null
	}

	$data['module'] = "eticket_system";
	$data['view_file'] = "create";
	echo Modules::run('your_module/method', $data);
}

function get_data_from_post() 
{
	// Get data from post
	$data['name'] = $this->input->post('name', TRUE);
	$data['address'] = $this->input->post('address', TRUE);
	$data['phone'] = $this->input->post('phone', TRUE);
	$data['device_make'] = $this->input->post('device_make', TRUE);
	$data['device_model'] = $this->input->post('device_model', TRUE);
	$data['device_sic'] = $this->input->post('device_sic', TRUE);
	return $data;
}

function get_data_from_db($update_id) 
{
	// Get data from DB
	$query = $this->get_where($update_id);
	foreach($query->result() as $row) 
	{
		$data['name'] = $row->name;
		$data['address'] = $row->address;
		$data['phone'] = $row->phone;
		$data['device_make'] = $row->device_make;
		$data['device_model'] = $row->device_model;
		$data['device_sic'] = $row->device_sic;
	}
	return $data;
}

function delete($data) 
{
	// Delete button pending
	$delete_id = $this->uri->segment(3);
	
	if (is_numeric($delete_id)) 
	{
		$this->_delete($delete_id);
	}
	
	redirect('eticket_system');
}

function get($order_by) 
{
$this->load->model('mdl_eticket_system');
$query = $this->mdl_eticket_system->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
$this->load->model('mdl_eticket_system');
$query = $this->mdl_eticket_system->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) 
{
$this->load->model('mdl_eticket_system');
$query = $this->mdl_eticket_system->get_where($id);
return $query;
}

function get_where_custom($col, $value) 
{
$this->load->model('mdl_eticket_system');
$query = $this->mdl_eticket_system->get_where_custom($col, $value);
return $query;
}

function _insert($data) 
{
$this->load->model('mdl_eticket_system');
$this->mdl_eticket_system->_insert($data);
}

function _update($id, $data) 
{
$this->load->model('mdl_eticket_system');
$this->mdl_eticket_system->_update($id, $data);
}

function _delete($id) 
{
$this->load->model('mdl_eticket_system');
$this->mdl_eticket_system->_delete($id);
}

function count_where($column, $value) 
{
$this->load->model('mdl_eticket_system');
$count = $this->mdl_eticket_system->count_where($column, $value);
return $count;
}

function get_max() 
{
$this->load->model('mdl_eticket_system');
$max_id = $this->mdl_eticket_system->get_max();
return $max_id;
}

function _custom_query($mysql_query) 
{
$this->load->model('mdl_eticket_system');
$query = $this->mdl_eticket_system->_custom_query($mysql_query);
return $query;
}

}
