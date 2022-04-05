<?php 
	
class Front_login_model extends CI_Model {

	public function login_check(){
		$email=$this->input->post('email');
		$password=$this->input->post('password');

		$this->db->select('u.*,r.role_name');
		$this->db->from('users AS u');
		$this->db->join('roles AS r', 'u.idrole = r.idrole');
		$this->db->where('u.status', 2);
		$this->db->where('r.role_name !=', 'Admin');
		$this->db->where('u.email =', $email);
		$result = $this->db->get()->result_array();
		if(count($result)>0){
			
			$enct_password=$this->encryption->decrypt($result[0]['password']);
			if($password == $enct_password && $email == $result[0]['email']){
				//set session
				$user_data = array(
					'name' => $result [0]['fullname'],
					'email' => $result [0]['email'],
					'role_id' => $result [0]['idrole'],
					'role' => $result [0]['role_name'],
					'status	' => $result [0]['status'],
					'permission_region	' => $result [0]['permission_region'],
					'user_validated' => true
				);
				$this->session->set_userdata($user_data); 
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	
}

?>