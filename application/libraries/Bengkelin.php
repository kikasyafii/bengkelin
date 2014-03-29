<?php

/*
 * Name : Bengkelin
 * File: library/bengkelin
 * Author: Santo Doni Romadhoni
 * email: exblopz@gmail.com
 */ 

class Bengkelin{

	var $ci= null;
	
	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->model('Config_model');
		$this->ci->load->model('Perms_model');
		$this->get_config();
	}
	
	function get_config(){
		$result = $this->ci->Config_model->get_config();
		$this->config = $result;
	}
	
	function menu($group_id){
		
		$resGroupPerm = $this->ci->Perms_model->groups_menu($group_id);
		
		$arr = array();
		if ($resGroupPerm){
			foreach($resGroupPerm as $row){
				if ($row->parent_id == 0){
					$arr['parent'][$row->ordering]=$row;
				}else{
					$arr['sub'][$row->parent_id][] = $row;
				}
			}
		}
		
		if ($arr){
			ksort($arr);

			foreach($arr['parent'] as $parent => $row){ 
				?>
				<ul class="nav navbar-nav">
					<?php if (isset($arr['sub'][$row->perm_id])): ?>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row->class_name; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php 
						$arrTmp = $arr['sub'][$row->perm_id];
						$arrFix = array();
						foreach($arrTmp as $key => $obj){
							$arrFix[$obj->ordering] = $obj;
						}
						ksort($arrFix);
						?>
						<?php foreach($arrFix as $key=> $obj): ?>
							<li><?php echo anchor($obj->class_path, $obj->class_name); ?></li>
						<?php endforeach; ?>
						</ul>
					</li>
					<?php else: ?>
					<li><a href=""><?php echo $row->class_name; ?></a></li>
					<?php endif; ?>
				</ul>
			<?php }
		}
	}
	
	function child_active($val){
		$selected = '';
		if (preg_match("/$val/i", current_url())){
			$selected = 'class="active open"';
		}
		
		return $selected;
	}
	
	function parent_active($array){
		$active='';
		foreach($array as $val){
			if (preg_match("/$val/i", current_url())){
				$active = 'class="active open"';
				break;
			}
		}
		
		return $active;
	}
	
	function parent_selected($array){
		$selected='';
		foreach($array as $val){
			if (preg_match("/$val/i", current_url())){
				$selected = '<span class="selected"></span>';
				break;
			}
		}
		
		return $selected;
	}
	
	function gallery_bengkel_by_id($bengkel_id){
		$this->ci->load->model('Gallery_model');
		
		$result = $this->ci->Gallery_model->get_image_by_bengkel_id($bengkel_id);
		
		return $result;
	}
	
	function bengkel_populer(){
		$this->ci->load->model('Bengkel_model');
		$result = $this->ci->Bengkel_model->get_popular_bengkel();
		return $result; 
	}
	
	function showroom_populer(){
		$this->ci->load->model('Bengkel_model');
		$result = $this->ci->Bengkel_model->get_popular_showroom();
		return $result; 
	}
	
	function get_main_image_bengkel($bengkel_id){
		$this->ci->load->model('Gallery_model');
		$result = $this->ci->Gallery_model->get_main_image_bengkel($bengkel_id);
		return $result[0];
	}
	
	function get_image_profile($user_id){
		$this->ci->load->model('Gallery_model');
		$result = $this->ci->Gallery_model->get_profpic($user_id);
		return $result[0];
	}
	
	function menu_admin(){ 
		?>
			<li>
				<a href="<?php echo base_url(); ?>"><i class="clip-home-3"></i>
					<span class="title"> Beranda </span><span class="selected"></span>
				</a>
			</li>
			<li <?php echo $this->parent_active(array('dashboard')); ?>>
				<a href="<?php echo site_url('dashboard'); ?>"><i class="clip-home-2"></i>
					<span class="title"> Dashboard </span>
				</a>
			</li>
			<li <?php echo $this->parent_active(array('users', 'configuration', 'groups', 'perms','comments\/testimoni', 'bengkel\/dashboard', 'partners')); ?>>
				<a href="javascript:void(0)"><i class="clip-user-5"></i>
					<span class="title"> Administrasi </span><i class="icon-arrow"></i>
					<?php echo $this->parent_selected(array('users', 'configuration', 'groups', 'perms', 'bengkel\/dashboard')); ?>
				</a>
				<ul class="sub-menu">
					<li <?php echo $this->child_active('groups');?>>
						<a href="<?php echo site_url('groups'); ?>"><i class="clip-users"></i>
							<span class="title"> Manajemen Group </span>
						</a>
					</li>
					<li <?php echo $this->child_active('users');?>>
						<a href="<?php echo site_url('users'); ?>"><i class="clip-users-2"></i>
							<span class="title"> Manajemen Users </span>
						</a>
					</li>
					<li <?php echo $this->child_active('perms');?>>
						<a href="<?php echo site_url('perms'); ?>"><i class="clip-checkmark-circle"></i>
							<span class="title"> Manajemen Permision </span>
						</a>
					</li>
					<li <?php echo $this->child_active('bengkel\/dashboard');?>>
						<a href="<?php echo site_url('bengkel/dashboard'); ?>"> <i class="clip-wrench"></i>
							<span class="title"> Manajemen Bengkel </span>
						</a>
					</li>
					<li <?php echo $this->child_active('comments\/testimoni');?>>
						<a href="<?php echo site_url('comments/testimoni'); ?>"> <i class="clip-pencil"></i>
							<span class="title"> Manajemen Testimoni </span>
						</a>
					</li>
					<li <?php echo $this->child_active('configuration'); ?>>
						<a href="<?php echo site_url('configuration'); ?>"> <i class="clip-cog-2"></i>
							<span class="title"> Konfigurasi </span>
						</a>
					</li>
					<li <?php echo $this->child_active('partners\/dashboard'); ?>>
						<a href="<?php echo site_url('partners/dashboard'); ?>"> <i class="clip-cogs"></i>
							<span class="title"> Partners </span>
						</a>
					</li>
				</ul>
			</li>
			<li <?php echo $this->parent_active(array('blogs', 'promo', 'gallery', 'services')); ?>>
				<a href="javascript:void(0);">
					<i class="clip-pencil-3"></i><span class="title">Manajemen Konten</span>
					<i class="icon-arrow"></i>
				</a>
				<ul class="sub-menu">
					<li <?php echo $this->child_active('blogs\/dashboard'); ?>>
						<a href="<?php echo site_url('blogs/dashboard');?>"><i class="clip-pencil"></i>
						<span class="title">Blogs</span>
						</a>
					</li>
					<li <?php echo $this->child_active('promo\/dashboard'); ?>>
						<a href="<?php echo site_url('promo/dashboard');?>"><i class="clip-star-4"></i>
						<span class="title">Promo</span>
						</a>
					</li>
					<li <?php echo $this->child_active('services\/dashboard'); ?>>
						<a href="<?php echo site_url('services/dashboard');?>"><i class="clip-wrench"></i>
						<span class="title">Layanan</span>
						</a>
					</li>
					<li <?php echo $this->child_active('gallery\/gallery_bengkel'); ?>>
						<a href="<?php echo site_url('gallery/gallery_bengkel');?>"><i class="clip-images-2"></i>
						<span class="title">Gallery Bengkel</span>
						</a>
					</li>
				</ul>
			</li>
	<?php
	}
	
	function menu_bengkel(){
		?>
		<li>
			<a href="<?php echo base_url(); ?>"><i class="clip-home-3"></i>
				<span class="title"> Beranda </span><span class="selected"></span>
			</a>
		</li>
		<li <?php echo $this->parent_active(array('users\/profile')); ?>>
			<a href="<?php echo site_url('users/profile'); ?>"><i class="clip-user"></i>
			<span class="title">Setting</span>
			</a>
		</li>
		<li <?php echo $this->parent_active(array('bengkel\/bengkel_profile')); ?>>
			<a href="<?php echo site_url('bengkel/bengkel_profile'); ?>"><i class="clip-wrench"></i>
			<span class="title">My Profile</span>
			</a>
		</li>
		<li <?php echo $this->parent_active(array('bengkel\/user_product')); ?>>
			<a href="<?php echo site_url('bengkel/user_product'); ?>"><i class="clip-paperplane"></i>
			<span class="title">Produk</span>
			</a>
		</li>
		<li <?php echo $this->parent_active(array('services\/layanan_bengkel')); ?>>
			<a href="<?php echo site_url('services/layanan_bengkel'); ?>"><i class="clip-truck"></i>
			<span class="title">Layanan</span>
			</a>
		</li>
		<li <?php echo $this->parent_active(array('promo\/dashboard')); ?>>
			<a href="<?php echo site_url('promo/dashboard'); ?>"><i class="clip-inject"></i>
			<span class="title">Promo</span>
			</a>
		</li>
		<?php
	}
	
	function get_produk_image($produk_id){
		$this->ci->load->model('Gallery_model');
		
		$result = $this->ci->Gallery_model->get_image_produk_by_id($produk_id);
		
		return $result[0];
	}
	
	function get_layanan_image($layanan_id){
		$this->ci->load->model('Gallery_model');
		
		$result = $this->ci->Gallery_model->get_image_layanan_by_id($layanan_id);
		
		return $result[0];
	}
	
	function get_bengkel($bengkel_id){
		$this->ci->load->model('Bengkel_model');
		
		$result = $this->ci->Bengkel_model->get_bengkel_by_id($bengkel_id);
		
		return $result[0];
	}
}
