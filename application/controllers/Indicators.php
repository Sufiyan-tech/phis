<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicators extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Indicators';
		//$order = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['indicators']=$this->listing_model->get_indicator_data();
		//$this->data['indicators']=$this->listing_model->fetchall('indicators','','','','', $order);
        $this->data['content'] = $this->load->view('indicators/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
	
		$this->data['title'] = 'create-Indicators';
		$order = array('id' => 'created_at', 'order' => 'DESC');
		
		$this->data['groups']=$this->listing_model->fetchall('groups','','','','', $order);
		$this->data['goals']=$this->listing_model->get_all_goal_data();
        
        $this->data['content'] = $this->load->view('indicators/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		
		$uuid = uuid();
		$this->data['title'] = 'Add new Indicator';
		$this->form_validation->set_rules('label', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('group', 'Group', 'trim|required');
		$this->form_validation->set_rules('goal', 'Goal', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $order = array('id' => 'created_at', 'order' => 'DESC');
		
			$this->data['groups']=$this->listing_model->fetchall('groups','','','','', $order);
	        $this->data['goals']=$this->listing_model->get_all_goal_data();
            
            $this->data['content'] = $this->load->view('indicators/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$group = $this->input->post('group');
			$goal = $this->input->post('goal');
			$status = $this->input->post('status');
			$data = array(
				'idindicator' => $uuid,
                'name' => $name,
                'slug' => $slug,
                'idgroup' => $group,
                'idgoal' => $goal,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
			$this->listing_model->insert_update('indicators', $data);
			$this->session->set_flashdata('success', 'Congratulations! Indicator has been successfully added.');
            redirect(base_url().'indicators');
		}
	}
	public function edit($ind_id){
		if($ind_id){
			$this->data['title'] = 'create-Indicators';

			$where=" idindicator = '".$ind_id."'  ";
			$this->data['indicator'] = $this->listing_model->get_info('indicators',$ind_id, 'idindicator', $where);
			$order = array('id' => 'created_at', 'order' => 'DESC');
			
			$this->data['groups']=$this->listing_model->fetchall('groups','','','','', $order);

	        $this->data['goals']=$this->listing_model->fetchall('goals','','','','', $order);
	        
	        $this->data['content'] = $this->load->view('indicators/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($ind_id){
		if($ind_id){
		$this->data['title'] = 'Update Indicator';
		$this->form_validation->set_rules('label', 'Name', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('group', 'Group', 'trim|required');
		$this->form_validation->set_rules('goal', 'Goal', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $where=" status = 2 AND idindicator = '".$ind_id."'  ";
			$this->data['indicator'] = $this->listing_model->get_info('indicators',$ind_id, 'idindicator', $where);

            $order = array('id' => 'created_at', 'order' => 'DESC');
		
			$this->data['groups']=$this->listing_model->fetchall('groups','','','','', $order);
	        $this->data['goals']=$this->listing_model->fetchall('goals','','','','', $order);

            $this->data['content'] = $this->load->view('indicators/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$group = $this->input->post('group');
			$goal = $this->input->post('goal');
			$status = $this->input->post('status');
			$data = array(
                'name' => $name,
                'slug' => $slug,
                'idgroup' => $group,
                'idgoal' => $goal,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
            $whereInd = array('idindicator' => $ind_id);
			$this->listing_model->insert_update('indicators', $data, $ind_id, $whereInd);
			$this->session->set_flashdata('success', 'Congratulations! Indicator has been successfully updated.');
            redirect(base_url().'indicators');
		}
		}
	}

}
