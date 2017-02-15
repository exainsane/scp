<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 * 2016 Exairie
 */

/**
 * Description of Api
 *
 * @author exain
 */
class Api extends Api_Controller {
    
    function getabout(){
        $abtq = new ModelUIAbout();
       
        return $abtq->ExactQuery()->result();
    }
    function postcheckout(){
        $event = new t_checkout();
        
        $this->ParsePostData($event);
        if($event->Insert() >= 1){
            return $this->Success("Sync Success");
        }
        
        return $this->Fail();
    }
    function postevent(){
        $event = new t_event_report();
        
        $this->ParsePostData($event);
        if($event->Insert() >= 1){
            return $this->Success("Sync Success");
        }
        
        return $this->Fail();
    }
    function getslider(){
        $sliders = new ModelUISlider();                
        
        $sliders->des = "belajar";
        $val = $sliders->Search()->result();
        
       
        //$val = $sliders->Search()->result();
        
        var_dump($val);
    }
    function postcompany(){
        $user = new m_company();
        
        $IOManager = new IOManager($this);
        
        $IOManager->Table("m_company")
                ->IdFieldOnTable("id");
        
        $this->ParsePostData($user);
        
        $IOManager->SetMode("new");
        $IOManager->Data($user);
        $IOManager->Execute();         
        
        return $this->Success();
    }
    function getcompany(){
        $company = new m_company();
        
        return $company->ExactQuery()->result();
    }
    
