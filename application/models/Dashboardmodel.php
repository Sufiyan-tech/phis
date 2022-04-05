<?php

class Dashboardmodel extends CI_Model {


	function getServeyIndicatorData($filter){
		$this->db->select('*');
		$this->db->from('pdhs_vw AS t');
		if (isset($filter)) {
			if (isset($filter['idindicator'])) {
				$this->db->where('t.idindicator', $filter['idindicator']);
			}
			if (isset($filter['idcampaign'])) {
				$this->db->where('t.idcampaign', $filter['idcampaign']);
			}
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	function getCampaigns($filter){
		$this->db->select('c.*');
		$this->db->from('campaigns AS c');
		$this->db->join('surveyforms AS f', 'c.idsurveyform = f.idsurveyform');
		$this->db->join('subcomponents AS s', 'f.idsubcomponent = s.idsubcomponent');
		if (isset($filter)) {
			if (isset($filter['idsurvey'])) {
				$this->db->where('s.idsubcomponent', $filter['idsurvey']);
			}
		}
		$this->db->where('c.status', 2);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getCampaignLocations($filter){
		$this->db->select('p.*');
		$this->db->from('campaign_locations AS c');
		$this->db->join('provinces AS p', 'c.province_code = p.province_code');
		if (isset($filter)) {
			if (isset($filter['idcampaign'])) {
				$this->db->where('c.idcampaign', $filter['idcampaign']);
			}
		}
		// $this->db->where('c.status', 2);
		$this->db->order_by("p.province_name ASC");
		$query = $this->db->get();
		return $query->result_array();
	}

	function getCampaignIndicators($filter){
		$this->db->select('i.*');
		$this->db->from('campaigns AS c');
		$this->db->join('surveyforms AS f', 'c.idsurveyform = f.idsurveyform');
		$this->db->join('surveyformindicators AS fi', 'f.idsurveyform = fi.idsurveyform');
		$this->db->join('indicators AS i', 'fi.idindicator = i.idindicator');
		if (isset($filter)) {
			if (isset($filter['idcampaign'])) {
				$this->db->where('c.idcampaign', $filter['idcampaign']);
			}
		}
		// $this->db->where('c.status', 2);
		$this->db->order_by("i.name ASC");
		$query = $this->db->get();
		return $query->result_array();
	}

	function getSurveyForm($filter){
		$where = 'i.name IS NOT NULL';
		if (isset($filter)) {
			if (isset($filter['idcampaign'])) {
				$where = " AND c.idcampaign = '{$filter['idcampaign']}'";
			}
		}
		$q = "SELECT
			i.name, i.idgroup, i.idindicator,
			json_agg(
				json_build_object(
					'idoption', o.idoption,
					'value', o.value,
					'type', o.type,
					'label', o.name,
					'readonly', o.readonly
				) ORDER BY o.idoption
			) AS options
		FROM campaigns AS c
		JOIN surveyforms AS f ON c.idsurveyform = f.idsurveyform
		JOIN surveyformindicators AS fi ON f.idsurveyform = fi.idsurveyform
		JOIN indicators AS i ON fi.idindicator = i.idindicator
		JOIN groups AS g ON i.idgroup = g.idgroup
		JOIN option_groups AS og ON g.idgroup = og.idgroup
		JOIN options AS o ON og.idoption = o.idoption
		$where
		GROUP BY i.name, i.idgroup, i.idindicator
		ORDER BY i.name";
		$query = $this->db->query($q);
		return $query->result_array();
	}

	function getSurveyFormData($filter){
		$where = 'WHERE i.idindicator IS NOT NULL AND h.status = 2 AND i.status = 2';
		if (isset($filter)) {
			if (isset($filter['idcampaign'])) {
				$where .= " AND h.idcampaign = '{$filter['idcampaign']}'";
			}
			if (isset($filter['province_code'])) {
				$where .= " AND h.iddistrict = '{$filter['province_code']}'";
			}
		}
		$q = "SELECT
			i.idsurveyheader, i.idsurveyindicator, i.idindicator, i.idgroup, i.idoption, i.value
		FROM surveyheaders AS h
		JOIN surveyindicators AS i ON h.idsurveyheader = i.idsurveyheader
		$where";
		$query = $this->db->query($q);
		return $query->result_array();
	}

	function getIndicatorOptions($filter=NULL) {
		$this->db->select('o.*');
		$this->db->from('indicators AS i');
		$this->db->join('groups AS g', 'i.idgroup = g.idgroup');
		$this->db->join('option_groups AS og', 'g.idgroup = og.idgroup');
		$this->db->join('options AS o', 'og.idoption = o.idoption');
		// $this->db->order_by('ri.name', 'asc');
		if (isset($filter)) {
			if (isset($filter['idindicator'])) {
				$this->db->where('i.idindicator', $filter['idindicator']);
			}
		}
		$query = $this->db->get();
		return $query->result();

	}

	function getDHISGoals($filter){
		$this->db->select('g.*');
		$this->db->from('goals AS g');
		$this->db->join('subcomponents AS s', 'g.idsubcomponent = s.idsubcomponent');
		if (isset($filter)) {
			if (isset($filter['idsubcomponent'])) {
				$this->db->where('s.idsubcomponent', $filter['idsubcomponent']);
			}
		}
		$this->db->where('g.status', 2);
		$this->db->order_by('g.name', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getSingleIndicator($filter){
		$this->db->select('*');
		$this->db->from('indicators AS t');
		$this->db->where('t.idindicator', $filter['idindicator']);
		// if (isset($filter)) {
		// 	if (isset($filter['idindicator'])) {
		// 	}
		// }
		$query = $this->db->get();
		return $query->row_array();
	}

	function getDHISIndicatorDataProvince($filter){
		$select = "{$filter['slug']} AS value";
		$this->db->select("t.pcode AS code, t.pname, $select");
		$this->db->from('dhis_province_vw AS t');
		if (isset($filter)) {
			if (isset($filter['year'])) {
				$this->db->where('t.year', $filter['year']);
			}
			if (isset($filter['month'])) {
				$this->db->where('t.month', $filter['month']);
			}
		}
		$this->db->where('t.ymonth', $filter['year'].'-'.$filter['month']);
		$this->db->where('t.fatype', 'ALL');
		$this->db->order_by('t.pcode', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDHISIndicatorDataProvinceYear($filter){

		$select = "SUM({$filter['slug']}) AS value";
		$this->db->select("t.year, t.month, TO_CHAR(TO_DATE (t.month::text, 'MM'), 'Mon') AS mon, $select");
		$this->db->from('dhis_province_vw AS t');
		$this->db->where('t.year', $filter['year']);
		$this->db->where('t.fatype', 'ALL');
		$this->db->group_by('t.year, t.month');
		$this->db->order_by('t.month', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDHISIndicatorDataProvinceFacility($filter){
		$select = "SUM({$filter['slug']}) AS value";
		$this->db->select("t.fatype, $select");
		$this->db->from('dhis_province_vw AS t');
		if (isset($filter)) {
			if (isset($filter['year'])) {
				$this->db->where('t.year', $filter['year']);
			}
			if (isset($filter['month'])) {
				$this->db->where('t.month', $filter['month']);
			}
		}
		$this->db->where('t.ymonth', $filter['year'].'-'.$filter['month']);
		$this->db->where("t.fatype <> 'ALL'");
		$this->db->group_by('t.fatype');
		$this->db->order_by('t.fatype', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDHISIndicatorDataDistrict($filter){
		$select = "{$filter['slug']} AS value";
		$this->db->select("t.dcode AS code, t.dname, $select");
		$this->db->from('dhis_mv AS t');
		if (isset($filter)) {
			if (isset($filter['year'])) {
				$this->db->where('t.year', $filter['year']);
			}
			if (isset($filter['month'])) {
				$this->db->where('t.month', $filter['month']);
			}
		}
		$this->db->where('t.pcode', $filter['code']);
		$this->db->where('t.ymonth', $filter['year'].'-'.$filter['month']);
		$this->db->where('t.fatype', 'ALL');
		$this->db->order_by('t.pcode', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDHISIndicatorDataDistrictYear($filter){
		$select = "SUM({$filter['slug']}) AS value";
		$this->db->select("t.year, t.month, TO_CHAR(TO_DATE (t.month::text, 'MM'), 'Mon') AS mon, $select");
		$this->db->from('dhis_mv AS t');
		$this->db->where('t.year', $filter['year']);
		$this->db->where('t.pcode', $filter['code']);
		$this->db->where('t.fatype', 'ALL');
		$this->db->group_by('t.year, t.month');
		$this->db->order_by('t.month', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDHISIndicatorDataDistrictFacility($filter){

		$select = "SUM({$filter['slug']}) AS value";
		$this->db->select("t.fatype, $select");
		$this->db->from('dhis_mv AS t');
		if (isset($filter)) {
			if (isset($filter['year'])) {
				$this->db->where('t.year', $filter['year']);
			}
			if (isset($filter['month'])) {
				$this->db->where('t.month', $filter['month']);
			}
		}
		$this->db->where('t.pcode', $filter['code']);
		$this->db->where('t.ymonth', $filter['year'].'-'.$filter['month']);
		$this->db->where("t.fatype <> 'ALL'");
		$this->db->group_by('t.fatype');
		$this->db->order_by('t.fatype', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
}
