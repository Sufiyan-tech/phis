<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
	   $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Dashboard';
		$groups = array('id' => 'province_code', 'order' => 'ASC');
		$this->data['provinces']=$this->listing_model->fetchall('provinces','','','','', $groups);
		$this->data['content'] = $this->load->view('location/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-user';
		$this->data['content'] = $this->load->view('location/create', $this->data, true);
        $this->load->view('index', $this->data);
	}

}
