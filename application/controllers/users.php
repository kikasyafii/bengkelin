<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Users
 * Class Name Users
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

require_once APPPATH.'/third_party/recaptchalib.php';

class Users extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Group_model');
	}
	
	public function index($_query='-', $_group_id='-', $_show='-',$_page=0){
		
		//$this->bengkelin_auth->login_required();
		
		$arrVar = array( 'group_id','query','show','page'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="clip-arrow-left-2"></i>';
		$config['next_link'] = '<i class="clip-arrow-right-2"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$page = (empty($_page) ? 0 : $_page);
		
		foreach($arrVar as $var){
			$newvar = 'str'.$var;
			$$newvar = ($$var == '-' ? '' : $$var);
		}
		
		$arrGroups = $this->Group_model->get_groups('','');
		$newArr = array();
		foreach($arrGroups as $key => $group){
			if ($key == -1) continue;
			$newArr[$group->group_id] = $group->group_name;
		}
		
		$arrGroups = $newArr;
		
		$data['arrGroups'] = $arrGroups;

		if ($show != ''){
			$config['base_url'] = site_url('users/index/'.$query.'/'.$group_id.'/'.$show);
		}else{
			$config['base_url'] = site_url('users/index/');
		}
		
		$config['per_page'] = 50;
		if ($show!=''){
			$config['uri_segment'] = 6;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($show != ''){
			$data['result'] = $this->User_model->get_user_query($strquery, $strgroup_id, $config['per_page'], $page);
			//echo $this->db->last_query();die;
			$config['total_rows'] = $this->User_model->get_user_query_cnt($strquery, $strgroup_id);
		}else{
			$data['result'] = $this->User_model->get_user_query('', '', $config['per_page'], $page);
			//echo $this->db->last_query();die;
			$data['total_rows'] = $this->User_model->get_user_query_cnt('', '');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/users/user_index',$data);
	}
	
	public function add(){
		$arrGroups = $this->Group_model->get_groups('','');
		$newArr = array();
		foreach($arrGroups as $key => $group){
			if ($key == -1) continue;
			$newArr[$group->group_id] = $group->group_name;
		}
		
		$arrGroups = $newArr;
		
		$data['arrGroups'] = $arrGroups;
		
		$this->load->view('admin/users/add_user', $data);
	}
	
	public function save_add(){
		$arrVar = array('username', 'name', 'alamat', 'kota', 'm', 'y', 'd', 'email', 'bdate', 'first_name', 'last_name', 'group_id', 'password1', 'password2','propinsi', 'zippostal', 'phone', 'sex', 'facebook', 'twitter', 'path', 'linkedin', 'gplus', 'negara', 'is_active', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('username', 'Username', 'required|alphanumeric');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alphanumeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password1', 'Password1','required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password2','required');
		
		if ($save){
			$bdate = $y.'-'.$m.'-'.$d;
			$yearnow = date('Y');
			$usia = intval($yearnow) - intval($y);
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('users', 'refresh');
			}else{
				if ($usia <= 17){
					flashmsg_set('Error: Usia yang diperbolehkan adalah minimal 17 tahun');
					redirect('users/add', 'refresh');
				}elseif ($this->User_model->get_user_by_username($username)){
					flashmsg_set('Error: Username '.$username.' Sudah dipakai, pakai nama yang lain.');
					redirect('users','refresh');
				}else if ($this->User_model->get_user_by_email($email)){
					flashmsg_set('Error: Email '.$email.' Sudah dipakai, pakai email yang lain.');
					redirect('users','refresh');
				}else{
					$this->User_model->add_user($username, $first_name, $last_name, $bdate, $email, $group_id, $this->bengkelin_auth->make_hash($password1,'',TRUE), $alamat, $kota, $propinsi, $phone, $negara, $zippostal, $sex, $facebook,$twitter,$gplus,$linkedin,$path, $is_active);
					flashmsg_set('Berhasil dan suskes menambahkan User ');//.$this->db->last_query());
					redirect('users', 'refresh');
				}
			}
		}
	}
	
	public function edit(){
		$user_id = $this->input->get_post('user_id');
		
		$arrGroups = $this->Group_model->get_groups('','');
		$newArr = array();
		foreach($arrGroups as $key => $group){
			if ($key == -1) continue;
			$newArr[$group->group_id] = $group->group_name;
		}
		
		$arrGroups = $newArr;
		
		$data['arrGroups'] = $arrGroups;
		
		$result = $this->User_model->get_user_by_id($user_id);
		
		if (!$result){
			flashmsg_set('Error: User tidak ditemukan');
			redirect('users', 'refresh');
		}
		
		$data['result'] = $result;
		
		$this->load->view('users/edit_user', $data);
	}
	
	public function save_edit(){
		
		$arrVar = array('user_id', 'username', 'first_name', 'last_name', 'propinsi', 'negara', 'kota', 'email', 'y','m','d','zippostal', 'bdate', 'group_id', 'sex', 'facebook', 'twitter', 'linkedin', 'path', 'gplus', 'alamat', 'phone', 'password1', 'password2','is_active', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('username', 'Username', 'required|alphanumeric');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alphanumeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password1', 'Password1','matches[password2]');
		
		if ($save){
			$bdate = $y.'-'.$m.'-'.$d;
			$yearnow = date('Y');
			$usia = intval($yearnow) - intval($y);
			if ($usia < 17){
				flashmsg_set('Error : Usia paling tidak harus 17 tahun');
				redirect('users', 'refresh');
			}else if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('users', 'refresh');
			}else{
				
				if ($password1 == $password2){
					if ($password1 != ''){
						$this->User_model->edit_user($username, $first_name, $last_name, $email, $bdate, $group_id, $alamat, $kota, $propinsi, $phone, $negara, $zippostal, $is_active, $sex,$facebook,$twitter,$path,$linkedin,$gplus, $this->bengkelin_auth->make_hash($password1,'',TRUE));
					}else{
						$this->User_model->edit_user($username, $first_name, $last_name, $email, $bdate, $group_id, $alamat, $kota, $propinsi, $phone, $negara, $zippostal, $is_active, $sex,$facebook,$twitter,$path,$linkedin,$gplus);
					}
					
					flashmsg_set('Berhasil mengubah user '.$username);//.' '.$password1. ' '.$this->bengkelin_auth->make_hash($password1,'',TRUE).' '.$this->db->last_query());
					redirect('users', 'refresh');
				}else{
					flashmsg_set('Error : Password tidak cocok');
					redirect('users', 'refresh');
				}
			}
		}
	}
	
	public function delete(){
		$user_id = $this->input->get_post('user_id');
		
		$result = $this->User_model->get_user_by_id($user_id);
		
		if (!$result){
			show_404();
		}
		
		$this->User_model->delete_user($user_id);
		flashmsg_set('Berasil menghapus User <strong>'.$result[0]->username.'</strong>');
		redirect('users','refresh');
	}
	
	function modal_add_user(){
		
		$arrGroups = $this->Group_model->get_groups('','');
		$newArr = array();
		foreach($arrGroups as $key => $group){
			if ($key == -1) continue;
			$newArr[$group->group_id] = $group->group_name;
		}
		
		$arrGroups = $newArr;
		
		$data['arrGroups'] = $arrGroups;
		
		$arrDate = array();
		for($i=1;$i<=31;$i++){
			$arrDate[$i] = $i;
		}
		
		$arrMonth = array(
		'01' => 'Januari', '02'=> 'Februari','03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli',
		'08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		);
		
		$arrYear = array();
		$thisy = date('Y');
		for($i=1930;$i<=$thisy;$i++){
			$arrYear[$i] = $i;
		}
		
		$data['year'] = $arrYear;
		$data['month'] = $arrMonth;
		$data['date'] = $arrDate;
		
		$this->load->view('admin/users/modal_add_user',$data);
	}
	
	function modal_edit_user(){
		
		$user_id = $this->input->get_post('user_id');
		
		$arrGroups = $this->Group_model->get_groups('','');
		$newArr = array();
		foreach($arrGroups as $key => $group){
			if ($key == -1) continue;
			$newArr[$group->group_id] = $group->group_name;
		}
		
		$arrGroups = $newArr;
		
		$data['arrGroups'] = $arrGroups;
		
		$arrDate = array();
		for($i=1;$i<=31;$i++){
			$arrDate[$i] = $i;
		}
		
		$arrMonth = array(
		'01' => 'Januari', '02'=> 'Februari','03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli',
		'08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		);
		
		$arrYear = array();
		$thisy = date('Y');
		for($i=1930;$i<=$thisy;$i++){
			$arrYear[$i] = $i;
		}
		
		$data['year'] = $arrYear;
		$data['month'] = $arrMonth;
		$data['date'] = $arrDate;
		
		$data['result'] = $this->User_model->get_user_by_id($user_id);
		
		$this->load->view('admin/users/modal_edit_user',$data);
	}
	
	public function register(){
		
		if (isset($this->bengkelin_auth->user[0]->username) && $this->bengkelin_auth->user[0]->username != ''){
			redirect('users/profile', 'refresh');
		}
		
		$arrVar = array('username', 'email', 'email2', 'password1', 'password2','setuju', 'sex', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$pesan = '';
		
		$public_key = '6Lfu_uwSAAAAAPy0vRZzqb0pSWhuwIsRK-Y8j6hT';
		$data['html'] = recaptcha_get_html($public_key); 
		
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('email2', 'Email2', 'required|valid_email|matches[email]');
		$this->form_validation->set_rules('password1', 'Password1', 'required');
		$this->form_validation->set_rules('password2', 'Password2', 'required|matches[password1]');
		
		
		if ($save){
			
			if ($setuju == ''){
				flashmsg_set('Error : Anda harus menyetujui persyaratan yang berlaku');
				redirect('users/register', 'refresh');
			}else{
			
				$privatekey = '6Lfu_uwSAAAAAGtJphDIYph0y9A__M9FIoK-PYMs';
				$resp = recaptcha_check_answer($privatekey,   $_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
				
				if ($this->form_validation->run() === FALSE){
					flashmsg_set('Error : '.validation_errors());
					redirect('users/register', 'refresh');
				}else if (!$resp->is_valid){
					flashmsg_set('Error: Captcha invalid');
					redirect('users/register', 'refresh');
				}else{
					
					if ($resUser = $this->User_model->get_user_by_username($username)){
						flashmsg_set('Error: Username sudah ada');
						redirect('users/register', 'refresh');
					}else if ($resUser = $this->User_model->get_user_by_email($email)){
						flashmsg_set('Error: Email sudah dipakai');
						redirect('users/register', 'refresh');
					}else{
						/**
						 * data yang berhubungan dengan register user 
						 * 1. Users
						 * 2. Bengkel
						 * 3. Profile perms
						 * automatic group_id for bengkel group_id = 3
						 * */
						$this->User_model->add_user($username, '', '', '0000-00-00 00:00:00', $email, 3, $this->bengkelin_auth->make_hash($password1,'',TRUE), '', '', '', '','','','',$sex,'','','','','');
						$new_user_id = $this->db->insert_id();
						$this->User_model->add_profile_perms($new_user_id);
						$this->User_model->set_deactive($username);
						
						$resUser = $this->User_model->get_user_by_id($new_user_id);
						
						require_once APPPATH . 'Mail/class.pop3.php';
						require_once APPPATH . 'Mail/class.smtp.php';
						require_once APPPATH . 'Mail/class.phpmailer.php';
						
						$smtp = new PHPMailer(true);
						$smtp->IsSMTP();
						$smtp->SMTPSecure = 'ssl';
						$smtp->Host = 'nakula4.pandawanetworks.com';
						$smtp->Port = 465;
						$smtp->Username = 'info@bengkelin.com';
						$smtp->Password = 'b3ngk3l!nOm';
						$smtp->SMTPAuth = true;
						$smtp->SMTPDebug = 0;
						$smtp->From = 'info@bengkelin.com';
						$smtp->FromName = 'Bengkelin.com';
						$smtp->SMTPKeepAlive = true;
						$smtp->XMailer = 'Bengkelin.com/1.0 (http://www.bengkelin.com)';
						
						try{
							
							$smtp->IsHTML(true);
							
							$subject = $this->bengkelin->config['website_name'].": Konfirmasi pendaftaran";
							
							$signature_html = "<p>Tim Bengkelin.com</p>";
							$signature_plain = "\nTim Bengkelin.com";
							
							$body_html = "<p>Dear ".$username."</p>
							<p>Seseorang atau Anda telah mendaftarkan diri dengan email $email ke bengkelin.com<br>
							Userame Anda : ".$username."<br>
							Password Anda: ".$password1."</p>
							<p>Untuk mengkonfirmasi silakan menuju ke halaman ini: <a href='".base_url()."index.php/users/confirm_key/".urlencode($email)."/".$resUser[0]->confirm_key."'>".base_url()."index.php/users/confirm_key/".urlencode($email)."/".$resUser[0]->confirm_key."</a></p>";
							
							$body_plain = "Dear ".$username.",
							Seseorang atau Anda telah mendaftarkan diri dengan email ".$email." ke bengkelin.com\n
							Userame Anda : ".$username."\n
							Password Anda: ".$password1."\n
							
							Untuk mengkonfirmasi silakan menuju ke halaman ini: ".base_url()."index.php/users/confirm_key/".urlencode($email)."/".$resUser[0]->confirm_key;
							
							$smtp->Body = utf8_decode($body_html.$signature_html);
							$smtp->AltBody = utf8_decode($body_plain . $signature_plain);
							$smtp->Subject = $subject;
							$smtp->AddAddress($email, $username);
							$smtp->AddCustomHeader("X-UniqID: {".uniqid()."}");
							$smtp->AddCustomHeader("X-Description: Registration");
							
							if ($smtp->Send()){
								flashmsg_set('Pendaftaran berhasil. Email telah terkirim, silakan untuk melihat inbox email Anda');
							}else{
								flashmsg_set('Error: Pendaftaran tidak berhasil. Ada kesalahan teknis, segera hubungi admin website bengkelin.com');
							}
						}catch(phpMailerException $e){
							$this->log("Gagal mengirim email ke ".$email." - ".$subject." :".$e->errorMessage());
						}catch(Exception $e){
							$this->log("Gagal mengirim email ke ".$email." - ".$subject." : ".$e->getMessage());
						}
					}
				}
			}
		}
		
		$this->load->view('maintheme/users/register',$data);
	}
	
	public function message(){
		
		$data['pesan'] = $this->input->get_post('pesan');
		
		$this->load->view('maintheme/users/message',$data);
	}
	
	public function confirm_key($email, $key){
		
		$resConfirm = $this->User_model->get_user_by_confirm_key(urldecode($email), $key);
		if ($resConfirm){
			
			if ($resConfirm[0]->is_active == 1){
				redirect(base_url(), 'refresh');
			}else{
				$this->User_model->set_active($resConfirm[0]->username);
				flashmsg_set('Konfirmasi berhasil. Silakan login');
				redirect('auth/login', 'refresh');
			}
		}else{
			flashmsg_set('Error: Maaf kode tidak valid');
			redirect('users/confirm_key', 'refresh');
		}
		
		$this->load->view('maintheme/users/confirm_key',$data);
	}
	
	public function forgot_password(){
		
		$arrVar = array('email', 'send');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$pesan = '';
		
		if ($send){
			
			$resUser = $this->User_model->get_user_by_email($email);
			
			if ($resUser){
				
				require_once APPPATH . 'Mail/class.pop3.php';
				require_once APPPATH . 'Mail/class.smtp.php';
				require_once APPPATH . 'Mail/class.phpmailer.php';
				
				$smtp = new PHPMailer(true);
				$smtp->IsSMTP();
				$smtp->SMTPSecure = 'ssl';
				$smtp->Host = 'nakula4.pandawanetworks.com';
				$smtp->Port = 465;
				$smtp->Username = 'info@bengkelin.com';
				$smtp->Password = 'b3ngk3l!nOm';
				$smtp->SMTPAuth = true;
				$smtp->SMTPDebug = 0;
				$smtp->From = 'info@bengkelin.com';
				$smtp->FromName = 'Bengkelin.com';
				$smtp->SMTPKeepAlive = true;
				$smtp->XMailer = 'Bengkelin.com/1.0 (http://www.bengkelin.com)';
				
				try{
									
					$smtp->IsHTML(true);
					
					$subject = $this->bengkelin->config['website_name'].": Konfirmasi Reset Password";
					
					$signature_html = "<p>Tim Bengkelin.com</p>";
					$signature_plain = "\nTim Bengkelin.com";
					
					$body_html = "<p>Dear ".$resUser[0]->first_name.",</p>
					<p>Seseorang atau Anda baru saja meminta untuk mereset password. Apabila ini bukan Anda maka hiraukan pesan ini. Apabila benar, maka silakan ikuti link di bawah ini.</p>
					<p>Someone or you requested to reseting password. If this is not you, then you can ignore this message. If this is right you, then please follow the link bellow.</p>
					<p><a href=".base_url()."index.php/users/reset_password/".$resUser[0]->confirm_key."/".urlencode($resUser[0]->email).">".base_url()."index.php/users/reset_password/".$resUser[0]->confirm_key."/".$resUser[0]->email."</a></p>";
					
					$body_plain = "Dear ".$resUser[0]->first_name.",
					Seseorang Atau Anda baru saja meminta utnuk mereset password. Apabila ini bukan Anda maka hiraukan pesan ini. Apabila benar, maka silakan ikuti link di bawah ini.\r\n
					Someone or you erquested to reseting your password. If this is not you, then you can ignore this message. If this is right you, then please follow the link bellow.\r\n
					".base_url()."index.php/users/confirm_key/".urlencode($resUser[0]->email)."/".$resUser[0]->confirm_key;
					
					$smtp->Body = utf8_decode($body_html.$signature_html);
					$smtp->AltBody = utf8_decode($body_plain . $signature_plain);
					$smtp->Subject = $subject;
					$smtp->AddAddress($resUser[0]->email, $resUser[0]->username);
					$smtp->AddCustomHeader("X-UniqID: {".uniqid()."}");
					$smtp->AddCustomHeader("X-Description: Registration");
					
					if ($smtp->Send()){
						$pesan = 'Email konfirmasi telah dikirimkan. Cek Inbox Email Anda!';
						redirect('users/message?pesan='.$pesan, 'refresh');
					}else{
						$pesan = 'Konfirmasi gagal. Ada kesalahan teknis, segera hubungi admin website bengkelin.com';
						redirect('users/message?pesan='.$pesan, 'refresh');
					}
					
				}catch(phpMailerException $e){
					$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." :".$e->errorMessage());
				}catch(Exception $e){
					$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." : ".$e->getMessage());
				}
				
				flashmsg_set($pesan);
				redirect('users/forgot_password', 'refresh');
			}
			
		}
		
		$this->load->view('auth/login');
	}
	
	public function reset_password($key,$email){
		
		$data['username'] = '';
		
		if (!empty($email) && !empty($key)){
			
			$resUser = $this->User_model->get_user_by_confirm_key(urldecode($email),$key);
			if ($resUser) {
				$data['username'] = $resUser[0]->username;
				$this->User_model->set_forgot_password($resUser[0]->username);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
		
		$this->load->view('maintheme/users/reset_password',$data);
	}
	
	public function edit_password(){
		
		$arrVar = array('password1', 'username', 'password2', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$resUser = $this->User_model->get_user_by_username($username);
		$confirm_key = $resUser[0]->confirm_key;
		$email = urlencode($resUser[0]->email);
		
		$this->form_validation->set_rules('password1', 'Password1', 'required');
		$this->form_validation->set_rules('password2', 'Password2', 'required|matches[password1]');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('users/reset_password/'.$confirm_key.'/'.$email, 'refresh');
			}else{
				$this->User_model->edit_password($username, $this->bengkelin_auth->make_hash($password1,'',TRUE));
				$this->User_model->set_active($username);
				flashmsg_set('Berhasil mengupdate password silakan login');
				redirect('auth/login', 'refresh');
			}
		}
	}
	
	public function show_profile($username=''){
		
		if ($username == ''){
			$username = $this->bengkelin_auth->user[0]->username;
		}
		
		$result = $this->User_model->get_user_by_username($username);

		$data['profile'] = $result[0];
		
		$this->load->model('Gallery_model');
		if ($result){
			$resGallery = $this->Gallery_model->get_profpic($result[0]->user_id);
		
			$data['resGallery'] = $resGallery;
		}else{
			$data['resGallery'] = FALSE;
		}
		
		$this->load->view('maintheme/users/show_profile', $data);
	}
	
	public function profile($type=''){
		
		$this->bengkelin_auth->login_required();
		
		$arrDate = array();
		for($i=1;$i<=31;$i++){
			$arrDate[$i] = $i;
		}
		
		$arrMonth = array(
		'01' => 'Januari', '02'=> 'Februari','03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli',
		'08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
		);
		
		$arrYear = array();
		$thisy = date('Y');
		for($i=1930;$i<=$thisy;$i++){
			$arrYear[$i] = $i;
		}
		
		$data['year'] = $arrYear;
		$data['month'] = $arrMonth;
		$data['date'] = $arrDate;
		
		$data['profile'] = $this->bengkelin_auth->user[0];
		
		$this->load->model('Gallery_model');
		
		$resGallery = $this->Gallery_model->get_profpic($this->bengkelin_auth->user[0]->user_id);
		
		$data['resGallery'] = $resGallery;
		
		if ($type == 'edit'){
			$this->load->view('admin/users/edit_profile', $data);
		}else{
			$this->load->view('admin/users/profile', $data);
		}
	}
	
	public function save_profile(){
		
		$arrVar = array('first_name', 'last_name', 'email', 'd', 'm', 'y', 'alamat', 'kota', 'negara', 'propinsi', 'zippostal', 'phone', 'facebook', 'twitter', 'linkedin', 'path', 'gplus', 'sex', 'save', 'password1', 'password2');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('users/profile/edit', 'refresh');
			}else{
				$bdate = $y.'-'.$m.'-'.$d;
				$resUser = $this->User_model->get_user_by_email($email);
				
				$emailnow = $this->bengkelin_auth->user[0]->email;
				
				if ($resUser){
					
					if ($emailnow != $resUser[0]->email){
						flashmsg_set('Error: Email sudah pernah dipakai');
						redirect('users/profile/edit','refresh');
					}else{
						if ($password1 != $password2){
							flashmsg_set('Error: Password tidak sama');
							redirect('users/profile/edit','refresh');
						}else{
							$this->User_model->edit_user($this->bengkelin_auth->user[0]->username, $first_name, $last_name, $email, $bdate, $this->bengkelin_auth->user[0]->group_id, $alamat, $kota, $propinsi, $phone,$negara,$zippostal,1,$sex,$facebook,$twitter,$path,$linkedin,$gplus,$password1);
						
							flashmsg_set('Berhasil mengubah Profile');
							redirect('users/profile', 'refresh');
						}
					}
				}else{
					if ($password1 != $password2){
						flashmsg_set('Error: Password tidak sama');
						redirect('users/profile/edit','refresh');
					}else{
						if($emailnow != $resUser[0]->email){
							
							require_once APPPATH . 'Mail/class.pop3.php';
							require_once APPPATH . 'Mail/class.smtp.php';
							require_once APPPATH . 'Mail/class.phpmailer.php';
							
							$smtp = new PHPMailer(true);
							$smtp->IsSMTP();
							$smtp->SMTPSecure = 'ssl';
							$smtp->Host = 'nakula4.pandawanetworks.com';
							$smtp->Port = 465;
							$smtp->Username = 'info@bengkelin.com';
							$smtp->Password = 'b3ngk3l!nOm';
							$smtp->SMTPAuth = true;
							$smtp->SMTPDebug = 0;
							$smtp->From = 'info@bengkelin.com';
							$smtp->FromName = 'Bengkelin.com';
							$smtp->SMTPKeepAlive = true;
							$smtp->XMailer = 'Bengkelin.com/1.0 (http://www.bengkelin.com)';
							
							try{
												
								$smtp->IsHTML(true);
								
								$subject = $this->bengkelin->config['website_name'].": Konfirmasi Reset Password";
								
								$signature_html = "<p>Regards~</p>".
								"<p>Tim Bengkelin</p>";
								$signature_plain = "\nRegards~\r\n".
								"Tim Bengkelin";
								
								$body_html = "<p>Dear ".$this->bengkelin_auth->user[0]->username." (".$this->bengkelin_auth->user[0]->first_name.")</p><p>Anda baru saja melakukan perubahan email di bengkelin.com pada tanggal ".date('d-m-Y').". Apabila ini bukan Anda, maka akun Anda besar kemungkinan telah dihack. Klik link berikut ini untuk restorasi.</p>".
								"<a href='".base_url()."index.php/users/restore_email/".urlencode($this->bengkelin_auth->user[0]->email)."/".$this->bengkelin_auth->user[0]->confirm_key."'>".base_url()."index.php/users/restore_email/".$this->bengkelin_auth->user[0]->email."/".$this->bengkelin_auth->user[0]->confirm_key."</a>".
								"<p>Apabila ini adalah Anda, maka hiraukan pesan ini.</p>";
								
								$body_plain = "Dear ".$this->bengkelin_auth->user[0]->username." (".$this->bengkelin_auth->user[0]->first_name.") \r\nAnda baru saja melakukan perubahan email di bengkelin.com pada tanggal ".date('d-m-Y').". Apabila ini bukan Anda, maka akun Anda besar kemungkinan telah dihack. Klik link berikut ini untuk restorasi.\r\n".
								base_url()."index.php/users/restore_email/".urlencode($this->bengkelin_auth->user[0]->email)."/".$this->bengkelin_auth->user[0]->confirm_key."\r\n".
								"Apabila ini adalah Anda, maka hiraukan pesan ini.\r\n
								Regards~\r\n".
								"Tim Bengkelin";
								
								
								$smtp->Body = utf8_decode($body_html.$signature_html);
								$smtp->AltBody = utf8_decode($body_plain . $signature_plain);
								$smtp->Subject = $subject;
								$smtp->AddAddress($resUser[0]->email, $resUser[0]->username);
								$smtp->AddCustomHeader("X-UniqID: {".uniqid()."}");
								$smtp->AddCustomHeader("X-Description: Registration");
								
								if ($smtp->Send()){
									$pesan = 'Email konfirmasi telah dikirimkan. Cek Inbox Email Anda!';
									redirect('users/message?pesan='.$pesan, 'refresh');
								}else{
									$pesan = 'Konfirmasi gagal. Ada kesalahan teknis, segera hubungi admin website bengkelin.com';
									redirect('users/message?pesan='.$pesan, 'refresh');
								}
								
							}catch(phpMailerException $e){
								$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." :".$e->errorMessage());
							}catch(Exception $e){
								$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." : ".$e->getMessage());
							}
						}
					
						$this->User_model->edit_user($this->bengkelin_auth->user[0]->username, $first_name, $last_name, $email, $bdate, $this->bengkelin_auth->user[0]->group_id, $alamat, $kota, $propinsi, $phone,$negara,$zippostal,1,$sex,$facebook,$twitter,$path,$linkedin,$gplus,$password1);
						
						flashmsg_set('Berhasil mengubah Profile');
						redirect('users/profile', 'refresh');
					}
				}
			}
		}
	}
	
	public function restore_email($email, $confirm_key){
		
		$resUser = $this->User_model->get_user_by_confirm_key(urldecode($email),$confirm_key);
		
		if (!$resUser){
			show_404();
		}else{
			$last_email = $resUser[0]->last_email;
			$this->User_model->restore_email($resUser[0]->username, $last_email);
			
			require_once APPPATH . 'Mail/class.pop3.php';
			require_once APPPATH . 'Mail/class.smtp.php';
			require_once APPPATH . 'Mail/class.phpmailer.php';
			
			$smtp = new PHPMailer(true);
			$smtp->IsSMTP();
			$smtp->SMTPSecure = 'ssl';
			$smtp->Host = 'nakula4.pandawanetworks.com';
			$smtp->Port = 465;
			$smtp->Username = 'info@bengkelin.com';
			$smtp->Password = 'b3ngk3l!nOm';
			$smtp->SMTPAuth = true;
			$smtp->SMTPDebug = 0;
			$smtp->From = 'info@bengkelin.com';
			$smtp->FromName = 'Bengkelin.com';
			$smtp->SMTPKeepAlive = true;
			$smtp->XMailer = 'Bengkelin.com/1.0 (http://www.bengkelin.com)';
			
			try{
								
				$smtp->IsHTML(true);
				
				$subject = $this->bengkelin->config['website_name'].": Konfirmasi Reset Password";
				
				$signature_html = "<p>Regards~</p>".
				"<p>Tim Bengkelin</p>";
				$signature_plain = "\nRegards~\r\n".
				"Tim Bengkelin";
				
				$body_plain = "<p>Dear ".$resUser[0]->username." (".$resUser[0]->first_name.")</p><p>Email Anda telah direstore. Silakan lakukan perubahan password dengan mengikuti link berikut:</p>".
				"<a href='".base_url()."index.php/users/reset_password/".$resUser[0]->confirm_key."/".urlencode($last_email)."'>".base_url()."index.php/users/reset_password/".$resUser[0]->confirm_key."/".urlencode($last_email)."</a>".
				"<p>Terima kasih.</p>";
				
				$body_plain = "Dear ".$resUser[0]->username." (".$resUser[0]->first_name.") \r\nEmail Anda telah direstore. Silakan lakukan perubahan password dengan mengikuti link berikut\r\n".
				base_url()."index.php/users/reset_password/".$resUser[0]->confirm_key."/".urlencode($last_email)."\r\n".
				"Terima kasih.\r\n";
				
				$smtp->Body = utf8_decode($body_html.$signature_html);
				$smtp->AltBody = utf8_decode($body_plain . $signature_plain);
				$smtp->Subject = $subject;
				$smtp->AddAddress($resUser[0]->email, $resUser[0]->username);
				$smtp->AddCustomHeader("X-UniqID: {".uniqid()."}");
				$smtp->AddCustomHeader("X-Description: Registration");
				
				if ($smtp->Send()){
					$pesan = 'Email konfirmasi telah dikirimkan. Cek Inbox Email Anda!';
					redirect('users/message?pesan='.$pesan, 'refresh');
				}else{
					$pesan = 'Konfirmasi gagal. Ada kesalahan teknis, segera hubungi admin website bengkelin.com';
					redirect('users/message?pesan='.$pesan, 'refresh');
				}
				
			}catch(phpMailerException $e){
				$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." :".$e->errorMessage());
			}catch(Exception $e){
				$this->log("Gagal mengirim email ke ".$resUser[0]->email." - ".$subject." : ".$e->getMessage());
			}
			
		}
	}
	
	public function cities_json(){
		
		header("Content-type: application/json;charset=utf-8");
		
		$result = $this->User_model->get_cities();
		$arr = array();
		foreach($result as $row){
			$arr[] = $row->City;
		}
		echo 'var Cities='.json_encode($arr).';';
	}
	
	public function states_json(){
		
		header("Content-type: application/json;charset=utf-8");
		
		$result = $this->User_model->get_cities();
		$arr = array();
		foreach($result as $row){
			$arr[] = $row->State;
		}
		echo 'var States='.json_encode($arr).';';
	}
	
	public function get_state(){
		
		$city = $this->input->get_post('city');
		
		$result = $this->User_model->get_state($city);
		if($result){
			echo $result[0]->State;
		}
	}
	
	public function get_country(){
		
		$state = $this->input->get_post('state');
		
		$result = $this->User_model->get_country($state);
		if($result){
			echo $result[0]->Country;
		}
	}
	
	
	public function countries_json(){
		
		header("Content-type: application/json;charset=utf-8");
		
		$result = $this->User_model->get_countries();
		$arr = array();
		foreach($result as $row){
			$arr[] = $row->Country;
		}
		echo 'var Countries='.json_encode($arr).';';
	}
	
	public function get_user_json(){
		header("Content-type: application/json;charset=UTF-8");
		
		$result = $this->User_model->get_user_all();
		$arr = array();
		foreach($result as $row){
			$arr[] = $row->username;
		}
		
		echo 'var Users='.json_encode($arr).';';
	}
	
	function log($s)
	{
		$date = date('Y-m-d H:i:s');
		echo "[$date] $s<br />\n";
	}
}
