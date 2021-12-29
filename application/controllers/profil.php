<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function info_akun()
	{
        $data['barTitle'] = "My Profile";

        $this->load->view('includes/header', $data);
		$this->load->view('v_profil');
        $this->load->view('includes/footer');
	}
	
	public function info_pesanan()
	{
        $data['barTitle'] = "My Cart";

        $this->load->view('includes/header', $data);
		$this->load->view('v_pesanan');
        $this->load->view('includes/footer');
	}
}
