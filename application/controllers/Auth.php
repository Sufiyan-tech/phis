<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function __construct() {
       parent::__construct();
		$this->load->model('login_model');
		$this->load->library('encryption');
	}

	public function login($msg = NULL)
	{
		$data['title'] = 'Login';
		if(! $this->session->userdata('user_validated')){ // validated checking in session
        $data = array();
		if($msg=='Error'){
			$data['msg'] = base64_encode("Error! Please Login First");	
			}
			$this->load->view('frontend/login', $data);
		}else{
			redirect(base_url()); // dashboard function called
		}
	}

	public function process(){
		if(isset($_POST) && !empty($_POST)){
			$is_login = $this->login_model->login_check();
		}
		if($is_login){
			header("location: ".base_url()."dashboard");
		}else{
			$str = 'Error! Incorrect username or password!';
			$data['msg'] = base64_encode($str);
			$this->load->view('auths/auth-login',$data);
		}
	}
}
