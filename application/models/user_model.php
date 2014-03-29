<?php
/***
 * Class Model 
 * Name : User Model
 * file : user_model.php
 * author : Santo Doni Romadhoni
 * email : exblopz@gmail.com
 */

class User_model extends CI_Model {

	var $table = 'users';
	var $table_profile = 'profile_perms';

	function __construct(){
		parent::__construct();
	}
	
	function add_user($username, $first_name, $last_name, $bdate, $email, $group_id, $password, $alamat, $kota, $propinsi, $phone, $negara, $zippostal,$sex, $facebook,$twitter,$gplus,$linkedin,$path, $is_active='1'){
		
		//$username, $first_name, $last_name, $bdate, $email, $group_id, $this->properti_auth->make_hash($password1,'',TRUE), $alamat, $kota, $propinsi, $phone, $negara, $zippostal
		
		$this->db->insert($this->table,
			array('username' => $username, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'kota' => $kota, 'group_id' => $group_id, 'password' => $password, 'alamat' => $alamat, 'propinsi' => $propinsi, 'phone' => $phone, 'negara' => $negara, 'zippostal' => $zippostal, 'bdate' => $bdate, 'sex' => $sex, 'facebook' => $facebook, 'twitter' => $twitter, 'gplus' => $gplus, 'linkedin' => $linkedin, 'path' => $path, 'confirm_key' => $this->bengkelin_auth->make_hash($username,'',TRUE), 'is_active' => $is_active
			)
		);
	}
	
	function edit_user($username ,$first_name, $last_name, $email, $bdate, $group_id, $alamat, $kota, $propinsi, $phone, $negara, $zippostal, $is_active, $sex, $facebook, $twitter, $path, $linkedin, $gplus, $password=''){
		if ($password != ''){
			$array = array('first_name'=> $first_name, 'last_name' => $last_name, 'bdate' => $bdate, 'email' => $email, 'kota' => $kota, 'group_id' => $group_id, 'password' => $password, 'alamat' => $alamat, 'propinsi' => $propinsi, 'negara' => $negara, 'zippostal' => $zippostal, 'phone' => $phone, 'is_active' => $is_active, 'sex' => $sex, 'facebook' => $facebook, 'twitter' => $twitter, 'gplus' => $gplus, 'path' => $path, 'linkedin'=> $linkedin );
		}else{
			$array = array('first_name'=> $first_name, 'last_name' => $last_name, 'bdate' => $bdate, 'email' => $email, 'kota' => $kota, 'group_id' => $group_id, 'alamat' => $alamat, 'propinsi' => $propinsi, 'negara' => $negara, 'zippostal' => $zippostal,'phone' => $phone, 'is_active' => $is_active, 'sex' => $sex, 'facebook' => $facebook, 'twitter' => $twitter, 'gplus' => $gplus, 'path' => $path, 'linkedin'=> $linkedin);
		}
		
		$this->db->where('username', $username);
		$this->db->update($this->table, $array);
	}
	
