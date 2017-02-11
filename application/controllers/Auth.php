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
        $auth instanceof Authenticator;
        if ($auth->Login($data->username, $data->password)){
            
            $return->status = "ok";
            $return->message = "Login Success";
            $return->token = $auth->token;
            $udt = TransformIntoStdClass($auth->CurrentUser());
            $shift = new m_shift();
            $shift->id = $udt->shift;
            
            $shift->Parse(singlerow($shift->ExactQuery()));
            
            $udt->shift_label = $shift->title;
            
            $return->accountdata = $udt;
            
        }else{
            $return = new stdClass();
            $return->status = "fail";
            $return->message = "Failed : ".$auth->last_error;
            
        }
        return $return;
    }
}
