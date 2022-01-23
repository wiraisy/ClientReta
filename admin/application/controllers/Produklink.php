<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produklink extends MY_Controller {

	public function index()
	{
		// Get Data From API
		$url = 'http://202.157.184.70:8080/reta-api/Produk/GetAllProdukbyFilterandPagination';
        $method = 'GET';
        $dataproduk = $this->SendRequest($url, $method);

		$data['title'] = "Produk Link";
		$data['dataproduk'] = $dataproduk;

		$this->load->view('includes/header');
		$this->load->view('v_produklink', $data);
		$this->load->view('includes/footer');
	}
}

