    <div class="site-main">
      <div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
          <ul class="sidebar-menu">
            <li class="menu-title">Main</li>
            <li <?php if ( $this->uri->segment(2) == 'dashboard'): ?><?php echo 'class="active"';?><?php endif;?>>
              <a href="<?php echo base_url();?>admin/dashboard">
                <span class="menu-icon">
                  <i class="fa fa-dashboard"></i>
                </span>
                <span class="menu-text">Dashboard</span>
              </a>
            </li>
<?php
  $main=$this->db->get_where('menu_backend',array('parent'=>0))->result();
  foreach ($main as $m ){
    // chek ada submenu atau tidak
    $sub=$this->db->get_where('menu_backend',array('parent'=>$m->id));
    if($sub->num_rows()>0){
      // looping submenu
      $uri = $m->uri;
      echo "<li class='with-sub "; if ( $this->uri->segment(2) == $uri): ?><?php echo 'active';?><?php endif; ?><?php echo "'>";
      echo "<a href='".base_url().'admin/'.$m->slug."'><span class='menu-icon'><i class='fa ".$m->icon."'></i></span> <span class='menu-text'>".ucwords($m->nama)."</span></a>";
      echo "<ul class='sidebar-submenu collapse'>"; 
        foreach ($sub->result() as $s){
          echo "<li "; if ( $this->uri->segment(2) == $s->uri): ?><?php echo 'class="active"';?><?php endif; ?><?php echo ">".anchor('admin/'.$s->slug,''.ucfirst($s->nama))."</li>"; 
        }
      echo "</ul>";
      echo "</li>";
    }else{
      $url = $m->slug;
      echo "<li ";?><?php if ( $this->uri->segment(2) == $m->uri): ?><?php echo 'class="active"';?><?php endif; echo">
              <a href="; ?><?php echo base_url()."admin/".$m->slug.">
                <span class='menu-icon'>
                  <i class='fa ".$m->icon."'></i>
                </span>
                <span class='menu-text'>".ucwords($m->nama)."</span>
              </a>
            </li>";
      }
}?>

             <li class="menu-title">SETTING</li>
            <li <?php if ( $this->uri->segment(2) == 'profile'): ?><?php echo 'class="active"';?><?php endif;?>>
              <a href="<?php $user_id = $this->session->userdata('user_id'); echo base_url('admin/profile/edit/'.$user_id.'') ?>">
                <span class="menu-icon">
                  <i class="fa fa-pencil"></i>
                </span>
                <span class="menu-text">Edit Profil</span>
              </a>
            </li>
            <li class="with-sub <?php if ( $this->uri->segment(3) == 'create_user' || $this->uri->segment(3) == 'user' || $this->uri->segment(3) == 'edit_user' ): ?><?php echo 'active';?><?php endif;?>">
              <a href="#">
                <span class="menu-icon">
                  <i class="fa fa-user"></i>
                </span>
                <span class="menu-text">User</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Users</li>
                <li <?php if ( $this->uri->segment(3) == 'create_user'): ?><?php echo 'class="active"';?><?php endif;?>><a href="<?php echo base_url() ?>admin/users/create_user">Add User</a></li>
                <li <?php if ( $this->uri->segment(3) == 'user' || $this->uri->segment(3) == 'edit_user'): ?><?php echo 'class="active"';?><?php endif;?>><a href="<?php echo base_url() ?>admin/users/user">User View</a></li>
              </ul>
            </li>
            <li class="with-sub <?php if ( $this->uri->segment(3) == 'create_group' || $this->uri->segment(3) == 'users_group' || $this->uri->segment(3) == 'edit_group'): ?><?php echo 'active';?><?php endif;?>">
              <a href="#">
                <span class="menu-icon">
                  <i class="fa fa-group"></i>
                </span>
                <span class="menu-text">Groups</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Groups</li>
                <li <?php if ( $this->uri->segment(3) == 'create_group'): ?><?php echo 'class="active"';?><?php endif;?>><a href="<?php echo base_url() ?>admin/users/create_group">Add Group</a></li>
                <li <?php if ( $this->uri->segment(3) == 'users_group' || $this->uri->segment(3) == 'edit_group'): ?><?php echo 'class="active"';?><?php endif;?>><a href="<?php echo base_url() ?>admin/users/users_group">Group View</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo base_url();?>logout">
                <span class="menu-icon">
                  <i class="fa fa-sign-out"></i>
                </span>
                <span class="menu-text">Logout</span>
              </a>
            </li>

          </ul>
        </div>
      </div>