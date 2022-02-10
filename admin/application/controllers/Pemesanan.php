<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends MY_Controller {

	public function index()
	{
		$data['title'] = "Pemesanan";

		$this->load->view('includes/header');
		$this->load->view('v_pemesanan', $data);
		$this->load->view('includes/footer');
	}

	
	public function orderByAdmin()
	{
		// Get Data From API
		$url = 'http://api-reta.id/reta-api/PasienAPI/listfilterpasien';
        $method = 'GET';
        $datamember = $this->SendRequest($url, $method);

		$url = 'http://api-reta.id/reta-api/Produk/getallprodukbykategori/UMUM';
        $method = 'GET';
        $produkumum = $this->SendRequest($url, $method);

		$url = 'http://api-reta.id/reta-api/Produk/getallprodukbykategori/ANDALAN';
        $method = 'GET';
        $produkandalan = $this->SendRequest($url, $method);

		$data['title'] = "Pemesanan Oleh Admin";
		$data['produkumum'] = $produkumum;
		$data['produkandalan'] = $produkandalan;
		$data['datamember'] = $datamember;

		$this->load->view('includes/header');
		$this->load->view('v_orderbyadmin', $data);
		$this->load->view('includes/footer');
	}

	public function checkout(){
		$data['title'] = "Checkout Oleh Admin";
		
		$this->load->view('includes/header');
		$this->load->view('v_checkoutbyadmin', $data);
		$this->load->view('includes/footer');
	}
	
	public function payment(){
		$data['title'] = "Pembayaran Oleh Admin";
		
		$this->load->view('includes/header');
		$this->load->view('v_paymentbyadmin', $data);
		$this->load->view('includes/footer');
	}
	
	public function expired(){
		
		$this->load->view('includes/header');
		$this->load->view('v_expired');
		$this->load->view('includes/footer');
	}
}
