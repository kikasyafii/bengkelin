<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Bengkel
 * Class Name Bengkel
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Bengkel extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model('Bengkel_model');
		$this->load->model('User_model');
	}
	
	public function dashboard($_query='-', $_jenis_id='-', $_show='-', $_page=0){
		$this->bengkelin_auth->check_perms();
		$arrVar = array('query', 'jenis_id', 'show', 'page'); 
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		
		if ($show != ''){
			$config['base_url'] = site_url('bengkel/dashboard/'.$query.'/'.$jenis_id.'/'.$show);
		}else{
			$config['base_url'] = site_url('bengkel/dashboard/');
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
			$data['result'] = $this->Bengkel_model->get_bengkel_query($strquery, $strjenis_id, $config['per_page'], $page);
			//echo $this->db->last_query();
			$config['total_rows'] = $this->Bengkel_model->get_bengkel_query_cnt($strquery,$strjenis_id);
		}else{
			$data['result'] = $this->Bengkel_model->get_bengkel_query('', '', $config['per_page'], $page);
			//echo $this->db->last_query();	
			$config['total_rows'] = $this->Bengkel_model->get_bengkel_query_cnt('','');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/bengkel/bengkel_dashboard',$data);
	}
	
	public function modal_add_bengkel(){
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		$this->load->view('admin/bengkel/modal_add_bengkel',$data);
	}
	
	public function modal_edit_bengkel(){
		
		$bengkel_id = $this->input->get_post('bengkel_id');
		$data['bengkel_id'] = $bengkel_id;
		$result = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if (!$result)
			show_404();
		
		$data['result'] = $result;
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		$this->load->view('admin/bengkel/modal_edit_bengkel', $data);
	}
	
	public function bengkel_profile(){ //for users
		$this->bengkelin_auth->login_required();
		$user_id = $this->bengkelin_auth->user[0]->user_id;
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_user_id($user_id);
		if ($resBengkel){
			$data['result']= $resBengkel;
			
			$arr = array();
			$resJenis = $this->Bengkel_model->get_jenis_bengkel();
			foreach($resJenis as $row){
				$arr[$row->jenis_id] = ucwords($row->nama_jenis);
			}
			
			$data['arrJenis'] = $arr;
		
			$this->load->view('admin/bengkel/list_user_bengkel',$data);
		}else{
			$this->load->view('admin/bengkel/belum_ada_profile');
		}
	}
	
	public function save_add_bengkel_user(){
		
		$arrVar = array('username', 'nama_bengkel', 'alamat_bengkel', 'jenis_id', 'city', 'propinsi', 'zippostal', 'email', 'telp', 'country', 'fax','deskripsi', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_bengkel', 'Nama Bengkel', 'required');
		$this->form_validation->set_rules('email', 'Username', 'valid_email');
		
		if ($save){
			
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('bengkel/add_bengkel', 'redirect');
			}else{
				$user_id = $this->bengkelin_auth->user[0]->user_id;
				
				$this->Bengkel_model->add_bengkel($user_id, $jenis_id, $nama_bengkel,$alamat_bengkel, $city, $propinsi, $country, $zippostal, $telp, $fax, $email, $deskripsi );
				flashmsg_set('Berhasil menambahkan bengkel');
				redirect('bengkel/bengkel_profile', 'refresh');
				
			}
			
		}
	}
	
	public function save_add(){
		
		$arrVar = array('username', 'nama_bengkel', 'alamat_bengkel', 'jenis_id', 'city', 'propinsi', 'zippostal', 'email', 'telp', 'country', 'fax','deskripsi', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_bengkel', 'Nama Bengkel', 'required');
		$this->form_validation->set_rules('email', 'Username', 'valid_email');
		
		if ($save){
			
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('bengkel/dashboard', 'redirect');
			}else{
				$resUser = $this->User_model->get_user_by_username($username);
				if ($resUser){
					$user_id = $resUser[0]->user_id;
				}else{
					$user_id = 0;
				}
				
				$this->Bengkel_model->add_bengkel($user_id, $jenis_id, $nama_bengkel,$alamat_bengkel, $city, $propinsi, $country, $zippostal, $telp, $fax, $email, $deskripsi );
				flashmsg_set('Berhasil menambahkan bengkel');
				redirect('bengkel/dashboard', 'refresh');
				
			}
			
		}
	}
	
	public function save_edit(){
		
		$arrVar = array('bengkel_id', 'username', 'jenis_id', 'nama_bengkel', 'alamat_bengkel', 'city', 'propinsi', 'zippostal', 'email', 'telp', 'country', 'fax','deskripsi', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_bengkel', 'Nama Bengkel', 'required');
		//$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Username', 'valid_email');
		
		if ($save){
			
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('bengkel/dashboard', 'redirect');
			}else{
				$user_id = 0;
				if ($username != ''){
					$resUser = $this->User_model->get_user_by_username($username);
					if (!$resUser){
						flashmsg_set('Error: Username tidak dikenal');
						redirect('bengkel/dashboard', 'redirect');
					}
					$user_id = $resUser[0]->user_id;
				}
				$this->Bengkel_model->edit_bengkel($bengkel_id, $user_id, $jenis_id, $nama_bengkel,$alamat_bengkel, $city, $propinsi, $country, $zippostal, $telp, $fax, $email, $deskripsi );
				echo $this->db->last_query();
				flashmsg_set('Berhasil menambahkan bengkel');
				//redirect('bengkel/dashboard', 'refresh');
			}
			
		}
	}
	
	function delete_produk($bengkel_id, $produk_id){
		
		$resProduk = $this->Bengkel_model->get_produk_by_id($produk_id);
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if (!$resProduk){
			show_404();
		}
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
				show_404();
			}
		}
		
		$this->Bengkel_model->delete_produk($produk_id,$bengkel_id);
		
		if ($resGallery){
			$resGallery = $this->Gallery_model->get_produk_by_id($produk_id);
			
			foreach($resGallery as $row){
				unlink(APPPATH.'../assets/images/galleries/product/'.$row->file_produk);
				unlink(APPPATH.'../assets/images/galleries/product/thumb/'.$row->thumb_produk);
			}
		
			$this->Gallery_model->delete_produk($produk_id);
		}
		flashmsg_set('Berhasil menghapus produk');
		redirect($this->session->flashdata('url'), 'refresh');
	}
	
	function delete(){
		$bengkel_id = $this->input->get_post('bengkel_id');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		if (!$resBengkel){
			show_404();
		}
		
		$this->Bengkel_model->delete_bengkel($bengkel_id);
		
		flashmsg_set('Berhasil menghapus bengkel '.$resBengkel[0]->nama_bengkel);
		redirect('bengkel/dashboard', 'refresh');
	}
	
	function user_delete(){
		$bengkel_id = $this->input->get_post('bengkel_id');
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		if (!$resBengkel){
			shoew_404();
		}
		
		$this->Bengkel_model->delete_bengkel($bengkel_id);
		
		flashmsg_set('Berhasil menghapus bengkel '.$resBengkel[0]->nama_bengkel);
		redirect('bengkel/bengkel_profile', 'refresh');
	}
	
	public function detail_bengkel($bengkel_id){
		
		
		$result = $this->Bengkel_model->get_detail_bengkel($bengkel_id);
		if (!$result){
			show_404();
		}
		
		if ($this->bengkelin_auth->user[0]->group_id != 1){
			if ($result[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
				show_404();
			}
		}
		
		$data['result'] = $result;
		$this->load->model('Service_model'); 
		$data['resLayanan'] = $this->Service_model->get_service_by_bengkel_id($bengkel_id);
		$this->load->model('Comment_model');
		$data['resTestimoni'] = $this->Comment_model->get_testimoni($bengkel_id);
		
		$this->load->view('admin/bengkel/detail_bengkel', $data);
	}
	
	public function bengkel_venue(){
		
		$bengkel_id = $this->input->get_post('bengkel_id');
		$location = $this->input->post('location');
		$go = $this->input->post('go');
		$data['bengkel_id'] = $bengkel_id;
		$data['location'] = $location;
		$result = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		$lat = $result[0]->latitude;
		$lng = $result[0]->longitude;
		
		if (!$result)
			show_404();
			
		$data['result'] = $result;
		
		$this->load->library('googlemaps');

		if ($go){
			$location = preg_replace("/, /", " ", $location);
			$wordLocation = preg_replace("/ /" , "\+", $location);
			
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$wordLocation."&sensor=true";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response_a = json_decode($response);
			
			$lat = $response_a->results[0]->geometry->location->lat;
			$lng = $response_a->results[0]->geometry->location->lng;
			
			
			$config['center'] = $lat.', '.$lng;
			$config['zoom'] = '18';
			$config['map_width'] = '600';
			$this->googlemaps->initialize($config);

			$marker = array();
			$marker['position'] = $lat.', '.$lng;
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			
		}else{
			
			if (empty($lat) || empty($lng)){
			
				/*$url = "http://maps.googleapis.com/maps/api/geocode/json?address=Malang+Jawa+Timur+Indonesia&sensor=true";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);
				
				$lat = $response_a->results[0]->geometry->location->lat;
				$lng = $response_a->results[0]->geometry->location->lng;*/
				$config = array();
				$config['center'] = 'auto';
				$config['zoom'] = '18';
				$config['map_width'] = '600';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}else{
				
				$config = array();
				$config['center'] = $lat.','.$lng;
				$config['map_width'] = '600';
				$config['zoom'] = '18';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}
			
			$this->googlemaps->initialize($config);
			   
			// set up the marker ready for positioning 
			// once we know the users location
			$marker = array();
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
		}
		
		$this->load->view('admin/bengkel/bengkel_venue',$data);
	}
	
	public function bengkel_venue_profile($bengkel_id){
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if (!$resBengkel)
			show_404();
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
				show_404();
			}
		}
		
		$location = $this->input->post('location');
		$go = $this->input->post('go');
		$data['bengkel_id'] = $bengkel_id;
		$data['location'] = $location;
		$result = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		$lat = $result[0]->latitude;
		$lng = $result[0]->longitude;
		
		if (!$result)
			show_404();
			
		$data['result'] = $result;
		
		$this->load->library('googlemaps');

		if ($go){
			$location = preg_replace("/, /", " ", $location);
			$wordLocation = preg_replace("/ /" , "\+", $location);
			
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$wordLocation."&sensor=true";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response_a = json_decode($response);
			
			$lat = $response_a->results[0]->geometry->location->lat;
			$lng = $response_a->results[0]->geometry->location->lng;
			
			
			$config['center'] = $lat.', '.$lng;
			$config['zoom'] = '18';
			$config['map_width'] = '600';
			$this->googlemaps->initialize($config);

			$marker = array();
			$marker['position'] = $lat.', '.$lng;
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			
		}else{
			
			if (empty($lat) || empty($lng)){
			
				/*$url = "http://maps.googleapis.com/maps/api/geocode/json?address=Malang+Jawa+Timur+Indonesia&sensor=true";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);
				
				$lat = $response_a->results[0]->geometry->location->lat;
				$lng = $response_a->results[0]->geometry->location->lng;*/
				$config = array();
				$config['center'] = 'auto';
				$config['zoom'] = '18';
				$config['map_width'] = '600';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}else{
				
				$config = array();
				$config['center'] = $lat.','.$lng;
				$config['map_width'] = '600';
				$config['zoom'] = '18';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}
			
			$this->googlemaps->initialize($config);
			   
			// set up the marker ready for positioning 
			// once we know the users location
			$marker = array();
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
		}
		
		$this->load->view('admin/bengkel/bengkel_venue_profile',$data);
	}
	
	
