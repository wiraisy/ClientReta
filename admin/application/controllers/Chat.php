<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('ModelChat');
    }

	public function index()
	{
		// Check Session
		if (!$this->session->userdata('isLoggedIn_adminReta')) {
			return redirect(base_url() . 'login');
		}

		$data['title'] = "Chat";

		$this->load->view('includes/header');
		$this->load->view('v_chat', $data);
		$this->load->view('includes/footer');
	}

	public function getAllUsers(){
		$this->ModelChat->get_allusers();
	}

	public function getbyUser(){
		$incoming_id = $_POST['incoming_id'];
		$this->ModelChat->get_infouser($incoming_id);
	}

	public function getmessage(){
		
		$incoming_id = $_POST['incoming_id'];
		$this->ModelChat->get_message($incoming_id);
	}

	public function insertChat(){
		$custid = $_POST['custid'];
        $message = $_POST['message'];
        $this->ModelChat->insert_message($custid,$message);
	}

}
