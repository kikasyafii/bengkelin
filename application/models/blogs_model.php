<?php
/***
 * Class Model 
 * Name : Blogs Model
 * file : blogs_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Blogs_model extends CI_Model {

	var $table = 'blog';
	var $komen = 'blog_komen';
	
	function get_blog_query($query, $is_publish, $limit, $start){
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			$this->db->where('user_id', $this->bengkelin_auth->user[0]->user_id);
		}
		
		if (!empty($query)){
			$this->db->like('judul_blog', $query);
			$this->db->or_like('konten', $query);
			$this->db->or_like('users.username', $query);
		}
		
		if (!empty($is_publish)){
			$this->db->where('is_publish', $is_publish);
		}
		
		$this->db->limit($limit,$start);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id','left');
		$this->db->select($this->table.'.*, users.username');
		$this->db->from($this->table);
		$q=$this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_blog_query_cnt($query,$is_publish){
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			$this->db->where('user_id', $this->bengkelin_auth->user[0]->user_id);
		}
		
		if (!empty($query)){
			$this->db->like('judul_blog', $query);
			$this->db->or_like('konten', $query);
			$this->db->or_like('users.username', $query);
		}
		
		if (!empty($is_publish)){
			$this->db->where('is_publish', $is_publish);
		}
		
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id','left');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function add($user_id, $judul_blog, $konten, $is_comment, $is_publish, $date_publish, $time_publish){
		$this->db->insert($this->table, 
		array(
		'user_id' => $user_id, 'judul_blog' => $judul_blog, 'konten' => $konten, 'is_comment' => $is_comment, 'is_publish' => $is_publish, 'date_publish' => $date_publish, 'time_publish' => $time_publish, 'created_time' => date('Y-m-d H:i:s'), 'updated_date' => date('Y-m-d H:i:s')
			)
		);
	}
	
	function edit($blog_id, $judul_blog, $konten, $is_comment, $is_publish, $date_publish, $time_publish){
		$this->db->where('blog_id', $blog_id);
		$this->db->update($this->table, 
			array('judul_blog' => $judul_blog, 'konten' => $konten, 'is_comment' => $is_comment, 'is_publish' => $is_publish, 'date_publish' => $date_publish, 'time_publish' => $time_publish, 'update_date' => date('Y-m-d H:i:s'))
		);
	}
	
	function delete($blog_id){
		$this->db->where('blog_id',$blog_id);
		$this->db->delete($this->table);
	}
	
}
