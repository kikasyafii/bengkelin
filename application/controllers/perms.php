<?php

/*
 * Copyright : Cakra Development
 * Author: Santo Doni Romadhoni
 * Script : Controller/Users
 * Perum Bandara Santika C2-7 Kelurahan Asrikaton, Kecamatan Pakis, Kabupaten Malang
 * email: exblopz@gmail.com
 */ 

class Perms extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->bengkelin_auth->login_required();
		$this->load->model('Perms_model');
	}
	
	public function index(){
		$this->bengkelin_auth->check_perms();
		
		$result = $this->Perms_model->get_perms();
		
		$data['result'] = $result;
		
		$arrSub = array();
		
		if ($result){
			foreach($result as $row){
				$arrSub[$row->perm_id] = $this->Perms_model->get_perms_by_parent_id($row->perm_id);
			//	echo $this->db->last_query();
			}
		}
		
		$data['arrSub'] =$arrSub;
		
		$this->load->view('admin/perms/perm_index',$data);
	}
	
	public function save_perm(){
		
		$arrVar = array('newparentorder', 'newparentnama', 'newparenticon', 'newparentpath', 'newparentstatus', 'newparent', 'parentorder', 'perm_id', 'parentnama', 'parenticon', 'parentpath', 'parentstatus', 'saveparent','suborder', 'subnama', 'sub_id','subpath','substatus','subparent_id', 'savesub' );
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($newparent){
			$this->Perms_model->add_perms($newparentnama,$newparentpath,0, $newparentorder,$newparentstatus,$newparenticon);
			flashmsg_set('Berhasil menambahkan permission '.$newparentnama);
		}else if ($saveparent){
			foreach($perm_id as $key => $id){
				$this->Perms_model->edit_perms($id, $parentnama[$key], $parentpath[$key], 0, $parentorder[$key], $parentstatus[$key],$parenticon[$key]);
			}
			flashmsg_set('Berhasil mengubah permission '.$parentnama[$key]);
		}else if ($savesub){
			foreach($sub_id as $key => $id){
				$this->Perms_model->edit_perms($id, $subnama[$key], $subpath[$key], $subparent_id[$key], $suborder[$key], $substatus[$key]);
			}
			flashmsg_set('Berhasil mengubah permission '.$subnama[$key]);
		}
		
		redirect('perms', 'refresh');
		
	}
	
	public function save_sub(){
		$arrVar = array('class_name', 'class_path', 'parent_id', 'ordering', 'is_active', 'save');
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			if ($class_name == ''){
				flashmsg_set('Error : Nama Permision tidak boleh kosong');
				redirect('perms', 'refersh');
			}else{
				$this->Perms_model->add_perms($class_name, $class_path, $parent_id, $ordering, $is_active);
				flashmsg_set('Berhasil menambahkan permission');
				redirect('perms', 'refresh');
			}
		}
	}
	
	public function modal_sub(){
		$this->load->view('admin/perms/modal_sub');
	}
	
	public function delete(){
		$perm_id = $this->input->get_post('perm_id');
		
		$result = $this->Perms_model->get_perm_by_id($perm_id);
		
		if (!$result){
			show_404();
		}
		
		$class_name = $result[0]->class_name;
		
		$this->Perms_model->delete_perms($perm_id);
		flashmsg_set('Berhasil menghapus permission '.$class_name);
		redirect('perms', 'refresh');
	}
	
	public function group_perms(){
		
		$group_id = $this->input->get_post('group_id');
		
		$result = $this->Perms_model->get_perms();
		
		$arr=array();
		foreach($result as $row){
			$arr[] = $row->perm_id;
		}
		
		$arrGroupsPerms = array();
		$resGroupPerms = $this->Perms_model->get_group_perms($group_id);
		if ($resGroupPerms){
			foreach($resGroupPerms as $rgp){
				$arrGroupsPerms[] = $rgp->perm_id;
			}
		}
		
		$perms = $this->_get_perms_sub(0,$arrGroupsPerms);
		$data['group_id'] = $group_id;
		$data['perms']=$perms;
		
		$this->load->view('admin/perms/group_perms',$data);
	}
	
	public function save_group_perms(){
		
		$arrVar = array('perm_id', 'group_id', 'save');
		
		foreach($arrVar as $var){
			$$var = $this->input->post($var);
		}
		
		if ($save){
			$this->Perms_model->delete_group_perms($group_id);
			
			foreach($perm_id as $key => $val){
				$this->Perms_model->set_group_perms($group_id, $val);
			}
		}
		
		flashmsg_set('Berhasil mengedit permission group');
		redirect('groups', 'refresh');
	}
	
/*	function _get_perms_sub($parent=0 ){
		$array = array();
		$result = $this->Perms_model->get_perms_by_parent_id($parent);
		
		if ($result){
			foreach($result as $row){
				$array[$parent]['name'][] = $row->class_name;
				
				$child = $this->_get_perms_sub($row->perm_id);
				
				if ($child){
					$array[$row->perm_id][$row->class_name]= $child;
				}
			}
		}
		
		return $array;
	}*/
	
	function _get_perms_sub($parent=0, $arrGroupsPerms ){
		$str = '<ul class="form-group">';
		$result = $this->Perms_model->get_perms_by_parent_id($parent);
		
		if ($result){
			$i = 1;
			foreach($result as $row){
				$cek = (in_array($row->perm_id, $arrGroupsPerms) ? TRUE : FALSE);
				$str .= '<li style="list-style-type:none;" class="form-inline">'.form_checkbox('perm_id[]',$row->perm_id,$cek, 'class="cekperm"' ).'&nbsp;&nbsp;<label for="perm'.$i.'">'.$row->class_name.'</label></li>';
				$child = $this->_get_perms_sub($row->perm_id, $arrGroupsPerms);
				if ($child){
					$str .= $child;
				}
				$i++;
			}
		}
		$str .= '</ul>';
		
		return $str;
	}
}
