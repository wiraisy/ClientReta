<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function index()
	{
		$data['title'] = "Chat";

		$this->load->view('includes/header');
		$this->load->view('v_chat', $data);
		$this->load->view('includes/footer');
	}
}
