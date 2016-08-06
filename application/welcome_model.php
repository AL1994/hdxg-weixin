<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    public function do_check_user($username){
        return $this -> db -> get_where('student_card',$username) -> row();
    }

    public function check_openid($open_id){
        return $this -> db -> get_where('student_bind',$open_id) -> row();
    }

    public function save_user($username,$open_id){
        $this -> db -> insert('student_bind',array('student_id'=>$username,'open_id'=>$open_id));
        return $this -> db -> get_where('student_bind',array('student_id'=>$username)) -> row();
    }

    public function get_student_card($student_id){
        return $this -> db -> get_where('student_card',array('student_id'=>$student_id)) -> row();
    }
    public  function get_student_pto($student_id){
        return $this -> db -> get_where('student_pto',array('student_id'=>$student_id)) -> row();
    }






}
