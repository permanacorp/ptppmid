<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>      

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Users View</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">Users View</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
			<div class="box-body table-responsive padding"> 
				<a href="<?php echo base_url('admin/users/create_user') ?>"> 
					<button class="btn btn-success"><i class="fa fa-plus"></i> Tambah User Baru</button> 
				</a> 
				<h4 align="center"><?php echo $message ?></h4> 
				<hr/> 
				<table id="tableslider" class="table table-bordered" cellspacing="0" width="100%"> 
					<thead> 
						<tr> 
							<th width="10" style="text-align: center">No.</th> 
							<th style="text-align: center">Nama</th> 
							<th style="text-align: center">Username</th> 
							<th style="text-align: center">Email</th> 
							<th style="text-align: center">Last Login</th> 
							<th style="text-align: center">Usertype</th> 
							<th style="text-align: center">Status</th> 
							<th width="100" style="text-align: center">Aksi</th> 
						</tr> 
					</thead> 
					<tbody> 
						<?php $start = 0; foreach ($users as $user):?> 
						<tr> 
							<td style="text-align:center"><?php echo ++$start ?></td> 
							<td><?php echo $user->nama ?></td> <td style="text-align:center"><?php echo $user->username ?></td> 
							<td style="text-align:center"><?php echo $user->email ?></td> 
							<td style="text-align:center"><?php echo $user->last_login ?></td> 
							<td style="text-align:center"><?php echo $user->usertype ?></td> 
							<td style="text-align:center"><?php echo ($user->active) ? anchor("admin/users/deactivate/".$user->id, 'ACTIVE','title="ACTIVE", class="btn btn-sm btn-primary"', lang('index_active_link')) : anchor("admin/users/activate/". $user->id, 'INACTIVE','title="INACTIVE", class="btn btn-sm btn-danger"' , lang('index_inactive_link'));?></td> 
							<td style="text-align:center"> <?php echo anchor(site_url('admin/users/edit_user/'.$user->id),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' '; echo anchor(site_url('admin/users/delete_user/'.$user->id),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"'); ?> </td> 
						</tr> 
					<?php endforeach;?> 
					</tbody> 
				<table> 
			</div> 
		</table>
      </div> <!-- row body -->
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<?php $this->load->view('templates/backend/footer'); ?>      
