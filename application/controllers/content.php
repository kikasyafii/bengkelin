<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Content
 * Class Name Content
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Content extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Config_model');
	}
	
	public function pages($config_name=''){
		
		if (!in_arraY($config_name, array('about', 'api', 'developer', 'terms_of_use', 'kontak', 'policy'))){
			show_404();
		}
		
		$result = $this->Config_model->get_config_value($config_name);
		if (!$result){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$data['baru'] = $this->Bengkel_model->get_bengkel_baru();
		
		$data['content'] = $result[0]->config_value;
		$data['title'] = strtoupper($result[0]->config_name);
		
		$this->load->view('admin/config/content',$data);
	}
	
}
