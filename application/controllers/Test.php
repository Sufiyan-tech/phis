<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('listing_model');
       $this->load->model('main_model');
	}

	public function index() {
		$this->data['title'] = 'create-user';
		$this->data['content'] = $this->load->view('users/create', $this->data, true);
		$this->load->view('index', $this->data);
	}

	public function wasimJan() {
		$this->load->view('index', $this->data);
	}
}
