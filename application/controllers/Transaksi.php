<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {
	function  __construct(){
        parent::__construct();
	
		$this->load->library('cart');
	}

	public function checkout()
	{
        $data['barTitle'] = "Checkout";

        $this->load->view('includes/header', $data);
		$this->load->view('v_checkout');
        $this->load->view('includes/footer');
	}
	
	public function payment()
	{
        $data['barTitle'] = "Payment";

        $this->load->view('includes/header', $data);
		$this->load->view('v_payment');
        $this->load->view('includes/footer');
	}
	
	public function expired()
	{
        $data['barTitle'] = "Payment Expired";

        $this->load->view('includes/header', $data);
		$this->load->view('v_expired');
        $this->load->view('includes/footer');
	}

	public function addToCart(){

		// Cart Algotithm Code

        $data['barTitle'] = "Checkout";

        $this->load->view('includes/header', $data);
		$this->load->view('v_checkout');
        $this->load->view('includes/footer');
	}
}
