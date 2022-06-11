<?php
ini_set("display_errors",true);
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	
	function __construct()
	{
        parent::__construct();	
	}
	
	public function index()
    {
	    $this->load->view('login');
	}

    public function validate_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pwd');

        if($email == "" || $password == "")
        {
            echo json_encode(array('status'=>404,'msg'=>'Please Fill all fields'));
            return false;
        }

        $this->load->model('user_details_model');
        
        $result = $this->user_details_model->get_where_single(array('email'=>$email,'password'=>$password));
        if(!$result)
        {
            echo json_encode(array('status'=>404,'msg'=>'Wrong Username or Password'));
            return false;
        }

        // if($result['status'] != 'A')
        // {
        //     echo json_encode(array('status'=>404,'msg'=>'Your Account is Suspended'));
        //     return false;
        // }

        $_SESSION['uid'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        
        echo json_encode(array('status'=>200,'msg'=>'Logged In Successfully'));
    }
}
?>