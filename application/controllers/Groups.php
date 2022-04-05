<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Groups';
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['groups']=$this->listing_model->fetchall('groups','','','','', $groups);
		$this->data['content'] = $this->load->view('groups/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-Groups';
		$where=" status = 2 ";
        $this->data['options'] = $this->listing_model->get_records('options' ,$where);
		$this->data['content'] = $this->load->view('groups/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$uuid = uuid();
		$this->data['title'] = 'Add new Group';
		$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('options[]', 'Value', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('groups/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$optionsArr = $this->input->post('options');
			$data = array(
				'idgroup' => $uuid,
                'name' => $name,
                'slug' => $slug,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => 2
            );
			$this->listing_model->insert_update('groups', $data);
			// insert data into option group table now
			if($optionsArr){
				foreach ($optionsArr as $key => $option) {
					$data_optionArr = array(
						'idgroup' => $uuid,
						'idoption' => $option,
						'status' => 2 
					);
					$this->listing_model->insert_update('option_groups', $data_optionArr);
				}
			}
			$this->session->set_flashdata('success', 'Congratulations! Options and Groups has been successfully added.');
            redirect(base_url().'groups');
		}
	}
	public function edit($group_id){
		if($group_id){
			$this->data['title'] = 'Edit-Group';
			// get options data
			$whereOptionGroup=" status = 2 AND idgroup = '".$group_id."' ";
			$range = array('idoption');
        	$allOptionGroups = $this->listing_model->get_records('option_groups' ,$whereOptionGroup, '', $range);
        	$all_option_group = array();
        	if($allOptionGroups){
        		foreach ($allOptionGroups as $key => $allOptionGroup) {
        			$all_option_group[] = $allOptionGroup['idoption'];
        		}
        	}
        	$this->data['options_groups'] = $all_option_group;
			$whereOption=" status = 2 ";
        	$this->data['options'] = $this->listing_model->get_records('options' ,$whereOption);
			$where="idgroup = '".$group_id."' ";
			$this->data['group'] = $this->listing_model->get_info('groups',$group_id, 'idoption', $where);
			$this->data['content'] = $this->load->view('groups/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($group_id){
		if($group_id){
			$this->data['title'] = 'Update Group';
			$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('options[]', 'Value', 'trim|required');
			if ($this->form_validation->run() == FALSE)
	        {
	            // fails
	            $whereOptionGroup=" status = 2 AND idgroup = '".$group_id."' ";
				$range = array('idoption');
	        	$allOptionGroups = $this->listing_model->get_records('option_groups' ,$whereOptionGroup, '', $range);
	        	$all_option_group = array();
	        	if($allOptionGroups){
	        		foreach ($allOptionGroups as $key => $allOptionGroup) {
	        			$all_option_group[] = $allOptionGroup['idoption'];
	        		}
	        	}
	        	$this->data['options_groups'] = $all_option_group;
				$whereOption=" status = 2 ";
	        	$this->data['options'] = $this->listing_model->get_records('options' ,$whereOption);
				$where="idgroup = '".$group_id."' ";
				$this->data['group'] = $this->listing_model->get_info('groups',$group_id, 'idoption', $where);
	            $this->data['content'] = $this->load->view('groups/create',$this->data,true);
				$this->load->view('index', $this->data);
			}else{
				$name = $this->input->post('label');
				$slug = $this->input->post('slug');
				$optionsArr = $this->input->post('options');
				$data = array(
	                'name' => $name,
	                'slug' => $slug,
	                'updated_at' => todayDateTime()
	            );
	            $whereGroup = array('idgroup' => $group_id);
				$this->listing_model->insert_update('groups', $data, $group_id, $whereGroup);
				// remove options and insert new
				$this->listing_model->delete_record('option_groups', $group_id, 'idgroup');
				
				// insert data into option group table now
				if($optionsArr){
					foreach ($optionsArr as $key => $option) {
						$data_optionArr = array(
							'idgroup' => $group_id,
							'idoption' => $option,
							'status' => 2 
						);
						$this->listing_model->insert_update('option_groups', $data_optionArr);
					}
				}
				$this->session->set_flashdata('success', 'Congratulations! Options and Groups has been successfully updated.');
	            redirect(base_url().'groups');
			}
		}
	}

}
