<?php
defined('BASEPATH') OR exit('No direct script access allowed');
interface IAuthenticator{
    
    function SetAuthOptions();
    function GetAuthOptions();
    function OnFailedAuthentication();
    function OnAfterAuthentication();
}
interface IUsePasswordField{
    function SetPassword($password);   
    function GetPasswordField();
}
interface IUseEncodedID{
    function SetID($id);
    function GetID();
}
interface IFileUpload{
    function SaveFileUpload();
    function GetFileField();
}
class Ext_Controller extends CI_Controller{    
    protected $cfg = array();
    protected $cred = array();
    protected $headerUI, $footerUI;
    protected $uidata = array();
    public function SetUIData($key,$value){
        $this->uidata[$key] = $value;
    }
    public function SetHeaderAndFooter($header,$footer){
        $this->headerUI = $header;
        $this->footerUI = $footer;
    }
    public function LoadUI($ui){
        $this->load->view($this->headerUI);
        $this->load->view($ui,$this->uidata);
        $this->load->view($this->footerUI);
    }
    public function ParsePostData(EntityModel &$obj){
        $postarr = $this->input->post(null);
        $data = array();
        
        if($obj instanceof IUseEncodedID){            
            $idfield = $obj->GetIDField();
            if(isset($postarr["form-".$idfield])){
                $postarr["form-".$idfield] = decrypt($postarr["form-".$idfield], true);
            }
        }
        if($obj instanceof IFileUpload){
            $filefield = $obj->GetFileField();            
            $postarr[$filefield] = $obj->SaveFileUpload();
        }
        
        foreach ($postarr as $key=>$value){
            if(is_numeric(strpos($key, "form-"))){
                $tkey = str_replace("form-", "", $key);
                $data[$tkey] = $value;
            }
        }
        
        $obj->Parse($data);
    }
    
    public function ParseGetData(EntityModel &$obj){
        $postarr = $this->input->get(null);
        $data = array();
        foreach ($postarr as $key => $value){
            if(is_numeric(strpos($key, "urd_"))){
                $tkey = str_replace("urd_", "", $key);
                $data[$tkey] = $value;
            }
        }
        
        $obj->Parse($data);
    }
    
