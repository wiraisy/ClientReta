<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {

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
		if ($this->session->userdata('data_admin_reta')['rule'] == 'superadmin') {
			$this->load->view('includes/header');
			$this->load->view('v_chat', $data);
			$this->load->view('includes/footer');
		} else {
			$this->load->view('includes/headeradmin');
			$this->load->view('v_chat', $data);
			$this->load->view('includes/footer');
		}
	}

	public function getAllUsers(){
		$url = 'https://api-reta.id/reta-api/MessageAPI/getallusermessage';
		$method = 'GET';
		$alluser = $this->SendRequest($url, $method);
		
        $srcImage = base_url()."assets/user.png";
        $output = "";

		if (!empty($alluser)) {
            foreach($alluser as $row){
                $incoming_id = $row['custid'];
				$url = 'https://api-reta.id/reta-api/MessageAPI/getallmessagebyincomingid/'.$incoming_id;
				$method = 'GET';
				$resultmsg = $this->SendRequest($url, $method);
                $resmsg = end($resultmsg);
                $lastmsg = ($resmsg) ? strlen($resmsg['msg']) > 20 ? substr($resmsg['msg'],0,20)."..." : $resmsg['msg'] : '-';
                $output .= "<li class='clearfix' id='userChat{$row['custid']}' onclick=openMessage('{$row['custid']}')><img src='{$srcImage}' alt='avatar'><div class='about'><div class='name'>".$row['name']."</div><div class='custid'>".$lastmsg."</div></div></li>";
            }
        }else{
            $output .= "No users are available to chat";
        }
		echo $output;
	}

	public function getbyUser(){
		$incoming_id = $_POST['incoming_id'];

		$url = 'https://api-reta.id/reta-api/MessageAPI/getusermassagebycustid/'.$incoming_id;
		$method = 'GET';
		$res_user = $this->SendRequest($url, $method);
		
		$srcImage = base_url()."assets/user.png";
        $header = "";
		$header .= "<div class='row'><div class='col-lg-6'><img src='".$srcImage."' alt='avatar'><div class='chat-about'><h3 class='mb-0'>".$res_user['name']."</h3><small>".$res_user['custid']."</small></div></div><div class='col-lg-6 text-right refresh-chat' onclick=refreshChat('".$incoming_id."')><i class='fa fa-sync'></i></div></div>";

		echo $header;
	}

	public function getmessage(){
		$incoming_id = $_POST['incoming_id'];

		$url = 'https://api-reta.id/reta-api/MessageAPI/getallmessagebyincomingid/'.$incoming_id;
		$method = 'GET';
		$res_msg = $this->SendRequest($url, $method);

		$output = "";
        $srcImage = base_url()."assets/user.png";
        if (!empty($res_msg)) {
            foreach($res_msg as $row){
                if($row['incoming_msg_id'] == 'ADMINCS'){
                    $output .= '<li class="clearfix"><div class="message my-message"> '.$row['msg'].' </div></li>';
                }else{
                    $output .= '<li class="clearfix"><div class="message-data text-right"><img src="'.$srcImage.'" alt="avatar"></div><div class="message other-message float-right"> '.$row['msg'].' </div></li>';
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }

		echo $output;
	}

	public function insertChat(){
		$custid = $_POST['custid'];
        $message = $_POST['message'];

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-reta.id/reta-api/MessageAPI/sendmessage',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		"incoming_msg_id": "'.$custid.'",
		"msg": "'.$message.'",
		"msg_id": 0,
		"outgoing_msg_id": "ADMINCS"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Accept: */*',
			'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);
	}

}
