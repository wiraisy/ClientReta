<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->model('ModelChat');
    }

	public function checkout(){
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

        $data['dataChatPasien'] =$this->ModelChat->get_user($custid);
        $data['barTitle'] = "Checkout";
		$data['datacart'] = $datacart;
		$data['dataAlamat'] = $dataAlamat;
		$data['dataProvinsi'] = $dataProvinsi;

        $this->load->view('includes/header', $data);
		$this->load->view('v_checkout', $data);
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

		redirect(base_url() . 'transaksi/checkout');
	}

	public function payment($idpenjualan){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}

        // Get Data Penjualan Pasien
		$url = 'https://api-reta.id/reta-api/Penjualan/getpenjualanbyid/'.$idpenjualan;
        $method = 'GET';
        $datapenjualan = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Penjualan/getBuktibayarexist?idpenjualan='.$idpenjualan;
        $method = 'GET';
        $databukti = $this->SendRequest($url, $method);

		if ($datapenjualan['status'] === 500 || $databukti == true) {
			$data['barTitle'] = "Payment";
			$data['databukti'] = $databukti;

			$this->load->view('includes/header', $data);
			$this->load->view('v_penjualankosong', $data);
			$this->load->view('includes/footer');
		} else {
			$custid = $this->session->userdata('data_user_reta')['data']['custid'];
	
			$data['dataChatPasien'] =$this->ModelChat->get_user($custid);
			$data['barTitle'] = "Payment";
			$data['datapenjualan'] = $datapenjualan;
	
			$this->load->view('includes/header', $data);
			$this->load->view('v_payment', $data);
			$this->load->view('includes/footer');
		}
	}

	public function updateQty(){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}

		$custid = $this->session->userdata('data_user_reta')['data']['custid'];
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
		
		redirect('checkout');
	}
	
	public function uploadBukti(){
		$kodetransaksi = $this->input->post('kodetransaksi', true);
		$filename = $_FILES['fileBuktiBayar']['tmp_name'];
		list($width, $height, $type, $attr) = getimagesize($_FILES['fileBuktiBayar']['tmp_name']);

		$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/ClientReta/assets/uploads/';
		$uploadFile = $uploadDir . basename($_FILES['fileBuktiBayar']['name']);

		if (move_uploaded_file($_FILES['fileBuktiBayar']['tmp_name'], $uploadFile))
		{
			// Execute remote upload
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/uploadbuktibayarbykodetransaksi/'.$kodetransaksi,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($uploadFile, 'image/jpg')),
			  CURLOPT_HTTPHEADER => array(
				'Content-Type: multipart/form-data',
				'Accept: */*',
				'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
			  ),
			));
			$response = curl_exec($curl);
			curl_close($curl);			

			// Now delete local temp file
			unlink($uploadFile);
			// die(var_dump($response));
		}
		else
		{
			echo "Possible file upload attack!\n";
		}

		redirect(base_url() . 'my-transaction');
	}
}
