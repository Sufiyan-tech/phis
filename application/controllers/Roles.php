<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Roles';
		$order = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['roles']=$this->listing_model->fetchall('roles','','','','', $order);
		$this->data['content'] = $this->load->view('roles/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-user';
		$this->data['content'] = $this->load->view('roles/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$this->data['title'] = 'Add new Role';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[8]');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('roles/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$title = $this->input->post('name');
			$short_name = $this->input->post('slug');
			$data = array(
				
                'role_name' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $title),
                'short_name' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $short_name),
				'status' => 2
            );
			$this->listing_model->insert_update('roles', $data);
			$this->session->set_flashdata('success', 'Congratulations! Role has been successfully added.');
            redirect(base_url().'roles');
		}
	}
	public function edit($role_id){
		$this->data['title'] = 'create-user';
		if($role_id){
			$where="idrole = '".$role_id."' ";
			$this->data['role'] = $this->listing_model->get_info('roles',$role_id, 'idrole', $where);
			
			$this->data['content'] = $this->load->view('roles/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($role_id){
		$this->data['title'] = 'update Role';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[8]');
		if ($this->form_validation->run() == FALSE)
        {
        	$where="idrole = '".$role_id."' ";
			$this->data['role'] = $this->listing_model->get_info('roles',$role_id, 'idrole', $where);
            // fails
            $this->data['content'] = $this->load->view('roles/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$title = $this->input->post('name');
			$short_name = $this->input->post('slug');
			$data = array(
				
                'role_name' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $title),
                'short_name' => $short_name,
				'status' => 2
            );
            $whereArr = array('idrole' => $role_id);
			$this->listing_model->insert_update('roles', $data, $role_id, $whereArr);
			$this->session->set_flashdata('success', 'Congratulations! Role has been successfully updated.');
            redirect(base_url().'roles');
		}
	}
	public function delete($role_id){
		if($role_id){
			$data = array(
				'status' => 1,
				'is_delete' => 1
            );
            $whereArr = array('idrole' => $role_id);
			$this->listing_model->insert_update('roles', $data, $role_id, $whereArr);
			$this->session->set_flashdata('success', 'Congratulations! Role has been successfully updated.');
            redirect(base_url().'roles');
		}
	}

}
