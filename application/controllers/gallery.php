<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('allow_url_fopen', 1);
/**
 * Controller Name Users
 * Class Name Users
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Gallery extends CI_Controller {
	
	
	function __construct(){
		parent::__construct();
		$this->load->model('Gallery_model');
	}
	
	public function admin_user(){
		
		$user_id = $this->input->get_post('id');
		$data['user_id'] = $user_id;
		if ($this->bengkelin_auth->user[0]->group_id > 2){
			show_404();
		}
		
		$resGallery = $this->Gallery_model->get_profpic($user_id);
		$data['resGallery'] = $resGallery;
		
		$this->load->view('admin/users/admin_profile',$data);
	}
	
	public function gallery_profile(){
		
		if (!isset($this->bengkelin_auth->user) || $this->bengkelin_auth->user[0] == ''){
			redirect('auth/login', 'refresh');
		}
		
		$resGallery = $this->Gallery_model->get_profpic($this->bengkelin_auth->user[0]->user_id);
			
		$data['resGallery'] = $resGallery;
		
		$this->load->view('admin/users/upload_profile',$data);
	}
	
	public function gallery_bengkel($bengkel_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$data['bengkel_id'] = $bengkel_id;
		
		$data['resBengkel'] = $resBengkel;
		
		$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		$data['resGallery'] = $resGallery;
		
		$this->load->view('admin/gallery/bengkel_gallery',$data);
	}
	
	public function save_profile_gallery(){
		
		$gambar = $this->input->post('gambar');
		$save = $this->input->post('save');
		
		$user_id = $this->bengkelin_auth->user[0]->user_id;
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/gallery_profile','refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/users';
				$filethumb = APPPATH.'../assets/images/galleries/users/thumb/';
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
					
					$resGallery = $this->Gallery_model->get_profpic($user_id);
					
					unlink($filepath.'/'.$resGallery[0]->name_file);
					unlink($filethumb.$resGallery[0]->thumb_file);
					
					$this->Gallery_model->set_all_inactive($user_id);
					$this->Gallery_model->delete_all_inactive($user_id);
					
					$this->Gallery_model->save_image_profile($user_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					$new_gal_id = $this->db->insert_id();
					
					flashmsg_set('Berhasil simpan gambar profile');
					redirect('gallery/set_crop?gallery_id='.$new_gal_id, 'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
				}
				redirect('gallery/gallery_profile','refresh');
			}else{
			}
		
		}
	}
	
	public function admin_save_profile(){
		
		$gambar = $this->input->post('gambar');
		$save = $this->input->post('save');
		
		$user_id = $this->input->post('user_id');
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/admin_user?id='.$user_id,'refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/users';
				$filethumb = APPPATH.'../assets/images/galleries/users/thumb/';
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
					
					$resGallery = $this->Gallery_model->get_profpic($user_id);
					
					@unlink($filepath.'/'.$resGallery[0]->name_file);
					@unlink($filethumb.$resGallery[0]->thumb_file);
					
					$this->Gallery_model->set_all_inactive($user_id);
					$this->Gallery_model->delete_all_inactive($user_id);
					
					$this->Gallery_model->save_image_profile($user_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					$new_gal_id = $this->db->insert_id();
					
					flashmsg_set('Berhasil simpan gambar profile');
					redirect('gallery/set_crop?gallery_id='.$new_gal_id, 'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
				}
				redirect('gallery/admin_user?id='.$user_id,'refresh');
			}else{
			}
		}
	}
	
	public function save_bengkel_gallery(){
		$bengkel_id = $this->input->post('bengkel_id');
		$gambar = $this->input->post('gambar');
		$save = $this->input->post('save');
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/gallery_bengkel/'.$bengkel_id,'refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/bengkel';
				$filethumb = APPPATH.'../assets/images/galleries/bengkel/thumb/';
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
					
					$this->Gallery_model->save_image_bengkel($bengkel_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil simpan gambar bengkel');
					redirect('gallery/gallery_bengkel/'.$bengkel_id,'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('gallery/gallery_bengkel/'.$bengkel_id,'refresh');
				}
				
			}else{
				
			}
		}
	}
	
	public function admin_save_bengkel(){
		$gambar = $this->input->post('gambar');
		$save = $this->input->post('save');
		$id = $this->input->post('id');
		
		$this->load->model('Bengkel_model');
		$bengkel_id = $id;
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/admin_bengkel?id='.$id,'refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/bengkel';
				$filethumb = APPPATH.'../assets/images/galleries/bengkel/thumb/';
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
					
					$this->Gallery_model->save_image_bengkel($bengkel_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil simpan gambar bengkel');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
				}
				redirect('gallery/admin_bengkel?id='.$id,'refresh');
			}else{
				
			}
		}
	}
	
	public function set_active(){
		$gallery_id = $this->input->get_post('gallery_id');
		
		$user_id = $this->bengkelin_auth->user[0]->user_id;
		
		$this->Gallery_model->set_active($user_id, $gallery_id);
		
		flashmsg_set('Berhasil mengaktifkan Foto Profile');
		redirect('gallery/gallery_profile', 'refresh');
	}
	
	public function set_inactive(){
		$gallery_id = $this->input->get_post('gallery_id');
		
		$user_id = $this->bengkelin_auth->user[0]->user_id;
		
		$this->Gallery_model->set_inactive($user_id, $gallery_id);
		
		flashmsg_set('Berhasil menon-aktifkan Foto Profile');
		redirect('gallery/gallery_profile', 'refresh');
	}
	
	public function admin_profile_delete(){
		
		$gallery_id = $this->input->get_post('gallery_id');
		
		$user_id = $this->input->get_post('user_id');
		
		if ($this->bengkelin_auth->user[0]->group_id > 2){
			show_404();
		}
		
		$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		if (!$resGallery){
			show_404();
		}
		
		$filepath = APPPATH.'../assets/images/galleries/users';
		$filethumb = APPPATH.'../assets/images/galleries/users/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->name_file) or die('Gagal ');
		unlink($filethumb.'/'.$resGallery[0]->thumb_file) or die('Gagal cuy');
		
		$this->Gallery_model->delete_image($user_id, $gallery_id);
		
		flashmsg_set('Berhasil menghapus foto');
		redirect('gallery/admin_user?id='.$user_id, 'refresh');
	}
	
	public function delete(){
		
		$gallery_id = $this->input->get_post('gallery_id');
		
		$user_id = $this->bengkelin_auth->user[0]->user_id;
		
		$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		if (!$resGallery){
			show_404();
		}
		
		if ($this->bengkelin_auth->user[0]->user_id != $resGallery[0]->user_id)
			show_404();
		
		$filepath = APPPATH.'../assets/images/galleries/users';
		$filethumb = APPPATH.'../assets/images/galleries/users/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->name_file) or die('Gagal ');
		unlink($filethumb.'/'.$resGallery[0]->thumb_file) or die('Gagal cuy');
		
		$this->Gallery_model->delete_image($user_id, $gallery_id);
		
		flashmsg_set('Berhasil menghapus foto');
		redirect('gallery/gallery_profile', 'refresh');
	}
	
	public function delete_bengkel(){
		
		$gallery_id = $this->input->get_post('gallery_id');
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		$bengkel_id = $resBengkel[0]->bengkel_id;
		
		$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		
		if (!$resGallery){
			show_404();
		}
		
		$filepath = APPPATH.'../assets/images/galleries/bengkel';
		$filethumb = APPPATH.'../assets/images/galleries/bengkel/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->name_file);
		unlink($filethumb.'/'.$resGallery[0]->thumb_file);
		
		$this->Gallery_model->delete_image_bengkel($bengkel_id,$gallery_id);
		
		flashmsg_set('Berhasil menghapus foto bengkel');
		redirect('gallery/gallery_bengkel', 'refresh');
	}
	
	public function admin_delete(){
		
		$gallery_id = $this->input->get_post('gallery_id');
		$bengkel_id = $this->input->get_post('bengkel_id');
		
		if ($this->bengkelin_auth->user[0]->group_id>2){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		
		if (!$resGallery){
			show_404();
		}
		
		$filepath = APPPATH.'../assets/images/galleries/bengkel';
		$filethumb = APPPATH.'../assets/images/galleries/bengkel/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->name_file);
		unlink($filethumb.'/'.$resGallery[0]->thumb_file);
		
		$this->Gallery_model->delete_image_bengkel($bengkel_id,$gallery_id);
		
		flashmsg_set('Berhasil menghapus foto bengkel');
		redirect('gallery/admin_bengkel?id='.$bengkel_id, 'refresh');
	}
	
	public function rotate_image($gallery_id, $direction){
		
		$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		$file_name = $resGallery[0]->name_file;
		$name_thumb = $resGallery[0]->thumb_file;
		
		$this->load->library('image_lib');
		
		$filepath = APPPATH.'../assets/images/galleries/users/';
		$filethumb = APPPATH.'../assets/images/galleries/users/thumb/';
		
		$config['image_library'] = 'gd2';
		//$config['library_path'] = '/usr/bin/';
		$config['source_image']	= $filepath.$file_name;
		$config['rotation_angle'] = $direction;
			
		
		$this->image_lib->initialize($config); 
		if ( ! $this->image_lib->rotate())
		{
			echo $this->image_lib->display_errors();
		}else{
		
			$this->image_lib->clear();
			
			$config2['image_library'] = 'gd2';
	//		$config['library_path'] = '/usr/bin/';
			$config2['source_image']	= $filethumb.$name_thumb;
			$config2['rotation_angle'] = $direction;
			
			$this->image_lib->initialize($config2); 
			

			if ( ! $this->image_lib->rotate())
			{
				echo $this->image_lib->display_errors();
			}
		}
		
		flashmsg_set('Gambar telah dibuah');
		redirect('gallery/gallery_profile', 'refresh');
	}
	
	public function set_crop(){
		
		$gallery_id = $this->input->get_post('gallery_id');
		
		$resultGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		if (!$resultGallery){
			show_404();
		}
		
		if ($resultGallery[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			if ($this->bengkelin_auth->user[0]->group_id > 2){
				show_404();
			}
		}
		
		$data['resultGallery'] = $resultGallery;
		$data['gallery_id'] = $gallery_id;
		
		$this->load->view('admin/gallery/crop_image',$data);
	}
	
	function image_crop($x,$y,$w,$h,$gallery_id){
		
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;

		$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		//$src = APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file;
		$src = APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file;
		
		$ext = pathinfo($src, PATHINFO_EXTENSION);
		
//			die;
		//echo $src;
		//die;
		if ($ext == 'jpeg' || $ext == 'jpg'){
			$img_r = imagecreatefromjpeg($src);
		}else if ($ext == 'gif'){
			$img_r = imagecreatefromgif($src);
		}else if ($ext == 'png'){
			$img_r = imagecreatefrompng($src);
		}
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$x,$y, $targ_w,$targ_h,$w,$h) or die('Error');;

		if ($ext == 'jpeg' || $ext == 'jpg'){
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$jpeg_quality);
		}else if ($ext == 'gif'){
			header('Content-type: image/gif');
			//imagegif($dst_r,null,$jpeg_quality);
		}else if ($ext == 'png'){
			header('Content-type: image/png');
			imagepng($dst_r,null,$jpeg_quality);
		}
		
		imagedestroy($dst_r);
		
	

	}
	
	function crop_image_thumb($gallery_id){
		
		$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);
		
		$filename = APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file;
		
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		if ($ext == 'jpeg' || $ext == 'jpg'){
			header('Content-type: image/jpeg');
			//imagejpeg($dst_r,null,$jpeg_quality);
		}else if ($ext == 'gif'){
			header('Content-type: image/gif');
			//imagegif($dst_r,null,$jpeg_quality);
		}else if ($ext == 'png'){
			header('Content-type: image/png');
			//imagepng($dst_r,null,$jpeg_quality);
		}
		
		$percent = 0.5;

		// Content type
		//header('Content-Type: image/jpeg');

		// Get new sizes
		list($width, $height) = getimagesize($filename);
		$newwidth = $width * $percent;
		$newheight = $height * $percent;

		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		
		if ($ext == 'jpeg' || $ext == 'jpg'){
			$source = imagecreatefromjpeg($filename);
		}else if ($ext == 'gif') {
			$source = imagecreatefromgif($filename);
		}else if ($ext == 'png'){
			$source = imagecreatefrompng($filename);
		}

		// Resize
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		if ($ext == 'jpeg' || $ext == 'jpg'){
			// Output
			imagejpeg($thumb);
		} else if ($ext == 'gif'){
			// Output
			imagegif($thumb);
		} else if ($ext == 'png'){
			// Output
			imagepng($thumb);
		}
		
		imagedestroy($thumb);
		
	}
	
	function save_crop(){
		
		$arrVar = array('x','y','w','h','gallery_id', 'crop'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($crop){
			
			$url = base_url().'index.php/gallery/image_crop/'.$x.'/'.$y.'/'.$w.'/'.$h.'/'.$gallery_id;
			
			//$thefile = file_get_contents($url);
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data_raw = curl_exec($ch);
			curl_close($ch);
			//$data = file_get_contents($data_raw);
			//$data = simplexml_load_string($data_raw);
			
			//echo $thefile;
			
			//$data = base64_encode($thefile);
			
			$resGallery = $this->Gallery_model->get_image_by_id($gallery_id);

			//$src = APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file;
			$src = APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file;
			
			$ext = pathinfo($src, PATHINFO_EXTENSION);
			
			
			$fh = fopen(APPPATH.'../assets/images/galleries/users/'.$resGallery[0]->name_file, 'wb');
			fwrite($fh, $data_raw);
			fclose($fh);
			
			/*$this->crop_image_thumb($gallery_id);*/
			
			$urlthumb = base_url().'index.php/gallery/crop_image_thumb/'.$gallery_id;
			$ch = curl_init($urlthumb);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$thumb_raw = curl_exec($ch);
			curl_close($ch);
			
			//$datathumb = file_get_contents($thumb_raw);
			//$datathumb = simplexml_load_string($thumb_raw);
			
			$fh = fopen(APPPATH.'../assets/images/galleries/users/thumb/'.$resGallery[0]->thumb_file, 'wb');
			fwrite($fh, $thumb_raw);
			fclose($fh);
			
			/**/
		}
		flashmsg_set('Gambar berhasil diedit');
		
		if ($this->bengkelin_auth->user[0]->group_id > 2){
			redirect('users/profile', 'refresh');
		}else{
			redirect('users', 'refresh');
		}
	}
	
	function admin_bengkel(){
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			show_404();
		}
		
		$bengkel_id = $this->input->get_post('id');
		$data['bengkel_id'] = $bengkel_id;
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if (!$resBengkel){
			show_404();
		}
		
		$data['resBengkel'] = $resBengkel;
		
		if ($resBengkel){
			
			$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
			
			$data['resGallery'] = $resGallery;
		}else{
			$data['resGallery'] = FALSE;
		}
		
		$this->load->view('admin/gallery/admin_bengkel',$data);
	}
	
	function produk_gallery($bengkel_id, $produk_id){
		if (!isset($this->bengkelin_auth->user) || $this->bengkelin_auth->user[0] == ''){
			redirect('auth/login', 'refresh');
		}
		
		$resGallery = $this->Gallery_model->get_profpic($this->bengkelin_auth->user[0]->user_id);
			
		$data['resGallery'] = $resGallery;
		
		$this->load->view('admin/users/upload_profile',$data);
	}
	
	/*** GALLERY PRODUK & LAYANAN ****/
	
	function gallery_layanan($bengkel_id, $layanan_id){
		
		if ($bengkel_id == '' || $layanan_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$result = $this->Gallery_model->get_gallery_layanan($bengkel_id,$layanan_id);
		$data['result'] = $result;
		$data['bengkel_id'] = $bengkel_id;
		$data['layanan_id'] = $layanan_id;
		$this->load->view('admin/gallery/layanan', $data);
	}
	
	function gallery_produk($bengkel_id, $produk_id){
		
		if ($bengkel_id == '' || $produk_id == ''){
			show_404();
		}
		
		$this->load->model('Bengkel_model');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$result = $this->Gallery_model->get_gallery_produk($bengkel_id,$produk_id);
		$data['result'] = $result;
		$data['bengkel_id'] = $bengkel_id;
		$data['produk_id'] = $produk_id;
		
		$this->session->set_flashdata('url', current_url());
		
		$this->load->view('admin/gallery/produk', $data);
	}
	
	function save_admin_produk(){
	}
	
	function save_admin_layanan(){
	}
	
	function save_produk(){
		$arrVar = array('bengkel_id', 'produk_id', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/gallery_produk/'.$bengkel_id.'/'.$produk_id,'refresh');
			}else if ($_FILES) {
				$filepath = APPPATH.'../assets/images/galleries/product';
				$filethumb = APPPATH.'../assets/images/galleries/product/thumb/';
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
					
					$this->Gallery_model->save_image_produk($bengkel_id, $produk_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil simpan gambar bengkel');
					redirect('gallery/gallery_produk/'.$bengkel_id.'/'.$produk_id,'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('gallery/gallery_produk/'.$bengkel_id.'/'.$produk_id,'refresh');
				}
				
			}else{
				
			}
		}
	}
	
	function save_layanan(){
		$arrVar = array('bengkel_id', 'layanan_id', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			
			if ($_FILES['gambar']['error'] == 4){
				flashmsg_set('Error: File masih kosong');
				redirect('gallery/gallery_layanan/'.$bengkel_id.'/'.$layanan_id,'refresh');
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
					
					$this->Gallery_model->save_image_layanan($bengkel_id, $layanan_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil simpan gambar bengkel');
					redirect('gallery/gallery_layanan/'.$bengkel_id.'/'.$layanan_id,'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('gallery/gallery_layanan/'.$bengkel_id.'/'.$layanan_id,'refresh');
				}
				
			}else{
				
			}
		}
	}
	
	function delete_produk($id){
		
		$resGallery = $this->Gallery_model->get_gallery_by_id($id);
		
		if (!$resGallery){
			show_404();
		}
	//	print_r($resGallery); die;
		$resBengkel = $this->bengkelin->get_bengkel($resGallery[0]->bengkel_id);
		
		if ($this->bengkelin_auth->user[0]->user_id != $resBengkel->user_id){
			show_404();
		}
		
		$filepath = APPPATH.'../assets/images/galleries/product';
		$filethumb = APPPATH.'../assets/images/galleries/product/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->file_produk);
		unlink($filethumb.'/'.$resGallery[0]->thumb_produk);
		
		$this->Gallery_model->delete_produk($id);
		flashmsg_set('Berhasil menghapus gambar');
		redirect($this->session->flashdata('url'), 'refresh');
	}
	
	function delete_layanan($id){
		
		$resGallery = $this->Gallery_model->get_layanan_by_id($id);
		
		if (!$resGallery){
			show_404();
		}
		
		$resBengkel = $this->bengkelin->get_bengkel($resGallery[0]->bengkel_id);
		
		if ($this->bengkelin_auth->user[0]->user_id != $resBengkel->user_id){
			show_404();
		}
		
		
		$filepath = APPPATH.'../assets/images/galleries/service';
		$filethumb = APPPATH.'../assets/images/galleries/service/thumb';
		
		unlink($filepath.'/'.$resGallery[0]->file_layanan);
		unlink($filethumb.'/'.$resGallery[0]->thumb_layanan);
		
		$this->Gallery_model->delete_layanan($id);
		flashmsg_set('Berhasil menghapus gambar');
		redirect('gallery/gallery_layanan/'.$resGallery[0]->bengkel_id.'/'.$resGallery[0]->layanan_id, 'refresh');
	}
	
	function admin_add_produK(){
	}
	
	function admin_add_layanan(){
	}
	
	function admin_delete_produk(){
	}
	
	function admin_delete_layanan(){
	}
	
	/*** end ***/
}
