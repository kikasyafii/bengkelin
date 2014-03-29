<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Pages
 * Class Name Pages
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Promo_model extends CI_Model {
	
	var $table = 'promo';
	
	function __construct(){
		parent::__construct();
	}
	
	function get_promo($judul_promo, $query, $limit, $start){
		
		if (!empty($judul_promo)){
			$this->db->like('judul_promo', $judul_promo);
		}
		
		if (!empty($query)){
			$this->db->like('sinopsis', $query);
			$this->db->or_like('content', $query);
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
	
	function get_promo_cnt($judul_promo, $query){
		if (!empty($judul_promo)){
			$this->db->like('judul_promo', $judul_promo);
		}
		
		if (!empty($query)){
			$this->db->like('sinopsis', $query);
			$this->db->or_like('content', $query);
		}
		
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		return $cnt;
	}
	
	function add_promo($judul_promo, $sinopsis, $content, $file, $thumb){
		$this->db->insert($this->table, array('judul_promo' => $judul_promo, 'sinopsis' => $sinopsis, 'content' => $content, 'file_promo' => $file, 'file_thumb' => $thumb));
	}
	
	function edit_promo($promo_id,$judul_promo, $sinopsis, $content, $file='', $thumb=''){
		$this->db->where('promo_id', $promo_id);
		if ($file == ''){
			$array = array('judul_promo' => $judul_promo, 'sinopsis' => $sinopsis, 'content' => $content);
		}else{
			$array = array('judul_promo' => $judul_promo, 'sinopsis' => $sinopsis, 'content' => $content, 'file_promo' => $file, 'file_thumb' => $thumb);
		}
		
		$this->db->update($this->table, $array);
	}
	
	function delete($promo_id){
		$this->db->where('promo_id', $promo_id);
		$this->db->delete($this->table);
	}
	
	function get_promo_by_id($promo_id){
		$this->db->where('promo_id', $promo_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_promo_welcome(){
		$this->db->limit(5);
		$this->db->order_by('promo_id', 'DESC');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
}
