<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('ModelChat');
    }

    public function index(){
		// Check Session
		if (!$this->session->userdata('isLoggedIn_userReta')) {
			return redirect(base_url() . 'auth');
		}
        
        $custid = $this->session->userdata('data_user_reta')['data']['custid'];

        $data['dataChatPasien'] =$this->ModelChat->get_user($custid);
        $data['barTitle'] = "Chat Testing";

        $this->load->view('includes/header', $data);
        $this->load->view('v_testing'); 
    }

    public function postPasien(){
        $custid = $_POST['custid'];
        $custnama = $_POST['custnama'];
        $this->ModelChat->add_user($custid,$custnama);
    }

    public function insertChat(){
        $custid = $_POST['custid'];
        $message = $_POST['message'];
        $this->ModelChat->insert_message($custid,$message);
    }

    public function getChat(){
        $outgoing_id = $_POST['outgoing_id'];
        $this->ModelChat->get_message($outgoing_id);
    }
}
?>