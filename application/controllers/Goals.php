<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goals extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Goals';

        $this->data['goals']=$this->listing_model->get_all_goal_data();
		
		$this->data['content'] = $this->load->view('goals/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-Goal';
		$where=" status = 2 ";
        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);
		$this->data['content'] = $this->load->view('goals/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$uuid = uuid();
		$this->data['title'] = 'Add new Goal';
		$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[100]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('subcomponents', 'Subcomponent', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('goals/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$subcomponents = $this->input->post('subcomponents');
			$status = $this->input->post('status');
			$data = array(
				'idgoal' => $uuid,
                'name' => $name,
                'slug' => $slug,
                'idsubcomponent' => $subcomponents,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
			$this->listing_model->insert_update('goals', $data);
			$this->session->set_flashdata('success', 'Congratulations! Goal has been successfully added.');
            redirect(base_url().'goals');
		}
	}
	public function edit($goal_id){
		$this->data['title'] = 'Edit-goal';
		
		$where="idgoal = '".$goal_id."' ";
		$this->data['goal'] = $this->listing_model->get_info('goals',$goal_id, 'idgoal', $where);
		
		$where=" status = 2 ";
        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

		$this->data['content'] = $this->load->view('goals/edit', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function update($goal_id){
		if($goal_id){

			$this->data['title'] = 'Update Goal';
			$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('subcomponents', 'Subcomponent', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			if ($this->form_validation->run() == FALSE)
	        {
	            // fails
	            $where="idgoal = '".$goal_id."' ";
				$this->data['goal'] = $this->listing_model->get_info('goals',$goal_id, 'idgoal', $where);
		
				$where=" status = 2 ";
        		$this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);
	            $this->data['content'] = $this->load->view('goals/edit',$this->data,true);
				$this->load->view('index', $this->data);
			}else{
				$name = $this->input->post('label');
				$slug = $this->input->post('slug');
				$subcomponents = $this->input->post('subcomponents');
				$status = $this->input->post('status');
				$data = array(
	                'name' => $name,
	                'slug' => $slug,
	                'idsubcomponent' => $subcomponents,
	                'created_at' => todayDateTime(),
	                'updated_at' => todayDateTime(),
					'status' => $status
	            );
	            $whereGoal = array('idgoal' => $goal_id);
				$this->listing_model->insert_update('goals', $data, $goal_id, $whereGoal);
				$this->session->set_flashdata('success', 'Congratulations! Goal has been successfully updated.');
	            redirect(base_url().'goals');
			}
		}
	}

}
