<?php

/****
 * Author: Santo Doni Romadhoni
 * Script : Controller/Auth
 * Perum Bandara Santika C2-7 Kelurahan Asrikaton, Kecamatan Pakis, Kabupaten Malang
 * email: exblopz@gmail.com
 */ 

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
		redirect('bengkel/bengkel_profile','refresh');
		$this->load->view('admin/dashboard');
	}
	
}
