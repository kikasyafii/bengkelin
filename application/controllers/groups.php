<?php

/****
 * Author: Santo Doni Romadhoni
 * Script : Controller/Groups
 * Perum Bandara Santika C2-7 Kelurahan Asrikaton, Kecamatan Pakis, Kabupaten Malang
 * email: exblopz@gmail.com
 */ 

class Groups extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('Group_model');
	}
	
	function index(){
		
		$result = $this->Group_model->get_groups();
		$data['result'] = $result;
		
		$this->load->view('admin/groups/group_index', $data);
	}
	
	function add(){
		$this->load->view('admin/groups/add_group');
	}
	
	function save_add(){
		$arrVar = array('group_name', 'description', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('groups', 'refresh');
			}else{
				if ($this->Group_model->if_name_exists($group_name)){
					flashmsg_set('Error : Nama '.$group_name.' Sudah ada');
					redirect('groups', 'refresh');
				}else{
					$this->Group_model->add_group($group_name, $description);
					flashmsg_set('Berhasil menyimpan Group '.$group_name);
					redirect('groups', 'refresh');
				}
			}
		}
	}
	
	function edit(){
		$group_id = $this->input->get_post('id');
		
		$result = $this->Group_model->get_group_by_id($group_id);
		
		if (!$result){
			show_404();
		}
		
		$data['group_id'] = $group_id;
		$data['result'] = $result;
		$this->load->view('admin/groups/edit_group',$data);
	}
	
	function save_edit(){
		$arrVar = array('group_id', 'group_name', 'description', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($save){
			if ($this->form_validation->run() === FALSE){
				flashmsg_set('Error : '.validation_errors());
				redirect('groups/add', 'refresh');
			}else{
				if ($this->Group_model->if_group_exists($group_id, $group_name)){
					flashmsg_set('Error : Nama '.$group_name.' Sudah ada');
					redirect('groups/add', 'refresh');
				}else{
					$this->Group_model->edit_group($group_id, $group_name, $description);
					flashmsg_set('Berhasil mengubah Group '.$group_name);
					redirect('groups', 'refresh');
				}
			}
		}
	}
	
	function delete(){
		$group_id = $this->input->get_post('id');
		
		if (!$this->Group_model->get_group_by_id($group_id)){
			show_404();
		}
		
		$this->Group_model->delete_group($group_id);
		flashmsg_set('Berhasil menghapus group');
		redirect('groups', 'refresh');
	}
	
	function modal_add_group(){
		
		$this->load->view('admin/groups/modal_add_group');
	}
	
	function modal_edit_group(){
		$group_id = $this->input->get_post('id');
		
		$result = $this->Group_model->get_group_by_id($group_id);
		
		if (!$result){
			show_404();
		}
		
		$data['group_id'] = $group_id;
		$data['result'] = $result;
		$this->load->view('admin/groups/modal_edit_group',$data);
	}
}