/*	function bengkel_location($username=''){
		
		if (!isset($this->bengkelin_auth->user[0]->username) || ($this->bengkelin_auth->user[0]->username == '')){
			redirect('auth/login', 'refresh');
		}
		
		if ($username == ''){
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		}else{
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($username);
		}
		$bengkel_id = $resBengkel[0]->bengkel_id;
		
		$location = $this->input->post('location');
		$go = $this->input->post('go');
		$data['bengkel_id'] = $bengkel_id;
		$data['location'] = $location;
		$result = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		$lat = $result[0]->latitude;
		$lng = $result[0]->longitude;
		
		if (!$result)
			show_404();
			
		$data['result'] = $result;
		
		$this->load->library('googlemaps');

		if ($go){
			$location = preg_replace("/, /", " ", $location);
			$wordLocation = preg_replace("/ /" , "\+", $location);
			
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$wordLocation."&sensor=true";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response_a = json_decode($response);
			
			$lat = $response_a->results[0]->geometry->location->lat;
			$lng = $response_a->results[0]->geometry->location->lng;
			
			
			$config['center'] = $lat.', '.$lng;
			$config['zoom'] = '18';
			$config['map_width'] = '600';
			$this->googlemaps->initialize($config);

			$marker = array();
			$marker['position'] = $lat.', '.$lng;
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			
		}else{
			
			if (empty($lat) || empty($lng)){
			
				/*$url = "http://maps.googleapis.com/maps/api/geocode/json?address=Malang+Jawa+Timur+Indonesia&sensor=true";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);
				
				$lat = $response_a->results[0]->geometry->location->lat;
				$lng = $response_a->results[0]->geometry->location->lng;*/
				/**
				$config = array();
				$config['center'] = 'auto';
				$config['zoom'] = '18';
				$config['map_width'] = '600';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}else{
				
				$config = array();
				$config['center'] = $lat.','.$lng;
				$config['map_width'] = '600';
				$config['zoom'] = '18';
				$config['onboundschanged'] = 'if (!centreGot) {
					var mapCentre = map.getCenter();
					marker_0.setOptions({
						position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
					});
				}
				centreGot = true;';
			}
			
			$this->googlemaps->initialize($config);
			   
			// set up the marker ready for positioning 
			// once we know the users location
			$marker = array();
			$marker['draggable'] = true;
			$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
		}
		
		$this->load->view('admin/bengkel/bengkel_location', $data);
	}*/
	
	function save_venue_location(){
		
		$bengkel_id = $this->input->post('bengkel_id');
		$lat =$this->input->post('lat');
		$lng =$this->input->post('lng');
		
		$this->Bengkel_model->save_lat_lng($bengkel_id, $lat,$lng);
		
	}
	
	public function add_bengkel(){ 
		//add bengkel for users
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		
		foreach($resJenis as $row){
			$arrjenis[$row->jenis_id] = $row->nama_jenis;
		}
		
		$data['arrJenis'] = $arrjenis;
		
		$this->load->view('admin/bengkel/add_bengkel',$data);
	}
	
	public function profile($bengkel_id){
		
		$resBengkel = $this->Bengkel_model->get_detail_bengkel($bengkel_id);
		
		if (!$resBengkel)
			show_404();
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
				show_404();
			}
		}
		
		$data['resBengkel'] = $resBengkel;
		$data['bengkel_id']  = $bengkel_id;
		$this->load->model('Gallery_model');
		
		if ($resBengkel){
			$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
			
			$data['resGallery'] = $resGallery;
		}else{
			$data['resGallery'] = FALSE;
		}
		
		
		$this->load->model('Service_model');
		
		$resService = $this->Service_model->get_service_by_bengkel_id($bengkel_id);
		$data['resService']=$resService;
		
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		
		foreach($resJenis as $row){
			$arrjenis[$row->jenis_id] = $row->nama_jenis;
		}
		
		$data['arrJenis'] = $arrjenis;
		
		$this->load->library('googlemaps');

		$lat ='-7.911282';
		$lng ='112.629';
		
		if ($resBengkel){
			$lat = (!empty($resBengkel[0]->latitude)) ? $resBengkel[0]->latitude : $lat;
			$lng = (!empty($resBengkel[0]->longitude)) ? $resBengkel[0]->longitude : $lng;
		}

		$config['center'] = $lat.', '.$lng;
		$config['zoom'] = 'auto';
		$config['map_width'] = '500';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.', '.$lng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('admin/bengkel/bengkel_profile',$data);
	}
	
	public function edit_profile($bengkel_id){
		
		//$this->Bengkel_model->insert_bengkel();
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if (!$resBengkel)
			show_404();
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
				show_404();
			}
		}
		
		$data['resBengkel'] = $resBengkel;
		$data['bengkel_id'] = $resBengkel[0]->bengkel_id;
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$this->load->library('googlemaps');
		
		$data['arrJenis'] = $arr;
		
		$lat ='-7.911282';
		$lng ='112.629';
		
		if ($resBengkel){
			$lat = (!empty($resBengkel[0]->latitude)) ? $resBengkel[0]->latitude : $lat;
			$lng = (!empty($resBengkel[0]->longitude)) ? $resBengkel[0]->longitude : $lng;
		}

		$config['center'] = $lat.', '.$lng;
		$config['zoom'] = 'auto';
		$config['map_width'] = '500';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.', '.$lng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('admin/bengkel/edit_profile',$data);
	}
	
	function save_profile(){
		
		$arrVar = array('bengkel_id','jenis_id', 'nama_bengkel', 'alamat_bengkel','kota','propinsi','negara','zippostal','email','telp', 'zippostal', 'fax', 'deskripsi','save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			$user_id = $this->bengkelin_auth->user[0]->user_id;
			$this->Bengkel_model->edit_bengkel($bengkel_id, $user_id, $jenis_id, $nama_bengkel, $alamat_bengkel, $kota, $propinsi, $negara, $zippostal,$telp, $fax, $email, $deskripsi);
			//echo $this->db->last_query();
			flashmsg_set('Berhasil mengupdate profile bengkel');
			redirect('bengkel/profile/'.$bengkel_id, 'refresh');
		}
		
	}
	
	public function show_profile($username=''){
		
		if ($username == ''){
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		}else{
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($username);
		}
		
		if ($resBengkel){
			$data['resBengkel'] = $resBengkel;
			$this->Bengkel_model->inc_counter($resBengkel[0]->bengkel_id);
		}else{
			show_404();
		}
		
		$bengkel_id = $resBengkel[0]->bengkel_id;
		$this->load->model('Service_model');
		
		$data['resLayanan'] = $this->Service_model->get_service_by_bengkel_id($bengkel_id);
		
		$data['username'] = $username;
		
		$this->load->library('googlemaps');
		$this->load->model('Gallery_model'); 
		$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		
		$data['resBengkel'] = $resBengkel;
		$data['resGallery'] = $resGallery;
		
		$lat ='-7.911282';
		$lng ='112.629';
		
		$lat = (empty($resBengkel[0]->latitude) ? $lat : $resBengkel[0]->latitude);
		$lng = (empty($resBengkel[0]->longitude) ? $lng : $resBengkel[0]->longitude);
		
		$config['center'] = $lat.', '.$lng;
		$config['zoom'] = 'auto';
		$config['map_width'] = '1080';
		$config['map_height'] = '230';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.', '.$lng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		$this->load->view('maintheme/bengkel/detail_bengkel',$data);
	}
	
