<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Admin Level
		if ($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') {
			// Get Data From API
			$url = 'https://api-reta.id/reta-api/PasienAPI/listfilterpasien';
			$method = 'GET';
			$datapasien = $this->SendRequest($url, $method);

			$url = 'https://api-reta.id/reta-api/Produk/GetAllProdukbyFilterandPagination';
			$method = 'GET';
			$dataproduk = $this->SendRequest($url, $method);
			
			$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanbystatus/DIKIRIM';
			$method = 'GET';
			$datakirim = $this->SendRequest($url, $method);

			$url = 'https://api-reta.id/reta-api/UserAdminAPI/getalladminbyrule/admin';
			$method = 'GET';
			$datadmin = $this->SendRequest($url, $method);

			$data['title'] = "Default";
			$data['jumlahpasien'] = $datapasien;
			$data['jumlahproduk'] = $dataproduk;
			$data['jumlahkirim'] = $datakirim;
			$data['jumlahadmin'] = $datadmin;

			$this->load->view('includes/header');
			$this->load->view('v_dashboard', $data);
			$this->load->view('includes/footer');
		} else {
			$data['title'] = "Default";

			$this->load->view('includes/headeradmin');
			$this->load->view('v_dashboardadmin', $data);
			$this->load->view('includes/footer');
		}
	}
}
