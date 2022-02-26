<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {
	function  __construct(){
        parent::__construct();
	
		$this->load->library('cart');
	}

	public function checkout()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}

		$custid = $this->session->userdata('data_user_reta')['data']['custid'];
		$id_pasien = $this->session->userdata('data_user_reta')['data']['id_pasien'];
		
		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Penjualan/lihatcart/'.$custid;
        $method = 'GET';
        $datacart = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/AlamatKirimAPI/GetAlamatbyidpasien/'.$id_pasien;
        $method = 'GET';
        $dataAlamat = $this->SendRequest($url, $method);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.rajaongkir.com/api/province",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"key: b0953e7e7ca5742d5e0569c113ad19bd"
		),
		));

		$response = curl_exec($curl);
		$dataProvinsi = json_decode($response, true);

        $data['barTitle'] = "Checkout";
		$data['datacart'] = $datacart;
		$data['dataAlamat'] = $dataAlamat;
		$data['dataProvinsi'] = $dataProvinsi;

        $this->load->view('includes/header', $data);
		$this->load->view('v_checkout', $data);
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
