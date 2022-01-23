<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function detailProduct($id_produk)
	{

        $data['barTitle'] = "Detail Products";

        $this->load->view('includes/header', $data);
		$this->load->view('v_product-detail', $data);
        $this->load->view('includes/footer');
	}
}
