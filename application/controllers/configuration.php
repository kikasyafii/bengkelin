<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Configuration
 * Class Name Configuration
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Configuration extends CI_Controller {
	
	
	function __construct(){
		parent::__construct();
		$this->load->model('Config_model');
	}
	
	public function index($type=''){
		
		$result = $this->Config_model->get_config();
		$data['result'] = $result;
		
		if ($type == 'content'){
			$this->load->view('admin/config/config_content',$data);
		}else if ($type == 'socmed'){
			$this->load->view('admin/config/config_socmed',$data);
		}else{
			$this->load->view('admin/config/config_index',$data);
		}
		
		
	}
	
	public function content($config_name){
		
		if (!in_arraY($config_name, array('about', 'api', 'faq', 'kontak', 'developer', 'terms_of_use', 'policy'))){
			show_404();
		}
		
		$result = $this->Config_model->get_config_value($config_name);
		if (!$result){
			show_404();
		}
		
		$data['content'] = $result[0]->config_value;
		
		
		$this->load->view('admin/config/content',$data);
	}
	
	public function save_config(){
		$arrVar = array('title', 'website_name', 'company_name', 'address', 'email', 'phone', 'facebook', 'twitter', 'path', 'gplus', 'about', 'api','slogan', 'faq', 'describe', 'kontak', 'policy', 'developer', 'youtube', 'forbidden_words', 'terms_of_use', 'save' );

		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}

		if ($save){

			foreach($arrVar as $var){
				if ($$var != ''){
					$this->Config_model->set_configuration($var, $$var);
				}
			}

			flashmsg_set('Konfigurasi telah diubah silakan refresh tampilan browser Anda!');
			redirect('configuration', 'refresh');
		}
	}
}
