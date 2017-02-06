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
abstract class EntityModel{
    public static function ManageUploadFile($formlabel){
        $ci =& get_instance();
        $ci->load->library("upload");                
        
        if(!isset($_FILES[$formlabel]) || $_FILES[$formlabel]['error'] == 4){
            if($ci->input->post("old-".$formlabel) != null)
            {
                return $ci->input->post("old-".$formlabel);
            }
            return;
        }
        
        $uploaded_name = $_FILES[$formlabel]['name'];
        
        $savefilepath = $ci->config->item("UPLOAD_LOCATION");
        $naming = $ci->config->item("UPLOAD_NAMING");
        
        $config['upload_path'] = $savefilepath;
        $config['file_name'] = $naming(get_filename_extension($uploaded_name));
        $config['file_ext_tolower'] = $savefilepath;
        $config['allowed_types'] = "jpg|png";
        
        recursive_check_add_dir($config['upload_path'], "/");
        
        $ci->upload->initialize($config);
        
        if(!$ci->upload->do_upload($formlabel)){
            app_error("Error on uploading! : ".$ci->upload->display_errors());            
        }
        
        return $savefilepath.$ci->upload->data("file_name");
    }
    public static function LoadReference(&$obj, $ref_field, $targettable, $target_field, $key = "id"){
        $id = $obj->$ref_field;
        
        $ci =& get_instance();
        
        $ci->db->from($targettable)
                ->where($key, $id)
                ->select($target_field);
        $q = $ci->db->get();
        
        $data = singlerow($q);
        $obj->$ref_field = $data->$target_field;
    }
    protected $_attrib = array();
    protected function SetModelCRUD(){
        $this->_attrib['model_crud'] = true;
    }
    protected function SetModelCRU(){
        $this->_attrib['model_crud'] = false;
    }
    protected function IsModelCRUD(){
        return !isset($this->_attrib['model_crud']) || $this->_attrib['model_crud'] = true;
    }
    public function GetIDField(){
        return $this->_attrib['key'];
    }    
    public static function GetData($obj,$wherequery = null, $orderby = null, $limit = null){
        $data = array();        
        
        $ci =& get_instance();
        
        $table = $obj->_attrib['table'];
        
        $classname;
        $props;
        
        if(is_string($obj)){
            $classname = $obj;
            $props = get_class_vars($obj);
        }
        else
        {
            $classname = get_class($obj);
            $props = get_object_vars($obj);
        }
        
        //Unset Non-data properties
        unset($props['_attrib']);
        
        
        $ci->db->select("*")
                ->from($table);
        if($wherequery != null){
            $ci->db->where($wherequery);
        }
        
        if($orderby != null){
            $ci->db->order_by($orderby);
        }
        
        if($limit != null){
            $this->db->limit($limit[1],$limit[0]);
        }
        
        $ci->db->where("_enable",1);
        
        $q = $ci->db->get();
        
        foreach ($q->result() as $d){
            $obj = new $classname;
            
            foreach ($props as $key => $value){
                $obj->$key = $d->$key;
            }
            
            array_push($data, $obj);
        }
        
        return $data;
    }
    public function Delete(){
        $ci =& get_instance();
        
        $idk = $this->_attrib['key'];
        $id = null;
        
        if($this instanceof IUseEncodedID){
            $id = $this->GetID();
        }else{
            $id = $this->$idk;
        }
        
        $ci->db->from($this->_attrib['table'])
                ->where($this->GetIDField(),$id);
        if($this->IsModelCRUD()){
            $ci->db->delete();
        }
        else{
            $ci->db->set("_enable",0)
                ->update();
        }
                
    }
    public function Insert(){
        $ci =& get_instance();
        
        $table = $this->_attrib['table'];
        
        $attrs = get_object_vars($this);
        
        unset($attrs[$this->_attrib['key']]);
        unset($attrs['_attrib']);
        
        $cols = "";
        $values = "";
        
//        $pos = 0; $lim = count($attrs) - 1;
        
        if(count($attrs) < 1) return false;
        
        foreach ($attrs as $key => $value) {
            if($value == null) continue;
            $ci->db->set($key,$value);
//            $cols += $key;
//            $values += "'"+$value+"'";
//            
//            if($pos < $lim){
//                $cols += ",";
//                $values += ",";
//            }
        }
        $ci->db->from($table);
        return $ci->db->insert();
                
    }
    public function ExactQuery(){
        $ci =& get_instance();
        
        $attrs = get_object_vars($this);
                
        unset($attrs['_attrib']);
        
        $ci->db->select("*")
                ->from($this->_attrib['table']);
        
        if($this instanceof IUseEncodedID){
            $idfield = $this->GetIDField();
            
            $attrs[$idfield] = $this->GetID();
                        
        }
        
        foreach ($attrs as $key => $value) {            
            if($value == null) continue;
            
            $ci->db->where($key, $value);
        }        
        return $ci->db->get();
               
    }
    public function Search(){
        $ci =& get_instance();
        
        $attrs = get_object_vars($this);
                
        unset($attrs['_attrib']);
        
        $ci->db->select("*")
                ->from($this->_attrib['table']);
        
        if($this instanceof IUseEncodedID){
            $idfield = $this->GetIDField();
            
            $attrs[$idfield] = $this->GetID();
                        
        }
        
        foreach ($attrs as $key => $value) {            
            if($value == null) continue;
            
            $ci->db->like($key, $value);
        }        
        return $ci->db->get();
               
    }
    public function Parse($obj){       
        $attrs = get_object_vars($this);
        
        unset($attrs['_attrib']);
        
        if($this instanceof IUseEncodedID){           
            $idfield = $this->GetIDField();
            if(isset($obj->$idfield)){
                $this->SetID($obj->$idfield);
            }else if(isset($obj[$idfield])){
                $this->SetID($obj[$idfield]);
            }
            //We no longer use ID Field here, since its encoded
            unset($attrs[$idfield]);
        }
        
        if($this instanceof IUsePasswordField){
            $pwfield = $this->GetPasswordField();
            if(isset($obj->$pwfield)){
                $this->SetPassword($obj->$pwfield);
            }else if(isset($obj[$pwfield])){
                $this->SetPassword($obj[$pwfield]);
            }
            //We no longer use Password Field here, since its secret
            unset($attrs[$pwfield]);
        }
        
        foreach ($attrs as $key => $value){                        
            
            if(is_array($obj)){
                if(isset($obj[$key])){
                    $this->$key = $obj[$key];
                }
            }
            else if(is_object($obj)){
                if(isset($obj->$key)){
                    $this->$key = $obj->$key;
                }
            }
        }
        
        
    }
    public function Update(){
        $ci =& get_instance();
        
        $table = $this->_attrib['table'];
        
        $attrs = get_object_vars($this);
        
        unset($attrs[$this->_attrib['key']]);
        unset($attrs['_attrib']);
        
        $idk = $this->_attrib['key'];
        $id = null;
                
        if($this instanceof IUseEncodedID){            
            $id = $this->GetID();            
        }else{
            $id = $this->$idk;
        }        
        
        $cols = "";
        $values = "";        
        $set = 0;
        
        if(count($attrs) < 1) return false;
        
        foreach ($attrs as $key => $value) {
            if($value == null) continue;
            $ci->db->set($key,$value);
            $set++;
        }
        if($set == 0 ) app_error ("Error updating Entity : 0 Fields changed!");
        $ci->db->from($table);
        $ci->db->where($this->_attrib['key'], $id);
        
        return $ci->db->update();
    }
    function __construct($tablename,$keyid = "id"){
        $this->_attrib['table'] = $tablename;
        $this->_attrib['key'] = $keyid;
        $this->_attrib['model_crud'] = false;
    }
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
   public $schedule;
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