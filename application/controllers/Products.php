<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
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

		// Login admin only
        if( $this->session->userdata('id_role') != 1 )
        {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access blocked!</div>');
            redirect('home');
        }
        // End Login admin only

		// load model
		$this->load->model('model_users');
		$this->load->model('model_categories');
		$this->load->model('model_products');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('product', 'Product', 'required|trim');
		$this->form_validation->set_rules('schedule', 'Schedule', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');

		if( $this->form_validation->run() == false )
		{
			$data['title'] = "Products";
			$data['active'] = "Products";
			$data['user'] = $this->model_users->get_by_email_session();
			$data['products'] = $this->model_products->get_all_join_category();
	
			$this->load->view('layouts/main_header', $data);
			$this->load->view('layouts/main_sidebar');
			$this->load->view('layouts/main_wrapper');
			$this->load->view('layouts/main_topbar');
			$this->load->view('products/index');
			$this->load->view('layouts/main_footer');
		} else
		{
			$product = htmlspecialchars($this->input->post('product', true));
			$schedule = htmlspecialchars($this->input->post('schedule', true));
			$price = htmlspecialchars($this->input->post('price', true));

			$this->model_products->add($product, $schedule, $price);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
            redirect('products');
		}

	}

	public function categories()
	{
		$this->form_validation->set_rules('category', 'Category', 'required|trim|is_unique[categories.category]', [
			'is_unique' => 'This category has already!'
		]);

		if( $this->form_validation->run() == false )
		{
			$data['title'] = "Categories";
			$data['active'] = "Categories";
			$data['user'] = $this->model_users->get_by_email_session();
			$data['categories'] = $this->model_categories->get_all();
	
			$this->load->view('layouts/main_header', $data);
			$this->load->view('layouts/main_sidebar');
			$this->load->view('layouts/main_wrapper');
			$this->load->view('layouts/main_topbar');
			$this->load->view('products/categories');
			$this->load->view('layouts/main_footer');
		} else
		{
			$this->model_categories->add_category();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data added successfully.</div>');
            redirect('products/categories');
		}

	}

}
