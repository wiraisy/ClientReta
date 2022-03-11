<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelChat extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    function get_user($custid){
        $sql = "SELECT * FROM `users` WHERE custid = '$custid'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function add_user($custid , $custname){
        $sql = "INSERT INTO `users` (custid, name) VALUES ('$custid', '$custname')";
        $query = $this->db->query($sql);
        return $query;
    }

    function insert_message($custid, $message){
        $sql = "INSERT INTO `messages` (incoming_msg_id, outgoing_msg_id, msg) VALUES ('ADMINCS', '$custid', '$message')";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_message($outgoing_id){
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.custid = messages.outgoing_msg_id
        WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = 'ADMINCS')
        OR (outgoing_msg_id = 'ADMINCS' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id ASC" ;
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $output = "";
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