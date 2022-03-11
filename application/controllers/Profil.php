<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('ModelChat');
    }

	public function info_akun()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}
		
		$id_pasien = $this->session->userdata('data_user_reta')['data']['id_pasien'];

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

		$custid = $this->session->userdata('data_user_reta')['data']['custid'];

        $data['dataChatPasien'] =$this->ModelChat->get_user($custid);
        $data['barTitle'] = "My Profile";
		$data['dataAlamat'] = $dataAlamat;
		$data['dataProvinsi'] = $dataProvinsi;

        $this->load->view('includes/header', $data);
		$this->load->view('v_profil');
        $this->load->view('includes/footer');
	}
	
	public function info_pesanan()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}

		$id_pasien = $this->session->userdata('data_user_reta')['data']['id_pasien'];

		// Status Belum Bayar
		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanfilter?id_pasien='.$id_pasien.'&status=BELUM_DIBAYAR';
        $method = 'GET';
        $dataBelumBayar = $this->SendRequest($url, $method);

		// Status Telah Bayar
		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanfilter?id_pasien='.$id_pasien.'&status=DIBAYAR';
        $method = 'GET';
        $dataDibayar = $this->SendRequest($url, $method);

		// Status Dikirim
		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanfilter?id_pasien='.$id_pasien.'&status=DIKIRIM';
        $method = 'GET';
        $dataDikirim = $this->SendRequest($url, $method);


		$custid = $this->session->userdata('data_user_reta')['data']['custid'];

        $data['dataChatPasien'] =$this->ModelChat->get_user($custid);
        $data['barTitle'] = "My Transaction";
		$data['dataBelumBayar'] = $dataBelumBayar;
		$data['dataDibayar'] = $dataDibayar;
		$data['dataDikirim'] = $dataDikirim;

        $this->load->view('includes/header', $data);
		$this->load->view('v_pesanan', $data);
        $this->load->view('includes/footer');
	}

	public function addAlamatKirim(){
		$idAlamatKirim = $this->input->post('idAlamatKirim');
		$alamat = $_POST['alamat'];
		$idkabupaten = (int)$_POST['selectKota'] ;
		$id_pasien = $this->session->userdata('data_user_reta')['data']['id_pasien'];
		$idpropinsi = (int)$_POST['selectProvinsi'];
		$kabupaten = $this->input->post('kabupaten');
		$propinsi = $this->input->post('provinsi');
		$data = array(
			'alamat' => $alamat,
			'idkabupaten' => $idkabupaten,
			'idkecamatan' => 0,
			'idpasien' => $id_pasien,
			'idpropinsi' => $idpropinsi,
			'kabupaten' => $kabupaten,
			'kecamatan' => "string",
			'propinsi' => $propinsi,
		);
		$dataString = json_encode($data);
		$curlPost = curl_init();

		curl_setopt_array($curlPost, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/AlamatKirimAPI/SimpanAlamat',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $dataString,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));

		$response = curl_exec($curlPost);
		curl_close($curlPost);

		$curlDelete = curl_init();
		curl_setopt_array($curlDelete, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/AlamatKirimAPI/HapusAlamat/'.$idAlamatKirim,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));
		$responseDelete = curl_exec($curlDelete);
		curl_close($curlDelete);

		redirect(base_url() . 'profil/info_akun');
	}

	public function batalPesan($idpenjualan){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/HapusPenjualanbyid/'.(int)$idpenjualan,
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
		redirect(base_url() . '/my-transaction');
	}
}
