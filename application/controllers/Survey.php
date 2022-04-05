<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_admin();
		$this->load->model('listing_model');
	}

	public function index()
	{
		$this->data['title'] = 'Survey';
		$order = array('id' => 'created_at', 'order' => 'DESC');
		$this->data['surveyforms']=$this->listing_model->fetchall('surveyforms','','','','', $order);
		$this->data['content'] = $this->load->view('survey-form/list', $this->data, true);
		$this->load->view('index', $this->data);
	}

	public function create(){

		$this->data['title'] = 'create-Indicators';
		$this->data['indicators']=$this->listing_model->get_indicator_data();
		$where=" status = 2";
        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

		$this->data['content'] = $this->load->view('survey-form/create', $this->data, true);
		$this->load->view('index', $this->data);
	}

	public function add(){
		$uuid = uuid();
		$this->data['title'] = 'Add new Survey';
		$this->form_validation->set_rules('label', 'Name', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('subcomponent', 'Sub Component', 'trim|required');
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('ind_id[]', 'Indicator', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			// fails
			$this->data['indicators']=$this->listing_model->get_indicator_data();

			$this->data['content'] = $this->load->view('survey-form/create',$this->data,true);
			$this->load->view('index', $this->data);
		}else{
			$name = $this->input->post('label');
			$slug = $this->input->post('slug');
			$status = $this->input->post('status');
			$subcomponent = $this->input->post('subcomponent');
			$ind_ids = $this->input->post('ind_id');
			$data = array(
				'idsurveyform' => $uuid,
				'name' => $name,
				'slug' => $slug,
				'created_at' => todayDateTime(),
				'updated_at' => todayDateTime(),
				'idsubcomponent' => $subcomponent,
				'status' => $status
			);
			$this->listing_model->insert_update('surveyforms', $data);
			// insert into survey indicator table
			if($ind_ids){
				foreach ($ind_ids as $key => $ind_id) {
					$data = array(
						'idsurveyformindicator' => uuid(),
						'idsurveyform' => $uuid,
						'idindicator' => $ind_id,
						'created_at' => todayDateTime(),
						'updated_at' => todayDateTime(),
						'status' => $status
					);
					$this->listing_model->insert_update('surveyformindicators', $data);
				}
			}
			$this->session->set_flashdata('success', 'Congratulations! Survey form has been generated successfully.');
			redirect(base_url().'survey');
		}
	}

	public function edit($surveyform_id){
		if($surveyform_id){
			$this->data['title'] = 'create-Indicators';

			$where=" idsurveyform = '".$surveyform_id."'  ";
			$this->data['surveyform'] = $this->listing_model->get_info('surveyforms',$surveyform_id, 'idsurveyform', $where);
			//echo "<pre>";print_r($this->data);exit;
			$where=" status = 2";
        	$this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

        	// $this->data['indicators']=$this->listing_model->get_indicator_data();

        	$allformInd = array();
        	$where=" idsurveyform = '".$surveyform_id."'  ";
        	$surveyformindicators = $this->listing_model->get_records('surveyformindicators' ,$where);
			// e_q();
        	if($surveyformindicators){
        		foreach ($surveyformindicators as $key => $value) {
        			$allformInd[] = $value['idindicator'];
        		}
				$this->data['indicators']=$this->listing_model->get_indicator_data("g.idsubcomponent = '{$this->data['surveyform']['idsubcomponent']}'");
        	} else {
				$this->data['indicators']=$this->listing_model->get_indicator_data();
			}
        	$this->data['allformInd'] = $allformInd;
			$this->data['content'] = $this->load->view('survey-form/edit', $this->data, true);
			$this->load->view('index', $this->data);
		}
	}

	public function update($surveyform_id){
		if($surveyform_id){
			$this->data['title'] = 'Add new Survey';
			$this->form_validation->set_rules('label', 'Name', 'trim|required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('subcomponent', 'Sub Component', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('ind_id[]', 'Indicator', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				// fails
				$where=" idsurveyform = '".$surveyform_id."'  ";
				$this->data['surveyform'] = $this->listing_model->get_info('surveyforms',$surveyform_id, 'idsurveyform', $where);
				//echo "<pre>";print_r($this->data);exit;
				$where=" status = 2";
	        	$this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

	        	$this->data['indicators']=$this->listing_model->get_indicator_data();

	        	$allformInd = array();
	        	$where=" idsurveyform = '".$surveyform_id."'  ";
	        	$surveyformindicators = $this->listing_model->get_records('surveyformindicators' ,$where);
	        	if($surveyformindicators){
	        		foreach ($surveyformindicators as $key => $value) {
	        			$allformInd[] = $value['idindicator'];
	        		}
	        	}
	        	$this->data['allformInd'] = $allformInd;

				$this->data['content'] = $this->load->view('survey-form/edit',$this->data,true);
				$this->load->view('index', $this->data);
			}else{
				$name = $this->input->post('label');
				$slug = $this->input->post('slug');
				$status = $this->input->post('status');
				$subcomponent = $this->input->post('subcomponent');
				$ind_ids = $this->input->post('ind_id');
				$data = array(
					'name' => $name,
					'slug' => $slug,
					'created_at' => todayDateTime(),
					'updated_at' => todayDateTime(),
					'idsubcomponent' => $subcomponent,
					'status' => $status
				);
				$where = array('idsurveyform' => $surveyform_id);
				$this->listing_model->insert_update('surveyforms', $data, $surveyform_id, $where);

				// delete indicators from survery indicator
				$this->listing_model->delete_record('surveyformindicators', $surveyform_id, 'idsurveyform');

				// insert into survey indicator table
				if($ind_ids){
					foreach ($ind_ids as $key => $ind_id) {
						$data = array(
							'idsurveyformindicator' => uuid(),
							'idsurveyform' => $surveyform_id,
							'idindicator' => $ind_id,
							'created_at' => todayDateTime(),
							'updated_at' => todayDateTime(),
							'status' => $status
						);
						$this->listing_model->insert_update('surveyformindicators', $data);
					}
				}

				$this->session->set_flashdata('success', 'Congratulations! Survey form has been updated successfully.');
				redirect(base_url().'survey');
			}
		}
	}

	function addsurveyform(){
		$this->data['title'] = 'Add Survey Form';

		$this->load->model('surveymodel');
 		$this->data['surveys'] = $this->surveymodel->getServeyList();

		$this->data['content'] = $this->load->view('survey-form/addsurveyform', $this->data, true);
		$this->load->view('index', $this->data);
	}

	function getCampaigns(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getCampaigns($filter);
		echo json_encode($data); exit;
	}

	function getCampaignLocations(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getCampaignLocations($filter);
		echo json_encode($data); exit;
	}

	function getCampaignIndicators(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getCampaignIndicators($filter);
		echo json_encode($data); exit;
	}

	function getGoalIndicators(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getGoalIndicators($filter);
		echo json_encode($data); exit;
	}

	function getSurveyForm(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getSurveyForm($filter);
		echo json_encode($data); exit;
	}

	function getSurveyFormData(){
		$filter = $this->input->get();
		$this->load->model('surveymodel');
 		$data = $this->surveymodel->getSurveyFormData($filter);
		echo json_encode($data); exit;
	}

	function addSurveyData(){
		//p($_POST);exit;
		$idsurveyheader = $this->input->post('idsurveyheader');
		$idheader = $idsurveyheader == '' ? uuid() : $idsurveyheader;
		$loc_code = '';
		if($this->input->post('district_code') != ''){
			$loc_code = $this->input->post('district_code');
		}else{
			$loc_code = $this->input->post('province_code');
		}
		$data = array(
			'idsurveyheader' => $idheader,
			'idcampaign' => $this->input->post('idcampaign'),
			'iddistrict' => $loc_code,
			'status' => 2
		);
		if ($idsurveyheader) {
			$data['updated_at'] = todayDateTime();
			$where = array('idsurveyheader' => $idsurveyheader);
			$this->listing_model->insert_update('surveyheaders', $data, $idsurveyheader, $where);
		} else {
			$data['created_at'] = todayDateTime();
			$this->listing_model->insert_update('surveyheaders', $data);
		}
		$indicators = $this->input->post('row');
		if($indicators){
			foreach ($indicators as $k => $v) {
				$idsurveyindicator = $v['idsurveyindicator'];
				$data = array(
					'idsurveyheader' => $idheader,
					'idindicator' => $v['idindicator'],
					'idgroup' => $v['idgroup'],
					'idoption' => $v['idoption'],
					'value' => $v['value'],
					'status' => 2
				);
				if ($idsurveyindicator) {
					$data['updated_at'] = todayDateTime();
					$where = array('idsurveyindicator' => $idsurveyindicator);
					$this->listing_model->insert_update('surveyindicators', $data, $idsurveyindicator, $where);
				} else {
					$data['created_at'] = todayDateTime();
					$this->listing_model->insert_update('surveyindicators', $data);
				}
			}
		}
		redirect(base_url().'survey');
		// $this->load->model('surveymodel');
		// $this->data['surveys'] = $this->surveymodel->getServeyList();
		//
		// $this->data['content'] = $this->load->view('survey-form/addsurveyform', $this->data, true);
		// $this->load->view('index', $this->data);
	}

	function view_checklist($idchecklist) {
		//$data['idroster'] = $idchecklist;
		$this->load->model('surveymodel');
 		$data['surveys'] = $this->surveymodel->getServeyList();
		$data['sections'] = $this->administrator_model->getChecklistSections($idchecklist);
		foreach ($data['sections'] as $k => $v) {
			$v->indicator_info = $this->administrator_model->getSectionIndicators($v->idsection);
		}
		$data['heading'] = $data['checklist']->name;
		$data['subview'] = $this->load->view('administrator/checklist_view', $data, TRUE);
		// p($data);
		$this->load->view('includes/default-layout', $data);
	}




	function getSctionIndicators(){
		$data = array();
		$idsection = $this->input->post('idsection');
		$idchecklist = $this->input->post('idchecklist');
		// printer($idsection);
		$data = $this->administrator_model->getSectionIndicators($idsection, $idchecklist);
		// e_q();
		json($data);
	}

	// function getSctionIndicators(){
	// 	$data = array();
	// 	$idsection = $this->input->post('idsection');
	// 	$idchecklist = $this->input->post('idchecklist');
	// 	// printer($idsection);
	// 	$data = $this->administrator_model->getSectionIndicators($idsection, $idchecklist);
	// 	// e_q();
	// 	json($data);
	// }
	//
	// function getSectionsDropdown() {
	// 	$data = array();
	// 	if ($this->input->post('idchecklist')) {
	// 		$idchecklist = $this->input->post('idchecklist');
	// 		$data = $this->administrator_model->getSectionsDropdown($idchecklist);
	// 	}
	// 	json($data);
	// }
	//
	// function getIndicatorGroup() {
	// 	$data = array();
	// 	if ($this->input->post('idindicator')) {
	// 		$idindicator = $this->input->post('idindicator');
	// 		$data = $this->administrator_model->getIndicatorGroup($idindicator);
	// 	}
	// 	json($data);
	// }
	// function getOptionsByGroup() {
	// 	$data = array();
	// 	if ($this->input->post('idgroup')) {
	// 		$idgroup = $this->input->post('idgroup');
	// 		$data = $this->administrator_model->get_opt_by_group($idgroup);
	// 	}
	// 	json($data);
	// }

}
