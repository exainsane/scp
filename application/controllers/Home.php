<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Home
 *
 * @author exain
 */
class Home extends Ext_Controller implements IAuthenticator {
    
    function __construct() {
        parent::__construct();
                
        $this->SetHeaderAndFooter("home/header", "home/footer");
    }
        
    function index(){                   
        $this->SetUIData("about", $this->db->get("ui_about")->result());
        $this->SetUIData("slider", $this->db->get("ui_slider")->result());
        $this->SetUIData("services", $this->db->get("ui_services")->result());
        $this->SetUIData("team", $this->db->get("ui_team")->result());
        $this->SetUIData("testimoni", $this->db->get("ui_testimoni")->result());
        $this->SetUIData("blog", $this->db->get("ui_blog")->result());
        
        $this->LoadUI("home/default");
    }
    function foo(){
        $u = new model_user();
        //var_dump(EntityModel::GetData($u));
        
        $u->email = "rnugraha305@gmail.com";
        $u->fullname = "Ridwan Achadi";
        $u->password = "Ridwan123";
        
        $u->Insert();
    }

//    public function GetAuthOption() {
//        return $this->cred;
//    }

    public function SetAuthOptions() {
        $this->RequireLogin("index");
    }

    public function OnFailedAuthentication() {
        
    }

    public function OnAfterAuthentication() {
        
    }
    public function PostLogin(){
        $data = new model_user();
        
        $this->ParsePostData($data);
        
        $auth = Authenticator::GetContext();
        $auth instanceof Authenticator;
        
        var_dump($auth->Login($data->username, $data->password));
    }
    public function PostRegister(){
        $data = new model_user();
        
        $this->ParsePostData($data);
        
        var_dump(Authenticator::GetContext()->Register($data));    
        
        echo Authenticator::GetContext()->last_error;
    }
    public function PostVerify(){
        $data = new AuthTokenModel();
        
        $this->ParseGetData($data);
        var_dump($data);
        $auth = Authenticator::GetContext();
        $auth instanceof Authenticator;
        var_dump($auth->ActivateUser($data->for_user, $data->token));
        
        echo $auth->last_error;
    }
    public function generateclass(){
        $tables = $this->db->list_tables();
        
        foreach ($tables as $table) {
            $flds = $this->dbm->fields($table);           
            echo "<br>class ".$table." extends EntityModel{ <br>";
            echo "&nbsp;&nbsp;&nbsp;function __construct(){<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::__construct(\"".$table."\");<br>";
            echo "&nbsp;&nbsp;&nbsp;}";
            
            foreach ($flds as $fld){
                echo "&nbsp;&nbsp;&nbsp;public \$".$fld.";<br>";
            }
            
            echo "}";
        }
    }
}
