<?php

class Main_model extends CI_Model {

	public function get_all_components(){
		if($where){
			$this->db->where($where);
		}
		$this->db->from($table);
		if($select){
			$this->db->select($select);
			return $this->db->get()->num_rows();
			}
			return $this->db->count_all_results();
	}

	public function get_comp_provinces($comp_id){
		$query = "select i.link,i.type,i.roles,pro.name, i.code
				from integrations i
				inner join popups pro
				on i.province_code=pro.id
				where i.idsubcomponent= '".$comp_id."' ";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}
	function getCampaignYears($filter){
		$this->db->select('c.*');
		$this->db->from('campaigns AS c');
		$this->db->join('surveyforms AS s', 'c.idsurveyform = s.idsurveyform');
		if (isset($filter)) {
			if (isset($filter['idsurvey'])) {
				$this->db->where('s.idsubcomponent', $filter['idsubcomponent']);
			}
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	function getDashboardComponent($filter){
		$this->db->select('s.*, i.is_province');
		$this->db->from('subcomponents AS s');
		$this->db->join('integrations AS i', 's.idsubcomponent = i.idsubcomponent');
		if (isset($filter)) {
			if (isset($filter['idsubcomp'])) {
				$this->db->where('s.idcomponent', $filter['idcomponent']);
			}
		}
		$this->db->where('s.status', 2);
		$this->db->group_by(array("s.idsubcomponent", "is_province", "s.subcomponent_name"));
		$this->db->order_by("sort", 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}
	function getDistrictByProvince($pro_id){
		$query = "select *
				from districts dist
				where LEFT(dist.district_code::TEXT, 1)::INT =" .$pro_id;
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}
}

?>