/*	public function bengkel_profile_location($username=''){
		
		if ($username == ''){
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($this->bengkelin_auth->user[0]->username);
		}else{
			$resBengkel = $this->Bengkel_model->get_bengkel_by_username($username);
		}
		if ($resBengkel){
			$lat = $resBengkel[0]->latitude;
			$lng = $resBengkel[0]->longitude;
		}else{
			$lat = $lng = 0;
		}
		
		$this->load->library('googlemaps');

		$config['center'] = $lat.', '.$lng;
		$config['zoom'] = 'auto';
		$config['map_width'] = '600';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.', '.$lng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

		$this->load->view('maintheme/bengkel/show_location', $data);
	}*/
	
	public function list_bengkel($_jenis_id='-', $_nama_bengkel='-', $_kota='-', $_alamat='-', $_propinsi='-', $_negara='-', $_telp='-', $_go='-', $_page=0){
		
		$arrVar = array('jenis_id', 'nama_bengkel', 'alamat', 'negara', 'kota', 'alamat', 'propinsi', 'negara', 'telp', 'go');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$data['jenis'] = 'Bengkel';
		
		$this->load->model('Bengkel_model');
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['next_link'] = '&gt;';
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
		
		if ($go!=''){
			$config['base_url'] = site_url('bengkel/list_bengkel/'.$jenis_id.'/'.$nama_bengkel.'/'.$kota.'/'.$alamat.'/'.$propinsi.'/'.$negara.'/'.$telp.'/'.$go);
		}else{
			$config['base_url'] = site_url('bengkel/list_bengkel');
		}
		
		$config['per_page'] = 50;
		if ($go!=''){
			$config['uri_segment'] = 11;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($go != ''){
			$data['result'] = $this->Bengkel_model->get_bengkel_profile($strjenis_id, $strnama_bengkel, $stralamat, $strkota, $strpropinsi, $strnegara, $strtelp, $config['per_page'], $page);
			//echo $this->db->last_query();
			$config['total_rows'] = $this->Bengkel_model->get_bengkel_profile_cnt($strjenis_id, $strnama_bengkel, $stralamat, $strkota, $strpropinsi,$strnegara, $strtelp);
		}else{
			
			$data['result'] = $this->Bengkel_model->get_bengkel_profile('', '', '', '', '', '','',$config['per_page'], $page);
			
			$config['total_rows'] = $this->Bengkel_model->get_bengkel_profile_cnt('', '', '', '', '','','', $config['per_page'], $page);
		}
		
		$arr = array();
		$arr[''] = 'Semua Jenis';
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		
		$this->load->view('maintheme/bengkel/list_bengkel',$data);
	}
	
	public function list_showroom( $_jenis_id='-', $_nama_bengkel='-', $_kota='-', $_alamat='-', $_propinsi='-', $_negara='-', $_telp='-', $_go='-', $_page=0){
		
		$arrVar = array('jenis_id', 'nama_bengkel', 'alamat', 'negara', 'kota', 'alamat', 'propinsi', 'negara', 'telp', 'go');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
				$$var = urldecode($$newvar);
			}
		}
		
		$data['jenis'] = 'Showroom';
		
		$this->load->model('Bengkel_model');
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['next_link'] = '&gt;';
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
		
		if ($go!=''){
			$config['base_url'] = site_url('bengkel/list_showroom/'.$jenis_id.'/'.$nama_bengkel.'/'.$kota.'/'.$alamat.'/'.$propinsi.'/'.$negara.'/'.$telp.'/'.$go);
		}else{
			$config['base_url'] = site_url('bengkel/list_showroom');
		}
		
		$config['per_page'] = 50;
		if ($go!=''){
			$config['uri_segment'] = 10;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($go != ''){
			$data['result'] = $this->Bengkel_model->get_showroom_profile($strjenis_id, $strnama_bengkel, $stralamat, $strkota, $strpropinsi, $strnegara, $strtelp, $config['per_page'], $page);
		//	echo $this->db->last_query();
			$config['total_rows'] = $this->Bengkel_model->get_showroom_profile_cnt($strjenis_id, $strnama_bengkel, $stralamat, $strkota, $strpropinsi,$strnegara, $strtelp);
		}else{
			
			$data['result'] = $this->Bengkel_model->get_showroom_profile('','', '', '', '', '','',$config['per_page'], $page);
		//	echo $this->db->last_query();
			$config['total_rows'] = $this->Bengkel_model->get_showroom_profile_cnt('','', '', '', '','','');
		}
		
		$arr = array();
		$arr[''] = 'Semua Jenis';
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		
		$this->load->view('maintheme/bengkel/list_bengkel',$data);
	}
	
	function view($slug){
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_slug($slug);
		
		if (!$resBengkel){
			show_404();
		}
		
		$bengkel_id = $resBengkel[0]->bengkel_id;
		
		$this->load->model('Comment_model');
		
		$data['resTestimoni'] = $this->Comment_model->get_testimoni($bengkel_id);
		
		$this->load->library('googlemaps');
		$this->load->model('Gallery_model'); 
		$this->load->model('Service_model'); 
		
		$data['resLayanan'] = $this->Service_model->get_service_by_bengkel_id($bengkel_id);
		
		$resGallery = $this->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		
		$data['resBengkel'] = $resBengkel;
		$data['resGallery'] = $resGallery;
		$this->Bengkel_model->inc_counter($resBengkel[0]->bengkel_id);
		
		$lat ='-7.911282';
		$lng ='112.629';
		
		$lat = (empty($resBengkel[0]->latitude) ? $lat : $resBengkel[0]->latitude);
		$lng = (empty($resBengkel[0]->longitude) ? $lng : $resBengkel[0]->longitude);
		
		$config['center'] = $lat.', '.$lng;
		$config['zoom'] = 'auto';
		$config['map_width'] = '500';
		$config['map_height'] = '270';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.', '.$lng;
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$arr = array();
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		foreach($resJenis as $row){
			$arr[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arr;
		
		$this->load->view('maintheme/bengkel/detail_bengkel', $data);
	}
	
	public function product($bengkel_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$result = $this->Bengkel_model->get_produk_by_bengkel_id($bengkel_id);
		$data['result'] = $result;
	}
	
	public function add_product($bengkel_id){
		
		if ($bengkel_id == ''){
			show_404();
		}
		
		$data['bengkel_id'] = $bengkel_id;
		$data['resBengkel'] = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		$this->load->view('admin/bengkel/add_produk', $data);
	}
	
	public function product_dashboard($_bengkel_id='-',$_query='-',$_show='-',$_page=0){
		
		if ($_bengkel_id == '-'){
			show_404();
		}
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
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
		
		$data['bengkel_id'] = $_bengkel_id;
		$data['resBengkel'] = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		
		if ($show != ''){
			$config['base_url'] = site_url('bengkel/product_dashboard/'.$bengkel_id.'/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('bengkel/product_dashboard/');
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
			$data['result'] = $this->Bengkel_model->get_produk_by_query($strbengkel_id, $strquery, $config['per_page'], $page);
			//echo $this->db->last_query();
			//print_r($data['result']); 
			$config['total_rows'] = $this->Bengkel_model->get_produk_by_query_cnt($strbengkel_id, $strquery);
		}else{
			$data['result'] = $this->Bengkel_model->get_produk_by_query_id($_bengkel_id, '', $config['per_page'], $page);
			echo $this->db->last_query();	
			$config['total_rows'] = $this->Bengkel_model->get_produk_by_query_id_cnt($_bengkel_id,'');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		
		$this->load->view('admin/bengkel/produk_dashboard',$data);
	}
	
	public function user_product($_bengkel_id='-',$_query='-',$_show='-',$_page=0){
		
		/*if ($_bengkel_id == '-'){
			show_404();
		}*/
		
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
			$config['base_url'] = site_url('bengkel/product_dashboard/'.$bengkel_id.'/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('bengkel/product_dashboard/');
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
			$data['result'] = $this->Bengkel_model->get_produk_by_query($strbengkel_id, $strquery, $config['per_page'], $page);
			//echo $this->db->last_query();
			//print_r($data['result']); 
			$config['total_rows'] = $this->Bengkel_model->get_produk_by_query_cnt($strbengkel_id, $strquery);
		}else{
			$data['result'] = $this->Bengkel_model->get_produk_by_query($_bengkel_id, '', $config['per_page'], $page);
			//echo $this->db->last_query();	
			$config['total_rows'] = $this->Bengkel_model->get_produk_by_query_cnt($_bengkel_id,'');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		
		$this->load->view('admin/bengkel/user_produk',$data);
	}
	
	public function edit_produk($bengkel_id, $produk_id){
		if ($bengkel_id == ''){
			show_404();
		}
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		if ($this->bengkelin_auth->user[0]->user_id != $resBengkel[0]->user_id){
			show_404();
		}
		
		$data['produk_id'] = $produk_id;
		$data['bengkel_id'] = $bengkel_id;
		$data['resBengkel'] = $resBengkel;
		$data['result'] = $this->Bengkel_model->get_produk_by_id($produk_id);
		
		$this->load->model('Gallery_model');
		
		$this->session->set_flashdata('url', current_url());
		
		$data['resGallery'] = $this->Gallery_model->get_produk_by_id($produk_id);
		//print_r($data['resGallery']); 
		
		$this->load->view('admin/bengkel/edit_produk', $data);
	}
	
	public function save_add_product_admin(){
		
		if ($this->bengkelin_auth->user[0]->group_id > 1){
			show_404();
		}
		
		$arrVar = array('bengkel_id', 'nama_produk', 'deskripsi', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('bengkel/add_product/'.$bengkel_id, 'refresh');
			}else{
				if ($_FILES['gambar']['error'] == 4){
					flashmsg_set('Error: File masih kosong');
					redirect('bengkel/add_product/'.$bengkel_id,'refresh');
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
						
						$this->Bengkel_model->add_produk($bengkel_id, $nama_produk, $deskripsi, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
						flashmsg_set('Berhasil menamabah produk');
						redirect('bengkel/product_dashboard/'.$bengkel_id,'refresh');
					}else{
						flashmsg_set('Error: '.$this->upload->display_errors());
						redirect('bengkel/add_product/'.$bengkel_id,'refresh');
					}
				}
			}
		}
	}
	
	public function save_add_product_user(){
		
		$arrVar = array('bengkel_id', 'nama_produk', 'deskripsi', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$resBengkel = $this->Bengkel_model->get_bengkel_by_id($bengkel_id);
	
		if ($resBengkel[0]->user_id != $this->bengkelin_auth->user[0]->user_id){
			show_404();
		}
		
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('bengkel/user_add_product/'.$bengkel_id, 'refresh');
			}else{
				if ($_FILES['gambar']['error'] == 4){
					flashmsg_set('Error: File masih kosong');
					redirect('bengkel/user_add_product/'.$bengkel_id,'refresh');
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
						
						$produk_id = $this->Bengkel_model->add_produk($bengkel_id, $nama_produk, $deskripsi, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
						$this->load->model('Gallery_model');
						$this->Gallery_model->save_image_produk($bengkel_id, $produk_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
						flashmsg_set('Berhasil menamabah produk');
						redirect('bengkel/user_product/'.$bengkel_id,'refresh');
					}else{
						flashmsg_set('Error: '.$this->upload->display_errors());
						redirect('bengkel/user_add_product/'.$bengkel_id,'refresh');
					}
				}
			}
		}
	}
	
	public function save_edit_product_user(){
		
		$arrVar = array('bengkel_id', 'produk_id', 'nama_produk', 'deskripsi', 'gambar', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('bengkel/user_produk'.$bengkel_id, 'refresh');
			}else if ($_FILES['gambar']['error'] == 4){
				$this->Bengkel_model->edit_produk($produk_id, $bengkel_id, $nama_produk, $deskripsi);
				flashmsg_set('Berhasil edit produk');
				redirect('bengkel/user_produk/'.$bengkel_id,'refresh');
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
					
					$this->Bengkel_model->edit_produk($produk_id, $bengkel_id, $nama_produk, $deskripsi);
					$this->load->model('Gallery_model');
					$this->Gallery_model->save_image_produk($bengkel_id, $produk_id, $userfile.'.'.$ext, $userfile.'_thumb.'.$ext);
					flashmsg_set('Berhasil edit produk');
					redirect('bengkel/edit_produk/'.$bengkel_id.'/'.$produk_id,'refresh');
				}else{
					flashmsg_set('Error: '.$this->upload->display_errors());
					redirect('bengkel/edit_produk/'.$bengkel_id.'/'.$produk_id,'refresh');
				}
			}
		}
	}
	
	public function user_add_product($bengkel_id=''){
		
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
		
		$this->load->view('admin/bengkel/user_add_produk',$data);
	}
	
	function user_save_edit_product(){
		$arrVar = array('bengkel_id', 'produk_id', 'nama_produk', 'deskripsi', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error: '.validation_errors());
				redirect('bengkel/edit_produk/'.$bengkel_id.'/'.$produk_id, 'refresh');
			}else{
				$this->Bengkel_model->edit_produk($produk_id, $bengkel_id, $nama_produk, $deskripsi);
				flashmsg_set('Berhasil menyimpan produk');
				redirect('bengkel/user_produk/'.$bengkel_id, 'refresh');
			}
		}
	}
}
