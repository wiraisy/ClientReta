<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produklink extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/UMUM/true';
        $method = 'GET';
        $produkumum = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/ANDALAN/true';
        $method = 'GET';
        $produkandalan = $this->SendRequest($url, $method);

		$data['title'] = "Produk Link";
		$data['produkumum'] = $produkumum;
		$data['produkandalan'] = $produkandalan;

		($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
		$this->load->view('v_produklink', $data);
		$this->load->view('includes/footer');
	}
}

