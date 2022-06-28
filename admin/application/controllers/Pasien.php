<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}


		$url = 'https://api-reta.id/reta-api/PasienAPI/listfilterpasien';
        $method = 'GET';
        $datapasien = $this->SendRequest($url, $method);

		$data['title'] = "Data Pasien";
		$data['datapasien'] = $datapasien;

		$this->load->view('includes/header');
		$this->load->view('v_pasien', $data);
		$this->load->view('includes/footer');
	}

	public function index_page()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}


		$page = $this->input->post('pageNumber', true);
		$pageSize = $this->input->post('pageSize', true);

		$pageNumber = (int)$page - 1;
		$url = 'https://api-reta.id/reta-api/PasienAPI/listfilterpasien?pageNumber='.$pageNumber.'&pageSize='.$pageSize;
        $method = 'GET';
        $datapasien = $this->SendRequest($url, $method);

		$data['title'] = "Data Pasien";
		$data['datapasien'] = $datapasien;

		$this->load->view('includes/header');
		$this->load->view('v_pasien', $data);
		$this->load->view('includes/footer');
	}

	public function search_pasien()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$custid = $this->input->post('custid', true);

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/PasienAPI/listfilterpasien?custid='.$custid;
        $method = 'GET';
        $datapasien = $this->SendRequest($url, $method);

		$data['title'] = "Data Pasien";
		$data['datapasien'] = ($datapasien['content']) ? $datapasien : $custid ;

		$this->load->view('includes/header');
		($datapasien['content']) ? $this->load->view('v_pasienresult', $data) : $this->load->view('v_pasiennotfound', $data) ;
		$this->load->view('includes/footer');
	}

	public function ubahPasien($id)
    {   
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$id_pasien = $this->input->post('id_pasien', true);
        $password = $this->input->post('password', true);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-reta.id/reta-api/PasienAPI/ubahpasswordpasien/".$id_pasien."/".$password,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

		if ($response['status'] === 500) {
			$this->session->set_flashdata('errorMsg', 'Pasien Gagal Diupdate');
			redirect('pasien');
        } else {
			$this->session->set_flashdata('successMsg', 'Pasien Berhasil Diupdate');
			redirect('pasien');
		}	
                
    }

	public function hapus($id){
		
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/PasienAPI/hapuspasien/'.$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

		if ($response['status'] === 500) {
			$this->session->set_flashdata('errorMsg', 'Pasien Gagal Dihapus');
			redirect('pasien');
        } else {
			$this->session->set_flashdata('successMsg', 'Pasien Berhasil Dihapus');
			redirect('pasien');
		}	
	}
}
