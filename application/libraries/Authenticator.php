<?php
define("USERDB_CLASSNAME","model_user");

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Authenticator
 *
 * @author exain
 */

class Authenticator {  
    public static $ERRORCODE_UNAUTHORIZED = 0;
    public static $ERRORCODE_LOWER_ACCESS_LEVEL = 1;
    public $last_error = "";    
    private static $instance = null;
    
    /**
     * 
     * @return type Authenticator
     */
    public static function GetContext(){
        if (self::$instance == null) {
            self::$instance = new Authenticator();
        }

        return self::$instance;
    }
    function __construct(){
        $this->ci =& get_instance();
        
    }
    
    public function Login($username, $password){
        $m = new model_user();
        
        $m instanceof IUsePasswordField;


        $m->username = $username;
        $m->SetPassword($password);
        
        $q = $m->ExactQuery();
        
        if($q->num_rows() != 1){
            return false;
        }
        
        $data = $q->result();
        $user = end($data);
        $m->Parse($user);
        
        $m instanceof model_user;
        if($m->user_activated == 0){
            $this->last_error = "User not activated";
            return false;
        }


        $this->SaveCredentialInfo();
        
        return true;
    }
    /**
     * 
     * @return type model_user
     */
    public function CurrentUser(){        
        if(!$this->IsLoggedIn()){
            return null;
        }
        
        return $this->UserData($ci->session->userdata(SESSIONKEY."loggeduserid"));
        
    }
    /**
     * 
     * @param int $id
     * @return model_user
     */
    public function UserData($id){        
        $ci =& get_instance();
        
        $m = new model_user();
        
        $m->id = $id;
        
        $q = $m->ExactQuery();
        
        if($q->num_rows() != 1){
            $this->last_error = "Cannot find user with specified ID!";
            return null;
        }
        
        $data = $q->result();
        $user = end($data);
        
        $m->Parse($user);
                

        return $m;
    }
    public function Register(model_user $ndt){
        if(strlen($ndt->username) < 1){
            $this->last_error = "Username empty";
            return false;
        }
        if(strlen($ndt->password) < 1){
            $this->last_error = "Password empty";
            return false;
        }
        
        $tokenInfo = new AuthTokenModel();
        
        $tokenInfo->token = $this->GenerateToken(25);        
        
        $ndt->user_activated = 0;
        
        //Check if username exist
        $m = new model_user();
        $m->username = $ndt->username;
        
        if($m->ExactQuery()->num_rows() > 0){
            $this->last_error = "User has already been taken!";
            return false;
        }
        $ist = $ndt->Insert();
        
        $tokenInfo->for_user = get_instance()->db->insert_id();
        
        $tokenInfo->valid_until = date("Y/m/d H:i:s");
        
        $tokenInfo->Insert();
        
        return $ist;
    }
    public function ActivateUser($userid,$token){
        $m = $this->UserData($userid);
        
        $tAuth = new AuthTokenModel();
        $tAuth->for_user = $m->id;
        $tAuth->token = $token;
        
        $q = $tAuth->ExactQuery();
        
        if($q->num_rows() != 1){
            return false;
        }
        
        $data = $q->result();
        $tdata = end($data);
        
        $tAuth->Parse($tdata);
        
        //$now = new DateTime();
//        if($tAuth->valid_until < $now->){
//            $this->last_error = "Unable to parse token : Token Expired! Use Another Token";
//            return false;
//        }
        
        $m->user_activated = 1;
        $m->Update();
        
        $tAuth->Delete();
        return true;
    }
    public function IsLoggedIn(){
        
        return get_instance()->session->userdata(SESSIONKEY."loggeduserid") != null;
    }
    public function VerifyLevel($level){
        
    }
    private function SaveCredentialInfo(model_user $obj){
        $ci =& get_instance();
        
        $ci->session->set_userdata(SESSIONKEY."loggeduserid", $obj->id);
        
        $obj->last_active = "CURRENT_TIMESTAMP";
        
        $obj->Update();
    }
    private function GenerateToken($length){        
        $key = array(
                'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
                '1','2','3','4','5','6','7','8','9'
                );
        
        $pin = '';
        for ($i=1;$i<=$length;$i++){
            $pin .= $key[rand(0, count($key)-1)];
        }
        return $pin;	
    }
}
