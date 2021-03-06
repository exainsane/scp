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
class Admin extends Ext_Controller implements IAuthenticator {
    public function OnAfterAuthentication() {
        
    }

    public function OnFailedAuthentication($code) {
        $this->session->set_flashdata("has_error",true);
        if($code == Authenticator::$ERRORCODE_UNAUTHORIZED)
            $this->session->set_flashdata("error_message","Login Required");
        elseif($code == Authenticator::$ERRORCODE_LOWER_ACCESS_LEVEL)
            $this->session->set_flashdata("error_message","Need higher Access Level to acces the page");
        redirect(site_url("home/login"));
    }

    public function SetAuthOptions() {
        $this->RequireLogin("index");
        $this->RequireUserLevel("device_keys", USERLEVEL::$SUPERADMIN);
        $this->RequireUserLevel("point_keys", USERLEVEL::$SUPERADMIN);
        
        $this->RequireUserLevel("points", USERLEVEL::$OPERATOR);
        $this->RequireUserLevel("schedules", USERLEVEL::$OPERATOR);
        $this->RequireUserLevel("shifts", USERLEVEL::$OPERATOR);
    }

    function __construct() {
        parent::__construct();
        
        $this->SetHeaderAndFooter("admin/header", "admin/footer");
    }
    function index(){
        $this->dashboard();
    }
    private function GetUserAccuracy(){
        /*
         * select *, delta/60  as minutes, delta - ((delta/60) * 60) as seconds, 
            case when delta < 0 then delta * -1 else delta end as deltatozero from 
            (
                SELECT *, unix_timestamp(checkout_time) as chk, unix_timestamp(schedule_time) as sch, 
                    (unix_timestamp(checkout_time) - unix_timestamp(schedule_time)) as delta FROM `t_checkout`
            ) as a
            order by case when delta < 0 then delta * -1 else delta end asc
         */
    }
    private function GetUserAccomplishment(){
        /*
         * SELECT a.id, username, b.schedule_base, b.after, scheduled, min(date_add(scheduled, INTERVAL -2 HOUR)) as lowest, count(b.id) as point_no FROM `m_user` a 
            left join 
            (
                SELECT 
                        a.*,
                        ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ) as datebase,
                        DATE_ADD(ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ), INTERVAL a.after MINUTE) as scheduled
                        FROM `m_schedule` a 

                        left join (select schedule_base as base, shift_id  from m_schedule where schedule_base != '-') as b
                        on a.shift_id = b.shift_id
            ) as b on a.shift = b.shift_id
            where a.user_level = 8
            group by a.id
         */
        $q = $this->db->query("SELECT a.id, username, firstname, lastname, b.schedule_base, b.after, scheduled, min(date_add(scheduled, INTERVAL -2 HOUR)) as lowest, count(b.id) as point_no FROM `m_user` a 
                        left join 
                        (
                            SELECT 
                                    a.*,
                                    ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ) as datebase,
                                    DATE_ADD(ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ), INTERVAL a.after MINUTE) as scheduled
                                    FROM `m_schedule` a 

                                    left join (select schedule_base as base, shift_id  from m_schedule where schedule_base != '-') as b
                                    on a.shift_id = b.shift_id
                        ) as b on a.shift = b.shift_id
                        where a.user_level = 8
                        group by a.id")->result();
        foreach($q as &$row){
            $sel = $this->db->where("checkout_time", "  >= ".$row->scheduled)
                    ->get("t_checkout")->num_rows();
            
            $row->checkouts = $sel;
        }
        
