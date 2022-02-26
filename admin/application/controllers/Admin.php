<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/UserAdminAPI/getalluseradmin';
        $method = 'GET';
        $datadmin = $this->SendRequest($url, $method);

		$data['title'] = "Data Admin";
		$data['datadmin'] = $datadmin;

		$this->load->view('includes/header');
		$this->load->view('v_admin', $data);
		$this->load->view('includes/footer');
	}
	
    public function tambahAdmin()
    {   
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
		$rule = $this->input->post('rule', true);
        
        $curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'api-reta.id/reta-api/UserAdminAPI/saveuseradmin',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"password": "'.$password.'",
			"rule": "'.$rule.'",
			"username": "'.$username.'"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ==',
		),
		));

		$response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

		if ($response['status'] === 400) {
			$this->session->set_flashdata('errorMsg', 'Admin Baru Gagal Ditambahkan');
			redirect('admin');
        } else {
			$this->session->set_flashdata('successMsg', 'Admin Baru Berhasil Ditambahkan');
			redirect('admin');
		}	
                
    }

	public function ubahAdmin($id)
    {   
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$idadmin = $this->input->post('idadmin', true);
        $password = $this->input->post('password', true);
		$rule = $this->input->post('rule', true);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-reta.id/reta-api/UserAdminAPI/updateuseradmin/".$idadmin."/".$password."/".$rule,
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
		
		$this->session->set_flashdata('successMsg', 'Admin Berhasil Diupdate');
		redirect('admin');
                
    }

	public function hapus($id){
		
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://api-reta.id/reta-api/UserAdminAPI/deleteuseradminbyid/'.$id,
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
			$this->session->set_flashdata('errorMsg', 'Admin Gagal Dihapus');
			redirect('admin');
        } else {
			$this->session->set_flashdata('successMsg', 'Admin Berhasil Dihapus');
			redirect('admin');
		}	
	}
}
