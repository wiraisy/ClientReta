<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

        // Get Data From API
		$url = 'https://api-reta.id/reta-api/Penjualan/LoadStatuspenjualan';
        $method = 'GET';
        $datastatus = $this->SendRequest($url, $method);

		$data['title'] = "Export Data";
        $data['datastatus'] = $datastatus;

		$this->load->view('includes/header');
		$this->load->view('v_export', $data);
		$this->load->view('includes/footer');
	}

	public function export_rule_admin(){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

        // Get Data From API
		$url = 'https://api-reta.id/reta-api/Penjualan/LoadStatuspenjualan';
        $method = 'GET';
        $datastatus = $this->SendRequest($url, $method);

		$data['title'] = "Export Data";
        $data['datastatus'] = $datastatus;

		$this->load->view('includes/headeradmin');
		$this->load->view('v_exportadmin', $data);
		$this->load->view('includes/footer');
	}
}
