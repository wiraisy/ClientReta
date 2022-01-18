<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		// Get Data From API
		$url = 'http://202.157.184.70:8080/reta-api/Produk/getallprodukbykategori/UMUM';
        $method = 'GET';
        $produkumum = $this->SendRequest($url, $method);

		$url = 'http://202.157.184.70:8080/reta-api/Produk/getallprodukbykategori/ANDALAN';
        $method = 'GET';
        $produkandalan = $this->SendRequest($url, $method);

        $data['barTitle'] = "Buy Products";
		$data['produkumum'] = $produkumum;
		$data['produkandalan'] = $produkandalan;

        $this->load->view('includes/header', $data);
		$this->load->view('v_home', $data);
        $this->load->view('includes/footer');
	}
}
