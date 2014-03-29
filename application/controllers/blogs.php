<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Blogs
 * Class Name Blogs
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Blogs extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Blogs_model');
	}
	
	function dashboard($_query='-', $_is_publish='-', $_show='-', $_page=0){
		
		$arrVar = array('query', 'show','is_publish', 'page');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
			$newvar = '_'.$var;
			if (empty($$var)){
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

		if ($show != ''){
			$config['base_url'] = site_url('blogs/dashboard/'.$query.'/'.$show);
		}else{
			$config['base_url'] = site_url('blogs/dashboard/');
		}
		
		$config['per_page'] = 35;
		if ($show!=''){
			$config['uri_segment'] = 5;
		}else{
			$config['uri_segment'] = 3;
		}
		
		if ($show!=''){
			$data['result'] = $this->Blogs_model->get_blog_query($strquery,$stris_publish, $config['per_page'], $page);
			$config['total_rows'] = $this->Blogs_model->get_blog_query_cnt($strquery,$stris_publihs);
		}else{
			$data['result'] = $this->Blogs_model->get_blog_query('','', $config['per_page'], $page);
			$config['total_rows'] = $this->Blogs_model->get_blog_query_cnt('','');
		}
		
		$this->pagination->initialize($config); 
		$data['links'] = $this->pagination->create_links();
		
		foreach($arrVar as $var){
			$newx = 'str'.$var;
			$data[$var] = $$newx;
		}
		
		$this->load->view('admin/blogs/blog_dashboard', $data);
	}
}
