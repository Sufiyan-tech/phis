<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//is_admin();
		$this->load->model('listing_model');
		set_time_limit(600);
	}

	public function index()	{
		$this->data['title'] = 'Years';
		$groups = array('id' => 'name', 'order' => 'ASC');
        $this->data['campaigns']=$this->listing_model->fetchall('campaigns','','','','', $groups);
		$this->data['content'] = $this->load->view('years/list', $this->data, true);
        $this->load->view('index', $this->data);
	}

	public function dhis_data($month, $year, $province, $exit = true) {
		$fmonth = "$year-$month";
		$ftypes = array('all' => 'ALL', 'BHU' => 'BHU', 'RHC' => 'RHC', 'MCH' => 'MCH', 'THQ' => 'THQ', 'DHQ' => 'DHQ', 'HOSP' => 'HOSP');
		$dashboard_header = array();
		$dashboard_indicators = array();
		foreach($ftypes as $fatype => $fftype) {
			// if($fatype=='all'){
			// 	$fftype='ALL';
			// }else{
			// 	$fftype=$fatype;
			// }

			if($province == '1'){
				$token = 'dhisapi'.date("Y-m-d");
				$url = "http://125.209.111.70:88/dhis/api-v2/dataextraction.php?fmonth=$fmonth&fatype=$fatype&distcode=&token=$token";
			}else if($province == '2'){
				$url = "http://dhissindh.pk/getDhisData/nhsrcdataexport.php?fmonth=$fmonth&fatype=$fatype";
			}else if($province == '3'){
				$url = "http://dhis.cres.pk/getDhisData/nhsrcdataexport.php?fmonth=$fmonth&fatype=$fatype";
			}else if($province == '4'){
				$token = sha1(md5("balochistandhisintegration".date('Y-m-d')));
				$url = "http://dhisbalochistan.pk/nhsrcexportdhisbaloch.php?fmonth=$fmonth&fatype=$fatype&code=$token";
			}else if($province == '5'){
				$token = sha1(md5("ajkdhisnhsrc98765".date('Y-m-d')));
				$url = "http://dhisajk.nhsrc.pk/nhsrcexportdhisajk.php?fmonth=$fmonth&fatype=$fatype&code=$token";
			}else if($province == '6'){
				$token = sha1(md5("gbdhisnhsrc98765".date('Y-m-d')));
				$url = "http://dhisgb.nhsrc.pk/nhsrcexportdhisgb.php?fmonth=$fmonth&fatype=$fatype&code=$token";
			}else if($province == '8'){
				$token = sha1(md5("fatadhisnhsrc23456".date('Y-m-d')));
				$url = "http://dhisfata.nhsrc.pk/nhsrcexportdhisfata.php?fmonth=$fmonth&fatype=$fatype&code=$token";
			}

			$data = file_get_url_data($url);
			$this->load->model('surveymodel');
			$form = $this->surveymodel->getSurveyFormByID('e8702ff1-aa90-47e3-9b48-726c36778525');
			$inidcators = $this->surveymodel->getSurveyFormIndicators($form->idsurveyform);
			if (count($data) > 0) {
				foreach ($data as $k => $v) {
					$uuid = uuid();
					$dashboard_header[] = array(
						'iddashboardheader' => $uuid,
						'idsurveyform' 		=> $form->idsurveyform,
						'iddistrict' 		=> $v['distcode'],
						'year' 				=> $year,
						'month'				=> $month,
						'ymonth' 			=> "$year-$month",
						'status' 			=> 2,
						'fatype' 			=> $fftype,
						'created_at' 		=> 'now()'
					);
					foreach ($inidcators as $kk => $vv) {
						$dashboard_indicators[] = array(
							'iddashboardheader' => $uuid,
							'idindicator' 		=> $vv->idindicator,
							'idgroup' 			=> $vv->idgroup,
							'idoption' 			=> $vv->idoption,
							'value'				=> (int)$v[renameIndicator($vv->slug)],
							'status' 			=> 2
						);
					}
				}
			}
			$w = "ymonth = '$fmonth' AND LEFT(iddistrict::TEXT, 1) = '$province' AND idsurveyform = '$form->idsurveyform'";
			$where = "iddashboardheader IN(SELECT iddashboardheader FROM dashboardheaders h WHERE $w)";

			$this->surveymodel->deleteRow('dashboardindicators', $where);

			$this->surveymodel->generalQuery("ALTER TABLE dashboardheaders DISABLE TRIGGER ALL");
			$this->surveymodel->deleteRow('dashboardheaders', $w);
			$this->surveymodel->generalQuery("ALTER TABLE dashboardheaders ENABLE TRIGGER ALL");

			$this->surveymodel->insertRows('dashboardheaders', $dashboard_header);
			$this->surveymodel->insertRows('dashboardindicators', $dashboard_indicators);

			$this->db->trans_complete();
			$response = '';
			if ($this->db->trans_status() === FALSE) {
				$response = json_encode(['status' => true,'message' => 'Error Importing DHIS Records']);
			} else {
				$response = json_encode(['status' => true,'message' => 'DHIS Records Successfully Inserted']);
			}
			if ($exit) {
				$this->surveymodel->generalQuery("REFRESH MATERIALIZED VIEW CONCURRENTLY dhis_mv");
				echo $response; exit;
			} else {
				return "DHIS Records Successfully Inserted for Province $province";
			}
		}
		if ($exit) {
			echo json_encode(['status' => true,'message' => 'Data Not Found']); exit;
		} else {
			return "Data Not Found for Province $province";
		}
	}

	public function mnch_data($month = '03', $year = '2017', $province = '2', $exit = true) {
		$fmonth = "$year-$month";
		if($province == '2') {
			$mnchsindhcode = sha1(md5("sindhmnchnhsrc".date('Y-m-d')));
			$url = "http://mnch.sindhealth.pk/exportdata/nhsrcexport.php?fmonth=$fmonth&procode=$province&code=$mnchsindhcode";
		} else if($province == '3') {
			$mnchkpcode = sha1(md5("kpmnchshared".date('Y-m-d')));
			$url = "http://mnch.kphealth.pk/exportdata/nhsrcexport.php?fmonth=$fmonth&procode=$province&code=$mnchkpcode";
		} else {
			$mnchpunjabcode = sha1(md5("punjabmnchlinkage".date('Y-m-d')));
			$url = "http://cmw.irmnch.gop.pk/nhsrcexportmnch.php?fmonth=$fmonth&procode=$province&code=$mnchpunjabcode";
		}
		$data = file_get_url_data($url);
        $this->load->model('surveymodel');
        $form = $this->surveymodel->getSurveyFormByID('c2458cdd-53ec-4e87-a762-06d51aa61baf');
        $inidcators = $this->surveymodel->getSurveyFormIndicators($form->idsurveyform);

		$dashboard_header = array();
		$dashboard_indicators = array();
		if (count($data) > 0) {
			foreach ($data as $k => $v) {
				$uuid = uuid();
				$dashboard_header[$k] = array(
					'iddashboardheader' => $uuid,
					'idsurveyform' 		=> $form->idsurveyform,
					'iddistrict' 		=> $v['distcode'],
					'year' 				=> $year,
					'month'				=> $month,
					'ymonth' 			=> "$year-$month",
					'status' 			=> 2,
					'fatype' 			=> 'ALL',
					'created_at' 		=> 'now()'
				);
				foreach ($inidcators as $kk => $vv) {
					$dashboard_indicators[] = array(
						'iddashboardheader' => $uuid,
						'idindicator' 		=> $vv->idindicator,
						'idgroup' 			=> $vv->idgroup,
						'idoption' 			=> $vv->idoption,
						'value'				=> $v[($vv->slug === 'neonataldeaths' ? 'newborndeaths' : $vv->slug)],
						'status' 			=> 2
					);
				}
			}
			$this->db->trans_start();

			$w = "ymonth = '$fmonth' AND LEFT(iddistrict::TEXT, 1) = '$province' AND idsurveyform = '$form->idsurveyform'";
			$where = "iddashboardheader IN(SELECT iddashboardheader FROM dashboardheaders h WHERE $w)";

			$this->surveymodel->deleteRow('dashboardindicators', $where);

			$this->surveymodel->generalQuery("ALTER TABLE dashboardheaders DISABLE TRIGGER ALL");
			$this->surveymodel->deleteRow('dashboardheaders', $w);
			$this->surveymodel->generalQuery("ALTER TABLE dashboardheaders ENABLE TRIGGER ALL");

			$this->surveymodel->insertRows('dashboardheaders', $dashboard_header);
			$this->surveymodel->insertRows('dashboardindicators', $dashboard_indicators);

			$this->db->trans_complete();
			$response = '';
			if ($this->db->trans_status() === FALSE) {
				$response = json_encode(['status' => true,'message' => 'Error Importing CMW Records']);
			} else {
				$response = json_encode(['status' => true,'message' => 'CMW Records Successfully Inserted']);
			}
			if ($exit) {
				$this->surveymodel->generalQuery("REFRESH MATERIALIZED VIEW CONCURRENTLY mnch_mv");
				echo $response; exit;
			} else {
				return "CMW Records Successfully Inserted for Province $province";
			}
		}
		if ($exit) {
			echo json_encode(['status' => true,'message' => 'Data Not Found']); exit;
		} else {
			return "Data Not Found for Province $province";
		}
	}

	public function dhis_import($month, $year) {
		$province = array(1,2,3,4,5,6,8);
		$response = [];
		foreach ($province as $k => $v) {
			$response [] = $this->dhis_data($month, $year, $v, false);
		}
		$this->load->model('surveymodel');
		$this->surveymodel->generalQuery("REFRESH MATERIALIZED VIEW CONCURRENTLY dhis_mv");
		echo json_encode(['status' => true, 'response' => $response]); exit;
	}

	public function mnch_import($month, $year) {
		$province = array(1,2,3);
		$response = [];
		foreach ($province as $k => $v) {
			$response [] = $this->mnch_data($month, $year, $v, false);
		}
		$this->load->model('surveymodel');
		$this->surveymodel->generalQuery("REFRESH MATERIALIZED VIEW CONCURRENTLY mnch_mv");
		echo json_encode(['status' => true, 'response' => $response]); exit;
	}

}
