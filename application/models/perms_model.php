<?php
/***
 * Class Model 
 * Name : Perms Model
 * file : perms_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Perms_model extends CI_Model {
	
	var $table = 'perms';
	var $table_group_perms = 'group_perms';
	
	function get_perms(){
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_perms($name, $path, $parent_id, $ordering, $is_active,$icon=''){
		$this->db->insert($this->table, array(
			'class_name' => $name, 'class_path' => $path, 'parent_id' => $parent_id, 'ordering' => $ordering, 'is_active' => $is_active, 'icon' => $icon
		));
	}
	
	function edit_perms($perm_id, $name, $path, $parent_id, $ordering, $is_active,$icon=''){
		$this->db->where('perm_id', $perm_id);
		$this->db->update($this->table, array(
			'class_name' => $name, 'class_path' => $path, 'parent_id' => $parent_id, 'ordering' => $ordering, 'is_active' => $is_active, 'icon'=>$icon
		));
	}
	
	function set_group_perms($group_id, $perm_id){
		$this->db->insert($this->table_group_perms, array('group_id' => $group_id, 'perm_id' => $perm_id));
	}
	
	function delete_perms($perm_id){
		
		if ($perm_id != 0){
			$this->db->where('parent_id', $perm_id);
			$this->db->from($this->table);
			$q = $this->db->get();
			if ($q->num_rows()>0){
				$this->db->where('parent_id', $perm_id);
				$this->db->delete($this->table);
			}
		}
		
		$this->db->where('perm_id', $perm_id);
		$this->db->delete($this->table_group_perms);
		
		
		$this->db->where('perm_id', $perm_id);
		$this->db->delete($this->table);
		
	}
	
	function delete_group_perms($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->delete($this->table_group_perms);
	}

	function get_perm_by_id($perm_id){
		$this->db->where('perm_id', $perm_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_group_perms_by_user($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->join($this->table_group_perms, $this->table_group_perms.'.perm_id = '.$this->table.'.perm_id');
		$this->db->from($this->table);
		$this->db->select($this->table.'.*');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_group_perms($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->from($this->table_group_perms);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function groups_menu($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->from($this->table_group_perms);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			$arrId = array();
			foreach($q->result() as $row){
				$arrId[] = $row->perm_id;
			}
			
			$this->db->where_in('perm_id', $arrId);
			$this->db->from($this->table);
			$q2 = $this->db->get();
			if ($q2->num_rows()>0){
				return $q2->result();
			}else{
				return FALSE;
			}
		}
	}
	
	function get_perms_by_parent_id($parent_id){
		$this->db->where('parent_id', $parent_id);
		$this->db->from($this->table);
		$q =$this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function perms_menu($group_id, $parent=0){
		$str = '<ul class="nav navbar-nav">';
		$result = $this->Perms_model->get_perms_by_parent_id($parent);
		
		if ($result){
			foreach($result as $row){
				$str .= '<li>';
				$str .= '<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">'.$row->class_name.' <b class="caret"></b></a>';
				$str .= '</li>';
				$child = $this->perms_menu($group_id, $row->perm_id);
				
				if ($child){
					if ($parent != 0)
						$str .= '<li class="dropdown">';
					$str .='<ul class="dropdown-menu">';
					$str .= $child;
					if ($parent != 0)
						$str .= '</li>';
					$str .= '</ul>';
				}
			}
		}
		
		$str .= '</ul>';
		
		return $str;
	}
	
	function get_parent_by_class_path($url){
		
		$tmp = explode("index.php/", $url);
		
		if (isset($tmp[1])){
			$tmp2 = explode("/", $tmp[1]);
			
			if (isset($tmp2[1])){
				$strNext = "OR class_path = '".$tmp2[0]."' OR class_path = '".$tmp2[0]."/".$tmp2[1]."'";
			}else if (isset($tmp2[0]) && !isset($tmp2[1])){
				$strNext = "OR class_path = '".$tmp2[0]."'";
			}
			
			$sql = "SELECT * FROM ".$this->table." WHERE class_path = '".$tmp[1]."' $strNext LIMIT 1";
			$q = $this->db->query($sql);
			//echo $this->db->last_query();
			if ($q->num_rows()>0){
				$res = $q->result();
				return array(TRUE, $res[0]->parent_id);
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
