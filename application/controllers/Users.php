<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('model_users');
	}
	
	public function index()
	{
		// $user = $this->model_users->get_by_email_session();
		// echo "Berhasil login ! " . $user['name'];
		$data['title'] = "Customer";
		$data['user'] = $this->model_users->get_by_email_session();

		$this->load->view('layouts/customer_template', $data);
	}

}
