            <!-- Sidebar -->
            <div id="sidebar-wrapper" class="waves-effect" data-simplebar>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="list-header">Main Navigation</li>
                            <li <?php if ( $this->uri->segment(2) == 'dashboard'):  echo 'class="active-link"'; endif; ?>><a href="<?php echo base_url()?>admin/dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>

<?php
  $main=$this->db->get_where('menu_backend',array('parent'=>0))->result();
  foreach ($main as $m ){
    // chek ada submenu atau tidak
    $sub=$this->db->get_where('menu_backend',array('parent'=>$m->id));
    if($sub->num_rows()>0){
      // looping submenu
      $uri = $m->slug;
      echo "<li "; if ( $this->uri->segment(2) == $uri):  echo 'class="active-link"'; endif;  echo ">";
      echo "<a href='#'><i class='fa ".$m->icon."'></i>".ucwords($m->nama)."</span> <span class='fa arrow'></span></a>";
      echo "<ul class='nav nav-second-level'>";
        foreach ($sub->result() as $s){
          echo "<li ";?><?php if ( $this->uri->segment(2) == $uri):  echo "class='active-link'"; endif;?><?php echo">".anchor('admin/'.$s->slug,' <i class="fa fa-circle-o"></i> '.ucfirst($s->nama))."</li>"; 
        }
      echo "</ul>";
      echo "</li>";
    }else{
      $url = $m->slug;
      echo "<li";?> <?php if ( $this->uri->segment(2) == $url):  echo "class='active-link'"; endif;  echo"><a href='".base_url().'admin/'."$m->slug'><i class='fa $m->icon'></i> <span>".ucwords($m->nama)."  </span></a></li>";
      }
}?>

                            <li class="list-divider"></li>
                            <li class="list-header">SETTING</li>
                            <li><a href="<?php $user_id = $this->session->userdata('user_id'); echo base_url('admin/users/edit_user/'.$user_id.'') ?>"><i class="material-icons">person</i>Edit User</a></li>
                            <?php if ($this->ion_auth->is_superadmin()): ?>
                            <li><a><i class="material-icons">account_circle</i>User<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url() ?>admin/users/create_user">Tambah User</a></li>
                                    <li><a href="<?php echo base_url() ?>admin/users">Data User</a></li>
                                </ul>
                            </li>
                            <li><a><i class="material-icons">people</i>Group<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo base_url() ?>admin/users/create_group">Tambah Group</a></li>
                                    <li><a href="<?php echo base_url() ?>admin/users_group">Data Group</a></li>
                                </ul>
                            </li>
                            <?php endif ?>
                            <li><a href="<?php echo base_url() ?>admin/users/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
                            <li class="side-last"></li>
                        </ul>
                        <!-- ./sidebar-nav -->
                    </div>
                    <!-- ./sidebar -->
                </div>
                <!-- ./sidebar-nav -->
            </div>
            <!-- ./sidebar-wrapper -->