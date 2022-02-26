<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/UMUM/true';
        $method = 'GET';
        $produkumum = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/ANDALAN/true';
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
