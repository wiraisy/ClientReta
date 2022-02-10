<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function index()
	{
		$data['title'] = "Export Data";

		$this->load->view('includes/header');
		$this->load->view('v_import', $data);
		$this->load->view('includes/footer');
	}

    public function import_produk()
	{
        $fileproduk = $_FILES['file']['tmp_name'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://api-reta.id/reta-api/Produk/importcsvproduk',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($fileproduk)),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: multipart/form-data',
            'Authorization: Basic YWtiYXI6d2lyYWlzeQ==',
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

		if (isset($response['status'])) {
			$this->session->set_flashdata('errorMsg', 'Import Produk Gagal');
			redirect('import');
        } else {
			$this->session->set_flashdata('successMsg', 'Import Produk Berhasil');
			redirect('import');
        }	
	}

    public function import_pasien(){
     
        $filepasien = $_FILES['file']['tmp_name'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://api-reta.id/reta-api/PasienAPI/importcsvpasien',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($filepasien)),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: multipart/form-data',
            'Authorization: Basic YWtiYXI6d2lyYWlzeQ==',
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

		if (isset($response['status'])) {
			$this->session->set_flashdata('errorMsg', 'Import Pasien Gagal');
			redirect('import');
        } else {
			$this->session->set_flashdata('successMsg', 'Import Pasien Berhasil');
			redirect('import');
        }	   
    }
}
