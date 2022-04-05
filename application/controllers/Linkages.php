<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Linkages extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Indicators';

        $this->data['linkages']=$this->listing_model->get_all_linkages();
		
        $this->data['content'] = $this->load->view('linkages/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
	
		$this->data['title'] = 'create-Linkages';
		$where=" status = 2 ";
        $this->data['components'] = $this->listing_model->get_records('components' ,$where);

        $this->data['subcomponents'] = $this->listing_model->get_allCom_subCom();
        
        $this->data['content'] = $this->load->view('linkages/create', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function get_subcomponent(){
		$componentId = $_POST['comp_id'];
		$where=" status = 2 AND idcomponent = '".$componentId."' ";
        $subcomponents = $this->listing_model->get_records('subcomponents' ,$where);
        $options = '<option value="">--select subcomponent--</option>';
        if($subcomponents){
        	foreach ($subcomponents as $key => $subcomponent) {
        		$options .= '<option value="'.$subcomponent['idsubcomponent'].'">'.$subcomponent['subcomponent_name'].'</option>'; 
        	}
        	
        }else{
        	$options .= '<option value="">--select subcomponent--</option>'; 
        }
        echo $options;exit;
	}
	public function add(){
		
		$uuid = uuid();
		$this->data['title'] = 'Add new Indicator';
		$component_type = $this->input->post('component_type');
		//echo $component_type;exit;
		//if($component_type == 2){
			//$this->form_validation->set_rules('province', 'Province', 'trim|required');
			//$this->form_validation->set_rules('link', 'Link', 'trim|required');
		//}
		$this->form_validation->set_rules('component', 'Component', 'trim|required');
		$this->form_validation->set_rules('subcomponent', 'Sub Component', 'trim|required');
		
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->data['subcomponents'] = $this->listing_model->get_allCom_subCom();

            $this->data['content'] = $this->load->view('linkages/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$subcomponent = $this->input->post('subcomponent');
			$component = $this->input->post('component');
			$province = $this->input->post('province');
			$link = $this->input->post('link');
			$code = $this->input->post('code');
			$status = $this->input->post('status');
			$is_province = 1;
			if(empty($province)){
				$province = 0;
				$is_province = 0;
			}
			$data = array(
				'idintegration' => $uuid,
				'code' => $code,
                'idcomponent' => $component,
                'idsubcomponent' => $subcomponent,
                'province_code' => $province,
                'link' => $link,
                'is_province' => $is_province,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
            //echo "<pre>";print_r($data);exit;
			$this->listing_model->insert_update('integrations', $data);
			$this->session->set_flashdata('success', 'Congratulations! Integrations has been successfully added.');
            redirect(base_url().'linkages');
		}
	}
	public function edit($link_id){
		if($link_id){
			$this->data['title'] = 'create-Indicators';

			$where=" idintegration = '".$link_id."'  ";
			$this->data['linkage'] = $this->listing_model->get_info('integrations',$link_id, 'idintegration', $where);
			$where=" status = 2 ";
	        $this->data['components'] = $this->listing_model->get_records('components' ,$where);
	        
	        $where=" status = 2 AND idcomponent = '".$this->data['linkage']['idcomponent']."' ";
	        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

	        $this->data['content'] = $this->load->view('linkages/edit', $this->data, true);
	        $this->load->view('index', $this->data);
		}
	}
	public function update($link_id){
		$this->data['title'] = 'Update linkage';
		$component_type = $this->input->post('component_type');
		if($component_type == 2){
			//$this->form_validation->set_rules('province', 'Province', 'trim|required');
			$this->form_validation->set_rules('link', 'Link', 'trim|required');
		}
		$this->form_validation->set_rules('component', 'Component', 'trim|required');
		$this->form_validation->set_rules('subcomponent', 'Sub Component', 'trim|required');
		
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $where=" status = 2 AND idintegration = '".$link_id."'  ";
			$this->data['linkage'] = $this->listing_model->get_info('integrations',$link_id, 'idintegration', $where);

			$where=" status = 2 ";
	        $this->data['components'] = $this->listing_model->get_records('components' ,$where);

	        $where=" status = 2 AND idcomponent = '".$this->data['linkage']['idcomponent']."' ";
	        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

            $this->data['content'] = $this->load->view('linkages/edit',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$subcomponent = $this->input->post('subcomponent');
			$component = $this->input->post('component');
			$province = $this->input->post('province');
			$link = $this->input->post('link');
			$code = $this->input->post('code');
			$status = $this->input->post('status');
			$is_province = 1;
			if(empty($province)){
				$province = 0;
				$is_province = 1;
			}
			$data = array(
				'code' => $code,
                'idcomponent' => $component,
                'idsubcomponent' => $subcomponent,
                'province_code' => $province,
                'link' => $link,
                'is_province' => $is_province,
                'created_at' => todayDateTime(),
                'updated_at' => todayDateTime(),
				'status' => $status
            );
            //echo "<pre>";print_r($data);exit;
            if($this->input->post('type')){
            	$data['type'] = $this->input->post('type');
            }
            if($this->input->post('roles')){
            	$data['roles'] = $this->input->post('roles');
            }
            $where = array('idintegration' => $link_id);
			$this->listing_model->insert_update('integrations', $data, $link_id, $where);
			$this->session->set_flashdata('success', 'Congratulations! Integrations has been successfully updated.');
            redirect(base_url().'linkages');
		}
	}
}
