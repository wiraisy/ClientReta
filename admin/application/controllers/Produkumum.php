<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkumum extends MY_Controller {

	public function index()
	{	
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Produk/GetAllProdukbyFilterandPagination?kategori=UMUM';
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);

		$data['title'] = "Produk Umum";
		$data['produk'] = $produk;

		$this->load->view('includes/header');
		$this->load->view('v_produkumum', $data);
		$this->load->view('includes/footer');
	}

	public function index_page($page)
	{	
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}
		$pageNumber = (int)$page - 1;

		// Get Data From API
		$url = 'https://api-reta.id/reta-api/Produk/GetAllProdukbyFilterandPagination?kategori=UMUM&pageNumber='.$pageNumber;
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);

		$data['title'] = "Produk Umum";
		$data['produk'] = $produk;

		$this->load->view('includes/header');
		$this->load->view('v_produkumum', $data);
		$this->load->view('includes/footer');
	}

	public function update_produk($id_produk){	
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		// Update Produk From API
		$hargacorporate = (int)$this->input->post('hargacorporate', true);
		$hargajual = (int)$this->input->post('hargajual', true);
		$hargajualdefault = (int)$this->input->post('hargajualdefault', true);
		$hargamember = (int)$this->input->post('hargamember', true);
		$hargapromo = (int)$this->input->post('hargapromo', true);
		$hargapromo1 = (int)$this->input->post('hargapromo1', true);
		$hargapromo2 = (int)$this->input->post('hargapromo2', true);
		$hargapromo3 = (int)$this->input->post('hargapromo3', true);
		$hargapromo4 = (int)$this->input->post('hargapromo4', true);
		$status = (boolean)$this->input->post('status', true);
		$kodeid = $this->input->post('kodeid', true);
		$kategori = $this->input->post('kategori', true);
		$namabarang = $this->input->post('namabarang', true);
		$namabarangdefault = $this->input->post('namabarangdefault', true);
		$satuan = $this->input->post('satuan', true);
		
		// If Fill Empty
		if (empty($namabarang)) {
			$namabarang = $namabarangdefault;
		}
		if (empty($hargajual)) {
			$hargajual = $hargajualdefault;
		}
		
		$formData = array(
			"hargacorporate"=> $hargacorporate,
			"hargajual"=> $hargajual,
			"hargamember"=> $hargamember,
			"hargapromo"=> $hargapromo,
			"hargapromo1"=> $hargapromo1,
			"hargapromo2"=> $hargapromo2,
			"hargapromo3"=> $hargapromo3,
			"hargapromo4"=> $hargapromo4,
			"kategori"=> $kategori,
			"kodeid"=> $kodeid,
			"namabarang"=> $namabarang,
			"satuan"=> $satuan,
			"status"=> $status
		);
		$dataString = json_encode($formData);

		$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/UpdateProduk/'.$id_produk,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $dataString,
            CURLOPT_HTTPHEADER => array(
                'Accept: */*',
				'Content-Type: application/json',
				'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

		if ($response['status'] === 400) {
			$this->session->set_flashdata('errorMsg', 'Produk Gagal Diperbarui');
			redirect('produkumum');
        } else {
			$this->session->set_flashdata('successMsg', 'Produk Berhasil Diperbarui');
			redirect('produkumum');
		}	
	}

	public function hapus($id){	
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/DeleteProdukbyId/'.$id,
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
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ==',
			'Cookie: JSESSIONID=FD38B83E815FFB9CF9679BEDB65BAF71'
		),
		));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

		if ($response['status'] === 500) {
			$this->session->set_flashdata('errorMsg', 'Produk Gagal Dihapus');
			redirect('produkumum');
        } else {
			$this->session->set_flashdata('successMsg', 'Produk Berhasil Dihapus');
			redirect('produkumum');
		}	
	}

	public function tambahimg(){
		$kodeid = $this->input->post('kodeid', true);
		$filename = $_FILES['img-produk']['tmp_name'];
		list($width, $height, $type, $attr) = getimagesize($_FILES['img-produk']['tmp_name']);
		
		// Move uploaded file to a temp location
		$uploadDir = base_url().'/admin/assets/uploads/';
		$uploadFile = $uploadDir . basename($_FILES['img-produk']['name']);

		var_dump($uploadDir);
		die();

		if (move_uploaded_file($_FILES['img-produk']['tmp_name'], $uploadFile))
		{
			// Execute remote upload
			// $curl = curl_init();

			// curl_setopt_array($curl, array(
			// 	CURLOPT_URL => 'https://api-reta.id/reta-api/Produk/uploadproductimagetoserver/'.$kodeid.'/'.$width.'/'.$height,
			// 	CURLOPT_RETURNTRANSFER => true,
			// 	CURLOPT_ENCODING => '',
			// 	CURLOPT_MAXREDIRS => 10,
			// 	CURLOPT_TIMEOUT => 0,
			// 	CURLOPT_SSL_VERIFYHOST => 0,
			// 	CURLOPT_SSL_VERIFYPEER => 0,
			// 	CURLOPT_FOLLOWLOCATION => true,
			// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 	CURLOPT_CUSTOMREQUEST => 'POST',
			// 	CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($uploadFile, 'image/jpg')),
			// 	CURLOPT_HTTPHEADER => array(
			// 		'Content-Type: multipart/form-data',
			// 		'Authorization: Basic YWtiYXI6d2lyYWlzeQ==',
			// 	),
			// ));

			// $response = curl_exec($curl);
			// curl_close($curl);
			// // Now delete local temp file
			unlink($uploadFile);
			// die(var_dump($response));
			echo "test";
		}
		else
		{
			echo "Possible file upload attack!\n";
		}
		redirect('produkumum');
	}
}
