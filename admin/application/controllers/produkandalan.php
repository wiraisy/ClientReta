<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produkandalan extends MY_Controller {

	public function index()
	{
		// Get Data From API
		$url = 'http://202.157.184.70:8080/reta-api/Produk/GetAllProdukbyFilterandPagination';
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);

		$data['title'] = "Produk Andalan";
		$data['produk'] = $produk;

		$this->load->view('includes/header');
		$this->load->view('v_produkandalan', $data);
		$this->load->view('includes/footer');
	}

	public function update_produk($id_produk){
		$url = 'http://202.157.184.70:8080/reta-api/Produk/UpdateProduk/'.$id_produk;
        $method = 'GET';
        $produk = $this->SendRequest($url, $method);

		// Update Produk From API
		$namabarang = $this->input->post('namabarang', true);
		$hargajual = $this->input->post('hargajual', true);

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
            CURLOPT_POSTFIELDS => array(
                idproduk: 3,
				kodeid: test,
				namabarang: Bedak Dewasa,
				satuan: pcs,
				hargajual: 10000,
				hargamember: 5000,
				hargapromo: 5000,
				hargacorporate: 5000,
				hargapromo1: 5000,
				hargapromo2: 5000,
				hargapromo3: 5000,
				hargapromo4: 5000
            ),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . $session
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

		redirect(base_url('produkandalan'));
	}
}
