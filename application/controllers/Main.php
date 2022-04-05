<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
       parent::__construct();
       $this->load->model('listing_model');
       $this->load->model('main_model');
	}

	public function index()
	{
		$this->data['title'] = 'PHIS';
		$order = array('id' => 'sort', 'order' => 'ASC');
		$this->data['components']=$this->listing_model->fetchall('components','','','','', $order);
		$this->data['com_id'] = '';

		// surveys
		$where=" idcomponent = '66bf179a-4e56-11eb-854e-4f03d6a08e57' AND status = 2";
        $all_surveys = $this->listing_model->get_records('subcomponents' ,$where, 'sort');

        $where = array('idcomponent' => '66bf179a-4e56-11eb-854e-4f03d6a08e57', 'idsubcomp' => 1);

        $DHISDashboard = $this->main_model->getDashboardComponent($where);
        	// DHIS dashboard
        $where = array('idcomponent' => '5ff4b3de-4e56-11eb-854d-a7c92409647f', 'idsubcomp' => 1);

    	$order_by = '';
    	$DHISDashboard = $this->main_model->getDashboardComponent($where);
        	// Integrated dashboard

    	$where = array('idcomponent' => '6b58cac6-4e56-11eb-854f-f33e63f92709', 'idsubcomp' => 1);
        $integratedDashboard = $this->main_model->getDashboardComponent($where);


    	//$where=" idcomponent = '6b58cac6-4e56-11eb-854f-f33e63f92709' AND status = 2";
        //$integratedDashboard = $this->listing_model->get_records('subcomponents' ,$where);

		$this->data['surveys_dashboards'] = $all_surveys;
		$this->data['hmis_dashboards'] = $DHISDashboard;
		$this->data['navbar'] = $this->load->view('frontend/layouts/nav_bar',$this->data, true);
		$this->data['integrated_dashboards'] = $integratedDashboard;
		$this->data['content'] = $this->load->view('frontend/dashboard', $this->data, true);
        $this->load->view('frontend/index', $this->data);
	}

	public function main()
	{
		$this->data['title'] = 'PHIS';
		$order = array('id' => 'created_at', 'order' => 'DESC');
		$this->data['components']=$this->listing_model->fetchall('components','','','','', $order);
		$this->data['com_id'] = '';

		//$this->data['content'] = $this->load->view('dashboard', $this->data, true);
        $this->load->view('frontend/main', $this->data);
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
		$this->load->model('surveymodel');
		$this->data['title'] = 'Survey Dashboard';
		$filter = $this->input->post('year');
		$year = $this->input->get('year');
		$idsubcomponent = $this->input->get('subcomp-id');
		
		$filterssss = array('idsubcomponent' => $idsubcomponent, 'year' => $year, 'idsurvey' => 1);
		$getselectedYear = $this->surveymodel->getCampaignsYear($filterssss);
		//echo $this->db->last_query();exit;
		//echo "<pre>";print_r($getselectedYear);exit;
		$this->data['idsubcomponent'] = $idsubcomponent;
		$this->data['getselectedYear'] = $getselectedYear;
		$this->load->model('surveymodel');

 		$where = array('idsubcomponent' => $idsubcomponent, 'idsurvey' => 1);
		$this->data['camp_years'] = $this->main_model->getCampaignYears($where);

		$this->load->model('surveymodel');
		$filter = array('idcampaign' => $filter, 'idsubcomponent' => $idsubcomponent);
 		$this->data['indicators'] = $this->surveymodel->getCampaignIndicators($filter);
 		$this->data['provinces'] = $this->surveymodel->generalQuery('select * from provinces');
 		$this->data['content'] = $this->load->view('frontend/report', $this->data, true);


// 		 //var_dump($this->data);die();
// 		print_r($this->data['indicators'][0]);
// 		// die;


 		$this->load->view('frontend/index', $this->data);
	}

	public function getDistrictRanking(){
		$this->load->model('surveymodel');
		$province_where = '';
		$year_where = '';
		if($this->input->post('province_id') != ''){
			$province_where = "and dhis_data2.procode = '" . $this->input->post('province_id') . "'";
		}

		if($this->input->post('years') != ''){
			$from_year = substr($this->input->post('years') , 0 , 4);
			$to_year = substr($this->input->post('years') , 5 , 9);
			$year_where = "and (dhis_data2.year >= ".$from_year." and dhis_data2.year <= ".$to_year." )";
		}

		$data = json_encode($this->surveymodel->generalQuery('select districts.district_name , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as "total" from districts INNER JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" '.$province_where.' '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id order by sum(dhis_data2.total_count) DESC'));
		echo $data;
	}

	public function getDistrictMap(){
		
		$this->load->model('surveymodel');
		$year_where = '';
		

		if($this->input->post('years') != ''){
			$from_year = substr($this->input->post('years') , 0 , 4);
			$to_year = substr($this->input->post('years') , 5 , 9);
			$year_where = "and (dhis_data2.year >= ".$from_year." and dhis_data2.year <= ".$to_year." )";
		}

		$data = array(
			'Islamabad_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id  , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 7 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'Balochistan_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 4 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'Sindh_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 2 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'Punjab_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 1 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'KPK_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 3 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'FATA_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 8 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'AJK_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 5 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'GB_province' => $this->surveymodel->generalQuery('select districts.district_name , districts.coordinate , districts.x , districts.y , districts.district_code , dhis_data2.indicator_id , sum(dhis_data2.total_count) as total , (sum(dhis_data2.umale)+sum(dhis_data2.ufemale)) as total_urban , (sum(dhis_data2.rmale)+sum(dhis_data2.rfemale)) as total_rural , dhis_data2.procode from districts LEFT JOIN dhis_data2 ON districts.district_code = dhis_data2.distcode where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and districts.province_code = 6 '.$year_where.' GROUP BY districts.district_code , districts.district_name , dhis_data2.indicator_id , dhis_data2.procode order by sum(dhis_data2.total_count) DESC'),
			'districts' => $this->surveymodel->generalQuery('select * from districts'),
		);

		echo json_encode($data);
	}

	public function getProvinceBar(){
		
		$this->load->model('surveymodel');
		$year_where = '';
		

		if($this->input->post('years') != ''){
			$from_year = substr($this->input->post('years') , 0 , 4);
			$to_year = substr($this->input->post('years') , 5 , 9);
			$year_where = "and (dhis_data2.year >= ".$from_year." and dhis_data2.year <= ".$to_year." )";
		}

		if($this->input->post('district') == ''){
			$data = array(
				'national' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" '.$year_where.''),
				'Islamabad_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 7 '.$year_where.''),
				'Balochistan_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 4 '.$year_where.''),
				'Sindh_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 2 '.$year_where.''),
				'Punjab_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 1 '.$year_where.''),
				'KPK_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 3 '.$year_where.''),
				'FATA_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 8 '.$year_where.''),
				'AJK_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 5 '.$year_where.''),
				'GB_province' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = 6 '.$year_where.''),
			);
	
			echo json_encode($data);
		}else{
			$data = array(
				'national' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban from dhis_data2 where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" '.$year_where.''),
				'province_data' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban , provinces.province_name , provinces.province_code from dhis_data2 INNER JOIN provinces ON dhis_data2.procode = provinces.province_code where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.procode = "'.$this->surveymodel->retriveProvince($this->input->post('district'))->province_code.'" '.$year_where.''),
				'district_data' => $this->surveymodel->generalQuery('select sum(dhis_data2.total_count) as Total , (sum(dhis_data2.rmale) + sum(dhis_data2.rfemale)) as Total_Rural , (sum(dhis_data2.umale) + sum(dhis_data2.ufemale)) as Total_Urban , districts.district_name , districts.district_code , districts.province_code from dhis_data2 INNER JOIN districts ON dhis_data2.distcode = districts.district_code where dhis_data2.indicator_id = "'.$this->input->post('indicator_id').'" and dhis_data2.distcode = "'.$this->input->post('district').'" '.$year_where.' '),
			);

		
			echo json_encode($data);
		}

		
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
	public function integrated_dashboards_after(){
		$this->data['title'] = 'Integrated Dashboard';
		$this->data['content'] = $this->load->view('frontend/integrated-dashboard-report-after-login', $this->data, true);
        $this->load->view('frontend/index', $this->data);
	}
}
