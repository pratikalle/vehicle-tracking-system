<?php

class Logout extends CI_Controller
{
    function __construct()
	{
        parent::__construct();	
	}

    public function index()
    {
        session_unset();
		session_destroy();
		redirect('login');
    }



}

?>