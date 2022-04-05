<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Years extends CI_Controller {

	public function __construct() {
       parent::__construct();
       is_admin();
       $this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Years';
		$groups = array('id' => 'name', 'order' => 'ASC');
        $this->data['campaigns']=$this->listing_model->fetchall('campaigns','','','','', $groups);
		$this->data['content'] = $this->load->view('years/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function create(){
		$this->data['title'] = 'create-user';
		$groups = array('id' => 'created_at', 'order' => 'DESC');
        $this->data['forms']=$this->listing_model->fetchall('surveyforms','','','','', $groups);
		$groups = array('id' => 'province_code', 'order' => 'ASC');
		$this->data['provinces']=$this->listing_model->fetchall('provinces','','','','', $groups);
		$where=" status = 2";
        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

		$this->data['content'] = $this->load->view('years/create', $this->data, true);
        $this->load->view('index', $this->data);
	}
	public function add(){
		// p($_POST);
		$uuid = uuid();
		$this->data['title'] = 'Add new Year';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
		$this->form_validation->set_rules('idsurveyform', 'Survey Form', 'trim|required|min_length[3]|max_length[150]');
		if ($this->form_validation->run() == FALSE)
		{
			$groups = array('id' => 'created_at', 'order' => 'DESC');
			$this->data['forms']=$this->listing_model->fetchall('surveyforms','','','','', $groups);
			$groups = array('id' => 'province_code', 'order' => 'ASC');
			$this->data['provinces']=$this->listing_model->fetchall('provinces','','','','', $groups);
			$this->data['content'] = $this->load->view('years/create', $this->data, true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('name');
			$idsurveyform = $this->input->post('idsurveyform');
			$national = $this->input->post('national') ? 1 : 0;
			$province = $this->input->post('province') ? 1 : 0;
			$district = $this->input->post('district') ? 1 : 0;
			$status = 2;//$this->input->post('status') ? 2 : 1;
			$province_code = $this->input->post('province_code');
			$data = array(
				'idcampaign' => $uuid,
				'name' => $name,
				'idsurveyform' => $idsurveyform,
				'national' => $national,
				'province' => $province,
				'district' => $district,
				'status' => $status,
				'created_at' => todayDateTime(),
				'updated_at' => todayDateTime()
			);
			$this->listing_model->insert_update('campaigns', $data);
			// insert into survey indicator table
			if($province_code){
				foreach ($province_code as $k => $v) {
					$data = array(
						'idcampaign_location' => uuid(),
						'idcampaign' => $uuid,
						'province_code' => $v,
						'status' => 1
					);
					$this->listing_model->insert_update('campaign_locations', $data);
				}
			}
			$this->session->set_flashdata('success', 'Congratulations! Sub-Components has been successfully added.');
			redirect(base_url().'years');
		}
	}
	public function edit($campaign_id){
		$this->data['title'] = 'Edit-Year';
		if($campaign_id){
			$groups = array('id' => 'created_at', 'order' => 'DESC');
			$this->data['forms']=$this->listing_model->fetchall('surveyforms','','','','', $groups);
			$groups = array('id' => 'province_code', 'order' => 'ASC');
			$this->data['provinces']=$this->listing_model->fetchall('provinces','','','','', $groups);

			$where = "idcampaign = '$campaign_id'";
			$this->data['campaign'] = $this->listing_model->get_info('campaigns', $campaign_id, 'idcampaign', $where);
			$this->data['campaign_locations'] = $this->listing_model->get_records('campaign_locations',$where, NULL, 'province_code');
			$this->data['content'] = $this->load->view('years/edit', $this->data, true);
			// print_r($this->data['campaign_locations']);;exit;
	        $this->load->view('index', $this->data);
		}
	}
	public function update($campaign_id){
		if($campaign_id){
			// get the record and update
			$uuid = uuid();
			$this->data['title'] = 'Add new Year';
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[150]');
			$this->form_validation->set_rules('idsurveyform', 'Survey Form', 'trim|required|min_length[3]|max_length[150]');
			if ($this->form_validation->run() == FALSE)
			{
				$groups = array('id' => 'created_at', 'order' => 'DESC');
				$this->data['forms']=$this->listing_model->fetchall('surveyforms','','','','', $groups);
				$groups = array('id' => 'province_code', 'order' => 'ASC');
				$this->data['provinces']=$this->listing_model->fetchall('provinces','','','','', $groups);
				$this->data['content'] = $this->load->view('years/edit',$this->data,true);
				$this->load->view('index', $this->data);
			}else{
				$name = $this->input->post('name');
				$idsurveyform = $this->input->post('idsurveyform');
				$national = $this->input->post('national') ? 1 : 0;
				$province = $this->input->post('province') ? 1 : 0;
				$district = $this->input->post('district') ? 1 : 0;
				$status = 2;//$this->input->post('status') ? 2 : 1;
				$province_code = $this->input->post('province_code');
				$data = array(
					'name' => $name,
					'idsurveyform' => $idsurveyform,
					'national' => $national,
					'province' => $province,
					'district' => $district,
					'status' => $status,
					'created_at' => todayDateTime(),
					'updated_at' => todayDateTime()
				);
				$where = array('idcampaign' => $campaign_id);
				$this->listing_model->insert_update('campaigns', $data, $campaign_id, $where);
				// if($province_code){
				// 	foreach ($province_code as $k => $v) {
				// 		$data = array(
				// 			'idcampaign_location' => uuid(),
				// 			'idcampaign' => $uuid,
				// 			'province_code' => $v,
				// 			'status' => 1
				// 		);
				// 		$this->listing_model->insert_update('campaign_locations', $data);
				// 	}
				// }
				$this->session->set_flashdata('success', 'Congratulations! Year has been successfully updated.');
				redirect(base_url().'years');
			}
		}
	}

	public function get_indicator_count($surveyform_id){
		$totalIndicator = $this->listing_model->getIndicatorCount($surveyform_id);
		return $totalIndicator['total'];
	}

	public function get_indicator_list(){
		$surveyform_id = $this->input->post('idsurveyform');
		$indicatorList = $this->listing_model->getIndicatorList($surveyform_id);

		$html = '<ul class="list-group" id="provinces-ul">';
		foreach ($indicatorList as $key => $value) {
			
            $html .= '<a href=""><li class="list-group-item" style="cursor:pointer;">
                <div class="md-v-line"></div><i class="fas fa-laptop mr-4 pr-3"></i>'.$value["name"].' 
              </li></a>';
                            
		}
		$html .= '</ul>';
		echo $html;
	}

}
