<?php

class Listing_model extends CI_Model {


//================= Count Number Of Records ==================//
	public function getCounts($table, $where=NULL, $select=NULL){
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
//=============Listing all the data in dropdowns=============//

	public function dropdown_1($table , $field,$where=NULL, $order=NULL)
	{
		$this->db->select('*');
		if($where){
			$this->db->where($where);
		}
		if($order){
			$this->db->order_by('id', $order);
			}
		$records=$this->db->get($table);
		$data=array();
		foreach($records->result() as $row)
		{
			$data[$row->id] = $row->atlas_code.' - '.$row->$field;
		}
		return ($data);
	}

	public function dropdown($table , $field,$where=NULL, $order=NULL, $order_by=NULL)
	{
		$this->db->select('*');
		if($where){
			$this->db->where($where);
		}
		if($order){
			$this->db->order_by('id', $order);
		}
		if($order_by){
			$this->db->order_by($order_by['id'], $order_by['order']);
		}
		$records=$this->db->get($table);
		$data=array();
		foreach($records->result() as $row)
		{
			if(is_array($field)){
				$data[$row->id] = $row->$field[0].' '.$row->$field[1];
			} else {
				$data[$row->id] = $row->$field;
			}
		}
		return ($data);
	}

//================== dropdown listing ends==================//


//=============Update record of table function starts=============//
	public function update_record($table, $id, $arr){
		$this->db->where('id', $id);
		$update=$this->db->update($table, $arr);
		//echo $this->db->last_query(); exit;
	}
//=============Update record of table function ends===============//

//=============Get single record of table function starts=============//
	public function get_record($table, $field, $where=NULL, $order_by=NULL, $range=NULL){
		if($range){
			$this->db->select($range);
		}
		if($where){
			$this->db->where($where);
		}
		if($order_by!=NULL){
			$this->db->order_by($order_by, 'desc');
		}
		$record=$this->db->get($table)->row();
		if($record){
			return $record->$field;
		}
		//echo $this->db->last_query(); exit;
	}
//=============Get single record of table function ends===============//

	//=============getlocation function starts=============//
	public function get_by_limit($table,$limit,$start)
	{
		$records = $this->db->get($table,$limit,$start)->result_array();
		//echo $this->db->last_query(); exit;
		return $records;
	}
	//=============getlocation function ends=============//


//=============List all records function starts=============//
	public function fetchall($table, $arr=NULL, $range=NULL, $where=NULL, $groupby=NULL, $order=NULL,$gJoin=NULL,$limit=-1,$offset=-1)
		{
		if($range){
			$this->db->select($range,false);
		}else{
			$this->db->select('*',false);
		}
		if($arr){
			$this->db->join($arr['table'], $table.'.'.$arr['id'].' = '.$arr['table'].'.'.'id','left outer');
		}
		if($gJoin){
            $this->db->join($gJoin['table'], $table.'.'.$gJoin['fID'].'='.$gJoin['table'].'.'.$gJoin['sID'],'left');
        }
		if($where){
			$this->db->where($where);
		}
		if($limit > -1 && $offset > -1){
			$this->db->limit($limit,$offset);
		}
		if($groupby){
			$this->db->group_by($groupby);
		}

		if($order){
			$this->db->order_by($order['id'], $order['order']);
		}
		$records = $this->db->get($table)->result_array();
		//echo $this->db->last_query(); exit;
		return $records;
		}
//=============List all records function ends=============//



//============== Function to fetch a row starts===========//
	public function get_info($tablename, $id, $field=NULL,$fullfield = NULL,$order_by=NULL){
		if($fullfield){
			$this->db->where($fullfield);
		} else {
			if($field){
				$this->db->where($field, $id);
			}else{
				$this->db->where('id', $id);
			}
		}
		if($order_by!=NULL){
			$this->db->order_by($order_by, 'desc');
		}
		$query = $this->db->get($tablename)->row_array();
		//echo $this->db->last_query(); exit;
		return $query;
	}
//============== Function to fetch row ends===========//



//=============Delete record from table function starts=============//
	public function delete_record($table, $id, $field=NULL){
		if($field){
		$this->db->where($field, $id);
		}else{
		$this->db->where('id', $id);
		}
		$delete=$this->db->delete($table);
	}
//=============Delete record from table function ends===============//


//============== Function to add/edit record starts===========//
	public function insert_update($tablename, $data, $id=NULL, $where=NULL){
		//$this->db->trans_start();
		if($id){
			if($where){
				$this->db->where($where);
			}else{
				$this->db->where('id', $id);
			}
			$query = $this->db->update($tablename, $data);
			//echo $this->db->last_query(); exit;
			$this->session->set_userdata(array('msg'=>'Record Updated'));
			return true;
		}else{
			$query = $this->db->insert($tablename, $data);

			//$id = $this->db->insert_id();
			//echo $this->db->last_query(); exit;

			return $id;
		}
	}


	public function get_records($table,$where, $order_by=NULL, $range=NULL){
		if($range){
			$this->db->select($range,false);
		}else{
			$this->db->select('*',false);
		}
		$this->db->from($table);
		if($where){
			$this->db->where($where);
		}
		if($order_by!=NULL){
			$this->db->order_by($order_by, 'asc');
		}
		return $res = $this->db->get()->result_array();
	}
	public function email_check($email, $table, $rest_id = NULL){
		$this->db->select('id');
		$this->db->from($table);
		$this->db->where('email', $email);
		if($rest_id != NULL){
			$this->db->where('rest_id', $rest_id);
		}
		$num_results = $this->db->count_all_results();
		if($num_results == 1){
			return true;
		}else{
			return false;
		}

    }
    public function username_check($username, $table){
		$this->db->select('id');
		$this->db->from($table);
		$this->db->where('username', $username);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	public function get_allCom_subCom(){
		$query = "select sub.*,com.component_name,sub.status as substatus
		from subcomponents sub
		inner join components com
		on sub.idcomponent = com.idcomponent";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}
	public function get_indicator_data($where = NULL){
		$whereCond = '';
		if($where){
			$whereCond = ' WHERE '.$where;
		}
		$query = "select ind.idindicator, ind.name as ind_name,ind.status, g.name as goalname, subcom.subcomponent_name as subcompname from indicators ind
			inner join
			goals g on ind.idgoal=g.idgoal
			inner join
			subcomponents subcom
			on g.idsubcomponent=subcom.idsubcomponent" .$whereCond. " order by ind.created_at DESC";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}

	public function get_indicator_list($where = NULL){
		$whereCond = '';
		if($where){
			$whereCond = ' WHERE '.$where;
		}
		$query = "select ind.idindicator, ind.name as ind_name,ind.status, g.name as goalname,subcom.subcomponent_name as subcompname from indicators ind
			inner join
			goals g on ind.idgoal=g.idgoal
			inner join
			subcomponents subcom
			on g.idsubcomponent=subcom.idsubcomponent" .$whereCond. " order by ind.created_at DESC";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}
	public function get_indicator_count($where = NULL){
		$whereCond = '';
		if($where){
			$whereCond = ' WHERE '.$where;
		}
		$query = "select count(ind.idindicator) as total from indicators ind
			inner join
			goals g on ind.idgoal=g.idgoal
			inner join
			subcomponents subcom
			on g.idsubcomponent=subcom.idsubcomponent" .$whereCond;
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}

	public function get_all_goal_data(){
		$query = "select g.idgoal, g.name as goalname,subcom.subcomponent_name as subcompname,g.status from
			goals g
			inner join
			subcomponents subcom
			on g.idsubcomponent=subcom.idsubcomponent
			order by g.created_at DESC";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}
	public function get_all_linkages(){
		$query = "select int.type as inttype, int.idintegration, int.link,int.status as integration_status,pro.province_name,sub.subcomponent_name,com.component_name,com.type,sub.status as substatus
		from integrations int
		left outer join subcomponents sub on int.idsubcomponent=sub.idsubcomponent
		inner join components com
		on sub.idcomponent = com.idcomponent
		left join provinces pro on int.province_code=pro.province_code";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}

	public function getIndicatorCount($surveryFormId){
		$query = "select count(*) as total from indicators ind
			inner join
			surveyformindicators sf on ind.idindicator=sf.idindicator
			WHERE sf.idsurveyform =  '".$surveryFormId."' ";
		$result = $this->db->query($query);
		$res_arr = $result->row_array();
		return $res_arr;
	}

	public function getIndicatorList($surveryFormId){
		$query = "select DISTINCT(ind.name) as name from indicators ind
			inner join
			surveyformindicators sf on ind.idindicator=sf.idindicator
			WHERE sf.idsurveyform =  '".$surveryFormId."' ";
		$result = $this->db->query($query);
		$res_arr = $result->result_array();
		return $res_arr;
	}

}
