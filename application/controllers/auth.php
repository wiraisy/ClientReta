<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
        $data['barTitle'] = "SHOP";

		$this->load->view('v_prelogin', $data);
	}

    public function member()
	{
        $data['barTitle'] = "MEMBER LOGIN";

		$this->load->view('v_login', $data);
	}

    public function nonmember()
	{
        $data['barTitle'] = "REGISTER";

		$this->load->view('v_register', $data);
	}

    
    public function forgetpassword()
	{
        $data['barTitle'] = "VERIFIKASI";

		$this->load->view('v_forgetpassword', $data);
	}
    
    public function makepassword()
	{
        $data['barTitle'] = "VERIFIKASI";

		$this->load->view('v_password', $data);
	}

    public function login()
    {

    }
}
