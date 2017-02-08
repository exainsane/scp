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
        $q = $this->db->get("m_shift");
        $this->SetUIData("rows",$q->result());
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
        $this->SetUIData("rows",$q->result());
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
                ->ViewOnAdd("admin/io/".$_naming);
        
        $IOManager->AddReference("shifts", $this->db->get("m_shift")->result());
        $IOManager->AddReference("points", $this->db->get("m_point")->result());
        
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
        
        $IOManager->AddReference("shifts", $this->db->get("m_shift")->result());
        
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
        $q = $this->db->get("m_user");
        $this->SetUIData("rows",$q->result());
        $this->LoadUI("admin/pages/users");
    }
    
     function history(){
        
        $this->LoadUI("admin/pages/trans_history.php");
    }
    function report(){
        
        $this->LoadUI("admin/pages/event_report.php");
    }
    
}
