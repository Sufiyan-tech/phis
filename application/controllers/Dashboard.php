<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function __construct() {
       parent::__construct();
       is_admin();
	}

	public function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['content'] = $this->load->view('dashboard', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function survey() {
		$this->data['title'] = 'Survey Dashboard';

		$this->load->model('surveymodel');
		$this->load->model('listing_model');

		$where=" status = 2";
        $this->data['subcomponents'] = $this->listing_model->get_records('subcomponents' ,$where);

 		$this->data['campaigns'] = $this->surveymodel->getCampaigns($filter = array('idsurvey'=> 'd215a680-6c51-11eb-8368-b8763f83058b'));

		$this->data['content'] = $this->load->view('dashboard/survey', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function getSurveyDashboard() {
		$filter = $this->input->get();

		$this->load->model('dashboardmodel');
		$this->data['current_data'] = $this->dashboardmodel->getServeyIndicatorData($filter);
		$data['current_data'] = $this->load->view('dashboard/pdhs', $this->data, true);
		echo json_encode($data); exit;
	}

	public function integrateddashboard() {
		$this->data['title'] = 'Integrated Dashboard';

		$this->load->model('dashboardmodel');
 		$this->data['goals'] = $this->dashboardmodel->getDHISGoals($filter = array('idsubcomponent'=> '530f5558-6aa2-11eb-9f4a-d7b5cbd62cef'));
		$this->data['nosidebar'] = true;
		$this->data['content'] = $this->load->view('dashboard/integrateddashboard', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function getIntegratedDashboard() {
		$filter = $this->input->get();
		$this->data = $filter;

		$this->load->model('dashboardmodel');
		$this->data['indicator'] = $this->dashboardmodel->getSingleIndicator($filter);
		$this->data['slug'] = $this->data['indicator']['slug'];
		$filter['slug'] = $this->data['slug'];
		$this->data['pdata'] = $this->dashboardmodel->getDHISIndicatorDataProvince($filter);

		$this->data['sub'] = $filter;
		$this->data['sub']['ydata'] = $this->dashboardmodel->getDHISIndicatorDataProvinceYear($filter);
		$this->data['sub']['fdata'] = $this->dashboardmodel->getDHISIndicatorDataProvinceFacility($filter);
		$this->data['sub']['indicator'] = $this->data['indicator'];


		$data['current_data'] = $this->load->view('dashboard/dhis', $this->data, true);
		echo json_encode($data); exit;
	}

	public function subIntegratedDashboard() {
		$filter = $this->input->get();
		$this->data = $filter;

		$this->load->model('dashboardmodel');
		$this->data['indicator'] = $this->dashboardmodel->getSingleIndicator($filter);
		$this->data['slug'] = $this->data['indicator']['slug'];
		$filter['slug'] = $this->data['slug'];

		$this->data['ydata'] = $this->dashboardmodel->getDHISIndicatorDataDistrictYear($filter);
		$this->data['fdata'] = $this->dashboardmodel->getDHISIndicatorDataDistrictFacility($filter);
		$this->data['ddata'] = $this->dashboardmodel->getDHISIndicatorDataDistrict($filter);

		$data = $this->load->view('dashboard/dhis_sub', $this->data, true);
		echo json_encode($data); exit;
	}
}
