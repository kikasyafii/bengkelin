<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller Name Pages
 * Class Name Pages
 * author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
*/

class Pages extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Pages_model');
	}
	
	function index(){
	}
	
	function add(){
		$arrVar = array('');
	}
	
	function edit(){
	}
	
	function delete(){
	}
	
}
