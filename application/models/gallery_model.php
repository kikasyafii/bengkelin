<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Users
 * Class Name Users
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Gallery_model extends CI_Model {
	
	var $table = 'gallery';
	var $layanan = 'gallery_layanan';
	var $produk = 'gallery_produk';
	
	function __construct(){
		parent::__construct();
		
	}
	
	function get_image_by_user_id($user_id){
		if ($user_id != 0){
			$this->db->where('user_id', $user_id);
			$this->db->from($this->table);
			$q = $this->db->get();
			if ($q->num_rows()>0){
				return $q->result();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	function get_image_by_bengkel_id($bengkel_id){
		
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_image_by_id($gallery_id){
		$this->db->where('gallery_id', $gallery_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_image_profile(){
	}
	
	function save_image_profile($user_id, $name_file, $thumb_file){
		
		$this->db->insert($this->table, 
		array(
			'user_id' => $user_id, 'name_file' => $name_file, 'thumb_file' => $thumb_file, 'is_active' => 1
			)
		);
	}
	
	function save_image_bengkel($bengkel_id, $name_file, $thumb_file){
		$this->db->insert($this->table, 
		array(
			'bengkel_id' => $bengkel_id, 'name_file' => $name_file, 'thumb_file' => $thumb_file
			)
		);
	}
	
	function save_image_layanan($bengkel_id, $layanan_id, $file, $thumb){
		$this->db->insert($this->layanan, 
			array('bengkel_id' => $bengkel_id, 'layanan_id' => $layanan_id, 'file_layanan' => $file, 'thumb_layanan' => $thumb
			)
		);
	}
	
	function save_image_produk($bengkel_id, $produk_id, $file, $thumb){
		$this->db->insert($this->produk, 
			array('bengkel_id' => $bengkel_id, 'produk_id' => $produk_id, 'file_produk' => $file, 'thumb_produk' => $thumb
			)
		);
	}
	
	function edit_image(){
	}
	
	function get_profpic($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('is_active', 1);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function set_active($user_id, $gallery_id){
		$this->db->where('user_id', $user_id);
		$this->db->update($this->table, array('is_active' => 0));
		
		$this->db->where('user_id', $user_id);
		$this->db->where('gallery_id', $gallery_id);
		$this->db->update($this->table, array('is_active' => 1));
	}
	
	function set_all_inactive($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->update($this->table, array('is_active' => 0));
	}
	
	function set_inactive($user_id, $gallery_id){
		$this->db->where('user_id', $user_id);
		$this->db->update($this->table, array('is_active' => 0));
		
		$this->db->where('user_id', $user_id);
		$this->db->where('gallery_id', $gallery_id);
		$this->db->update($this->table, array('is_active' => 0));
	}
	
	function delete_image($user_id, $gallery_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('gallery_id', $gallery_id);
		$this->db->delete($this->table);
	}
	
	function delete_image_bengkel($bengkel_id, $gallery_id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->where('gallery_id', $gallery_id);
		$this->db->delete($this->table);
	}
	
	function get_main_image_bengkel($bengkel_id){
		$this->db->limit(1);
		$this->db->order_by("RAND()");
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_gallery_profile_by_user_and_pic($user_id, $gallery_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('gallery_id',$gallery_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function delete_all_inactive($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('is_active',0);
		$this->db->delete($this->table);
	}
	
	function get_image_layanan_by_id($layanan_id){
		$this->db->limit(1);
		$this->db->where('layanan_id', $layanan_id);
		$this->db->from($this->layanan);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_image_produk_by_id($produk_id){
		$this->db->limit(1);
		$this->db->where('produk_id', $produk_id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_gallery_layanan($bengkel_id, $layanan_id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->where('layanan_id', $layanan_id);
		$this->db->from($this->layanan);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_gallery_produk($bengkel_id, $produk_id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->where('produk_id', $produk_id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_gallery_by_id($id){
		$this->db->where('id', $id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_produk_by_id($id){
		$this->db->where('produk_id', $id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_layanan_by_id($id){
		$this->db->where('id', $id);
		$this->db->from($this->layanan);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function delete_produk($id){
		$this->db->where('id', $id);
		$this->db->delete($this->produk);
	}
	
	function delete_layanan($id){
		$this->db->where('id', $id);
		$this->db->delete($this->layanan);
	}
}
