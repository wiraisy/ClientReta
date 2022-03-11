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
                $incoming_id = $row['custid'];
                $sqllastmsg = "SELECT * FROM messages LEFT JOIN users ON users.custid = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = 'ADMINCS')
                OR (outgoing_msg_id = 'ADMINCS' AND incoming_msg_id = '$incoming_id') ORDER BY msg_id DESC LIMIT 1";
                $querymsg = $this->db->query($sqllastmsg);
                $resmsg = $querymsg->result_array();
                $lastmsg = strlen($resmsg[0]['msg']) > 25 ? substr($resmsg[0]['msg'],0,25)."..." : $resmsg[0]['msg'];
                $output .= "<li class='clearfix' id='userChat{$row['custid']}' onclick=openMessage('{$row['custid']}')><img src='{$srcImage}' alt='avatar'><div class='about'><div class='name'>".$row['name']."</div><div class='custid'>".$lastmsg."</div></div></li>";
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
            $header .= "<div class='row'><div class='col-lg-6'><img src='".$srcImage."' alt='avatar'><div class='chat-about'><h3 class='mb-0'>".$res_user[0]['name']."</h3><small>".$res_user[0]['custid']."</small></div></div><div class='col-lg-6 text-right refresh-chat' onclick=refreshChat('".$incoming_id."')><i class='fa fa-sync'></i></div></div>";
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
        $srcImage = base_url()."assets/user.png";
        if (!empty($res_msg)) {
            foreach($res_msg as $row){
                if($row['outgoing_msg_id'] == 'ADMINCS'){
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
}
?>