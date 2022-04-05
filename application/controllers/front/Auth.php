<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
       parent::__construct();
		$this->load->model('front_login_model');
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
			$is_login = $this->front_login_model->login_check();
		}
		if($is_login){
			header("location: ".base_url());
		}else{
			$str = 'Error! Incorrect username or password!';
			$this->session->set_flashdata('error', $str);
			redirect(base_url().'auth/login');
		}
	}
	public function signup()
	{
		$data['title'] = 'Sign up';
		if($this->session->userdata('user_validated')){ // validated checking in session
        	redirect(base_url());

		}else{
			$this->load->view('frontend/signup', $data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$str = 'Logout Successfully!';
		$this->session->set_flashdata('success', $str);
		redirect(base_url());
	}
}
