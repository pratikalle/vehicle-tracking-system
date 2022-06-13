<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{
	
	function __construct()
	{
        parent::__construct();	
	}
	
    public function index()
    {
        $this->load->view('register');
    }

    public function submit_register_data()
    {
        $name = $this->input->post('name');
        $contact_no = $this->input->post('cno');
        $email = $this->input->post('email');
        $password = $this->input->post('pwd');
        
        if($name == "" || $email == "" || $contact_no == "" || $password == '')
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Fill all fields'));
            return false;
        }

        if(!preg_match('/^[0-9]{10}+$/', $contact_no)) 
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Enter Valid Mobile No'));
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Enter Valid Email ID'));
            return false;
        }

        $data = array(
            'name'=>$name,
            'phone'=>$contact_no,
            'email'=>$email,
            'password' => $password,
            'created_on'=>time(),
        );
        $this->load->model('user_details_model');
        
        $result = $this->user_details_model->insert($data);
        if(!$result)
        {
            echo json_encode(array('status'=>404,'msg'=>'Error. Something went wrong.'));
            return false;
        }
        echo json_encode(array('status'=>200,'msg'=>'You are registered.'));
    }

}
?>