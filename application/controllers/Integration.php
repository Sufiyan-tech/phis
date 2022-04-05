<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Integration extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Dashboard';
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['subcomponents']=$this->listing_model->get_allCom_subCom();
		$this->data['content'] = $this->load->view('integration/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-user';
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['components']=$this->listing_model->fetchall('components','','','','', $groups);
		$this->data['content'] = $this->load->view('integration/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		$uuid = uuid();
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['components']=$this->listing_model->fetchall('components','','','','', $groups);
		$this->data['title'] = 'Add new Sub-Component';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('long_desc', 'Long Description', 'trim|required|min_length[3]|max_length[250]');
		$this->form_validation->set_rules('components', 'Component', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('status', 'Value', 'trim|required');
		if (empty($_FILES['image']['name']))
		{
		    $this->form_validation->set_rules('image', 'Sub-Component logo', 'required');
        }
		if ($this->form_validation->run() == FALSE)
        {
        	// fails
            $this->data['content'] = $this->load->view('integration/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('name');
			$desc = $this->input->post('desc');
			//$url = $this->input->post('url');
			$long_desc = $this->input->post('long_desc');
			$components = $this->input->post('components');
			$status = $this->input->post('status');

			$upload_path = getcwd() . '/assets/uploads';
        	$files = upload_file($_FILES, 'image', $upload_path, 'assets/uploads/');

			$data = array(
				'idcomponent' => $uuid,
                'subcomponent_name' => $name,
                'idcomponent' => $components,
                'slug' => create_slug($name),
                'desc' => $desc,
                'long_desc' => $long_desc,
                //'bg_color' => $bg_color,
                'status' => $status,
                'icon' => $files,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime()
            );
			$this->listing_model->insert_update('subcomponents', $data);
			$this->session->set_flashdata('success', 'Congratulations! Sub-Components has been successfully added.');
            redirect(base_url().'integration');
		}
	}
	public function edit($sub_comp_id){
		$this->data['title'] = 'Edit-Sub-component';
		if($sub_comp_id){
			$groups = array('id' => 'created_at', 'order' => 'DESC');
        	$this->data['components']=$this->listing_model->fetchall('components','','','','', $groups);

			$where="idsubcomponent = '".$sub_comp_id."' ";
			$this->data['subcomponent'] = $this->listing_model->get_info('subcomponents',$sub_comp_id, 'idsubcomponent', $where);
			$this->data['content'] = $this->load->view('integration/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($sub_comp_id){
		if($sub_comp_id){
			// get the record and update
			$where="idsubcomponent = '".$sub_comp_id."' ";
			$subcomponent = $this->listing_model->get_info('subcomponents',$sub_comp_id, 'idsubcomponent', $where);
			
		$this->data['title'] = 'Add new Sub-Component';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('long_desc', 'Long Description', 'trim|required|min_length[3]');

		$this->form_validation->set_rules('components', 'Component', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('status', 'Value', 'trim|required');
		if ($subcomponent['icon'] == '' && empty($_FILES['image']['name']))
		{
		    $this->form_validation->set_rules('image', 'Sub-Component logo', 'required');
        }
		if ($this->form_validation->run() == FALSE)
        {
        	// fails
        	$where="idsubcomponent = '".$sub_comp_id."' ";
			$this->data['subcomponent'] = $this->listing_model->get_info('subcomponents',$sub_comp_id, 'idsubcomponent', $where);

			$groups = array('id' => 'created_at', 'order' => 'DESC');
        	$this->data['components']=$this->listing_model->fetchall('components','','','','', $groups);


            $this->data['content'] = $this->load->view('integration/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('name');
			$desc = $this->input->post('desc');
			$long_desc = $this->input->post('long_desc');
			//$bg_color = $this->input->post('bg_color');
			$components = $this->input->post('components');
			$status = $this->input->post('status');
			$data = array(
                'subcomponent_name' => $name,
                'idcomponent' => $components,
                'slug' => create_slug($name),
                'desc' => $desc,
                'long_desc' => $long_desc,
                'status' => $status,
                'updated_at' => todayDateTime()
            );
            if(isset($_FILES) && $_FILES['image']['name'] != ''){
            	$upload_path = getcwd() . '/assets/uploads';
        		$files = upload_file($_FILES, 'image', $upload_path, 'assets/uploads/');
        		$data['icon'] = $files;
            }
            $where = array('idsubcomponent' => $sub_comp_id);
			$this->listing_model->insert_update('subcomponents', $data, $sub_comp_id, $where);
			$this->session->set_flashdata('success', 'Congratulations! Sub-Components has been successfully updated.');
            redirect(base_url().'integration');
		}
		}
	}

}
