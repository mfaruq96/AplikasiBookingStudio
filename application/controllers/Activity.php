<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller
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
		$this->load->model('model_products');
		$this->load->model('model_orders');
		$this->load->model('model_order_details');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('room', 'Room', 'required|trim');
		$this->form_validation->set_rules('schedule', 'Scedule', 'required|trim');
		$this->form_validation->set_rules('note', 'Note', 'required|trim');

		if( $this->form_validation->run() == false )
		{
			// 
			$data['title'] = "Booking";
			$data['active'] = "Booking";
			$data['user'] = $this->model_users->get_by_email_session();
			$id_user = $data['user']['id_user'];
			$data['products'] = $this->model_products->get_all();
			$data['order_details'] = $this->model_order_details->get_where_id_user_status_zero($id_user);
			$data['order'] = $this->model_orders->get_where_id_user($id_user);
	
			$this->load->view('layouts/main_header', $data);
			$this->load->view('layouts/main_sidebar');
			$this->load->view('layouts/main_wrapper');
			$this->load->view('layouts/main_topbar');
			$this->load->view('activity/index');
			$this->load->view('modals/activity_modals');

			if( !empty($data['order']) )
			{
				$this->load->view('modals/checkout_modal');
			}

			$this->load->view('layouts/main_footer');
		} else
		{
			$date = htmlspecialchars($this->input->post('date', true));
			$room = htmlspecialchars($this->input->post('room', true));
			$id_product = htmlspecialchars($this->input->post('schedule', true));
			$note = htmlspecialchars($this->input->post('note', true));
			$day = date('d', strtotime($date));
			$month = date('m', strtotime($date));
			$year = date('Y', strtotime($date));
			
			$user = $this->model_users->get_by_email_session();
			$id_user = $user['id_user'];

			$product = $this->model_products->get_where_id_product($id_product);
			$total_price = $product['price'];

			$check_order_details = $this->model_order_details->get_where_id_product_date_room($id_product, $date, $room);
			if( !empty($check_order_details) )
			{
				// jika schedule not available
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry, schedule is not available!</div>');
				redirect('activity');
			} else
			{
				// jika schedule available
				$check_orders = $this->model_orders->get_where_id_user($id_user);
				if( empty($check_orders) )
				{
					// jika belum ada data orders
					$this->model_orders->add($id_user ,$total_price); 
				} else
				{
					// jika sudah ada data orders
					$order_on = $this->model_orders->get_where_id_user($id_user);
					$current_total_price = $order_on['total_price'];
					$current_id_order = $order_on['id_order'];
					$add_total_price = $product['price'];
					$update_total_price = $current_total_price + $add_total_price;
					$current_id_user = $order_on['id_user'];
					$this->model_orders->update_where_id_user_id_order($update_total_price, $current_id_user, $current_id_order);
				}

				$order_check_try = $this->model_orders->get_where_id_user($id_user);
				$id_order = $order_check_try['id_order'];

				$this->model_order_details->add($id_user, $id_order, $id_product, $date, $room, $note, $total_price);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
				redirect('activity');
			}
		}
	}

	public function delete($id_order_detail)
	{
		$order_detail_check = $this->model_order_details->get_where_id($id_order_detail);
		$id_user = $order_detail_check['id_user'];
		$id_order = $order_detail_check['id_order'];
		$delete_total_price = $order_detail_check['price'];
		$order = $this->model_orders->get_where_id_user($id_user);
		$total_price = $order['total_price'];
		$update_total_price = $total_price - $delete_total_price;

		$this->model_order_details->delete_where_id($id_order_detail);
		$this->model_orders->delete_where_id($id_order, $update_total_price);

		$order_detail_check_user = $this->model_order_details->get_where_id_user_id_order($id_user, $id_order);
		if( empty($order_detail_check_user) )
		{
			$this->model_orders->delete_all_where_id($id_order);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item deleted has been successfully!</div>');
		return redirect('activity');
	}

	public function check_out($id_order)
	{
		$remark = htmlspecialchars($this->input->post('remark', true));
		$order = $this->model_orders->get_where_id($id_order);
		$id_user = $order['id_user'];

		$month = date('m');
		$year = date('Y');
		$invoice = "INV/" . $month . "/" . $year . "/" . $id_order;

		// update data orders
		$this->model_orders->update_check_out($id_order, $invoice, $remark);
		
		// update data order_details
		$this->model_order_details->update_check_out($id_order);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulations, your booking has been successfully.</div>');
		return redirect("home");
	}

	public function history()
	{
		$data['title'] = "History";
		$data['active'] = "History";
		$data['user'] = $this->model_users->get_by_email_session();
		$id_user = $data['user']['id_user'];
		$data['orders'] = $this->model_orders->get_where_id_user_status_zero_plus($id_user);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('activity/history');
		$this->load->view('layouts/main_footer');
	}

	public function history_details($id_order)
	{
		$data['title'] = "History";
		$data['active'] = "History";
		$data['user'] = $this->model_users->get_by_email_session();
		$id_user = $data['user']['id_user'];
		$data['order'] = $this->model_orders->get_where_id($id_order);
		$data['order_details'] = $this->model_order_details->get_where_id_order_join_products_user($id_order);

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('activity/history_details');
		$this->load->view('layouts/main_footer');
	}

}
