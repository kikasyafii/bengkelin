<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/****
 * Name Class: Comments
 * Controllers: Comments
 * File :comments.php
 * author : Santo Doni Romadhoni
 * Email : exblopz@gmail.com
 * */


class Comments extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Comment_model');
	}
	
	function testimoni($_query='-',$_cari='-', $_page=0){
		
		$arrVar = array('query', 'cari', 'cari', 'page'); 
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

		if ($cari != ''){
			$config['base_url'] = site_url('comments/testimoni/'.$query.'/'.$cari);
		}else{
			$config['base_url'] = site_url('comments/testimoni/');
		}
		
		$config['per_page'] = 35;
		if ($cari!=''){
			$config['uri_segment'] = 6;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($cari!=''){
			$data['result'] = $this->Comment_model->get_testimoni_all($strquery, $config['per_page'], $page);
			$config['total_rows'] = $this->Comment_model->get_testimoni_all_cnt($strquery);
		}else{
			$data['result'] = $this->Comment_model->get_testimoni_all('', $config['per_page'], $page);
			$config['total_rows'] = $this->Comment_model->get_testimoni_all_cnt('');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/comment/testimoni_dashboard',$data);
		
	}
	
	function save_testimoni(){
		
		$this->load->model('Config_model');
		
		$resConfig = $this->Config_model->get_config_value('forbidden_words');
		$forbidden_words = $resConfig[0]->config_value;
		$arrforbids = explode("\n", $forbidden_words);
		foreach($arrforbids as $word){
			if (empty($word)) continue;
			$arrWords[] = $word;
		}
		
		$arrVar = array('bengkel_id', 'nama', 'email', 'website', 'slug', 'konten','save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
			}else{
				$found = false;
				foreach($arrWords as $word){
					if (preg_match("/$word/i", $konten)){
						$found = true;
						break;
					}
				}
				if ($found === false){
					$this->Comment_model->add_testimoni($bengkel_id, $nama, $email, $konten, $website);
					flashmsg_set('Komentar telah diposting');
				}else{
					flashmsg_set('Error: Mohon tidak memposting dengan kata-kata yang tidak sopan');
				}
			}
			redirect('bengkel/view/'.$slug, 'refresh');
		}
	}
	
	function edit_testimoni(){
		$testimoni_id = $this->input->get_post('id');
		
		$resTestimoni = $this->Comment_model->get_testimoni_by_id($testimoni_id);
		if(!$resTestimoni){
			show_404();
		}
		
		$data['result'] = $resTestimoni;
		
		$this->load->view('admin/comment/edit_testimoni',$data);
	}
	
	function user_edit_testimoni($bengkel_id,$testimoni_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$resTestimoni = $this->Comment_model->get_testimoni_by_id($testimoni_id);
		if(!$resTestimoni){
			show_404();
		}
		
		$data['bengkel_id'] = $bengkel_id;
		$data['result'] = $resTestimoni;
		
		$this->load->view('admin/comment/user_edit_testimoni',$data);
	}
	
	function save_user_edit_testimoni(){
		
		$arrVar = array('testimoni_id', 'bengkel_id', 'nama', 'email','website', 'konten', 'approved', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$this->load->model('Config_model');
		
		$resConfig = $this->Config_model->get_config_value('forbidden_words');
		$forbidden_words = $resConfig[0]->config_value;
		$arrforbids = explode("\n", $forbidden_words);
		foreach($arrforbids as $word){
			if (empty($word)) continue;
			$arrWords[] = $word;
		}
		
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('comments/user_edit_testimoni/'.$bengkel_id.'/'.$testimoni_id, 'refresh');
			}else{
				$found = false;
				foreach($arrWords as $word){
					if (preg_match("/$word/i", $konten)){
						$found = true;
						break;
					}
				}
				if ($found == true){
					flashmsg_set('Error: Ada kata-kata yang dilarang'); 
					redirect('comments/user_edit_testimoni/'.$bengkel_id.'/'.$testimoni_id, 'refresh');
				}else{
					$this->Comment_model->edit_testimoni($testimoni_id, $nama, $email, $website,$konten,$approved);
					flashmsg_set('Berhasil mengubah testimoni');
					redirect('comments/user_testimoni/'.$bengkel_id, 'refresh');
				}
			}
		}
	}
	
	function save_edit_testimoni(){
		
		$arrVar = array('testimoni_id', 'bengkel_id', 'nama', 'email','website', 'konten', 'approved', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->load->model('Config_model');
		
		$resConfig = $this->Config_model->get_config_value('forbidden_words');
		$forbidden_words = $resConfig[0]->config_value;
		$arrforbids = explode("\n", $forbidden_words);
		foreach($arrforbids as $word){
			if (empty($word)) continue;
			$arrWords[] = $word;
		}
		
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
			}else{
				$found = false;
				foreach($arrWords as $word){
					if (preg_match("/$word/i", $konten)){
						$found = true;
						break;
					}
				}
				if ($found == true){
					flashmsg_set('Error: Ada kata-kata yang dilarang'); 
				}else{
					$this->Comment_model->edit_testimoni($testimoni_id, $nama, $email, $website,$konten,$approved);
					flashmsg_set('Berhasil mengubah testimoni');
				}
				redirect('comments/testimoni', 'refresh');
			}
		}
	}
	
	
	function delete_testimoni(){
		$testimoni_id = $this->input->get_post('id');
		
		$resTestimoni = $this->Comment_model->get_testimoni_by_id($testimoni_id);
		if(!$resTestimoni){
			show_404();
		}
		
		$this->Comment_model->delete_testimoni($testimoni_id);
		flashmsg_set('Berhasil menghapus testimoni');
		redirect('comments/testimoni','refresh');
	}
	
	function user_delete_testimoni($bengkel_id, $testimoni_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$resTestimoni = $this->Comment_model->get_testimoni_by_id($testimoni_id);
		if(!$resTestimoni){
			show_404();
		}
		
		$this->Comment_model->delete_testimoni($testimoni_id);
		flashmsg_set('Berhasil menghapus testimoni');
		redirect('comments/user_testimoni/'.$bengkel_id,'refresh');
	}
	
	public function user_testimoni($_bengkel_id='-', $_query='-', $_show='-', $_page=0){
		
		if ($_bengkel_id == '-'){
			show_404();
		}
		
		$arrVar = array('bengkel_id', 'query', 'show', 'page'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		if ($show != ''){
			$config['base_url'] = site_url('comments/user_testimoni/'.$bengkel_id.'/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('comments/user_testimoni/');
		}
		
		$config['per_page'] = 35;
		if ($show!=''){
			$config['uri_segment'] = 6;
		}else{
			$config['uri_segment'] = 3;
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
		
		if ($show!=''){
			$data['result'] = $this->Comment_model->testimoni_query($strbengkel_id, $strquery, $config['per_page'], $page);
			//echo $this->db->last_query();
			//print_r($data['result']); 
			$config['total_rows'] = $this->Comment_model->testimoni_query_cnt($strbengkel_id, $strquery);
		}else{
			$data['result'] = $this->Comment_model->testimoni_query($_bengkel_id, '', $config['per_page'], $page);
			echo $this->db->last_query();	
			$config['total_rows'] = $this->Comment_model->testimoni_query_cnt($_bengkel_id,'');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		
		$this->load->view('admin/comment/user_testimoni',$data);
	}
}
