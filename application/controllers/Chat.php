<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends MY_Controller {

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

        $data['barTitle'] = "Chat Testing";

        $this->load->view('includes/header', $data);
        $this->load->view('v_testing'); 
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
		"incoming_msg_id": "ADMINCS",
		"msg": "'.$message.'",
		"msg_id": 0,
		"outgoing_msg_id": "'.$custid.'"
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

    public function getChat(){
        $outgoing_id = $_POST['outgoing_id'];
        
        $url = 'https://api-reta.id/reta-api/MessageAPI/getallmessagebyincomingid/'.$outgoing_id;
		$method = 'GET';
		$res = $this->SendRequest($url, $method);

        $output = "";
        $srcImage = base_url()."assets/user.png";

        if (!empty($res)) {
            foreach($res as $row){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="messages__item messages__item--operator">'. $row['msg'] .'</div>';
                }else{
                    $output .= '<div class="messages__item messages__item--visitor">'. $row['msg'] .'</div>';
                }
            }
        } else {
            $output .= '<div class="text" style="height: 100%;">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
        
    }
}
?>