<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Pages
 * Class Name Pages
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Promo extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model('Promo_model');
	}
	
	function dashboard($_judul_promo='-', $_query='-', $_cari='-', $_page=0){
		
		$arrVar = array('judul_promo', 'query', 'cari', 'page');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
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
		
		if ($cari != ''){
			$config['base_url'] = site_url('promo/dashboard/'.$judul_promo.'/'.$query.'/'.$cari);
		}else{
			$config['base_url'] = site_url('promo/dashboard/');
		}
		
		$config['per_page'] = 35;
		if ($cari!=''){
			$config['uri_segment'] = 6;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($cari != ''){
			$data['result'] = $this->Promo_model->get_promo($strjudul_promo, $strquery, $config['per_page'], $page);
			$config['total_rows'] = $this->Promo_model->get_promo_cnt($strjudul_promo, $strquery);
		}else{
			$data['result'] = $this->Promo_model->get_promo('', '', $config['per_page'], $page);
			$config['total_rows'] = $this->Promo_model->get_promo_cnt('', '');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/promo/promo_index',$data);
	}
	
	public function add(){
		
		$this->load->view('admin/promo/add_promo');
	}
	
	public function edit(){
		
		$promo_id = $this->input->get_post('promo_id');
		
		$result = $this->Promo_model->get_promo_by_id($promo_id);
		
		if (!$result){
			show_404();
		}
		
		$data['result'] = $result;
		
		$this->load->view('admin/promo/edit_promo',$data);
	}
	
	function save_add(){
		
		$arrVar = array('judul_promo', 'sinopsis', 'content', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('judul_promo', 'Judul Promo', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
			}else{
				
				if ($_FILES['gambar']['error'] == 4){
					flashmsg_set('Error: File masih kosong');
					redirect('promo/dashboard','refresh');
				}else if ($_FILES) {
					$filepath = APPPATH.'../assets/images/galleries/promo';
					$filethumb = APPPATH.'../assets/images/galleries/promo/thumb/';
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
						$config['width']	 = 200;
						$config['height']	 = 100;

						$this->load->library('image_lib', $config);

						if(!$this->image_lib->resize()){
							flashmsg_set('Error : '.$this->image_lib->display_errors());
						}else{
							$this->image_lib->clear();
						}
						//save the pict
						
						$this->Promo_model->add_promo($judul_promo, $sinopsis, $content, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
						flashmsg_set('Berhasil simpan gambar profile');
					}else{
						flashmsg_set('Error: '.$this->upload->display_errors());
					}
					redirect('promo/dashboard','refresh');
				}
			}
		}
	}
	
	function save_edit(){
		$arrVar = array('promo_id', 'judul_promo', 'sinopsis', 'content', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('judul_promo', 'Judul Promo', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
			}else{
				
				if ($_FILES['gambar']['error'] == 4){
					
					$this->Promo_model->edit_promo($promo_id, $judul_promo, $sinopsis, $content);
					flashmsg_set('Berhasil mengubah Promo');
					redirect('promo/dashboard','refresh');
				}else if ($_FILES) {
					$filepath = APPPATH.'../assets/images/galleries/promo';
					$filethumb = APPPATH.'../assets/images/galleries/promo/thumb';
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
						$config['width']	 = 200;
						$config['height']	 = 100;

						$this->load->library('image_lib', $config);

						if(!$this->image_lib->resize()){
							flashmsg_set('Error : '.$this->image_lib->display_errors());
						}else{
							$this->image_lib->clear();
						}
						//save the pict
						
						$resPromo = $this->Promo_model->get_promo_by_id($promo_id);
						$file_promo = $resPromo[0]->file_promo;
						$file_thumb = $resPromo[0]->file_thumb;
						
						unlink($filepath.'/'.$file_promo);
						unlink($filepath.'/'.$file_thumb);
						
						$this->Promo_model->edit_promo($promo_id, $judul_promo, $sinopsis, $content, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
						flashmsg_set('Berhasil simpan gambar profile');
					}else{
						flashmsg_set('Error: '.$this->upload->display_errors());
					}
					//redirect('promo/dashboard','refresh');
				}
			}
		}
	}
	
	function delete(){
		$promo_id = $this->input->get_post('promo_id');
		
		$result = $this->Promo_model->get_promo_by_id($promo_id);
		
		if (!$result){
			show_404();
		}
		
		$this->Promo_model->delete($promo_id);
		flashmsg_set('Berhasil menghapus promo');
		redirect('promo/dashboard', 'refresh');
	}
}
