<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Partners
 * Class Name Partners
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Partners extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Partner_model');
	}
	
	function add(){
		$this->load->view('admin/partner/add_partner');
	}
	
	function edit(){
		
		$partner_id = $this->input->get_post('id');
		
		$resPartner = $this->Partner_model->get_partner_by_id($partner_id);
		
		if (!$resPartner){
			show_404();
		}
		
		$data['result'] = $resPartner;
		
		$this->load->view('admin/partner/edit_partner',$data);
	}
	
	function dashboard($_query='-',$_go='-',$_page=0){
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
			$config['base_url'] = site_url('partners/dashboard/'.$query.'/'.$go);
		}else{
			$config['base_url'] = site_url('partners/dashboard/');
		}
		
		$config['per_page'] = 35;
		if ($go!=''){
			$config['uri_segment'] = 5;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($go!=''){
			$data['result'] = $this->Partner_model->get_partner($query, $config['per_page'], $page);
			$config['total_rows'] = $this->Partner_model->get_partner_cnt($strquery);
		}else{
			$data['result'] = $this->Partner_model->get_partner('', $config['per_page'], $page);
			$config['total_rows'] = $this->Partner_model->get_partner_cnt('');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/partner/partner_dashboard', $data);
	}
	
	function save_add(){
		
		$arrVar = array('nama_partner', 'deskripsi', 'gambar', 'is_active', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('partners/add','refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/partner';
				$filethumb = APPPATH.'../assets/images/galleries/partner/thumb/';
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
					
					$this->Partner_model->add($nama_partner, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext, $deskripsi, $is_active);
					flashmsg_set('Berhasil menyimpan partner');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
				}
				redirect('partners/dashboard','refresh');
			}
		}
	}
	
	function save_edit(){
		$arrVar = array('partner_id', 'nama_partner', 'deskripsi', 'gambar', 'is_active', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				
				$this->Partner_model->edit($partner_id, $nama_partner,'','', $deskripsi, $is_active);
				
				flashmsg_set('Berhasil mengubah partner '.$this->db->last_query());
				
				redirect('partners/dashboard','refresh');
			}else if ($_FILES) {
				
				$resPartner = $this->Partner_model->get_partner_by_id($partner_id);
				
				/*** DELETE FIRST ****/
				unlink(APPPATH.'../assets/images/galleries/partner/'.$resPartner[0]->name_file);
				unlink(APPPATH.'../assets/images/galleries/partner/thumb/'.$resPartner[0]->thumb_file);
				
				/*** --- ***/
				
				$filepath = APPPATH.'../assets/images/galleries/partner';
				$filethumb = APPPATH.'../assets/images/galleries/partner/thumb/';
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
					
					$this->Partner_model->edit($partner_id, $nama_partner, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext, $deskripsi, $is_active);
					flashmsg_set('Berhasil mengubah partner');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
				}
				redirect('partners/dashboard','refresh');
			}
		}
	}
	
	function delete(){
		$partner_id = $this->input->get_post('id');
		
		$resPartner = $this->Partner_model->get_partner_by_id($partner_id);
		
		if (!$resPartner){
			show_404();
		}
		
		/*** DELETE FIRST ****/
		unlink(APPPATH.'../assets/images/galleries/partner/'.$resPartner[0]->name_file);
		unlink(APPPATH.'../assets/images/galleries/partner/thumb/'.$resPartner[0]->thumb_file);
		
		/*** --- ***/
		
		$this->Partner_model->delete($partner_id);
		
		flasmsg_set('Berhasil menghapus partner');
		redirect('partners/dashboard', 'refresh');
	}
}
