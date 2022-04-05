<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Options';
		$order = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['options']=$this->listing_model->fetchall('options','','','','', $order);
		$this->data['content'] = $this->load->view('options/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-Options';
		$this->data['content'] = $this->load->view('options/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$this->data['title'] = 'Add new Option';
		$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('value', 'Value', 'trim|required|min_length[1]|max_length[15]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['content'] = $this->load->view('options/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$value = $this->input->post('value');
			$type = $this->input->post('type');
			$readonlybox = $this->input->post('readonlybox');
			$data = array(
                'name' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name),
                'slug' => $slug,
                'value' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $value),
                'type' => $type,
                'readonly' => $readonlybox,
				'status' => 2
            );
			$this->listing_model->insert_update('options', $data);
			$this->session->set_flashdata('success', 'Congratulations! Options has been successfully added.');
            redirect(base_url().'options');
		}
	}
	public function edit($option_id){
		if($option_id){
			$this->data['title'] = 'Edit-Options';
			// get options data
			$where="idoption = '".$option_id."' ";
			$this->data['option'] = $this->listing_model->get_info('options',$option_id, 'idoption', $where);
			$this->data['content'] = $this->load->view('options/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($option_id){
		$this->data['title'] = 'Update Option';
		$this->form_validation->set_rules('label', 'Label', 'trim|required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('value', 'Value', 'trim|required|min_length[1]|max_length[15]');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $where="idoption = '".$option_id."' ";
			$this->data['option'] = $this->listing_model->get_info('options',$option_id, 'idoption', $where);
            $this->data['content'] = $this->load->view('options/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$value = $this->input->post('value');
			$type = $this->input->post('type');
			$readonlybox = $this->input->post('readonlybox');
			$data = array(
                'name' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $name),
                'slug' => $slug,
                'value' => preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $value),
                'type' => $type,
                'readonly' => $readonlybox,
            );
            $where = array('idoption' => $option_id);
			$this->listing_model->insert_update('options', $data, $option_id, $where);
			$this->session->set_flashdata('success', 'Congratulations! Options has been successfully added.');
            redirect(base_url().'options');
		}
	}

}
