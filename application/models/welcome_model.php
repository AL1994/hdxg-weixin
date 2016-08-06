<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    public function do_check_user($data){
        return $this -> db -> get_where('student_card',$data) -> row();
    }

    public function do_check_bind($student_id){
        return $this -> db -> get_where('student_bind',array('student_id'=>$student_id)) -> row();
    }

    public function check_openid($open_id){
        return $this -> db -> get_where('student_bind',array('open_id'=>$open_id)) -> row();
    }

    public function save_user($username,$open_id){
        $this -> db -> insert('student_bind',array('student_id'=>$username,'open_id'=>$open_id));
        if($this -> db -> affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }

    public function get_student_card($open_id){
//        $this -> db -> select('card.*');
//        $this -> db -> from('student_card card');
//        $this -> db -> join('student_bind bind', 'card.student_id = bind.student_id');
//        $this -> db -> where('bind.open_id',$open_id);
        return $this -> db -> query("select * from student_card,student_bind where student_bind.open_id='$open_id' and student_bind.student_id=student_card.student_id and ('$open_id',student_card.category) not in (select student_pay.open_id,student_pay.project from student_pay)") -> row();

    }

    public function get_student_pto($open_id){
//        $this -> db -> select('pto.*');
//        $this -> db -> from('student_pto pto');
//        $this -> db -> join('student_bind bind', 'pto.student_id = bind.student_id');
//        $this -> db -> where('bind.open_id',$open_id);
        return $this -> db -> query("select * from student_pto,student_bind where student_bind.open_id='$open_id' and student_bind.student_id=student_pto.student_id and ('$open_id',student_pto.category) not in (select student_pay.open_id,student_pay.project from student_pay)") -> row();
    }

    public function get_card_detail($student_id){
        return $this -> db -> get_where('student_card',array('student_id'=>$student_id)) -> row();
    }

    public function get_pto_detail($student_id){
        return $this -> db -> get_where('student_pto',array('student_id'=>$student_id)) -> row();
    }

    public function save_pay($student_id,$project,$open_id){
        $this -> db -> insert('student_pay',array('student_id'=>$student_id,'project'=>$project,'open_id'=>$open_id));
        if($this -> db -> affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }


}
