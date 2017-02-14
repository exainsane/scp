<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Auth
 *
 * @author exain
 */
class Auth extends Api_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
    }
    function postlogin(){
        $return = new stdClass();
        $return->status = "fail";
        $return->message = "Failed : Undefined Error";
        
        $data = new LoginForm();
        
        $this->ParsePostData($data);
        
        
        $auth = Authenticator::GetContext();
        $checkaukey = function(&$ci){
          $ci->db->where("length(device_key) = 20");
        };
        $auth instanceof Authenticator;
        if ($auth->Login($data->username, $data->password)){
            
            $return->status = "ok";
            $return->message = "Login Success";
            $return->token = $auth->token;
            $udt = TransformIntoStdClass($auth->CurrentUser());
            
            $key = $udt->device_key;
            $this->db->where("device_key",$key)
                    ->where("valid_until >= date(now())");
            $chk = $this->db->get("m_device_key");
            if($chk->num_rows() != 1){
                return $this->Fail("Device key not found or no loger valid!");                
            }
            
            $shift = new m_shift();
            $shift->id = $udt->shift;
            
            $shift->Parse(singlerow($shift->ExactQuery()));
            
            $udt->shift_label = $shift->title;
            
            $return->accountdata = $udt;
            
        }else{
            $return = new stdClass();
            $return->status = "fail";
            $return->msg = "Failed : ".$auth->last_error;
            
        }
        return $return;
    }
}