    public function GetAuthOptions(){
        return $this->cred;
    }
    protected function RequireLogin($methodname){
        $this->SetCredential($methodname, true);
    }
    protected function RequireUserLevel($methodname,$level){
        $this->SetCredential($methodname, true, $level);
    }
    protected function SetCredential($methodname,$requirelogin = true,$userlevel = 1){
        $this->cred[$methodname]['authenticate'] = $requirelogin;
        $this->cred[$methodname]['level'] = $userlevel;
    }
}
class Api_Controller extends Ext_Controller{
    public function __construct() {
        parent::__construct();
    }    
    protected function Success($msg = "Action Completed Successfully"){
        $st = array();
        $st['status'] = 'ok';
        $st['code'] = 200;
        $st['msg'] = $msg;
        
        return $st;
    }
    protected function Fail($msg = "Action Failed"){
        $st = array();
        $st['status'] = 'fail';
        $st['code'] = 500;
        $st['msg'] = $msg;
        
        return $st;
    }
}
class IOManager{
    private $ci;
    private $table;
    private $useheaderfooter = false;
    private $idfield;
    private $data;
    private $mode;
    private $viewAdd;
    private $viewEdit;
    private $id;
    private $header;
    private $footer;
    private $urlpost;
    private $urlredir;
    function __construct(&$instance) {
        $this->ci =& $instance;        
    }
    /**
    * 
    * @param string $table
    * @return \IOManager
    */
    function Table($table){
        $this->table = $table;
        return $this;
    }
    /**
     * 
     * @param bool $use
     * @return \IOManager
     */
    function UseExistingHeaderAndFooter($use = true){
        $this->useheaderfooter = $use;
        return $this;
    }
    /**
     * 
     * @param string $idfield
     * @return \IOManager
     */
    function IdFieldOnTable($idfield){
        $this->idfield = $idfield;
        return $this;
    }
    /**
     * 
     * @param EntityModel $data
     * @return \IOManager
     */
    function Data($data){
        $this->data = $data;
        return $this;
    }
    /**
     * 
     * @param string $vw
     * @return \IOManager
     */
    function ViewOnAdd($vw){
        $this->viewAdd = $vw;
        $this->viewEdit = $vw;
        return $this;
    }
    /**
     * 
     * @param string $vw
     * @return \IOManager
     */
    function ViewOnEdit($vw){
        $this->viewEdit = $vw;
        return $this;
    }
    /**
     * 
     * @param int $id
     * @return \IOManager
     */
    function UseID($id){
        $this->id = $id;
        return $this;
    }
    function UseHeaderAndFooter($header,$footer){        
        $this->ci->SetHeaderAndFooter($header,$footer);
        $this->header = $header;
        $this->footer = $footer;
        return $this;
    }
    function AddReference($name,array $values){
        $this->ci->SetUIData($name, $values);
    }
    /**
     * 
     * @param string $mode : "edit"/"delete"/"new"
     * @return \IOManager
     * 
     */
    function SetMode($mode){
        $this->mode = $mode;
        return $this;
    }
    function Show(){
        
        if($this->useheaderfooter){
            if($this->header == null || $this->footer == null){
                //TODO : Replace with Error Page
                app_error("IOManager : header and/or footer not set");
            }
        }
        
        $this->ci->SetUIData("mode",$this->mode);
        $this->ci->SetUIData("action",$this->urlpost);
        if($this->mode == "edit"){
            $data = get_object_vars($this->data);
            $this->ci->SetUIData("used_id",$this->id);
            foreach ($data as $key => $value){
                $this->ci->SetUIData($key,$value);                   
            }
            
            $this->ci->LoadUI($this->viewEdit);
            return;
        }
        
        if($this->mode == "new"){
            $fields = $this->ci->dbm->fields($this->table);
            foreach ($fields as $field){
                $this->ci->SetUIData($field,"");
            }
            $this->ci->LoadUI($this->viewAdd);
            return;
        }
        
        if($this->mode == "delete"){
            $idfield = $this->idfield;
            if($this->id != null){
                $id = $this->id;
            }else if(isset($this->data->$idfield)){
                $id = $this->data->$idfield;
            }else{
                app_error("IOManager : Cannot find key to perform operations!");
            }
            $this->ci->db->where($this->idfield, $id);
            
            redirect($this->urlredir);
            return;
        }
        
        app_error("IOManager : Unspecified mode");
    }
    function Execute(){
        $status = false;
        if($this->mode == "new"){            
            $status = $status = $this->data->Insert();
                        
        }
        
        if($this->mode == "edit"){
            $status = $this->data->Update();            
                        
        }
        
        if($this->mode == "delete"){
            if($this->data == null){
                $status = $this->ci->dbm->delete($this->table, $this->id, $this->idfield);                    
            }else
            {
                $status = $this->data->Delete();                        
            }
        }        
        if($this->ci instanceof Api_Controller){            
            return $status;
        }
        
        if($this->ci instanceof Ext_Controller){
            redirect($this->urlredir);
        }
    }
    function RedirectTo($url){
        $this->urlredir = $url;
        return $this;
    }
    function PostTo($url){
        $this->urlpost = $url;
        return $this;
    }
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
    public function ScanDelete(){
        $ci =& get_instance();
        
        $attrs = get_object_vars($this);
        
        unset($attrs["_attrib"]);
        
        if(count($attrs) < 1) return false;
        
        foreach ($attrs as $key => $value){
            if($value == null) continue;
            $ci->db->where($key, $value);
        }
        $ci->db->from($this->GetTableName());
        
        return $ci->db->delete($this->GetTableName());
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
        $ins = 0;
        foreach ($attrs as $key => $value) {
            if($value == null) continue;
            $ci->db->set($key,$value);
            $ins++;
//            $cols += $key;
//            $values += "'"+$value+"'";
//            
//            if($pos < $lim){
//                $cols += ",";
//                $values += ",";
//            }
        }
        if($ins < 1) return false;
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
        if($set == 0 ) {
            app_error ("Error updating Entity : 0 Fields changed!");
            return false;
        }
        $ci->db->from($table);
        $ci->db->where($this->_attrib['key'], $id);
        
        return $ci->db->update();
    }
    function __construct($tablename,$keyid = "id"){
        $this->_attrib['table'] = $tablename;
        $this->_attrib['key'] = $keyid;
        $this->_attrib['model_crud'] = false;
    }
    function GetTableName(){
        return $this->_attrib['table'];
    }
}