        return $q;
    }
    private function dashboard(){
        /*
         * 
         * SELECT 'event' as type,a.id, time, title, description, b.username FROM `t_event_report` a 
            left join m_user b on a.user_id = b.id
            union
            select 'alert' as type,a.id, time, message, '', b.username from t_message_broadcast a
            left join m_user b on a.user_id = b.id

            order by time desc limit 0,10
         */
        $recents = $this->db
                ->query("SELECT 'event' as type,a.id, time, title, description, b.username FROM `t_event_report` a 
                        left join m_user b on a.user_id = b.id
                        union
                        select 'alert' as type,a.id, time, message, '', b.username from t_message_broadcast a
                        left join m_user b on a.user_id = b.id

                        order by time desc limit 0,10")
                ->result();
        $this->SetUIData("recents", $recents);        
        $this->SetUIData("accm",$this->GetUserAccomplishment());
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
        $p = new m_point();
        $q = $p->ExactQuery();
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
        
        /*
         * SELECT 
            a.*,
            ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ) as datebase,
            DATE_ADD(ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ), INTERVAL a.after MINUTE) as scheduled
            FROM `m_schedule` a 

            left join (select schedule_base as base, shift_id  from m_schedule where schedule_base != '-') as b
            on a.shift_id = b.shift_id
         */
        $this->db
                ->select("a.*,
                        ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ) as datebase,
                        DATE_ADD(ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  b.base ), INTERVAL a.after MINUTE) as scheduled")
                ->from("m_schedule a")
                ->join("(select schedule_base as base, shift_id  from m_schedule where schedule_base != '-') as b","a.shift_id = b.shift_id","left")
                ->where("a._enable = 1");
        //$m = new m_schedule();
        $q = $this->db->get();
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
        $checkout = new t_checkout();
        $this->SetUIData("checkouts",$checkout->ExactQuery()->result());
        $this->LoadUI("admin/pages/trans_history.php");
    }
    function events(){       
        $checkout = new t_event_report();
        $this->SetUIData("events",$checkout->ExactQuery()->result());
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
        
        /*
         * TODO : Create per-user Invoice Mail
         */
        
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
        
        /*
         * TODO : Create per-user Invoice Mail
         */
                
                
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
    public function qr($generate = null){
        if($generate != "generate"){
            show_404();
        }
        
        $pid = $this->input->post("form-pid");
        
        $pdata = new m_point();
        $pdata->id = $pid;
        
        $q = $pdata->ExactQuery();
        
        if($q->num_rows() != 1){
            show_404();
        }
        
        $pdata->Parse(singlerow($q));
        
        $pdata->point_code = Authenticator::GenerateRandomKey("35", "POINT-");
        
        $pdata->Update();
        
        require APPPATH.'third_party/qr/qrlib.php';
        ob_start();
        
        QRcode::png($pdata->point_code, false, "H", 10, 2, true);   
        $imgdata = ob_get_contents();

        ob_end_clean();
        
        $this->SetUIData("img", base64_encode($imgdata));
        $this->SetUIData("pdata", $pdata);
        $this->LoadUI("admin/exported/point_exported",true);
    }
    function insertkey($type = null){
        if($type == null){
            show_404();
        }
        
        if($type == "point"){
            $pid = $this->input->post("form-pid");
            $key = $this->input->post("key");
            
            //Remove strips
            $key = str_replace("-", "", $key);
            
            $data = new m_point_key();
            $data->point_key = $key;
            $data->used_by = $pid;
            
            $q = $data->ExactQuery();
            
            if($q->num_rows() != 1){
                $this->state_notify(
                        "Invalid Point Key", 
                        "The point key that you entered to the system seems to be invalid!<br>"
                        . "Re-check the key or if you think that this is a correct one, please contact the SUPERADMIN"
                        . "<br><b>Hint : </b>One key may ONLY be used with the correct point based on the request!",
                        site_url("admin/points"));
                return;
            }
            
            $point = new m_point();
            $point->id = $data->used_by;
            
            $q = $point->ExactQuery();
            if($q->num_rows() != 1){
                $this->state_notify(
                        "Invalid Point ID", 
                        "Error in data. System cannot find the correct ID for the specified Point",
                        site_url("admin/users"),
                        "Please notify SUPERADMIN about this issue");
                return;
            }
            
            $point->Parse(singlerow($q));
            $point->point_key = $data->point_key;
            $point->Update();
            
            redirect(site_url("admin/points"));
        }
        if($type == "device"){
            $pid = $this->input->post("form-uid");
            $key = $this->input->post("key");
            
            //Remove strips
            $key = str_replace("-", "", $key);
            
            $data = new m_device_key();
            $data->device_key = $key;
            $data->used_by = $pid;
            
            $q = $data->ExactQuery();
            
            if($q->num_rows() != 1){
                $this->state_notify(
                        "Invalid Device Key", 
                        "The point key that you entered to the system seems to be invalid!<br>"
                        . "Re-check the key or if you think that this is a correct one, please contact the SUPERADMIN"
                        . "<br><b>Hint : </b>One key may ONLY be used with the correct device based on the request!",
                        site_url("admin/users"));
                return;
            }
            
            $user = new m_user();
            $user->id = $data->used_by;
            
            $q = $user->ExactQuery();
            if($q->num_rows() != 1){
                $this->state_notify(
                        "Invalid User ID", 
                        "Error in data. System cannot find the correct ID for the specified Point",
                        site_url("admin/users"),
                        "Please notify SUPERADMIN about this issue");
                return;
            }
            
            $user->Parse(singlerow($q));
            $user->device_key = $data->device_key;
            $user->Update();
            
            redirect(site_url("admin/users"));
        }
    }
    function removekey($key){
        if($key == "device"){
            $uid = $this->input->post("form-uid");
            
            $this->db->set("device_key","")
                    ->where("id",$uid)
                    ->update("m_user");
            
            redirect(site_url("admin/users"));
        }
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
    //
    function point_keys($action = null, $id = null, $save = null){   
        $_naming = "point_keys";
        if($action == null){
            $m = $_naming."_home";
            return $this->$m();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("m_point_key")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/".$_naming."/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/".$_naming))
                ->ViewOnAdd("admin/io/".$_naming);
        
        $this->db->where("point_key","");
        $IOManager->AddReference("points", $this->db->get("m_point")->result());
        
        if($action == "edit" || $action == "new"){
            $data = new m_point_key();
            
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
    private function point_keys_home(){
        $shift = new m_point_key();
        $this->SetUIData("rows",$shift->ExactQuery()->result());
        $this->LoadUI("admin/pages/point_keys");
    }
    public function enablekey($type = null){
        if($type == null){
            show_404();
        }
        if($type == "point"){
            $key = $this->input->post("form-kid");
            $this->db->where("id",$key)
                    ->set("verified",$this->input->post("form-en"));
            $this->db->update("m_point_key");
            redirect(site_url("admin/point_keys"));
        }
        if($type == "device"){
            $key = $this->input->post("form-kid");
            $this->db->where("id",$key)
                    ->set("verified",$this->input->post("form-en"));
            $this->db->update("m_device_key");
            redirect(site_url("admin/device_keys"));
        }
    }
   
}
