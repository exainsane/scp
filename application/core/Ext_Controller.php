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
        $status = "";
        if($this->mode == "new"){            
            $status = $this->data->Insert();
                        
        }
        
        if($this->mode == "edit"){
            $this->data->Update();            
                        
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