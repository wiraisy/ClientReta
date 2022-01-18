<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkumum extends MY_Controller {

	public function index()
	{
		// Get Data From API
		$url = 'http://202.157.184.70:8080/reta-api/Produk/getallprodukbykategori/UMUM';
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);

		$data['title'] = "Produk Umum";
		$data['produk'] = $produk;

		$this->load->view('includes/header');
		$this->load->view('v_produkumum', $data);
		$this->load->view('includes/footer');
	}

	public function update_produk($id_produk){

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
			"satuan"=> $satuan
		);

		$dataString = json_encode($formData);
		$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://202.157.184.70:8080/reta-api/Produk/UpdateProduk/'.$id_produk,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
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

		if (isset($response['status'])) {
			$this->session->set_flashdata('errorMsg', 'Produk Gagal Diperbarui');
			redirect('produkumum');
        } else {
			$this->session->set_flashdata('successMsg', 'Produk Berhasil Diperbarui');
			redirect('produkumum');
		}	
	}

	public function hapus($id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => '202.157.184.70:8080/reta-api/Produk/DeleteProdukbyId/'.$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
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

		if (isset($response['status'])) {
			$this->session->set_flashdata('errorMsg', 'Produk Gagal Dihapus');
			redirect('produkumum');
        } else {
			$this->session->set_flashdata('successMsg', 'Produk Berhasil Dihapus');
			redirect('produkumum');
		}	
	}
}
