<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['title'] = "Default";

		$this->load->view('includes/header');
		$this->load->view('v_dashboard', $data);
		$this->load->view('includes/footer');
	}
}
