<?php
/***
 * Class Model 
 * Name : Service Model
 * file : service_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Service_model extends CI_Model {

	var $table = 'bengkel_service';
	
	function get_service_by_bengkel_id($bengkel_id){
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->order_by('service_id', 'DESC');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_service($bengkel_id, $judul_layanan, $konten){
		
		$this->db->insert($this->table, array('bengkel_id' => $bengkel_id, 'judul_layanan' => $judul_layanan, 'konten' => $konten, 'created_date' => date('Y-m-d H:i:s'), 'updated_date' => date('Y-m-d H:i:s')
		)
		);
		return $this->db->insert_id();
	}
	
	function update_service($layanan_id, $judul_layanan, $konten){
		$this->db->where('service_id', $layanan_id);
		$this->db->update($this->table, array(
			'judul_layanan' => $judul_layanan, 'konten' => $konten, 'updated_date' => date('Y-m-d H:i:s')
		));
	}
	
	function delete_service($id){
		$this->db->where('service_id', $id);
		$this->db->delete($this->table);
	}
	
	function get_service_query_all($bengkel_id, $query, $limit, $start){
		
		$this->db->where('bengkel.user_id', $this->bengkelin_auth->user[0]->user_id);
		
		if (!empty($bengkel_id)){
			$this->db->where($this->table.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like($this->table.'.judul_layanan', $query);
			$this->db->or_like($this->table.'.konten', $query);
			$this->db->or_like('bengkel.nama_bengkel', $query);
			$this->db->or_like('bengkel.alamat_bengkel', $query);
		}
		
		$this->db->limit($limit,$start);
		$this->db->order_by('service_id', 'DESC');
		$this->db->join('bengkel','bengkel.bengkel_id = '.$this->table.'.bengkel_id');
		$this->db->from($this->table);
		$this->db->select($this->table.'.service_id,'.$this->table.'.judul_layanan,konten, bengkel.nama_bengkel, bengkel.alamat_bengkel');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
		
	}
	
	function get_service_query_all_cnt($bengkel_id, $query){
		
		$this->db->where('bengkel.user_id', $this->bengkelin_auth->user[0]->user_id);
		
		if (!empty($bengkel_id)){
			$this->db->where($this->table.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like($this->table.'.judul_layanan', $query);
			$this->db->or_like($this->table.'.konten', $query);
			$this->db->or_like('bengkel.nama_bengkel', $query);
			$this->db->or_like('bengkel.alamat_bengkel', $query);
		}
		
		$this->db->join('bengkel','bengkel.bengkel_id = '.$this->table.'.bengkel_id');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	
	function get_service_all($bengkel_id, $query,$limit,$start){
		
		if (!empty($bengkel_id)){
			$this->db->where($this->table.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like($this->table.'.judul_layanan', $query);
			$this->db->or_like($this->table.'.konten', $query);
			$this->db->or_like('bengkel.nama_bengkel', $query);
			$this->db->or_like('bengkel.alamat_bengkel', $query);
		}
		
		$this->db->where('bengkel.user_id',$this->bengkelin_auth->user[0]->user_id);
		
		$this->db->limit($limit,$start);
		$this->db->order_by('service_id', 'DESC');
		$this->db->join('bengkel','bengkel.bengkel_id = '.$this->table.'.bengkel_id');
		$this->db->from($this->table);
		$this->db->select($this->table.'.service_id,'.$this->table.'.judul_layanan,konten, bengkel.nama_bengkel, bengkel.alamat_bengkel,'.$this->table.'.bengkel_id');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_service_all_cnt($bengkel_id, $query){
		
		if (!empty($bengkel_id)){
			$this->db->where($this->table.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like($this->table.'.judul_layanan', $query);
			$this->db->or_like($this->table.'.konten', $query);
			$this->db->or_like('bengkel.nama_bengkel', $query);
			$this->db->or_like('bengkel.alamat_bengkel', $query);
		}
		$this->db->where('bengkel.user_id',$this->bengkelin_auth->user[0]->user_id);
		$this->db->join('bengkel','bengkel.bengkel_id = '.$this->table.'.bengkel_id');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_service_by_id($id){
		$this->db->where('service_id', $id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
}