    /*
     * User
     */
    function postuser(){
        $user = new m_user();
        
        $this->ParsePostData($user);
        
        $IOManager = new IOManager($this);
        $IOManager->SetMode("new")
                ->IdFieldOnTable("id")
                ->Data($user);
        
        if($IOManager->Execute() == true){
            return $this->Success();
        }
    }
    /*
     * shift
     * Add Shift Entry
     */
    function postshift(){
        //Create new m_shift Object
        $user = new m_shift();
        /* Data sent from POST request, Get the data
         * To be clear, try var_dump($_POST) to take a look at
         * The POST data.
         * To be clear, each POST data that will be parsed will
         * have the name of
         * form-[field_name] ie: for field "username" the POST
         * data should have the name of form-username
         * 
         */
        $this->ParsePostData($user);
        /*
         * Create new instance of IOManager
         * this object is used to create/update/delete database
         * from a request data.
         * IOManager will calculate the data based on ID, and Mode
         * Data that is parsed to IOManager should be an instance OR
         * Inheritance of EntityModel. Hint : m_shift EXTENDS EntityModel
         */
        $IOManager = new IOManager($this);
        //Set the mode of Execution, in this case it will be "new"
        $IOManager->SetMode("new")
                /*
                 * Set the primary key field in database
                 * this PK is optional in "new" mode, but required in 
                 * "edit" mode. Since editing row need the row's primary
                 * key
                 */
                ->IdFieldOnTable("id")
                /*
                 * Specify the data that will be inserted to Database
                 */
                ->Data($user);
        /*
         * Execute the data. If you're using "new" mode then it will be
         * INSERTED to database.
         */
        if($IOManager->Execute() == true){
            /*
             * Return Success if true (successfully executed)
             */
            return $this->Success();
        }
        else{
            return $this->Fail("Failed to Insert data");
        }
    }
    /*
     * Update Entry
     */
    function putshift(){
        //Create new m_shift Object
        $user = new m_shift();
        /* Data sent from POST request, Get the data
         * To be clear, try var_dump($_POST) to take a look at
         * The POST data.
         * To be clear, each POST data that will be parsed will
         * have the name of
         * form-[field_name] ie: for field "username" the POST
         * data should have the name of form-username
         * 
         * In EDIT mode, user should send the requested ID to edit
         * in this case, the ID will be embedded in POST data, and 
         * encoded in Base64. look at "encrypt" helper in common_helper
         * 
         */
        $this->ParsePostData($user);
        /*
         * Create new instance of IOManager
         * this object is used to create/update/delete database
         * from a request data.
         * 
         * IOManager will calculate the data based on ID, and Mode
         * Data that is parsed to IOManager should be an instance OR
         * Inheritance of EntityModel. Hint : m_shift EXTENDS EntityModel
         */
        $IOManager = new IOManager($this);
        //Set the mode of Execution, in this case it will be "edit"
        $IOManager->SetMode("edit")
                /*
                 * Set the primary key field in database
                 * this PK is required in "edit" mode. Since editing row need the row's primary
                 * key
                 */
                ->IdFieldOnTable("id")
                /*
                 * Specify the data that will be edit to Database
                 * NOTE that based on the ID, all field value will be edited
                 * INCLUDING THE READ ONLY USERNAME
                 * This should not be a server's concern though, just to be noted
                 * TODO : Add READ ONLY FIELD Interface
                 */
                ->Data($user);
        /*
         * Execute the data. If you're using "edit" mode then it will be
         * UPDATED to database.
         */
        if($IOManager->Execute() == true){
            return $this->Success();
        }
        else{
            return $this->Fail("Failed to Update data");
        }
    }
    /*
     * Delete
     */
    function deleteshift(){
        $shift = new m_shift();
        
        /*
         * for deletion, it will be a bit different
         * to delete a row, you need ONLY THE ID of the field
         * so, if client-side app wants to delete a data, 
         * it have to send the ID
         * and according to the standard, the ID field will be
         * sent in POST data named form-id
         * thus, its parseable
         */
        
        $this->ParsePostData($shift);
        
        /*
         * Up to this line, the shift object will contain the ID
         * BUT FOR SECURITY REASONS, id field should be encoded
         * thus, it should implements the IUseEncodedID interface
         * Hint : take a look into m_company object in model/Entity.php
         * if its encoded then you need to use the GetID method instead of
         * directly accessing the id 
         */
        $IOManager = new IOManager($this);
        $IOManager->Table("m_shift");                
        
        /*
         * Be wary of this field, wrong field name wil result in either
         * wrong data deleted of failed deletion
         */
        $IOManager->IdFieldOnTable("id");
        
        if($shift instanceof IUseEncodedID){
            /*
             * this is when m_shift's id is encoded
             * you should use GetID()
             */
            $IOManager->UseID($shift->GetID());
        }else
        {
            /*
             * in contrary, if it's not encoded
             * you can directly use the object's ID
             */
            $IOManager->UseID($shift->id);
        }
            
        if ($IOManager->Execute() == true) {
            return $this->Success();
        }else
        {
            return $this->Fail();
        }
    }
    /*
     * schedule
     */
    function postschedule(){
        $schedule = new m_schedule();
        
        $this->ParsePostData($schedule);
        
        $IOManager = new IOManager($this);
        $IOManager->SetMode("new")
                ->IdFieldOnTable("id")
                ->Data($schedule);
        
        if($IOManager->Execute() == true){
            return $this->Success();
        }else{
            return $this->Fail();
        }
    }
    function postpoint(){
        $user = new m_point();
        
        $this->ParsePostData($user);
        
        $IOManager = new IOManager($this);
        $IOManager->SetMode("new")
                ->IdFieldOnTable("id")
                ->Data($user);
        
        if($IOManager->Execute() == true){
            return $this->Success();
        }else{
            return $this->Fail();
        }
    }
    function getschedule(){
        $schedule = new m_schedule();
        $schreq = new ScheduleRequestModel();
        $this->ParseGetData($schreq);
        
        $user = new m_user();
        
        $user->id = $schreq->identifier;
        
        $user->Parse(singlerow($user->ExactQuery()));
        
        if($user->shift == null){
            return $this->Fail("Unregistered in any shifts");
        }
        
        $schedule->shift_id = $user->shift;
        
        $schedules = $schedule->ExactQuery()->result();
        
        if(count($schedules) < 1)
        {
            return $this->Fail("Schedule Not Found");
        }            
        
        $pointids = array();
        
        foreach($schedules as $row){
            array_push($pointids, $row->point_id);
        }
        
        $points = new m_point();        
        $points->id = $pointids;
        
        $presult = $points->RangedQuery()->result();
        
        if(count($presult) < 1)
        {
            return $this->Fail("Points Undefined");
        }  
        
        return $this->Success("success", array("schedules"=>$schedules, "points" => $presult));
    }
    
    function getevent(){
        $report = new t_event_report();
        
        return $report->ExactQuery()->result();
    }
}
class ScheduleRequestModel extends EntityModel{
    function __construct() {
        parent::__construct("");
    }

    public $identifier;
}