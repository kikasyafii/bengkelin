<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Class Model 
 * Name : Partner Model
 * file : partner_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Partner_model extends CI_Model {

	var $table = 'partner';
	
	function get_partner($query,$limit,$start){
		
		if (!empty($query)){
			$this->db->like('nama_partner', $query);
			$this->db->or_like('deskripsi', $query);
		}
		
		$this->db->limit($limit,$start);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_partner_cnt($query){
		if (!empty($query)){
			$this->db->like('nama_partner', $query);
			$this->db->or_like('deskripsi', $query);
		}
		
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_partner_by_id($partner_id){
		
		$this->db->where('partner_id', $partner_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add($nama, $name_file, $thumb_file, $deskripsi, $is_active){
		$this->db->insert($this->table, array(
			'nama_partner' => $nama, 'name_file' => $name_file, 'thumb_file' => $thumb_file, 'deskripsi' => $deskripsi, 'is_active' => $is_active
			)
		);
	}
	
	function edit($partner_id, $nama, $nama_file, $thumb_file, $deskripsi, $is_active){
		$this->db->where('partner_id', $partner_id);
		
		if ($nama_file == ''){
			$array = array('nama_partner' => $nama, 'deskripsi' => $deskripsi, 'is_active' => $is_active);
		}else{
			$array = array('nama_partner' => $nama, 'name_file' => $nama_file, 'thumb_file' => $thumb_file, 'deskripsi' => $deskripsi, 'is_active' => $is_active);
		}
		
		$this->db->update($this->table, $array);
	}
	
	function delete($partner_id){
		$this->db->where('partner_id',$partner_id);
		$this->db->delete($this->table);
	}
	
	function get_partner_all(){
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
}