	function get_user($username, $first_name, $last_name, $email, $alamat, $kota, $phone, $group_id, $limit, $start){
		
		$arr = array('username','first_name', 'last_name','email','alamat','kota', 'phone');
		foreach($arr as $var){
			if (!empty($$var)){
				$this->db->like($var, $$var);
			}
		}
		
		if (!empty($group_id)){
			$this->db->where('group_id',$group_id);
		}
		
		$this->db->limit($limit, $start);
		$this->db->from($this->table);
		$q = $this->db->get();
	//	echo $this->db->last_query();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_user_cnt($username, $fist_name, $last_name, $email, $alamat, $kota, $phone, $group_id){
		$arr = array('username','first_name', 'last_name','email','alamat','kota', 'phone');
		foreach($arr as $var){
			if (!empty($$var)){
				$this->db->like($var, $$var);
			}
		}
		
		if (!empty($group_id)){
			$this->db->where('group_id',$group_id);
		}
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
	
	function get_user_by_pass($username, $password=''){
		$this->db->where('username', $username);
		
		if (!empty($password)){
			$this->db->where('password',$password);
		}
		
		$this->db->where('is_active' , 1);
		
		$this->db->select('user_id,username,first_name,last_name,email,bdate,group_id,confirm_key,group_id,alamat,phone,zippostal,kota,propinsi,negara,is_active,facebook,twitter,path,linkedin,gplus,sex');
		$q = $this->db->get($this->table);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function delete_user($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->delete($this->table);
	}
	
	
	function get_user_by_column($column, $value){
		$this->db->where($column, $value);
		$q = $this->db->get($this->table);
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_user_by_username($username){
		$this->db->where('username', $username);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_user_by_email($email){
		$this->db->where('email', $email);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_user_by_id($user_id){
		$this->db->where('user_id', $user_id);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function save_history($datetime, $username, $keterangan){
		$this->db->insert('history_log', 
			array('logtime' => $datetime, 'username' => $username, 'keterangan' => $keterangan)
		);
	}
	
	/*function save_user_history($username){
		$this->db->where('username', $username);
		$this->db->update($this->table, array(
			'logtime' => date('Y-m-d H:i:s'), 'last_update' => date('Y-m-d H:i:s')
			)
		);
	}*/
	
	function get_user_id_username(){
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_cities(){
		$this->db->from('cities');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_countries(){
		$this->db->from('countries');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_state($city){
		if (!empty($city)){
			$this->db->where('City', $city);
		}
		
		$this->db->from('cities');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_country($state){
		
		if (!empty($state)){
			$this->db->where('State', $state);
		}
		
		$this->db->join('cities', 'cities.Country = countries.Code');
		$this->db->from('countries');
		$this->db->select('countries.Country');
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function get_user_all(){
		$this->db->select('username');
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function add_profile_perms($user_id){
		$this->db->insert($this->table_profile, array('user_id' => $user_id));
	}
	
	function set_deactive($username){
		$this->db->where('username', $username);
		$this->db->update($this->table, array('is_active' => 0));
	}
	
	function set_active($username){
		$this->db->where('username', $username);
		$this->db->update($this->table, array('is_active' => 1));
	}
	
	function get_user_by_confirm_key ($email, $key){
		$this->db->where('email', $email);
		$this->db->where('confirm_key', $key);
		$this->db->from($this->table);
		$q = $this->db->get();
		if ($q->num_rows()>0){
			return $q->result();
		}else{
			return FALSE;
		}
	}
	
	function set_forgot_password($username){
		$this->db->where('username', $username);
		$this->db->update($this->table, array('is_active' => '0', 'password' => ''));
	}
	
	function edit_password($username, $password){
		$this->db->where('username', $username);
		$this->db->update($this->table, array( 'password' => $password));
	}
	
	function restore_email($username,$last_email){
		$this->db->where('username',$username);
		$this->db->update($this->table, array('email' => $last_email));
	}
	
	function get_user_query($query, $group_id, $limit, $start){
		
		if (!empty($query)){
			$this->db->like('username', $query);
			$this->db->or_like('first_name', $query);
			$this->db->or_like('last_name', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('alamat', $query);
			$this->db->or_like('phone', $query);
			$this->db->or_like('kota', $query);
			$this->db->or_like('propinsi', $query);
			$this->db->or_like('negara', $query);
		}
		
		if (!empty($group_id)){
			$this->db->where('group_id', $group_id);
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
	
	function get_user_query_cnt($query, $group_id){
		
		if (!empty($query)){
			$this->db->like('username', $query);
			$this->db->or_like('first_name', $query);
			$this->db->or_like('last_name', $query);
			$this->db->or_like('email', $query);
			$this->db->or_like('alamat', $query);
			$this->db->or_like('phone', $query);
			$this->db->or_like('kota', $query);
			$this->db->or_like('propinsi', $query);
			$this->db->or_like('negara', $query);
		}
		
		if (!empty($group_id)){
			$this->db->where('group_id', $group_id);
		}
		
		$this->db->from($this->table);
		$cnt = $this->db->count_all_results();
		
		return $cnt;
	}
}
