<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
       $this->load->model('user_model');
       $this->load->library('encryption');
	}

	public function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['content'] = $this->load->view('dashboard', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function list(){
		$this->data['title'] = 'Users-list';
		$this->data['users'] = $this->user_model->getUserList();
		$this->data['content'] = $this->load->view('users/list', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function create(){
		$this->data['title'] = 'create-user';
		$this->data['content'] = $this->load->view('users/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){

		//p($_POST);exit;
		$uuid = uuid();
		$this->data['title'] = 'Add new User';
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[5]|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('organization_name', 'Organization Name', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('users/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$full_name = $this->input->post('full_name');
			$email = $this->input->post('email');
			$country = $this->input->post('country');
			$cnic = $this->input->post('cnic');
			$tel_no = $this->input->post('tel_no');
			$passport = $this->input->post('passport');
			$permission_region = $this->input->post('permission_region');
			$role = $this->input->post('role');
			$permission_provinces = $this->input->post('permission_provinces');
			$organization_name = $this->input->post('organization_name');
			$status = $this->input->post('status');
			$password = $this->input->post('password');

			$cnicField = '';
			if($cnic != ""){
				$cnicField = $cnic;
			}elseif($passport != ""){
				$cnicField = $passport;
			}else{
				$cnicField = '';
			}

			$data = array(
				'iduser' => $uuid,
				'fullname' => $full_name,
                'email' => $email,
                'country' => $country,
                'cnic' => $cnicField,
                'tel_no' => $tel_no,
                'password' => $this->encryption->encrypt($password),
                'permission_region' => $permission_region,
                'idrole' => $role,
                'organization_name' => $organization_name,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
            //echo "<pre>";print_r($data);exit;
			$this->listing_model->insert_update('users', $data);
			if($permission_region == 2){
				// insert provinces into location table
				foreach ($permission_provinces as $key => $value) {
					$data = array(
						'iduser_location' => uuid(),
						'iduser' => $uuid,
		                'province_code' => $value,
						'status' => 2
	            	);
	            	$this->listing_model->insert_update('user_locations', $data);
				}
			}
			$this->session->set_flashdata('success', 'Congratulations! Usre has been successfully registered.');
            redirect(base_url().'user/list');
		}
	}
	public function edit($userId){
		$this->data['title'] = 'Edit-user';
		$where=" iduser = '".$userId."'  ";
		$this->data['user'] = $this->listing_model->get_info('users',$userId, 'iduser', $where);
		// check if country is pakistan
		$country = '';
		if($this->data['user']['country']){
			$where=" countryid = '".$this->data['user']['country']."'  ";
			$country = $this->listing_model->get_info('country',$this->data['user']['country'], 'countryid', $where);
			$country = $country['key'];
		}
		$this->data['selectedcountry'] = $country;
		$allProvinces = array();
		if($this->data['user']['permission_region']){
			if($this->data['user']['permission_region'] == 2){
				$where=" iduser = '".$this->data['user']['iduser']."' ";
        		$selectedAllProvinces = $this->listing_model->get_records('user_locations' ,$where);
        		if($selectedAllProvinces){
        			foreach ($selectedAllProvinces as $key => $value) {
        				$allProvinces[] = $value['province_code']; 
        			}
        		}
			}
		}
		$this->data['allprovinces'] = $allProvinces;

		$this->data['content'] = $this->load->view('users/edit', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function update($userId){
		//p($_POST);exit;
		$uuid = uuid();
		$this->data['title'] = 'Add new User';
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[5]|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('organization_name', 'Organization Name', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $where=" iduser = '".$userId."'  ";
			$this->data['user'] = $this->listing_model->get_info('users',$userId, 'iduser', $where);
			// check if country is pakistan
			$country = '';
			if($this->data['user']['country']){
				$where=" countryid = '".$this->data['user']['country']."'  ";
				$country = $this->listing_model->get_info('country',$this->data['user']['country'], 'countryid', $where);
				$country = $country['key'];
			}
			$this->data['selectedcountry'] = $country;
			$allProvinces = array();
			if($this->data['user']['permission_region']){
				if($this->data['user']['permission_region'] == 2){
					$where=" iduser = '".$this->data['user']['iduser']."' ";
	        		$selectedAllProvinces = $this->listing_model->get_records('user_locations' ,$where);
	        		if($selectedAllProvinces){
	        			foreach ($selectedAllProvinces as $key => $value) {
	        				$allProvinces[] = $value['province_code']; 
	        			}
	        		}
				}
			}
			$this->data['allprovinces'] = $allProvinces;

            $this->data['content'] = $this->load->view('users/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$full_name = $this->input->post('full_name');
			$email = $this->input->post('email');
			$country = $this->input->post('country');
			$cnic = $this->input->post('cnic');
			$tel_no = $this->input->post('tel_no');
			$passport = $this->input->post('passport');
			$permission_region = $this->input->post('permission_region');
			$role = $this->input->post('role');
			$permission_provinces = $this->input->post('permission_provinces');
			$organization_name = $this->input->post('organization_name');
			$status = $this->input->post('status');

			$cnicField = '';
			if($cnic != ""){
				$cnicField = $cnic;
			}elseif($passport != ""){
				$cnicField = $passport;
			}else{
				$cnicField = '';
			}

			$data = array(
				'fullname' => $full_name,
                'email' => $email,
                'country' => $country,
                'cnic' => $cnicField,
                'tel_no' => $tel_no,
                'permission_region' => $permission_region,
                'idrole' => $role,
                'organization_name' => $organization_name,
                'updated_at' => todayDateTime(),
				'status' => $status
            );
            $where = array('iduser' => $userId);
			$this->listing_model->insert_update('users', $data, $userId, $where);
			// delete record from location tble and insert new
			$this->listing_model->delete_record('user_locations', $userId, 'iduser');
			if($permission_region == 2){
				// insert provinces into location table
				foreach ($permission_provinces as $key => $value) {
					$data = array(
						'iduser_location' => uuid(),
						'iduser' => $userId,
		                'province_code' => $value,
						'status' => 2
	            	);
	            	$this->listing_model->insert_update('user_locations', $data);
				}
			}
			$this->session->set_flashdata('success', 'Congratulations! User has been successfully Updated.');
            redirect(base_url().'user/list');
		}
	}
}
