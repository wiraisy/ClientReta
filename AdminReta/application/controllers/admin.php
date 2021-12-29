<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data['title'] = "Data Admin";

		$this->load->view('includes/header');
		$this->load->view('admin', $data);
		$this->load->view('includes/footer');
	}
}
