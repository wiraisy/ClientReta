<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends MY_Controller {

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanbystatus/BELUM_DIBAYAR';
        $method = 'GET';
        $dataBelumBayar = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanbystatus/DIBAYAR';
        $method = 'GET';
        $dataDiBayar = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Penjualan/getallpenjualanbystatus/DIKIRIM';
        $method = 'GET';
        $dataDikirim = $this->SendRequest($url, $method);
		
		$data['title'] = "Pemesanan";
		$data['dataBelumBayar'] = $dataBelumBayar;
		$data['dataDibayar'] = $dataDiBayar;
		$data['dataDikirim'] = $dataDikirim;

		($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
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
		$url = 'https://api-reta.id/reta-api/PasienAPI/getallpasien';
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

		($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
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
		
		($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
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
	
	public function payment($id){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$idpenjualan = (int)$id;

		$url = 'https://api-reta.id/reta-api/Penjualan/getpenjualanbyid/'.$idpenjualan;
        $method = 'GET';
        $datapenjualan = $this->SendRequest($url, $method);

		$url = 'https://api-reta.id/reta-api/Penjualan/getBuktibayarexist?idpenjualan='.$idpenjualan;
        $method = 'GET';
        $databukti = $this->SendRequest($url, $method);

		if ($datapenjualan['status'] === 500 || $databukti == true) {
			$data['title'] = "Pembayaran Oleh Admin";
			$data['datapenjualan'] = $datapenjualan;
			$data['databukti'] = $databukti;

			$this->load->view('includes/header', $data);
			$this->load->view('v_expired', $data);
			$this->load->view('includes/footer');
		} else {
			$data['title'] = "Pembayaran Oleh Admin";
			$data['datapenjualan'] = $datapenjualan;
	
			($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
			$this->load->view('v_paymentbyadmin', $data);
			$this->load->view('includes/footer');
		}
	}

	public function uploadBukti(){
		$kodetransaksi = $this->input->post('kodetransaksi', true);
		$filename = $_FILES['fileBuktiBayar']['tmp_name'];
		list($width, $height, $type, $attr) = getimagesize($_FILES['fileBuktiBayar']['tmp_name']);

		$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/admin/assets/uploads/';
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

		redirect(base_url() . 'pemesanan');
	}
	
	public function expired(){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}
		
		($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') ? $this->load->view('includes/header') : $this->load->view('includes/headeradmin') ;
		$this->load->view('v_expired');
		$this->load->view('includes/footer');
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
		redirect(base_url() . 'pemesanan');
	}

	public function validasiDiBayar($kodetransaksi){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/updatestatusbayar/'.$kodetransaksi,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);

		redirect(base_url() . 'pemesanan');
	}

	public function addResi(){
		$kodetransaksi = $this->input->post('kodetransaksi', true);
        $noresi = $this->input->post('noresi', true);

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/Penjualan/updatenoresi/'.$kodetransaksi.'/'.$noresi,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_HTTPHEADER => array(
			'Accept: */*',
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);

		redirect(base_url() . 'pemesanan');
	}
}
