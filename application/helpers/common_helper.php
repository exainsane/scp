<?php
/**
	 * These are the regular expression rules that we use to validate the product ID and product name
	 * alpha-numeric, dashes, underscores, or periods
	 *
	 * @var current CI_Controller instance
	 */
function query_finalize($instance){
    $instance->db->where("row_active",1);    
}
/**
	 * Check if any user is logged in
	 *
	 * @return null if no user, userdata [from m_user] if available
	 */
function check_session(){
    $ci =& get_instance();

    if($ci->session->userdata("login_info") != null){
        $sessinfo = $ci->session->userdata("login_info");
        $userid = $sessinfo["user_id"];

        $q = $ci->db->select("*")->from("m_user")->where("id",$userid)->get();

        if($q->num_rows() != 1){
            $ci->session->sess_destroy();

            //TODO : display failed login
            return null;
        }

        $data = $q->result();
        $data = end($data);

        return $data;

    }

    return null;
}

function user_logout(){
    $ci =& get_instance();
    
    $ci->session->sess_destroy();
}
function encrypt($str,$asurl = false){
    $s = base64_encode($str);
    return ($asurl == true)? urlencode($s) : $s;
}
function decrypt($str,$asurl = false){
    if($asurl){
        $str = urldecode($str);
    }
    return base64_decode($str);
}

function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
function singlerow($q){
    $r = $q->result();
    $r = end($r);
    return $r;
}
function recursive_check_add_dir($dir,$path_delimiter,$currentdir = null){
    $dirs = explode($path_delimiter, $dir);
    $cdir = explode($path_delimiter, $currentdir);
    if(strlen($cdir[0]) < 1) unset($cdir[0]);

    if(!isset($dirs[0]) || strlen($dirs[0]) < 1) return;

    if(!file_exists($currentdir.$dirs[0]))
            mkdir($currentdir.$dirs[0]);

    array_push($cdir, $dirs[0]);
    unset($dirs[0]);

    recursive_check_add_dir(implode($path_delimiter, $dirs),$path_delimiter,implode($path_delimiter, $cdir).'/');
}
function get_filename_extension($filename){
    $n = explode(".", $filename);
    
    return end($n);
}