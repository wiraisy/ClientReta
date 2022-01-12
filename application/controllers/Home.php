<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		// Get Data From API
		$url = 'http://202.157.184.70:8080/reta-api/Produk/GetAllProdukbyFilterandPagination';
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);
		
        $data['barTitle'] = "Buy Products";
		$data['produkumum'] = $produk;

        $this->load->view('includes/header', $data);
		$this->load->view('v_home', $data);
        $this->load->view('includes/footer');
	}
}
