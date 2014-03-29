<?php

/*
 * Name : Bengkelin Auth
 * File: library/bengkelin_auth
 * Author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
 */ 

class Bengkelin_auth{
	var $ci= null;
	var $cookiename = 'bengkelin';
	var $salt = '0d99e703cbf4e440b8656b369474aee0';
	var $hash = '';
	var $user = null;
	
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->model('User_model', 'Users');
		$this->ci->load->library('form_validation');
		$this->ci->load->helper(array('form'));
		$this->get_current_user();
	}
	
	function get_current_user()
	{
		if (!$this->user)
		{
			$hash = ($this->hash) ? $this->hash : ( isset( $_COOKIE[$this->cookiename] ) ? $_COOKIE[$this->cookiename] : '' );
			if ($hash)
			{
				$a = explode( ':', $hash );
				$username = array_shift( $a );
				$mbuh = array_shift( $a );

				if ( $mbuh == $this->make_hash($username, '', FALSE) )
				{
					if ( $row =  $this->ci->Users->get_user_by_pass( $username ) )
					{
						$this->user = $row;
						return $this->user;
					}
				}
			}
		}
		return $this->user;
	}
	
	function login()
	{
		$this->ci->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required|min_length[3]|max_length[20]|alpha_dash|strtolower');
		$this->ci->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		if ( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			if ($this->ci->form_validation->run())
			{
				$username = set_value('username');
				$password = $this->make_hash(set_value('password'), '', true);
				$row = $this->ci->Users->get_user_by_pass( $username,$password);
				if ( $row = $this->ci->Users->get_user_by_pass( $username,$password) )
				{
					$this->set_login($row);
					$this->save_history("LOGIN");
					return TRUE;
				}
			}
		}

		return FALSE;
	}
	
	function make_hash($key, $prefix='', $forever=TRUE)
	{
		$prefix = $prefix ? $prefix . ':' : '';
	
		if ( !$forever )
		{
			$h = date('H');
			$i = date('i');
			if ( $h == '23' && $i == '59' )
			{
				$forever = date('Ymd', strtotime('+1day'));
			}
			else
			{
				$forever = date('Ymd');
			}
		}
		else
		{
			$forever = '';
		}
	
		return sha1($forever . $prefix . $this->salt . ':' . $key);
	}
	
	function set_login($row)
	{
		//7 days is enough
		if (empty($this->hash) || !isset($this->hash))
		{
			$ip = $this->get_ip();
			
			
			$this->hash = $row[0]->username . ':' . $this->make_hash($row[0]->username , '', FALSE);
			//$this->hash = $row[0]->username . ':' . $this->make_md5($row[0]->username);
		}

		setcookie($this->cookiename, $this->hash, time()+(86400), '/' );
		$_COOKIE[$this->cookiename] = $this->hash;

		$this->user = $row;
	}
	
	function set_logout()
	{
		$this->save_history("LOGOUT");
		$this->user = '';
		$this->hash = '';
		setcookie($this->cookiename, $this->hash, time()-(86400), '/');
		$_COOKIE[$this->cookiename] = '';
	}
	
	function get_ip()
	{
		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
	}
	
	function is_logged_in()
	{
		return !$this->get_current_user() ? FALSE : TRUE;
	}
	
	function login_required()
	{
		
		if ( !$this->is_logged_in() )
		{
			if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )
			{
				header('Content-type: application/x-json');
				echo json_encode(array('success' => false, 'next' =>  site_url('/auth/login?next='.rawurlencode(current_url()))));
			}
			else
			{
				redirect('/auth/login?next='.rawurlencode(current_url()));
			}

			exit;
		}
		$this->set_login($this->user);
		$this->check_perms();
	}
	
	function check_perms()
	{
		$group_id = $this->user[0]->group_id;
		$uri = uri_string();
		
		$tmp = explode("/",$uri);
		if (isset($tmp[1])){
			$realuri = $tmp[0]."/".$tmp[1];
		}else{
			$realuri = $tmp[0];
		}
		$realuri2 = $tmp[0];
		
		$sql = "SELECT p.* FROM group_perms gp JOIN perms p ON gp.perm_id = p.perm_id WHERE gp.group_id = '$group_id' AND (class_path = '$uri' or class_path = '$realuri' or class_path = '$realuri2')";
		
		$query = $this->ci->db->query($sql);
		if ($query->num_rows()>0){
			return true;
		}
		show_error("<p>Sorry, but you don't have permission to view this page</p>", 403);
		exit;
	}
	
	function save_history($url){
		$this->ci->Users->save_history(date('Y-m-d H:i:s'), $this->user[0]->username,$url);
		//$this->ci->Users->save_user_history($this->user[0]->username);
	}
	
	function avatar(){
		$this->ci->load->model('Gallery_model');
		
		$resGallery = $this->ci->Gallery_model->get_profpic($this->user[0]->user_id);
		
		if (!$resGallery){
			return base_url().'assets/images/galleries/user-icon-128.png';
		}else{
			return base_url().'assets/images/galleries/users/thumb/'.$resGallery[0]->thumb_file;
		}
	}
	
	function goto_login(){
		if (isset($this->user) || $this->user[0]->username == ''){
			redirect('auth/login', 'refresh');
		}
	}
}
