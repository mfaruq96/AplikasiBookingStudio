<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		
		// belum login
		if( !$this->session->userdata('email') )
        {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please login!</div>');
            redirect('auth');
        };

		// load model
		$this->load->model('model_users');
		$this->load->model('model_orders');
		$this->load->model('model_order_details');
		$this->load->model('model_products');
	}
	
	public function index()
	{
		$data['title'] = "All Orders";
		$data['active'] = "All Orders";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_all();

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/all_orders');
		$this->load->view('layouts/main_footer');
	}

	public function order_detail($id_order)
	{
		$data['title'] = "All Orders";
		$data['active'] = "All Orders";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_one();
		$data['order_details'] = $this->model_order_details->get_where_id_order_join_products_user($id_order);
		$data['order_detail_try'] = $this->model_order_details->get_where_id_order_join_products_user_row($id_order);
		$id_user = $data['order_detail_try']['id_user'];
		$data['order'] = $this->model_orders->get_where_id($id_order);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/order_detail');
		$this->load->view('layouts/main_footer');
	}

	public function manual_orders()
	{
		$data['title'] = "Manual Orders";
		$data['active'] = "Manual Orders";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_zero();
		$data['products'] = $this->model_products->get_all();

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/manual_orders');
		$this->load->view('modals/activity_modals');
		$this->load->view('layouts/main_footer');
	}

	public function manual_orders_detail($id_order)
	{
		$data['title'] = "Manual Orders";
		$data['active'] = "Manual Orders";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_zero();
		$data['order_details'] = $this->model_order_details->get_where_id_order_join_products_user($id_order);
		$data['order_detail_try'] = $this->model_order_details->get_where_id_order_join_products_user_row($id_order);
		$id_user = $data['order_detail_try']['id_user'];
		$data['order'] = $this->model_orders->get_where_id($id_order);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/manual_orders_detail');
		$this->load->view('layouts/main_footer');
	}

	public function order_verification()
	{
		$data['title'] = "Order Verification";
		$data['active'] = "Order Verification";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_one();

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/order_verification');
		$this->load->view('layouts/main_footer');
	}

	public function order_verification_detail($id_order)
	{
		$data['title'] = "Order Verification";
		$data['active'] = "Order Verification";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_one();
		$data['order_details'] = $this->model_order_details->get_where_id_order_join_products_user($id_order);
		$data['order_detail_try'] = $this->model_order_details->get_where_id_order_join_products_user_row($id_order);
		$id_user = $data['order_detail_try']['id_user'];
		$data['order'] = $this->model_orders->get_where_id($id_order);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/order_verification_detail');
		$this->load->view('layouts/main_footer');
	}

	public function order_verification_verify($id_order)
	{
		$this->model_orders->update_status_one_to_two($id_order);
		$this->model_order_details->update_status_one_to_two($id_order);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated has been successfully.</div>');
		redirect('orders/order_process');
	}

	public function order_process()
	{
		$data['title'] = "Order Process";
		$data['active'] = "Order Process";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_two();

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/order_process');
		$this->load->view('layouts/main_footer');
	}

	public function order_process_detail($id_order)
	{
		$data['title'] = "Order Process";
		$data['active'] = "Order Process";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['orders'] = $this->model_orders->get_where_status_two();
		$data['order_details'] = $this->model_order_details->get_where_id_order_join_products_user($id_order);
		$data['order_detail_try'] = $this->model_order_details->get_where_id_order_join_products_user_row($id_order);
		$id_user = $data['order_detail_try']['id_user'];
		$data['order'] = $this->model_orders->get_where_id($id_order);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('orders/order_process_detail');
		$this->load->view('layouts/main_footer');
	}

	public function order_process_verify($id_order)
	{
		$this->model_orders->update_status_two_to_three($id_order);
		$this->model_order_details->update_status_two_to_three($id_order);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated has been successfully.</div>');
		redirect('orders');
	}

	public function download()
	{
		$data['title'] = "Report All Orders EOZ Music Studio";
		$data['order_details'] = $this->model_order_details->get_all_export();

		$this->load->view('orders/download', $data);
	}

}
