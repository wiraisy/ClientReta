<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}
		
		$data['title'] = "Pemesanan";

		$this->load->view('includes/header');
		$this->load->view('v_pemesanan', $data);
		$this->load->view('includes/footer');
	}

	
	public function orderByAdmin()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/PasienAPI/listfilterpasien';
        $method = 'GET';
        $datamember = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/UMUM/true';
        $method = 'GET';
        $produkumum = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Produk/getallprodukbykategori/ANDALAN/true';
        $method = 'GET';
        $produkandalan = $this->SendRequest($url, $method);

		$data['title'] = "Pemesanan Oleh Admin";
		$data['produkumum'] = $produkumum;
		$data['produkandalan'] = $produkandalan;
		$data['datamember'] = $datamember;

		$this->load->view('includes/header');
		$this->load->view('v_orderbyadmin', $data);
		$this->load->view('includes/footer');
	}

	public function checkout($id, $custid){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$id_pasien = (int)$id;
		
		$url = 'https://api-reta.id/reta-api/Penjualan/lihatcart/'.$custid;
        $method = 'GET';
        $datacart = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/AlamatKirimAPI/GetAlamatbyidpasien/'.$id_pasien;
        $method = 'GET';
        $dataAlamat = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/PasienAPI/cariberdasarkanid/'.$id_pasien;
        $method = 'GET';
        $dataPasien = $this->SendRequest($url, $method);

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

		$data['title'] = "Checkout Oleh Admin";
		$data['datacart'] = $datacart;
		$data['dataAlamat'] = $dataAlamat;
		$data['dataProvinsi'] = $dataProvinsi;
		$data['dataPasien'] = $dataPasien;
		
		$this->load->view('includes/header');
		$this->load->view('v_checkoutbyadmin', $data);
		$this->load->view('includes/footer');
	}

	public function addAlamatKirim(){
		$idAlamatKirim = $this->input->post('idAlamatKirim');
		$alamat = $_POST['alamat'];
		$idkabupaten = (int)$_POST['selectKota'] ;
		$id_pasien = (int)$this->input->post('idpasien');
		$custid = $this->input->post('custid');
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

		redirect(base_url() . 'order-by-admin/checkout/'.$id_pasien.'/'.$custid);
	}

	public function updateQty(){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$id_pasien = (int)$this->input->post('id_pasien', true);
		$custid = $this->input->post('custid', true);
		$jumlah = (int)$this->input->post('jumlah', true);
		$kodeid = $this->input->post('kodeid', true);
		$data = array(
			'custid' => $custid,
			'jumlah' => $jumlah,
			'kodeid' => $kodeid,
		);
		$dataString = json_encode($data);
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/editdetailquantityincart',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS => $dataString,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		
		redirect(base_url() . 'order-by-admin/checkout/'.$id_pasien.'/'.$custid);
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
