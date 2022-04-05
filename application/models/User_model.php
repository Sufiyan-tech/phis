<?php 
	
class User_model extends CI_Model {

	
	function getUserList(){
		$this->db->select('u.iduser, u.fullname,u.permission_region, u.email, u.status, u.organization_name, r.role_name, c.value as cname');
		$this->db->from('users AS u');
		$this->db->join('roles AS r', 'u.idrole = r.idrole');
		$this->db->join('country AS c', 'c.countryid = u.country', 'LEFT');
		$query = $this->db->get();
		return $query->result_array();
	}
}

?>