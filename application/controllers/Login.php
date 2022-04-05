<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
       parent::__construct();
		$this->load->model('login_model');
		$this->load->library('encryption');
	}
	public function index($msg = NULL)
	{
		$data['title'] = 'Login';
		if(! $this->session->userdata('nimda_validated')){ // validated checking in session
        $data = array();
		if($msg=='Error'){
			$data['msg'] = base64_encode("Error! Please Login First");	
			}
			$this->load->view('auths/auth-login', $data);
		}else{
			redirect(base_url().'dashboard'); // dashboard function called
		}
	}
	public function login_process(){
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
	public function logout(){
		$this->session->sess_destroy();
		$str = 'Logout Successfully!';
		$this->session->set_flashdata('success', $str);
		redirect(base_url().'admin');
	}
}
