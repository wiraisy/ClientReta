<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	protected $_apiURL;
    function __construct()
    {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
        $this->_apiURL = 'https://api-reta.id/reta-api/';
    }

	public function index()
	{
        $data['barTitle'] = "SHOP";

		$this->load->view('v_prelogin', $data);
	}

    public function member()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}

        $data['barTitle'] = "MEMBER LOGIN";

		$this->load->view('v_login', $data);
	}

	public function loginmember()
	{
		$hp1 = $this->input->post('hp1');
        $password = $this->input->post('password');

		$url = $this->_apiURL . "PasienAPI/loginpasien/" . $hp1 . "/" . $password;
        $method = 'GET';
        $auth_login = $this->SendRequest($url, $method);

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL =>  $this->_apiURL ."PasienAPI/loginpasien/" . $hp1 . "/" . $password,
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
		$res_auth = json_decode($response, true);

		curl_close($curl);

		$url = 'https://api-reta.id/reta-api/Penjualan/lihatcart/'.$res_auth['custid'];
        $method = 'GET';
        $datacart = $this->SendRequest($url, $method);

		if ($res_auth) {
			$dataUser = array(
				"data" => $res_auth,
				"cart" => $datacart
			);
			$this->session->set_userdata('data_user_reta', $dataUser);
            $this->session->set_userdata('isLoggedIn_userReta', true);
			$this->session->set_flashdata('successMsg', 'Login Berhasil!');
            redirect(base_url());
		} else {
			$this->session->set_flashdata('error', 'Username / Password Salah, Login Gagal!');
            redirect(base_url() . 'auth/member');
		}
	}

    public function nonmember()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}

        $data['barTitle'] = "REGISTER";

		$this->load->view('v_register', $data);
	}

    
    public function forgetpassword()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}
		
        $data['barTitle'] = "VERIFIKASI";

		$this->load->view('v_forgetpassword', $data);
	}

	public function checkpassword()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}
		
		redirect(base_url() . 'auth/makepassword');
	}
    
    public function makepassword()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}

        $data['barTitle'] = "VERIFIKASI";

		$this->load->view('v_password', $data);
	}

	public function addNewPassword()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url());
		}
		
		redirect(base_url('auth'));
	}

    public function logout()
    {
		session_destroy();
		redirect(base_url() . 'auth');
    }
}
