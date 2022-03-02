<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelChat extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    function get_allusers(){
        $sql = "SELECT * FROM users WHERE NOT custid = 'ADMINCS' ORDER BY user_id DESC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $output = "";
        $srcImage = base_url()."assets/user.png";
        if (!empty($res)) {
            foreach($res as $row){
                $output .= "<li onclick=openMessage('{$row['custid']}')><img src='{$srcImage}' alt=''><div><h2>".$row['name']."</h2></div></li>";
            }
        }else{
            $output .= "No users are available to chat";
        }
        echo $output;
    }

    function insert_message($custid, $message){
        $sql = "INSERT INTO `messages` (incoming_msg_id, outgoing_msg_id, msg) VALUES ('$custid', 'ADMINCS', '$message')";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_infouser($incoming_id){
        // Get For Header
        $sql1 = "SELECT * FROM users WHERE custid = '$incoming_id'";
        $query1 = $this->db->query($sql1);
        $res_user = $query1->result_array();
        
        $srcImage = base_url()."assets/user.png";
        $header = "";
        if (!empty($res_user)) {
            $header .= '<img src="'.$srcImage.'" alt=""><h2>Chat with '.$res_user[0]['name'].'</h2>';
        } else {
            $header .= '<h2>Data Error</h2>';
        }
        echo $header;
    }

    function get_message($incoming_id){
        // Get For Messages
        $sql2 = "SELECT * FROM messages LEFT JOIN users ON users.custid = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = 'ADMINCS')
        OR (outgoing_msg_id = 'ADMINCS' AND incoming_msg_id = '$incoming_id') ORDER BY msg_id ASC" ;
        $query2 = $this->db->query($sql2);
        $res_msg = $query2->result_array();
        
        $output = "";
        if (!empty($res_msg)) {
            foreach($res_msg as $row){
                if($row['outgoing_msg_id'] == 'ADMINCS'){
                    $output .= '<li class="me"><div class="message">'.$row['msg'].'</div></li>';
                }else{
                    $output .= '<li class="you"><div class="message">'.$row['msg'].'</div></li>';
                }
            }
        } else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }

        echo $output;
    }
}
?>