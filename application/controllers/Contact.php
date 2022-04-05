<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
       parent::__construct();
	}

	public function index()
	{
		$this->data['title'] = 'login';
		$this->data['content'] = $this->load->view('contact/register-form', $this->data, true);
        $this->load->view('index', $this->data);
	}

}
