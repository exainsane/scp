<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Admin
 *
 * @author exain
 */
class Admin extends Ext_Controller {
    function __construct() {
        parent::__construct();
        
        $this->SetHeaderAndFooter("admin/header", "admin/footer");
    }
    function index(){
        $this->LoadUI("admin/pages/default");
    }
    
    function shifts($action = null, $id = null, $save = null){   
        $_naming = "shifts";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_shift")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->ViewOnAdd("admin/io/".$_naming);
                
        if($action == "edit" || $action == "new"){
            $data = new m_shift();
            
            if($action == "edit" && $save == null){
                if($data instanceof IUseEncodedID):
                    $data->SetID(decrypt($id, true));
                else:
                    $data->id = decrypt($id, true);
                endif;
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($save == "save"){
                $this->ParsePostData($data);
            }
            
            $IOManager->SetMode($action)
                    ->Data($data);
            
            if($save == null){
                $IOManager->Show();
            }else if($save == "save"){
                $IOManager->Execute();
            }
            
            return;
        }        
        
        if($action == "delete"){
            $IOManager->SetMode($action);
            $IOManager->UseID(decrypt($id,true))
                    ->Execute();
        }
    }    
    private function shifts_home(){
        $shift = new m_shift();
        $this->SetUIData("rows",$shift->ExactQuery()->result());
        $this->LoadUI("admin/pages/shifts");
    }
    
    function points($action = null, $id = null, $save = null){   
        $_naming = "points";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_point")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->ViewOnAdd("admin/io/".$_naming);
                
        if($action == "edit" || $action == "new"){
            $data = new m_point();
            
            if($action == "edit" && $save == null){
                if($data instanceof IUseEncodedID):
                    $data->SetID(decrypt($id, true));
                else:
                    $data->id = decrypt($id, true);
                endif;
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($save == "save"){
                $this->ParsePostData($data);
            }
            
            $IOManager->SetMode($action)
                    ->Data($data);
            
            if($save == null){
                $IOManager->Show();
            }else if($save == "save"){
                $IOManager->Execute();
            }
            
            return;
        }        
        
        if($action == "delete"){
            $IOManager->SetMode($action);
            $IOManager->UseID(decrypt($id,true))
                    ->Execute();
        }
    }    
    private function points_home(){
        $q = $this->db->get("m_point");
        $check_req = function($pid){
            $req = new t_point_key_request();
            $req->point_id = $pid;
            return $req->ExactQuery()->num_rows() > 0;
        };
        
        $this->SetUIData("rows",$q->result());
        $this->SetUIData("req_check", $check_req);
        $this->LoadUI("admin/pages/points");
    }
    
    //
    function schedules($action = null, $id = null, $save = null){   
        $_naming = "schedules";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_schedule")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->AllowEmpty(true)
                ->ViewOnAdd("admin/io/".$_naming);
        
        $shift = new m_shift();
        $IOManager->AddReference("shifts", $shift->ExactQuery()->result());
        $point = new m_point();
        $IOManager->AddReference("points", $point->ExactQuery()->result());
        
        if($action == "edit" || $action == "new"){
            $data = new m_schedule();
            
            if($action == "edit" && $save == null){
                if($data instanceof IUseEncodedID):
                    $data->SetID(decrypt($id, true));
                else:
                    $data->id = decrypt($id, true);
                endif;
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($save == "save"){
                $this->ParsePostData($data, true);
                if($data->schedule_base == null){
                    $data->schedule_base = "-";
                }
            }
            
            $IOManager->SetMode($action)
                    ->Data($data);
            
            if($save == null){
                $IOManager->Show();
            }else if($save == "save"){
                $IOManager->Execute();
            }
            
            return;
        }        
        
        if($action == "delete"){
            $IOManager->SetMode($action);
            $IOManager->UseID(decrypt($id,true))
                    ->Execute();
        }
    }    
    private function schedules_home(){
        $q = $this->db->get("m_schedule");
        $this->SetUIData("rows",$q->result());
        $this->LoadUI("admin/pages/schedules");
    }
    
    //
    function users($action = null, $id = null, $save = null){   
        $_naming = "users";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_user")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->ViewOnAdd("admin/io/".$_naming);
        $shift = new m_shift();
        
        $IOManager->AddReference("shifts", $shift->ExactQuery()->result());
        
        $lvls = get_class_vars("USERLEVEL");
        
        /*
         * TODO : add SUPERADMIN and ADMIN filter
         */
        
        $IOManager->AddReference("levels", $lvls);
        
        if($action == "edit" || $action == "new"){
            $data = new m_user();
            
            if($action == "edit" && $save == null){
                if($data instanceof IUseEncodedID):
                    $data->SetID(decrypt($id, true));
                else:
                    $data->id = decrypt($id, true);
                endif;
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($save == "save"){
                $this->ParsePostData($data);
            }
            
            $IOManager->SetMode($action)
                    ->Data($data);
            
            if($save == null){
                $IOManager->Show();
            }else if($save == "save"){
                $IOManager->Execute();
            }
            
            return;
        }        
        
        if($action == "delete"){
            $IOManager->SetMode($action);
            $IOManager->UseID(decrypt($id,true))
                    ->Execute();
        }
    }    
    private function users_home(){
        $filter_level = function($id){
            $r = "UNKNOWN";
            $ovr = get_class_vars("USERLEVEL");
            foreach($ovr as $k => $v){
                if($v == $id){
                    return $k;
                }
            }
            return $r;
        };
        $check_req = function($uid){
            $req = new t_device_key_request();
            $req->user_id = $uid;
            return $req->ExactQuery()->num_rows() > 0;
        };
        $q = $this->db->get("m_user");
        $this->SetUIData("filter", $filter_level);
        $this->SetUIData("req_check", $check_req);
        $this->SetUIData("rows",$q->result());
        $this->LoadUI("admin/pages/users");
    }
    
     function history(){
        
        $this->LoadUI("admin/pages/trans_history.php");
    }
    function report(){
        
        $this->LoadUI("admin/pages/event_report.php");
    }
    /*
     * Role : Administrator
     */
    function requestkey($keytype = null){
        if($keytype == null)
        {
            show_404();
        }
        
        if($keytype == "point"){
            $this->req_point_key();
        }
        if($keytype == "device"){
            $this->req_device_key();
        }
    }
    private function req_point_key(){
        $auth = Authenticator::GetContext();
        $auth instanceof Authenticator;
        
        $req = new PointRequest();
        
        $this->ParsePostData($req);
        
        /*
         * TODO: ADD ADMIN AUTH CHECKING
         */
        
        $usrs = new m_user();
        $usrs->user_level = USERLEVEL::$SUPERADMIN;
        
        $usrs = $usrs->ExactQuery()->result();
        
        $saemail = array();
        foreach($usrs as $u){
            array_push($saemail, $u->email);
        }
                
        
        $usrs = null;
        
        $data = new t_point_key_request();
        $data->point_id = $req->pid;
        $data->request_by = 9999;
        
        $data->Insert();
        
        $data->Parse(singlerow($data->ExactQuery()));   
        
        $pdata = new m_point();
        $pdata->id = $data->point_id;
        
        $pdata->Parse(singlerow($pdata->ExactQuery()));
        
        $this->load->library('emogrifier');
        
        $mbodhtm = $this->load->view("admin/email/mail_request_point", array("data"=>$data,"pdata"=>$pdata), true);
	$mbodcss = file_get_contents(base_url("assets/css/mail.css"));
	//INIT EMOGRIFIER	
        $this->emogrifier->setHtml($mbodhtm);
        $this->emogrifier->setCss($mbodcss);
        $mbod = $this->emogrifier->emogrify();	
        
        $this->load->library('email');

        $this->email->set_header('content-type', 'text/html');
        $this->email->from('noreply_marvanotifysystem@marvascp.net', 'Secure Checkpoint : Notification System');
        $this->email->to($saemail);

        $this->email->subject("Administrator Notification : New Point Key Request");
        $this->email->message($mbod);

        $this->email->send();
        
        $this->state_notify(
                "Request Sent", 
                "Your point request has been sent to super admin to be approved. Payment detail have been sent to your email", 
                site_url("admin/points"),
                "Please check your payment detail and notify us if you finished with the payment. We will send you the key as soon as we know that the payment has been made");
    }
    private function req_device_key(){
        $auth = Authenticator::GetContext();
        $auth instanceof Authenticator;
        
        $req = new DeviceRequest();
        
        $this->ParsePostData($req);
        
        /*
         * TODO: ADD ADMIN AUTH CHECKING
         */
        
        $usrs = new m_user();
        $usrs->user_level = USERLEVEL::$SUPERADMIN;
        
        $usrs = $usrs->ExactQuery()->result();
        
        $saemail = array();
        foreach($usrs as $u){
            array_push($saemail, $u->email);
        }
                
        
        $usrs = null;
        
        $data = new t_device_key_request();
        $data->user_id = $req->uid;
        $data->request_by = 9999;
        
        $data->Insert();
        
        $data->Parse(singlerow($data->ExactQuery()));   
        
        $pdata = new m_user();
        $pdata->id = $data->user_id;
        
        $pdata->Parse(singlerow($pdata->ExactQuery()));
        
        $this->load->library('emogrifier');
        
        $mbodhtm = $this->load->view("admin/email/mail_request_device", array("data"=>$data,"pdata"=>$pdata), true);
	$mbodcss = file_get_contents(base_url("assets/css/mail.css"));
	//INIT EMOGRIFIER	
        $this->emogrifier->setHtml($mbodhtm);
        $this->emogrifier->setCss($mbodcss);
        $mbod = $this->emogrifier->emogrify();	
        
        $this->load->library('email');

        $this->email->set_header('content-type', 'text/html');
        $this->email->from('noreply_marvanotifysystem@marvascp.net', 'Secure Checkpoint : Notification System');
        $this->email->to($saemail);

        $this->email->subject("Administrator Notification : New Point Key Request");
        $this->email->message($mbod);

        $this->email->send();
        
        $this->state_notify(
                "Request Sent", 
                "Your device request has been sent to super admin to be approved. Payment detail have been sent to your email", 
                site_url("admin/users"),
                "Please check your payment detail and notify us if you finished with the payment. We will send you the key as soon as we know that the payment has been made");
    }
    private function state_notify($msg, $content, $url, $alert = null){
        $this->SetUIData("message", $msg);
        $this->SetUIData("content", $content);
        $this->SetUIData("redir", $url);
        
        if($alert != null){
            $this->SetUIData("alert", $alert);
        }
        
        $this->LoadUI("admin/pages/state_alert");
    }    
    /*
     * Role : SUPERADMIN
     */
    function device_keys($action = null, $id = null, $save = null){   
        $_naming = "device_keys";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_device_key")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->ViewOnAdd("admin/io/".$_naming);
        
        $this->db->where("device_key","");
        $IOManager->AddReference("users", $this->db->get("m_user")->result());
        
        if($action == "edit" || $action == "new"){
            $data = new m_device_key();
            
            if($action == "edit" && $save == null){
                if($data instanceof IUseEncodedID):
                    $data->SetID(decrypt($id, true));
                else:
                    $data->id = decrypt($id, true);
                endif;
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($save == "save"){
                $this->ParsePostData($data);
            }
            
            $IOManager->SetMode($action)
                    ->Data($data);
            
            if($save == null){
                $IOManager->Show();
            }else if($save == "save"){
                $IOManager->Execute();
            }
            
            return;
        }        
        
        if($action == "delete"){
            $IOManager->SetMode($action);
            $IOManager->UseID(decrypt($id,true))
                    ->Execute();
        }
    }    
    private function device_keys_home(){
        $shift = new m_device_key();
        $this->SetUIData("rows",$shift->ExactQuery()->result());
        $this->LoadUI("admin/pages/device_keys");
    }
   
}
