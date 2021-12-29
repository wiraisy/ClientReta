<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produklink extends CI_Controller {

	public function index()
	{
		$data['title'] = "Produk Link";

		$this->load->view('includes/header');
		$this->load->view('produklink', $data);
		$this->load->view('includes/footer');
	}
}
