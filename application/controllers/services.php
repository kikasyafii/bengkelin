<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Services
 * Class Name Services
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Services extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Service_model');
		$this->load->model('Bengkel_model');
	}
	
	public function dashboard($_query='-', $_go='-', $_page=0){
		
		$arrVar = array('query', 'go', 'page');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$newvar)){
				$$var = urldecode($$newvar);
			}
		}
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
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

		if ($go != ''){
			$config['base_url'] = site_url('services/dashboard/'.$query.'/'.$go);
		}else{
			$config['base_url'] = site_url('services/dashboard/');
		}
		
		$config['per_page'] = 35;
		if ($go!=''){
			$config['uri_segment'] = 5;
		}else{
			$config['uri_segment'] = 3;
		}
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		
		$bengkel_id = $resBengkel[0]->bengkel_id;
		
		if ($go!=''){
			$data['result'] = $this->Service_model->get_service_all($bengkel_id,$query, $config['per_page'], $page);
			$config['total_rows'] = $this->Service_model->get_service_all_cnt($bengkel_id,$strquery);
		}else{
			$data['result'] = $this->Service_model->get_service_all($bengkel_id, '', $config['per_page'], $page);
			$config['total_rows'] = $this->Service_model->get_service_all_cnt($bengkel_id, '');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/services/service_index', $data);
	}
	
	function add_layanan_bengkel($bengkel_id=''){
		
		$data['resBengkel'] = FALSE;
		$data['result'] = FALSE;
		if ($bengkel_id == ''){
			$resBengkel = $this->Bengkel_model->get_bengkel_by_user_id($this->bengkelin_auth->user[0]->user_id);
			
			if (!$resBengkel){
				redirect('bengkel/bengkel_profile', 'refresh');
			}
			$data['resBengkel'] = $resBengkel;
		}else{
			$result = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
			if ($result){
				if ($result[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
					show_404();
				}
			}else{
				show_404();
			}
			
			$data['result'] = $result;
		}
		
		$this->load->view('admin/services/add_layanan_bengkel',$data);
	}
	
	function add(){
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		
		$data['bengkel_id'] = $resBengkel[0]->bengkel_id;
		
		$this->load->view('admin/services/add_services',$data);
	}
	
	function user_edit($bengkel_id, $service_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Gallery_model');
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
			show_404();
		}
		
		$resService=$this->Service_model->get_service_by_id($service_id);
		
		if (!$resService){
			show_404();
		}
		
		$this->session->set_flashdata('url', current_url());
		
		$data['bengkel_id'] = $bengkel_id;
		$data['result'] = $resService;
		$data['resGallery'] = $this->Gallery_model->get_gallery_layanan($bengkel_id, $service_id);
		
		$this->load->view('admin/services/user_edit_service', $data);
	}
	
	function edit(){
		
		$service_id = $this->input->get_post('id');
		
		$resService=$this->Service_model->get_service_by_id($service_id);
		
		if (!$resService){
			show_404();
		}
		
		$data['result'] = $resService;
		
		$this->load->view('admin/services/edit_service', $data);
	}
	
	function save_add_service(){
		
		$arrVar = array('bengkel_id', 'judul_layanan', 'konten', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('judul_layanan', 'Nama Layanan', 'required');
		$this->form_validation->set_rules('konten', 'Konten Layanan', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('services/add_layanan_bengkel/', 'refresh');
			}else  if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error : File masih kosong');
				redirect('services/add_layanan_bengkel/','refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/service';
				$filethumb = APPPATH.'../assets/images/galleries/service/thumb/';
				$userfile = $this->bengkelin_auth->make_hash(date('Y-m-d H:i:s'), '', TRUE);
				$tmp =  explode('/',$_FILES['gambar']['type']);
				$ext = $tmp[1];
				
				$configupload = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $filepath,
					'file_name' => $userfile.'.'.$ext,
					'max_size' => 2000
				);
				
				$this->load->library('upload',$configupload);
				
				if ($this->upload->do_upload('gambar')){
						
					$image_data = $this->upload->data();
				
					$config['image_library'] = 'gd2';
					$config['source_image']	= $image_data['full_path'];
					$config['new_image']	= $filethumb;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 254;
					$config['height']	 = 191;

					$this->load->library('image_lib', $config);

					if(!$this->image_lib->resize()){
						flashmsg_set('Error : '.$this->image_lib->display_errors());
					}else{
						$this->image_lib->clear();
					}
					//save the pict
					
					$layanan_id = $this->Service_model->add_service($bengkel_id, $judul_layanan, $konten);
					$this->load->model('Gallery_model');
					$this->Gallery_model->save_image_layanan($bengkel_id, $layanan_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil menambahkan layanan');
					redirect('services/layanan_bengkel','refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('services/add_layanan_bengkel/','refresh');
				}
			}
			/*{
				$this->Service_model->add_service($bengkel_id, $judul_layanan,$konten);
				flashmsg_set('Berhasil menyimpan layanan');
				redirect('services/layanan_bengkel/'.$bengkel_id, 'refresh');
			}*/
		}
	}
	
	function save_edit_service(){

		$arrVar = array('service_id', 'bengkel_id', 'judul_layanan', 'konten', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('judul_layanan', 'Nama Layanan', 'required');
		$this->form_validation->set_rules('konten', 'Konten Layanan', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('services/add_layanan_bengkel/'.$bengkel_id, 'refresh');
			}else{
				$this->Service_model->update_service($service_id, $judul_layanan, $konten);
				flashmsg_set('Berhasil menyimpan layanan');
				redirect('services/layanan_bengkel/'.$bengkel_id, 'refresh');
			}
		}
	}
	
	function save_user_edit_service(){

		$arrVar = array('service_id', 'bengkel_id', 'gambar', 'judul_layanan', 'konten', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('judul_layanan', 'Nama Layanan', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('services/add_layanan_bengkel/'.$bengkel_id, 'refresh');
			}elseif ($_FILES['gambar']['error'] == 4){
				$this->Service_model->update_service($service_id, $judul_layanan, $konten);
				flashmsg_set('Berhasil mengubah layanan');
				redirect('services/layanan_bengkel', 'refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/service';
				$filethumb = APPPATH.'../assets/images/galleries/service/thumb/';
				$userfile = $this->bengkelin_auth->make_hash(date('Y-m-d H:i:s'), '', TRUE);
				$tmp =  explode('/',$_FILES['gambar']['type']);
				$ext = $tmp[1];
				
				$configupload = array(
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $filepath,
					'file_name' => $userfile.'.'.$ext,
					'max_size' => 2000
				);
				
				$this->load->library('upload',$configupload);
				
				if ($this->upload->do_upload('gambar')){
						
					$image_data = $this->upload->data();
				
					$config['image_library'] = 'gd2';
					$config['source_image']	= $image_data['full_path'];
					$config['new_image']	= $filethumb;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	 = 254;
					$config['height']	 = 191;

					$this->load->library('image_lib', $config);

					if(!$this->image_lib->resize()){
						flashmsg_set('Error : '.$this->image_lib->display_errors());
					}else{
						$this->image_lib->clear();
					}
					//save the pict
					
					$this->Service_model->update_service($service_id, $judul_layanan, $konten);
					$this->load->model('Gallery_model');
					$this->Gallery_model->save_image_layanan($bengkel_id, $service_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil menambahkan layanan');
					redirect('services/layanan_bengkel','refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('services/user_edit/'.$bengkel_id.'/'.$service_id,'refresh');
				}
			}
		}
	}
	
	function user_delete($bengkel_id, $service_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Gallery_model');
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
			show_404();
		}
		
		$resService = $this->Service_model->get_service_by_id($service_id);
		
		if (!$resService){
			show_404();
		}
		
		$resGallery = $this->Gallery_model->get_gallery_layanan($bengkel_id, $service_id);
		
		if ($resGallery){
			foreach($resGallery as $row){
				unlink(APPPATH.'../assets/images/galleries/service/'.$row->file_layanan);
				unlink(APPPATH.'../assets/images/galleries/service/thumb/'.$row->thumb_layanan);
			}
		}
		
		$this->Service_model->delete_service($service_id);
		flashmsg_set('Berhasil menghapus layanan');
		redirect('services/layanan_bengkel/', 'refresh');
	}
	
	function delete(){
		
		$service_id = $this->input->get_post('id');
		
		$resService = $this->Service_model->get_service_by_id($service_id);
		
		if (!$resService){
			show_404();
		}
		
		$this->Service_model->delete_service($service_id);
		flashmsg_set('Berhasil menghapus layanan');
		redirect('services/dashboard', 'refresh');
	}
	
	function layanan($_bengkel_id='-', $_query='-',$_show='-',$_page=0){
		
		if ($this->bengkelin_auth->user[0]->user_id == ''){
			show_404();
		}
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_user_id($this->bengkelin_auth->user[0]->user_id);
		
		if (!$resBengkel){
			redirect('bengkel/bengkel_profile', 'refresh');
		}
		
		$arrVar = array('bengkel_id', 'query', 'show', 'page'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$data['bengkel_id'] = $_bengkel_id;
		
		$data['resBengkel'] = $resBengkel;
		
		if ($show != ''){
			$config['base_url'] = site_url('services/layanan/'.$bengkel_id.'/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('services/layanan/');
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
			$data['result'] = $this->Service_model->get_service_query_all($strbengkel_id, $strquery, $config['per_page'], $page);
			$config['total_rows'] = $this->Service_model->get_service_query_all_cnt($strbengkel_id, $strquery);
		}else{
			$data['result'] = $this->Service_model->get_service_query_all('', '', $config['per_page'], $page);
			$config['total_rows'] = $this->Service_model->get_service_query_all_cnt('', '');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/services/list_layanan_user', $data);
	}
	
	function layanan_bengkel($_bengkel_id='-',$_query='-',$_show='-', $_page=0){
		
		if ($this->bengkelin_auth->user[0]->user_id == '' && !isset($this->bengkelin_auth->user)){
			show_404();
		}
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_user_id($this->bengkelin_auth->user[0]->user_id);
		
		if (!$resBengkel){
			redirect('bengkel/bengkel_profile', 'refresh');
		}
		
		$arrVar = array('bengkel_id', 'query', 'show', 'page'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$data['bengkel_id'] = $_bengkel_id;
		
		$data['resBengkel'] = $resBengkel;
		
		if ($show != ''){
			$config['base_url'] = site_url('services/layanan_bengkel/'.$bengkel_id.'/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('services/layanan_bengkel/');
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
			$data['result'] = $this->Service_model->get_service_all($strbengkel_id, $strquery, $config['per_page'], $page);
			//echo $this->db->last_query();
			//print_r($data['result']); 
			$config['total_rows'] = $this->Service_model->get_service_all_cnt($strbengkel_id, $strquery);
		}else{
			$data['result'] = $this->Service_model->get_service_cnt('', '', $config['per_page'], $page);
			//echo $this->db->last_query();	
			$config['total_rows'] = $this->Service_model->get_service_all_cnt('','');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/services/layanan_bengkel',$data);
	}
	
	function layanan_bengkel_admin($bengkel_id){
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			show_404();
		}
		
		$result = $this->Service_model->get_service_by_bengkel_id($bengkel_id);
		
		$data['result'] = $result;
		$data['bengkel_id'] = $bengkel_id;
		
		$this->load->view('admin/services/layanan_bengkel_admin',$data);
	}
}
