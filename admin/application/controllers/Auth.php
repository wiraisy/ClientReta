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
	
	public function login()
	{
		// Check Session
		if ($this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url());
		}

		$this->load->view('v_login');
	}

	public function auth(){
		$username = $this->input->post('username');
        $password = $this->input->post('password');

		$url = $this->_apiURL . "UserAdminAPI/loginadmin/" . $username . "/" . $password;
        $method = 'GET';
        $auth_login = $this->SendRequest($url, $method);
		
		if ($auth_login['status'] === 500) {
			$this->session->set_flashdata('error', 'Username / Password Salah, Login Gagal!');
            redirect(base_url() . 'login');
		} else {
			$dataUser = array(
				'name' => $auth_login['username'],
				'rule' => $auth_login['rule'],
			);
			$this->session->set_userdata('data_admin_reta', $dataUser);
            $this->session->set_userdata('isLoggedIn_adminReta', true);
			$this->session->set_flashdata('successMsg', 'Login Berhasil!');
            redirect(base_url());
		}
		
	}

    public function logout()
	{
		session_destroy();
		$this->load->view('v_login');
	}
}
