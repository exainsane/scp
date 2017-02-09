<?php

/* 
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

class Entity extends CI_Model{
    
}




class AuthTokenModel extends EntityModel{
    public $id;
    public $for_user;
    public $token;
    public $valid_until;
    
    function __construct() {
        parent::__construct("t_auth_token");
        
        $this->SetModelCRUD();
    }
}


class m_company extends EntityModel implements IUseEncodedID{ 
    public function GetID() {
        return decrypt($this->id);
    }

    public function SetID($id) {
        $this->id = encrypt($id);
    }

    function __construct(){
      parent::__construct("m_company");
   }   
   public $id;
   public $_enable;
   public $company_name;
   public $company_address;
   public $company_phone;
   public $company_email;
}
class m_device_key extends EntityModel{ 
   function __construct(){
      parent::__construct("m_device_key");
   }   public $id;
   public $_enable;
   public $used_by;
   public $for_company;
   public $key;
   public $verified;
}
class m_point extends EntityModel{ 
   function __construct(){
      parent::__construct("m_point");
   }   public $id;
   public $_enable;
   public $point_name;
   public $point_lat;
   public $point_long;
   public $point_key;
   public $company_id;
}
class m_point_key extends EntityModel{ 
   function __construct(){
      parent::__construct("m_point_key");
   }   public $id;
   public $_enable;
   public $used_by;
   public $for_company;
   public $key;
   public $verified;
}
class m_schedule extends EntityModel{ 
   function __construct(){
      parent::__construct("m_schedule");
   }   public $id;
   public $_enable;
   public $shift_id;
   public $point_id;
   public $schedule_base;
   public $after;
}
class m_shift extends EntityModel{ 
   function __construct(){
      parent::__construct("m_shift");
   }   public $id;
   public $_enable;
   public $title;
   public $company_id;
}
class m_user extends EntityModel implements IUsePasswordField{ 
    public function GetPasswordField() {
        return "password";
    }

    public function SetPassword($password) {
        $this->password = md5($password);
    }

    function __construct(){
      parent::__construct("m_user");
   }   
   public $id;
   public $_enable;
   public $user_activated;
   public $username;
   public $password;
   public $firstname;
   public $lastname;
   public $address;
   public $phone;
   public $email;
   public $shift;
   public $user_level;
   public $device_key;
   public $company_id;
}
class m_user_level extends EntityModel{ 
   function __construct(){
      parent::__construct("m_user_level");
   }   public $id;
   public $_enable;
   public $level_name;
}
class t_checkout extends EntityModel{ 
   function __construct(){
      parent::__construct("t_checkout");
   }   public $id;
   public $_enable;
   public $point_id;
   public $user_id;
   public $checkout_time;
   public $schedule_time;
   public $point_name;
   public $point_lat;
   public $point_long;
}
class t_event_report extends EntityModel{ 
   function __construct(){
      parent::__construct("t_event_report");
   }   public $id;
   public $_enable;
   public $user_id;
   public $time;
   public $point_name;
   public $description;
   public $point_lat;
   public $point_long;
   public $img;
}
class m_token extends EntityModel{ 
   function __construct(){
      parent::__construct("m_token");
   }   
   public $id;
   public $id_user;
   public $token;
}

/*
 * Helper Models
 */

class LoginForm extends EntityModel{    
    function __construct(){
      parent::__construct("");
   }  
   public $username;
   public $password;
   
}