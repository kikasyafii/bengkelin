<?php
/***
 * Class Model 
 * Name : Config Model
 * file : config_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Config_model extends CI_Model {
	
	var $table = 'configuration';
	
	function get_config(){
		
		$q = $this->db->get($this->table);
		if ($q->num_rows()>0){
			$arr = array();
			$result = $q->result();
			foreach($result as $row){
				$arr[$row->config_name] = $row->config_value;
			}
			return $arr;
		}else{
			return FALSE;
		}
	}
	
	function set_configuration($config_name,$config_value){
		$this->db->where('config_name', $config_name);
		$this->db->update($this->table, array('config_value' => $config_value));
	}
	
	function get_config_value($name){
		$this->db->where('config_name',$name);
		$q= $this->db->get($this->table);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
}
