<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public function index()
	{
		$data['title'] = "Pemesanan";

		$this->load->view('includes/header');
		$this->load->view('v_pemesanan', $data);
		$this->load->view('includes/footer');
	}

	
	public function orderByAdmin()
	{
		$data['title'] = "Pemesanan Oleh Admin";

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
