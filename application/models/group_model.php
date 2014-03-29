<?php
/***
 * Class Model 
 * Name : Group Model
 * file : group_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Group_model extends CI_Model {

	var $table = 'groups';
	
	function get_groups($name='', $desc=''){
		
		if (!empty($name)){
			$this->db->like('group_name', $name);
		}
		
		if (!empty($desc)){
			$this->db->like('description', $desc);
		}
		
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_group($group_name, $description){
		$this->db->insert($this->table, 
		array('group_name' => $group_name, 'description' => $description)
		);
	}
	
	function edit_group($group_id, $group_name, $description){
		$this->db->where('group_id', $group_id);
		$this->db->update($this->table, array('description' => $description));
	}
	
	function delete_group($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->delete($this->table);
	}
	
	function get_group_by_id($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function if_name_exists($group_name){
		$this->db->where('group_name', $group_name);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function if_group_exists($group_id, $group_name){
		$this->db->where('group_id !=', $group_id);
		$this->db->where('group_name', $group_name);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
