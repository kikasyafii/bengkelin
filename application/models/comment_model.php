<?php
/***
 * Class Model 
 * Name : Comment Model
 * file : comment_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Comment_model extends CI_Model {

	var $testimoni = 'bengkel_testimoni';
	var $komen_status = 'komen_status';
	
	function get_testimoni($bengkel_id){
		$this->db->where('approved', 1);
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->from($this->testimoni);
		$this->db->select('testimoni_id, bengkel_id, approved, nama, email, website, konten, DATE_FORMAT(date_testimoni, \'%d-%m-%Y %H:%i\') as tanggal',false);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_testimoni($bengkel_id, $nama, $email, $konten, $website){
		$this->db->insert($this->testimoni, array(
			'bengkel_id' => $bengkel_id, 'nama' => $nama, 'email' => $email, 'website' => $website, 'konten' => $konten, 'date_testimoni' => date('Y-m-d H:i:s')
		));
	}
	
	function delete_testimoni($testimoni_id){
		$this->db->where('testimoni_id', $testimoni_id);
		$this->db->delete($this->testimoni);
	}
	
	function get_testimoni_all($query, $limit, $start){
		
		if (!empty($query)){
			$this->db->like('nama', $query);
			$this->db->or_like($this->testimoni.'.email', $query);
			$this->db->or_like('website', $query);
			$this->db->or_like('konten', $query);
			$this->db->or_like('bengkel.nama_bengkel',$query);
		}
		
		$this->db->order_by('testimoni_id', 'DESC');
		$this->db->where('approved', 1);
		$this->db->limit($limit,$start);
		$this->db->join('bengkel', 'bengkel.bengkel_id = '.$this->testimoni.'.bengkel_id','left');
		$this->db->from($this->testimoni);
		$this->db->select('testimoni_id, '.$this->testimoni.'.bengkel_id, approved, nama, '.$this->testimoni.'.email, website, konten, date_testimoni');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_testimoni_all_cnt($query){
		
		if (!empty($query)){
			$this->db->like('nama', $query);
			$this->db->or_like($this->testimoni.'.email', $query);
			$this->db->or_like('website', $query);
			$this->db->or_like('konten', $query);
			$this->db->or_like('bengkel.nama_bengkel',$query);
		}
		
		$this->db->where('approved', 1);
		$this->db->join('bengkel', 'bengkel.bengkel_id = '.$this->testimoni.'.bengkel_id','left');
		$this->db->from($this->testimoni);
		$cnt = $this->db->count_all_results();
		return $cnt;
	}
	
	function edit_testimoni($id, $nama, $email, $website, $konten, $approved){
		$this->db->where('testimoni_id', $id);
		$this->db->update($this->testimoni, array(
			'nama' => $nama, 'email' => $email, 'website' => $website, 'konten' => $konten, 'approved' => $approved
		));
	}
	
	function get_top_ten(){
		$this->db->limit(10);
		$this->db->where('approved', 1);
		$this->db->join('bengkel', 'bengkel.bengkel_id = '.$this->testimoni.'.bengkel_id','left');
		$this->db->from($this->testimoni);
		$this->db->select($this->testimoni.'.nama,'.$this->testimoni.'.email, '.$this->testimoni.'.website, '.$this->testimoni.'.konten, DATE_FORMAT('.$this->testimoni.'.date_testimoni, \'%d/%m/%Y\') as tanggal, bengkel.nama_bengkel, bengkel.slug, bengkel.alamat_bengkel, bengkel.city',false);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_random(){
		$query = "SELECT ".$this->testimoni.".nama, ".$this->testimoni.".email,".$this->testimoni.".website,".$this->testimoni.".konten, DATE_FORMAT(".$this->testimoni.".date_testimoni, '%d/%m/%Y') as tanggal, bengkel.nama_bengkel, bengkel.slug, bengkel.alamat_bengkel, bengkel.city FROM ".$this->testimoni." 
		LEFT JOIN bengkel ON bengkel.bengkel_id = ".$this->testimoni.".bengkel_id WHERE approved = 1
		ORDER BY RAND() LIMIT 2";
		$q = $this->db->query($query);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_testimoni_by_id($id){
		
		$this->db->where('testimoni_id',$id);
		$this->db->from($this->testimoni);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function testimoni_query($bengkel_id, $query, $limit, $start){
		
		$this->db->where('bengkel_id', $bengkel_id);
		
		$this->db->limit($limit, $start);
		
		if (!empty($query)){
			$this->db->like('nama', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('website', $query);
			$this->db->or_like('konten', $query);
		}
		
		$this->db->order_by('testimoni_id', 'DESC');
		$this->db->from($this->testimoni);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function testimoni_query_cnt($bengkel_id, $query){
		
		$this->db->where('bengkel_id', $bengkel_id);
		
		if (!empty($query)){
			$this->db->like('nama', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('website', $query);
			$this->db->or_like('konten', $query);
		}
		
		$this->db->from($this->testimoni);
		$cnt = $this->db->count_all_results();
		return $cnt;
	}
	
	function user_edit($bengkel_id, $id,$nama, $website, $email, $konten, $approved){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->where('testimoni_id', $id);
		$this->db->update($this->testimoni, array('nama' => $nama, 'website' => $website, 'email' =>$email, 'konten' => $konten, 'approved' => $approved));
	}
	
	function user_delete($bengkel_id, $id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->where('testimoni_id', $id);
		
		$this->db->delete($this->testimoni);
	}
}
