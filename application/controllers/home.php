<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
        $data['barTitle'] = "Buy Products";

        $this->load->view('includes/header', $data);
		$this->load->view('v_home');
        $this->load->view('includes/footer');
	}
}
