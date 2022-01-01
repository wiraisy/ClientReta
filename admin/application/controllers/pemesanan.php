<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public function index()
	{
		$data['title'] = "Pemesanan";

		$this->load->view('includes/header');
		$this->load->view('pemesanan', $data);
		$this->load->view('includes/footer');
	}
}
