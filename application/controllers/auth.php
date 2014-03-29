<?php

/****
 * Author: Santo Doni Romadhoni
 * Script : Controller/Auth
 * Perum Bandara Santika C2-7 Kelurahan Asrikaton, Kecamatan Pakis, Kabupaten Malang
 * email: exblopz@gmail.com
 */ 

require_once APPPATH.'/third_party/recaptchalib.php';

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
		if ($this->bengkelin_auth->is_logged_in()){
			if ($this->bengkelin_auth->user[0]->group_id == 1){
				redirect('dashboard','refresh');
			}else{
				redirect('welcome', 'refresh');
			}
		}else{
			$this->login();
		}
	}
	
	public function login()
	{
		
		$public_key = '6Lfu_uwSAAAAAPy0vRZzqb0pSWhuwIsRK-Y8j6hT';
		$data['html'] = recaptcha_get_html($public_key); 
		
		
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
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			
			$next = $this->input->get_post('next');
			if ($this->bengkelin_auth->login())
			{
				if ($next)
				{
					redirect( $next );
				}
				else
				{
					if ($this->bengkelin_auth->user[0]->group_id == 1){
						redirect('dashboard', 'refresh');
					}else{
						redirect( site_url('bengkel/bengkel_profile') );
					}
				}
			}
			else
			{
				flashmsg_set('Username atau password anda kurang tepat. Mohon ulangi kembali');
			}
		}
		
		$this->load->view('admin/login',$data);
	}
	
	public function logout()
	{
		if (isset($this->bengkelin_auth->user) && ($this->bengkelin_auth->user[0]->username != '' || count($this->bengkelin_auth->user)>0)){
			$this->bengkelin_auth->set_logout();
			redirect( site_url() );
		}else{
			$this->login();
		}
	}
}
