<?php

class Surveymodel extends CI_Model {


	function getServeyList(){
		$this->db->select('s.*');
		$this->db->from('subcomponents AS s');
		$this->db->join('components AS c', 's.idcomponent = c.idcomponent');
		$this->db->where('c.component_name', 'Surveys');
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

	function getCampaignsYear($filter){
		$this->db->select('c.*');
		$this->db->from('campaigns AS c');
		$this->db->join('surveyforms AS f', 'c.idsurveyform = f.idsurveyform');
		$this->db->join('subcomponents AS s', 'f.idsubcomponent = s.idsubcomponent');
		if (isset($filter)) {
			if (isset($filter['idsurvey'])) {
				$this->db->where('s.idsubcomponent', $filter['idsubcomponent']);
				$this->db->where('c.name', $filter['year']);

			}
		}
		$this->db->where('c.status', 2);
		$query = $this->db->get();
		return $query->row_array();
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
		$this->db->select('*');
		$this->db->from('indicators');
// 		$this->db->join('surveyforms AS f', 'c.idsurveyform = f.idsurveyform');
// 		$this->db->join('surveyformindicators AS fi', 'f.idsurveyform = fi.idsurveyform');
// 		$this->db->join('indicators AS i', 'fi.idindicator = i.idindicator');
// 		if (isset($filter)) {
// 			if (isset($filter['idcampaign'])) {
// 				$this->db->where('c.idcampaign', $filter['idcampaign']);
// 			}
// 			if (isset($filter['idsubcomponent'])) {
// 				$this->db->where('f.idsubcomponent', $filter['idsubcomponent']);
// 			}
// 		}
// 		// $this->db->where('c.status', 2);
// 		$this->db->group_by("i.idindicator");
// 		$this->db->order_by("i.name ASC");
		$query = $this->db->get();
		return $query->result_array();
	}

	function getGoalIndicators($filter){
		$this->db->select('i.*');
		$this->db->from('indicators AS i');
		$this->db->join('goals AS g', 'i.idgoal = g.idgoal');
		if (isset($filter)) {
			if (isset($filter['idgoal'])) {
				$this->db->where('i.idgoal', $filter['idgoal']);
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
			if (isset($filter['district_code'])) {
				$where .= " AND h.iddistrict = '{$filter['district_code']}'";
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

	function getSurveyFormByID($idsurveyform) {
		$this->db->select('s.*');
		$this->db->from('surveyforms AS s');
		$this->db->where('s.idsurveyform', $idsurveyform);
		$query = $this->db->get();
		return $query->row();

	}

	function getSurveyFormIndicators($idsurveyform) {
		$this->db->select('i.idindicator, g.idgroup, s.idsurveyform, o.idoption, i.slug');
		$this->db->from('indicators AS i');
		$this->db->join('surveyformindicators AS si', 'i.idindicator = si.idindicator');
		$this->db->join('groups AS g', 'i.idgroup = g.idgroup');
		$this->db->join('option_groups AS og', 'g.idgroup = og.idgroup');
		$this->db->join('options AS o', 'og.idoption = o.idoption');
		$this->db->join('surveyforms AS s', 'si.idsurveyform = s.idsurveyform');
		$this->db->where('s.idsurveyform', $idsurveyform);
		$query = $this->db->get();
		return $query->result();

	}

	public function insertRows($tbl, $data){
        $query = $this->db->insert_batch($tbl, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

	function deleteRow($tbl, $where){
        $this->db->where($where);
        $query = $this->db->delete($tbl);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

	public function generalQuery($query) {
        $query = $this->db->query($query);
        return $query->result();
    }

	function retriveProvince($district_code){
		$this->db->select("*");
		$this->db->from('districts');
		$this->db->where("district_code" , $district_code);
		$query = $this->db->get();
		return $query->row();
	}

}
