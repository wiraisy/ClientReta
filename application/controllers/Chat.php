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

        // Check Apakah Data User Ada di Api Chat
        $curl_check = curl_init();
        curl_setopt_array($curl_check, array(
        CURLOPT_URL => "https://api-reta.id/reta-api/MessageAPI/getallmessagebyincomingid/".$custid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
        ),
        ));

        $response_check = curl_exec($curl_check);
        curl_close($curl_check);
        $res_check = json_decode($response_check, true);

        if (!$res_check) {
            // Register User to API Chat
            $curl_reg = curl_init();
            curl_setopt_array($curl_reg, array(
            CURLOPT_URL => 'https://api-reta.id/reta-api/MessageAPI/registeruser/'.$custid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: */*',
                'Authorization: Basic YWtiYXI6d2lyYWlzeQ=='
            ),
            ));

            $reg = curl_exec($curl_reg);
            curl_close($curl_reg);
        }

        
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
        sort($res);

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