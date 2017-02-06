<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Model untuk akses database, field-scan, delete dan update
 * Pastikan menghapus data melalui model ini, karena sistematika
 * penghapusan data berbeda dengan model standar
 *
 * @author exain
 */
class BaseDBModel extends CI_Model {
    public static $DB_CRUD = 1;
    /** Mengambil daftar field dalam database
     * 
     * @param string $table
     * @return array
     */
    public function fields($table){
        $q = $this->db->select("*")->from($table)->limit(1,0)->get();
        return $q->list_fields();
    }
    /**
     * Mengambil data dari table yang ditujukan
     * 
     * @param string $table nama table
     */
    public function getTable($table,$limit = null,$search = null){
        $fields = $this->fields($table);
        $this->db->select("*")
                ->from($table);                
        
        if($search != null){
            $this->apply_search($fields, $search);
        }
        
        query_finalize($this);
        
        if($limit != null){
            $this->db->limit($limit[1],$limit[0]);
        }        
        
        return $this->db->get();
    }
    /**
     * 
     */
    public function delete($table, $id, $idfield = "id", $crud = 0){
        if(in_array("_enable", $this->fields($table))){
            $crud = $crud != 0 ? $crud : 0;
        }else
        {
            $crud = 1;
        }
        if($crud == 0){
            $this->db->set("_enabled",0);
            $this->db->where($idfield,$id);
            $this->db->update($table);        
        }else if($crud == self::$DB_CRUD){
            $this->db->where($idfield,$id);
            $this->db->delete($table);        
        }
    }
    
    public function update($table,$array){
        if(!isset($array["id"])){
            show_error("ERROR ON UPDATE : NO ID SPECIFIED!", 500);
            exit;
        }
        
        $id = $array["id"];
        
        unset($array["id"]);
        
        $fields = $this->fields($table);
        
        foreach ($fields as $field){
            if(isset($array[$field])){
                $this->db->set($field,$array[$field]);
            }
        }
        
        $this->db->where("id",$id)->update($table);
    }
    
    public function create($table,$data){
        $this->db->set($data)->insert($table);
    }
    /**
     * Completing whole db fields search
     * 
     * @param string $table
     * @param string $strquery
     */
    private function apply_search($fields,$strquery){                
        foreach ($fields as $field){
            $this->db->or_like($field,$strquery);
        }
    }
    
    public function field_scan($table){
        $fields = $this->fields($table);
        
        $data = array();
        
        if($this->input->post("mode") == null){
            show_error("INPUT MODE NOT SPECIFIED!");
            exit;
        }
        
        if($this->input->post("mode") != FORM_MODE_ADD && $this->input->post("mode") != FORM_MODE_EDIT){
            show_error("INVALID INPUT MODE!");
            exit;
        }
        
        if($this->input->post("mode") == FORM_MODE_EDIT && $this->input->post("fid") == null){
            show_error("UNKNOWN ROW ID!");
            exit;
        }                
        
        foreach($fields as $field){
            if($this->input->post($field) != null){
                $data[$field] = $this->input->post($field);
            }
        }
        
        if($this->input->post("mode") == FORM_MODE_ADD){    
            return $this->db->insert($table, $data);
        }
        else if($this->input->post("mode") == FORM_MODE_EDIT){
            $id = decrypt($this->input->post("fid"));
            return $this->db->set($data)->where("id",$id)->update($table);
        }
        return false;
    }
}
