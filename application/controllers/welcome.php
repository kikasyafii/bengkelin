<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function index(){
		
		$this->load->model('Bengkel_model'); 
		$this->load->model('Gallery_model'); 
		
		$resJenis = $this->Bengkel_model->get_jenis_bengkel();
		$arrjenis[] = 'Semua Jenis';
		foreach($resJenis as $row){
			$arrjenis[$row->jenis_id] = ucwords($row->nama_jenis);
		}
		
		$data['arrJenis'] = $arrjenis;
		
		$random_bengkel = $this->Bengkel_model->random_bengkel();
		$data['randBengkel'] = $random_bengkel;
		
		$arrGallery = array();
		
		foreach($random_bengkel as $row){
			$arrGallery[$row->bengkel_id] = $this->Gallery_model->get_image_by_bengkel_id($row->bengkel_id);
		}
		
		$data['arrGallery'] = $arrGallery;
		
		$terbaru = $this->Bengkel_model->bengkel_few();
		
		$data['terbaru'] = $terbaru;
		
		$data['baru'] = $this->Bengkel_model->get_bengkel_baru();
		
		
		$this->load->model('Partner_model');
		
		$data['resPartner'] = $this->Partner_model->get_partner_all(); 
		
		$this->load->model('Comment_model');
		
		$data['reviewTerakhir'] = $this->Comment_model->get_top_ten();
		
		$data['randomTestimoni'] = $this->Comment_model->get_random();
		
		$this->load->view('maintheme/frontpage',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
