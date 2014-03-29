<?php
/***
 * Class Model 
 * Name : Bengkel Model
 * file : bengkel_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class Bengkel_model extends CI_Model {
	
	var $table = 'bengkel';
	var $table_jenis = 'jenis_bengkel';
	var $produk = 'bengkel_produk';
	
	function get_bengkel($username, $nama_bengkel, $alamat_bengkel, $city, $propinsi, $zippostal, $email, $telp, $limit, $start){
		
		$arrVar = array('nama_bengkel', 'alamat_bengkel', 'city', 'propinsi', 'zippostal', 'email', 'telp');
		
		foreach($arrVar as $var){
			if (!empty($$var)){
				$this->db->like($var, $$var);
			}
		}
		
		if (!empty($username)){
			$this->db->like('users.username', $username);
		}
		
		//$this->db->where($this->table.'.user_id !=',0);
		
		$this->db->limit($limit, $start);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id');
		$this->db->from($this->table);
		$this->db->select($this->table.'.*, users.username,'.$this->table_jenis.'.nama_jenis');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_cnt($username, $nama_bengkel, $alamat_bengkel, $city, $propinsi, $zippostal, $email, $telp){
		$arrVar = array( 'nama_bengkel', 'alamat_bengkel', 'city', 'propinsi', 'zippostal', 'email', 'telp');
		
		foreach($arrVar as $var){
			if (!empty($$var)){
				$this->db->like($var, $$var);
			}
		}
		
		if (!empty($username)){
			$this->db->like('users.username', $username);
		}
		
		//$this->db->where($this->table.'.user_id !=',0);
		
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id','left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_bengkel_by_user_id($user_id){
		
		$this->db->where($this->table.'.user_id', $user_id);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.*, users.username,'.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_detail_bengkel($bengkel_id){
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.*, '.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_by_username($username){
		
		$this->db->where('users.username', $username);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.*, users.username,'.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_bengkel($user_id, $jenis_id, $nama_bengkel, $alamat_bengkel, $city, $propinsi, $country, $zippostal, $telp, $fax, $email, $deskripsi){
		
		$slug = $this->set_slug($nama_bengkel);
		
		$this->db->insert($this->table, array(
			'user_id' => $user_id, 'jenis_id' =>$jenis_id, 'nama_bengkel' => $nama_bengkel, 'alamat_bengkel' => $alamat_bengkel, 'city' => $city, 'country' => $country, 'zippostal' => $zippostal, 'telp' => $telp, 'fax' => $fax, 'email' => $email, 'deskripsi' => $deskripsi, 'created_date' => date('Y-m-d H:i:s'), 'updated_date' => date('Y-m-d H:i:s'), 'slug' => $slug
		));
	}
	
	function edit_bengkel($bengkel_id, $user_id, $jenis_id, $nama_bengkel, $alamat_bengkel, $city, $propinsi, $country, $zippostal, $telp, $fax, $email, $deskripsi){
		
		$slug = $this->set_slug($nama_bengkel);
		
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->update($this->table, array(
			'user_id' => $user_id, 'jenis_id' => $jenis_id, 'nama_bengkel' => $nama_bengkel, 'alamat_bengkel' => $alamat_bengkel,'propinsi' =>$propinsi, 'city' => $city, 'country' => $country, 'zippostal' => $zippostal, 'telp' => $telp, 'fax' => $fax, 'email' => $email, 'deskripsi' => $deskripsi, 'updated_date' => date('Y-m-d H:i:s'), 'slug' => $slug
			)
		);
	}
	
	function set_slug($nama_bengkel){
		
		$slug = url_title($nama_bengkel);
		
		$this->db->where('slug', $slug);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			$nextcnt = $q->num_rows();
			if ($nama_bengkel == ''){
				$q2 = $this->db->query("SELECT MAX(bengkel_id) as maxid FROM ".$this->bengkel);
				$row = $q2->result();
				$maxid = $row[0]->maxid;
				return ($maxid+1);
			}else{
				return $slug.'-'.($nextcnt + 1);
			}
		}else{
			return $slug;
		}
	}
	
	
	function delete_bengkel($bengkel_id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->delete($this->table);
	}
	
	function get_bengkel_by_id($bengkel_id){
		$this->db->where($this->table.'.bengkel_id', $bengkel_id);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.*, users.username,'.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_baru(){
		
		//$this->db->where($this->table.'.user_id !=',0);
		$this->db->limit(5);
		$this->db->order_by('bengkel_id', 'desc');
		//$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.*,'.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function save_lat_lng($bengkel_id, $lat, $lng){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->update($this->table, 
			array('latitude' => $lat, 'longitude' => $lng)
		);
	}
	
	function insert_bengkel(){
		$this->db->where('user_id', $this->bengkelin_auth->user[0]->user_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows() == 0){
			$this->db->insert($this->table, array('user_id' => $this->bengkelin_auth->user[0]->user_id));
		}
	}
	
	function get_jenis_bengkel(){
		$q =$this->db->get($this->table_jenis);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_profile($jenis_id, $nama, $alamat, $kota, $propinsi, $negara, $telp, $limit, $start){
		
		if (!empty($jenis_id)){
			$this->db->where('jenis_id', $jenis_id);
		}else{
			$this->db->where_in('jenis_id', array(1,2));
		}
		
		if (!empty($nama)){
			$this->db->like('nama_bengkel', $nama);
		}
		
		if (!empty($nama)){
			$this->db->like('country', $negara);
		}
		
		if (!empty($telp)){
			$this->db->like('telp', $telp);
		}
		
		if (!empty($alamat)){
			$this->db->like('alamat_bengkel', $alamat);
		}
		
		if (!empty($kota)){
			$this->db->like($this->table.'.city', $kota);
		}
		
		if (!empty($propinsi)){
			$this->db->like($this->table.'.propinsi', $propinsi);
		}
		
		$this->db->limit($limit,$start);
		//$this->db->join('gallery', 'gallery.bengkel_id = '.$this->table.'.bengkel_id', 'left');
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$this->db->select($this->table.'.bengkel_id,'.$this->table.'.jenis_id, '.$this->table.'.nama_bengkel, '.$this->table.'.slug, '.$this->table.'.alamat_bengkel, '.$this->table.'.city, '.$this->table.'.country, '.$this->table.'.propinsi, '.$this->table.'.email, '.$this->table.'.telp, '.$this->table.'.zippostal, '.$this->table.'.nama_bengkel, '.$this->table.'.deskripsi, '.$this->table.'.latitude, '.$this->table.'.longitude, '.$this->table.'.counter, '.$this->table.'.fax, users.username, users.facebook, users.twitter,users.path, users.linkedin, users.gplus');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
		
	}
	
	function get_bengkel_profile_cnt($jenis_id, $nama, $alamat, $kota, $propinsi, $negara, $telp){
		if (!empty($jenis_id)){
			$this->db->where('jenis_id', $jenis_id);
		}else{
			$this->db->where_in('jenis_id', array(1,2));
		}
		
		if (!empty($telp)){
			$this->db->where('telp', $telp);
		}
		
		if (!empty($nama)){
			$this->db->like('nama_bengkel', $nama);
		}
		
		if (!empty($alamat)){
			$this->db->like('alamat_bengkel', $alamat);
		}
		
		if (!empty($kota)){
			$this->db->like($this->table.'.city', $kota);
		}
		
		if (!empty($propinsi)){
			$this->db->like($this->table.'.propinsi', $propinsi);
		}
		
		if (!empty($negara)){
			$this->db->like('country', $negara);
		}
		
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_showroom_profile($jenis_id, $nama, $alamat, $kota, $propinsi, $negara, $telp, $limit, $start){
		
		if (!empty($jenis_id)){
			$this->db->where('jenis_id', $jenis_id);
		}else{
			$this->db->where_in('jenis_id', array(3,4));
		}
		
		if (!empty($nama)){
			$this->db->like('nama_bengkel', $nama);
		}
		
		if (!empty($nama)){
			$this->db->like('country', $negara);
		}
		
		if (!empty($telp)){
			$this->db->like('telp', $telp);
		}
		
		if (!empty($alamat)){
			$this->db->like('alamat_bengkel', $alamat);
		}
		
		if (!empty($kota)){
			$this->db->like($this->table.'.city', $kota);
		}
		
		if (!empty($propinsi)){
			$this->db->like($this->table.'.propinsi', $propinsi);
		}
		
		$this->db->limit($limit,$start);
		//$this->db->join('gallery', 'gallery.bengkel_id = '.$this->table.'.bengkel_id', 'left');
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$this->db->select($this->table.'.bengkel_id,'.$this->table.'.jenis_id, '.$this->table.'.slug, '.$this->table.'.nama_bengkel, '.$this->table.'.alamat_bengkel, '.$this->table.'.city, '.$this->table.'.country, '.$this->table.'.propinsi, '.$this->table.'.email, '.$this->table.'.telp, '.$this->table.'.zippostal, '.$this->table.'.nama_bengkel, '.$this->table.'.deskripsi, '.$this->table.'.latitude, '.$this->table.'.longitude, '.$this->table.'.counter, '.$this->table.'.fax, users.username, users.facebook, users.twitter,users.path, users.linkedin, users.gplus');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
		
	}
	
	function get_showroom_profile_cnt($jenis_id, $nama, $alamat, $kota, $propinsi, $negara, $telp){
		
		if (!empty($jenis_id)){
			$this->db->where('jenis_id', $jenis_id);
		}else{
			$this->db->where_in('jenis_id', array(3,4));
		}
		
		if (!empty($telp)){
			$this->db->where('telp', $telp);
		}
		
		if (!empty($nama)){
			$this->db->like('nama_bengkel', $nama);
		}
		
		if (!empty($alamat)){
			$this->db->like('alamat_bengkel', $alamat);
		}
		
		if (!empty($kota)){
			$this->db->like($this->table.'.city', $kota);
		}
		
		if (!empty($propinsi)){
			$this->db->like($this->table.'.propinsi', $propinsi);
		}
		
		if (!empty($negara)){
			$this->db->like('country', $negara);
		}
		
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function random_bengkel(){
		
		$query = "SELECT ".$this->table.".*, users.username FROM ".$this->table." LEFT JOIN users ON ".$this->table.".user_id = users.user_id WHERE nama_bengkel != '' AND ".$this->table.".user_id != 0 ORDER BY RAND() LIMIT 10";
		
		$q = $this->db->query($query);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function bengkel_few(){
		
		$this->db->limit(12);
		$this->db->order_by('bengkel_id', 'desc');
		$this->db->where("nama_bengkel != ''");
		//$this->db->where($this->table.'.user_id !=' , 0);
	//	$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$this->db->select($this->table.'.bengkel_id,'.$this->table.'.jenis_id,'.$this->table.'.slug, '.$this->table.'.nama_bengkel, '.$this->table.'.alamat_bengkel, '.$this->table.'.city, '.$this->table.'.country, '.$this->table.'.propinsi, '.$this->table.'.email, '.$this->table.'.telp, '.$this->table.'.zippostal, '.$this->table.'.nama_bengkel, '.$this->table.'.deskripsi, '.$this->table.'.latitude, '.$this->table.'.longitude, '.$this->table.'.counter, '.$this->table.'.fax');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function bengkel_cities(){
		
		$query = "SELECT city, COUNT(*) as CNT FROM ".$this->table." WHERE city != '' GROUP BY 1 LIMIT 7";
		
		$q = $this->db->query($query);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_by_city($city, $limit, $start){
		$this->db->limit($limit, $start);
		$this->db->where('city', $city);
		//$this->db->where($this->table.'.user_id !=',0);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_by_city_cnt($city){
		$this->db->where('city', $city);
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
	}
	
	function get_bengkel_query($query, $jenis_id, $limit, $start){
		
		if (!empty($query)){
			$this->db->like('users.username', $query);
			$this->db->or_like('nama_bengkel', $query);
			$this->db->or_like('alamat_bengkel', $query);
			$this->db->or_like('city', $query);
			$this->db->or_like('propinsi', $query);
			$this->db->or_like('country', $query);
			$this->db->or_like('telp', $query);
			$this->db->or_like('fax', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('deskripsi', $query);
		}
		
		//$this->db->where($this->table.'.user_id !=',0);
		
		if ($jenis_id > 0){
			$this->db->where($this->table.'.jenis_id', $jenis_id);
		}
		
		$this->db->limit($limit, $start);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id','left');
		$this->db->from($this->table);
		$q = $this->db->get();
		//echo $this->db->last_query();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_query_cnt($query,$jenis_id){
		
		if (!empty($query)){
			$this->db->like('users.username', $query);
			$this->db->or_like('nama_bengkel', $query);
			$this->db->or_like('alamat_bengkel', $query);
			$this->db->or_like('city', $query);
			$this->db->or_like('propinsi', $query);
			$this->db->or_like('country', $query);
			$this->db->or_like('telp', $query);
			$this->db->or_like('fax', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('deskripsi', $query);
		}
		
		//$this->db->where($this->table.'.user_id !=',0);
		
		if ($jenis_id > 0){
			$this->db->where($this->table.'.jenis_id', $jenis_id);
		}
		
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id','left');
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function inc_counter($bengkel_id){
		$this->db->where('bengkel_id', $bengkel_id);
		$this->db->set('counter', 'counter + 1', false);
		$this->db->update($this->table);
	}
	
	function get_popular_bengkel(){
		$this->db->limit(2);
		$this->db->order_by('counter', 'desc');
		$this->db->where_in('jenis_id', array(1,2));
		//$this->db->where($this->table.'.user_id !=',0);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$this->db->select($this->table.'.*, users.username');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_popular_showroom(){
		$this->db->limit(2);
		$this->db->order_by('counter', 'desc');
		$this->db->where_in('jenis_id', array(3,4));
		//$this->db->where($this->table.'.user_id !=',0);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->from($this->table);
		$this->db->select($this->table.'.*, users.username');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_bengkel_by_slug($slug){
		$this->db->where('slug',$slug);
		$this->db->join('users', 'users.user_id = '.$this->table.'.user_id', 'left');
		$this->db->join($this->table_jenis, $this->table_jenis.'.jenis_id = '.$this->table.'.jenis_id', 'left');
		$this->db->select($this->table.'.bengkel_id, '.$this->table.'.slug, '.$this->table.'.jenis_id, '.$this->table.'.city, '.$this->table.'.propinsi, '.$this->table.'.nama_bengkel, '.$this->table.'.alamat_bengkel, '.$this->table.'.country, '.$this->table.'.telp, '.$this->table.'.fax, '.$this->table.'.email, '.$this->table.'.deskripsi, '.$this->table.'.latitude, '.$this->table.'.longitude, '.$this->table.'.zippostal, users.username,'.$this->table_jenis.'.nama_jenis');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_produk($bengkel_id, $nama, $deskripsi, $file_produk, $file_thumb){
		
		$this->db->insert($this->produk, array('bengkel_id' => $bengkel_id, 'nama_produk' => $nama, 'deskripsi' => $deskripsi, 'file_produk' => $file_produk, 'thumb_produk' => $file_thumb));
		
		return $this->db->insert_id();
	}
	
	function edit_produk($produk_id, $bengkel_id, $nama, $deskripsi){
		$this->db->where('id_produk',$produk_id);
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->update($this->produk, array(
		'nama_produk' => $nama, 'deskripsi' => $deskripsi));
	}
	
	function delete_produk($produk_id,$bengkel_id){
		$this->db->where('id_produk',$produk_id);
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->delete($this->produk);
	}
	
	function get_produk_by_bengkel_id($bengkel_id, $limit, $start){
		$this->db->limit($limit,$start);
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_produk_by_bengkel_id_cnt($bengkel_id){
		$this->db->where('bengkel_id',$bengkel_id);
		$this->db->from($this->produk);
		$cnt = $this->db->count_all_results();
		return $cnt;
	}
	
	function get_produk_by_query($bengkel_id,$query,$limit,$start){
		if (!empty($bengkel_id)){
			$this->db->where($this->produk.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like('nama_produk',$query);
			$this->db->like('deskripsi',$query);
		}
		
		$this->db->where('bengkel.user_id', $this->bengkelin_auth->user[0]->user_id);
		
		$this->db->order_by('id_produk', 'DESC');
		$this->db->limit($limit,$start);
		$this->db->join('bengkel', 'bengkel.bengkel_id = '.$this->produk.'.bengkel_id');
		$this->db->select($this->produk.'.*,bengkel.user_id');
		$this->db->from($this->produk);
		$q = $this->db->get();
		//echo $this->db->last_query();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_produk_by_query_cnt($bengkel_id,$query){
		if (!empty($bengkel_id)){
			$this->db->where($this->produk.'.bengkel_id',$bengkel_id);
		}
		
		if (!empty($query)){
			$this->db->like('nama_produk',$query);
			$this->db->like('deskripsi',$query);
		}
		
		$this->db->where('bengkel.user_id', $this->bengkelin_auth->user[0]->user_id);
		$this->db->join('bengkel', 'bengkel.bengkel_id = '.$this->produk.'.bengkel_id');
		$this->db->from($this->produk);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_produk_by_id($produk_id){
		$this->db->where('id_produk', $produk_id);
		$this->db->from($this->produk);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}

}
