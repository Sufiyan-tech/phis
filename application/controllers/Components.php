<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Components';
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['components']=$this->listing_model->fetchall('components','','','','', $groups);
		$this->data['content'] = $this->load->view('components/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-component';
		$this->data['content'] = $this->load->view('components/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$uuid = uuid();
		$this->data['title'] = 'Add new Component';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('status', 'Value', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('components/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('name');
			$status = $this->input->post('status');
			$data = array(
				'idcomponent' => $uuid,
                'component_name' => $name,
                'status' => $status,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime()
            );
			$this->listing_model->insert_update('components', $data);
			$this->session->set_flashdata('success', 'Congratulations! Components has been successfully added.');
            redirect(base_url().'components');
		}
	}
	public function edit($com_id){
		$this->data['title'] = 'Edit-component';
		if($com_id){
			$where="idcomponent = '".$com_id."' ";
			$this->data['component'] = $this->listing_model->get_info('components',$com_id, 'idcomponent', $where);
			
			$this->data['content'] = $this->load->view('components/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($comp_id){
		$this->data['title'] = 'Update Component';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('status', 'Value', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $where="idcomponent = '".$com_id."' ";
			$this->data['component'] = $this->listing_model->get_info('components',$com_id, 'idcomponent', $where);
            $this->data['content'] = $this->load->view('components/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('name');
			$status = $this->input->post('status');
			$data = array(
                'component_name' => $name,
                'status' => $status,
                'updated_at' => todayDateTime()
            );
            $where = array('idcomponent' => $comp_id);
			$this->listing_model->insert_update('components', $data, $comp_id, $where);

			$this->session->set_flashdata('success', 'Congratulations! Components has been successfully Update.');
            redirect(base_url().'components');
		}
	}
}
