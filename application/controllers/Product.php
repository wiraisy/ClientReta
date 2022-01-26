<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function detailProduct($id_produk){
		// Get Data From API
		$url = "http://202.157.184.70:8080/reta-api/Produk/GetProdukbyId/$id_produk";
        $method = 'GET';
        $detailproduk = $this->SendRequest($url, $method);	

        $data['barTitle'] = "Detail Products";
		$data['detailproduk'] = $detailproduk;

        $this->load->view('includes/header', $data);
		$this->load->view('v_product-detail', $data);
        $this->load->view('includes/footer');
	}
}
