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
    function about($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->about_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_about")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/contact/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/about"))
                ->ViewOnAdd("admin/io/about");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUIAbout();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
                $data->Parse(singlerow($data->ExactQuery()));                
            }else if($action == "edit" && $save == "save"){
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
            $IOManager->UseID(base64_decode($id))
                    ->Execute();
        }
    }    
    private function about_home(){
        $q = $this->db->get("ui_about");
        $this->SetUIData("about",$q->result());
        $this->LoadUI("admin/pages/about");
    }
    
    function contact($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->contact_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_contact")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/contact/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/contact"))
                ->ViewOnAdd("admin/io/contact");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUIContact();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
            $IOManager->UseID(base64_decode($id))
                    ->Execute();
        }
    }    
    private function contact_home(){
        $q = $this->db->get("ui_contact");
        $this->SetUIData("contact",$q->result());
        $this->LoadUI("admin/pages/contact");
    }
    
    function testimoni($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->testimoni_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_testimoni")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/testimoni/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/testimoni"))
                ->ViewOnAdd("admin/io/testimoni");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUITestimoni();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
    private function testimoni_home(){
        $q = $this->db->get("ui_testimoni");
        $this->SetUIData("testimoni",$q->result());
        $this->LoadUI("admin/pages/testimoni");
    }
    
    function slider($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->slider_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_slider")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/slider/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/slider"))
                ->ViewOnAdd("admin/io/slider");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUISlider();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
    private function slider_home(){
        $q = $this->db->get("ui_slider");
        $this->SetUIData("slider",$q->result());
        $this->LoadUI("admin/pages/slider");
    }
    
    function post($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->post_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_blog")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/post/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/post"))
                ->ViewOnAdd("admin/io/post");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUIBlog();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
    private function post_home(){
        $q = $this->db->get("ui_blog");
        $this->SetUIData("post",$q->result());
        $this->LoadUI("admin/pages/post");
    }
    
    function team($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->team_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_team")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/team/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/team"))
                ->ViewOnAdd("admin/io/team");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUITeam();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
    private function team_home(){
        $q = $this->db->get("ui_team");
        $this->SetUIData("team",$q->result());
        $this->LoadUI("admin/pages/team");
    }
    
    function services($action = null, $id = null, $save = null){                  
        if($action == null){
            return $this->services_home();
        }
        
        $IOManager = new IOManager($this);
        $IOManager->Table("ui_services")
                ->IdFieldOnTable("id")
                ->PostTo(site_url("admin/services/".$action."/".($action == "new"?1:$id)."/save"))
                ->RedirectTo(site_url("admin/services"))
                ->ViewOnAdd("admin/io/services");
                
        if($action == "edit" || $action == "new"){
            $data = new ModelUIServices();
            
            if($action == "edit" && $save == null){
                $data->SetID(decrypt($id, true));
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
    private function services_home(){
        $q = $this->db->get("ui_services");
        $this->SetUIData("services",$q->result());
        $this->LoadUI("admin/pages/services");
    }
}
