<?php

/*
 * Created by Exairie
 * Use of this script should be followed by knowledge of the author
 * Any application created by using this file shall be acknowledged
 * by the author
 ADDTIME( CONVERT( DATE( NOW( ) ) , DATETIME ) ,  '08:00:00' )
 * 2016 Exairie
 */

/**
 * Description of Injector
 *
 * @author exain
 */
class Injector extends Ext_Controller {
    //put your code here
    public function i(){
        $this->db->set("valid_until","2019-12-12 00:00:00");
        $this->db->update("m_device_key");
    }
    public function a(){
        
    }
}
