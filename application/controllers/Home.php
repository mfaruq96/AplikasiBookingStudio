<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
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
	}
	
	public function index()
	{
		$data['title'] = "Home";
		$data['active'] = "Home";
		$data['user'] = $this->model_users->get_by_email_session();
		$data['products'] = $this->model_products->get_all();

		$this->load->view('layouts/main_header', $data);
		$this->load->view('layouts/main_sidebar');
		$this->load->view('layouts/main_wrapper');
		$this->load->view('layouts/main_topbar');
		$this->load->view('home/index');
		$this->load->view('modals/activity_modals');
		$this->load->view('layouts/main_footer');
	}

}
