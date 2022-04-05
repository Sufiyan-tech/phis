<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('listing_model');
       $this->load->model('main_model');
	}

	public function index($slug = NULL)
	{
		$this->data['title'] = 'PHIS';

    	$where="slug = '".$slug."' ";
		$subcomponents = $this->listing_model->get_info('subcomponents',$slug, 'idcampaign', $where);
		$this->data['subcomponents'] = $subcomponents;
		$this->data['content'] = $this->load->view('frontend/detail-survey', $this->data, true);
        $this->load->view('frontend/index', $this->data);
	}

	public function get_survey_years(){
		$comp_id = $_POST['subcompid'];
		$where = array('idsubcomponent' => $comp_id, 'idsurvey' => 1);
		$camp_years = $this->main_model->getCampaignYears($where);
		$sub_com_name = get_subcomponent_name($comp_id);
		$lipanel = '';
		if($camp_years){
			//echo "<pre>";print_r($subcomponents);exit;
			foreach ($camp_years as $key => $year) {
				//$linkURLConcate = createLink($subcomponent['type'], $code, $roles);
				//echo $linkURLConcate;exit;
				$lipanel .= '<li><a href="'.base_url().'main/survey?subcomp-id='.$comp_id.'&year='.$year['name'].'" class="d-flex justify-content-between" target="_blank">'.$year["name"].' <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
			}
		}
		$returndata = array('sub_comp_name' => $sub_com_name, 'lipanel' => $lipanel);
		echo json_encode($returndata);exit;
	}

	public function subcomponent(){
		$subcomponents = '';
		$com_id = '';
		$order = array('id' => 'created_at', 'order' => 'DESC');
		$this->data['components']=$this->listing_model->fetchall('components','','','','', $order);
		$type = '';
		if($_GET['type']){
			$type = $_GET['type'];
		}
		$this->data['type'] = $type;
		$this->data['com_id'] = '';
		if($_GET['com_id']){

			$com_id = $_GET['com_id'];
			$where=" idcomponent = '".$com_id."' AND status = 2";
        	$subcomponents = $this->listing_model->get_records('subcomponents' ,$where);
		}
		$this->data['subcomponents'] = $subcomponents;
		$this->data['com_id'] = $com_id;
		$this->load->view('frontend/index', $this->data);

	}

	public function get_comp_provinces(){
		$comp_id = $_POST['subcompobj'];
		$subcomponents = $this->main_model->get_comp_provinces($comp_id);
		$sub_com_name = get_subcomponent_name($comp_id);
		$lipanel = '';
		if($subcomponents){
			//echo "<pre>";print_r($subcomponents);exit;
			foreach ($subcomponents as $key => $subcomponent) {
				$code = '';
				$link = $subcomponent['link'];
				if($subcomponent['code'] != ''){
					$code = $subcomponent['code'];
				}
				$roles = $subcomponent['roles'];
				//echo $subcomponent['type'].'--'. $code.'--'. $roles;exit;
				$linkURLConcate = createLink($subcomponent['type'], $code, $roles);
				//echo $linkURLConcate;exit;
				$lipanel .= '<li><a href="'.$link.$linkURLConcate.'" class="d-flex justify-content-between" target="_blank">'.$subcomponent["name"].' <i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>';
			}
		}
		$returndata = array('sub_comp_name' => $sub_com_name, 'lipanel' => $lipanel);
		echo json_encode($returndata);exit;
	}

	public function get_years(){
		$this->data['title'] = 'Survey selection/Year';

		$idsubcomponent = $_GET['subcomp-id'];
		$this->data['idsubcomponent'] = $idsubcomponent;
		$where = array('idsubcomponent' => $idsubcomponent, 'idsurvey' => 1);
		$this->data['camp_years'] = $this->main_model->getCampaignYears($where);
		$this->data['content'] = $this->load->view('frontend/year', $this->data, true);

		$this->load->view('frontend/index', $this->data);
	}

	public function survey() {
		$this->data['title'] = 'Survey Dashboard';
		$filter = $this->input->post('year');

		$idsubcomponent = $this->input->get('subcomp-id');
		$this->data['idsubcomponent'] = $idsubcomponent;
		$this->load->model('surveymodel');

 		$where = array('idsubcomponent' => $idsubcomponent, 'idsurvey' => 1);
		$this->data['camp_years'] = $this->main_model->getCampaignYears($where);

		$this->load->model('surveymodel');
		$filter = array('idcampaign' => $filter, 'idsubcomponent' => $idsubcomponent);
 		$this->data['indicators'] = $this->surveymodel->getCampaignIndicators($filter);
 		$this->data['content'] = $this->load->view('frontend/report', $this->data, true);
 		$this->load->view('frontend/index', $this->data);
	}

	public function get_ind_by_subcomponent(){
		$subcompobj = $this->input->post('subcompobj');
		$where = " g.idsubcomponent = '".$subcompobj."' ";
		$indicators = $this->listing_model->get_indicator_data($where);
		$html = '';
		if($indicators){
            foreach ($indicators as $key => $indicator) {
                $html .= '<div class="nk-tb-item">
                    <div class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input checkSingle" name="ind_id[]" value="'.$indicator['idindicator'].'" id="uid'.$key.'">
                            <label class="custom-control-label" for="uid'.$key.'"></label>
                        </div>
                    </div>
                    <div class="nk-tb-col tb-col-mb">
                        <span class="tb-amount">'.$indicator['ind_name'].'<span class="currency"> ('.$indicator['subcompname'].') </span></span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        <span class="tb-status text-success">Active</span>
                    </div>
                </div>';
            }
        }
        echo $html;
	}

	public function get_indicator_list(){
		$idsubcomponent = $this->input->post('idsubcom');
		$where = " g.idsubcomponent = '".$subcompobj."' ";
		$indicators = $this->listing_model->get_indicator_list($where);
		echo json_encode($indicators);
	}

	public function get_indicator_count(){
		$idsubcomponent = $this->input->post('idsubcom');
		$where = " g.idsubcomponent = '".$subcompobj."' ";
		$indicators = $this->listing_model->get_indicator_count($where);
		echo json_encode($indicators);
	}
	public function get_district_by_subcom(){
		$idcampaign = $this->input->post('idcampaign');
		$pro_id = $this->input->post('pro_id');
		// get survey form id
		$where="idcampaign = '".$idcampaign."' ";
		$is_district = 0;
		$provinces =array();
		$campaign = $this->listing_model->get_info('campaigns',$idcampaign, 'idcampaign', $where);
		if($campaign){
			if($campaign['district'] == 1){
				// get all districts
				$provinces = $this->main_model->getDistrictByProvince($pro_id);
				$is_district = 1;
			}
		}
		$jsonData = array('provinces' => $provinces, 'is_district' => $is_district);
        echo json_encode($jsonData);exit;
	}
	public function integrated_dashboards(){
		$this->data['title'] = 'Integrated Dashboard';
		$this->data['content'] = $this->load->view('frontend/integrated-dashboard-report', $this->data, true);
        $this->load->view('frontend/index', $this->data);
	}
}
