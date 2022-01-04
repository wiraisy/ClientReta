<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkandalan extends CI_Controller {

	public function index()
	{
		$data['title'] = "Produk Andalan";

		$this->load->view('includes/header');
		$this->load->view('v_produkandalan', $data);
		$this->load->view('includes/footer');
	}
}
