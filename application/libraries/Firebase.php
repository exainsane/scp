<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Firebase
 *
 * @author exain
 */
class Firebase {
    //put your code here
    private $key;
    private $data = array();
    private $recipients = array();
    public function SetKey($key){
        $this->key = $key;
    }
    public function AddData($key, $value){
        $this->data[$key] = $value;
    }
    public function AddRecipients($fcmtoken){
        if(is_array($fcmtoken)){
            $this->recipients = $fcmtoken;
        }  
        else{
            array_push($this->recipients, $fcmtoken); 
        }
    }
    public function GetRecipients(){
        $ci =& get_instance();
        $users = new m_user();
        
        $filter = function(&$ci){
          $ci->db->where("length(fcm_token) > 0");
        };
        
        $udt = $users->ExactQuery($filter)->result();
        
        $rec = array();
        foreach($udt as $row){
            array_push($rec, $row->fcm_token);
        }
        
        return $rec;
    }
    public function Send(){
        $headers = array
        (
            'Authorization: key=' . $this->key,
            'Content-Type: application/json'
        );
        $fields = array();
        $fields['data'] = $this->data;
        
        if(count($this->recipients) > 1){
            $fields['registration_ids'] = $recipients;
        }elseif(count($this->recipients) == 1){
            $fields['to'] = $recipients;
        }else{
            return null;
        }
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        /*
//      result be like
//      {
//          "multicast_id":8840928181501720294,
//          "success":0,
//          "failure":1,
//          "canonical_ids":0,
//          "results":[
//            {"error":"NotRegistered"}
//          ]
//      }
//      */
        return json_decode($result, true);
    }
     
}
