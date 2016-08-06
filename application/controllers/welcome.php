<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this -> load -> model('welcome_model');
        $this->load->library('wechat');
    }

    public function index()
    {
        if($this -> session -> userdata('open_id')!=""){
            $open_id = $this -> session -> userdata('open_id');
        }else{
            $open_id = $this -> wechat -> get_openid();
            $this -> session -> set_userdata('open_id', $open_id);
        }
        $this->load->view('bind_page');
    }

    public function check_user(){
        $open_id = $this -> session -> userdata('open_id');
        $username = $this -> input -> post('username');
        $data = array(
            'student_id'=>$username
        );
        $rs = $this -> welcome_model -> do_check_user($data);
        if($rs){
            $this -> welcome_model -> save_user($username,$open_id);
            echo "success";
        }else{
            echo "fail";
        }
    }
    public function check_bind(){
        $open_id = $this -> session -> userdata('open_id');
        $student_id = $this -> input -> post('username');
        $rs = $this -> welcome_model -> do_check_bind($student_id);
        $query = $this -> welcome_model -> check_openid($open_id);
        if($rs || $query){
            echo "success";
        }else{
            echo "false";
        }
    }

    public function bind_succes()
    {
        $this->load->view('bind_succes');
    }

    public function bind_fail()
    {
        $this->load->view('bind_fail');
    }

    public function dont_bind()
    {
        $this->load->view('dont_bind');
    }

    public function news_center()
    {
        $this->load->view('news_center');
    }

    public function news_detail()
    {
        $this->load->view('news_detail');
    }

    public function pay_list()
    {
        if($this -> session -> userdata('open_id')!=""){
            $open_id = $this -> session -> userdata('open_id');
        }else{
            $open_id = $this -> wechat -> get_openid();
            $this -> session -> set_userdata('open_id', $open_id);
        }
        if(!($this -> welcome_model -> check_openid($open_id))){
            $this->load->view('dont_bind');
        }else{
            $card = $this -> welcome_model -> get_student_card($open_id);
            $pto = $this -> welcome_model -> get_student_pto($open_id);
            $data = array(
                'card'=>$card,
                'pto'=>$pto
            );

            if($card || $pto){
                $this -> load -> view('pay_list',$data);
            }else{
                $this -> load -> view('list_none');
            }
        }
    }

    public function pay_fail()
    {
        $this->load->view('pay_fail');
    }

    public function pay_detail()
    {
        $student_id = $this -> input -> get('student_id');
        $project = $this -> input -> get('card');
        if($project == "学生证"){
            $rs = $this -> welcome_model -> get_card_detail($student_id);
        }else if($project == "照片"){
            $rs = $this -> welcome_model -> get_pto_detail($student_id);
        }
        $data = array(
            'project'=>$rs
        );
        $this -> session -> set_userdata($data);
        $this->load->view('pay_detail',$data);
    }

//    public function pay_confirm(){
//        $category = $this -> session -> userdata('project') -> category;
//        $money = $this -> session -> userdata('project') -> money;
//        $data = array(
//            'category'=>$category,
//            'money'=>$money
//        );
//        $this->load->view('pay_confirm',$data);
//    }

    public function pay_succes()
    {
        $student_id = $this -> session -> userdata('project') -> student_id;
        $project = $this -> session -> userdata('project') -> category;
        $open_id = $this -> session -> userdata('open_id');
        $this -> welcome_model -> save_pay($student_id,$project,$open_id);
        $this->load->view('pay_succes');
    }





}
