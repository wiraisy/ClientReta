<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ModelChat');
    }

	public function detailProduct($id_produk){
		
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}
		
		// Get Data From API
		$url = "https://api-reta.id/reta-api/Produk/GetProdukbyId/$id_produk";
        $method = 'GET';
        $detailproduk = $this->SendRequest($url, $method);	
		
        $data['barTitle'] = "Detail Products";
		$data['detailproduk'] = $detailproduk;

        $this->load->view('includes/header', $data);
		$this->load->view('v_product-detail', $data);
        $this->load->view('includes/footer');
	}
}
