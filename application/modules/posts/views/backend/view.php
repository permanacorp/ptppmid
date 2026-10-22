<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Posts View</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">Posts</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
        <a href="<?php echo base_url('admin/posts/add') ?>">
          <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>  Tambah Post Baru</button>
        </a> 
        
        <h4 align="center"><?php echo $this->session->userdata('message');?></h4>
        <table id="table-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center">No.</th>
              <th style="text-align: center">Nama Post</th>
              <th style="text-align: center">Gambar</th>
              <th style="text-align: center">Author</th>
              <th style="text-align: center">Modified</th>
              <th style="text-align: center">Status</th>
              <th style="text-align: center">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php $start = 0; foreach ($posts_data as $posts):?>
            <tr>
              <td width="10" style="text-align:center"><?php echo ++$start ?></td>  
              <td width="400"><?php echo $posts->namaPost ?></td>
              <td style="text-align:center"><?php if (empty($posts->img)) { echo '(no image)'; } else { echo '<img height=30 src="'.base_url().'assets/img/'.$posts->img.'"'; } ?></td>
              <td style="text-align:center"><?php echo $posts->createdBy ?></td>
              <td style="text-align:center"><?php if($posts->updatedTime=='0000-00-00 00:00:00'){ echo '(no updated data)';}else{echo $posts->updatedTime; } ?></td>
              <td width="100" style="text-align:center"><?php if($posts->status==1) { echo "<span class='label label-outline-success m-w-60'>Publish</span>"; } else { echo "<span class='label label-outline-warning m-w-60'>Draft</span>"; }?></td>
              <td width="100" style="text-align:center"><div class="btn-group">
                  <button type="button" class="btn btn-default btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span> 
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'admin/posts/edit/'.$posts->idPost;?>">Edit</a></li>
                    <li><a href="<?php echo base_url().'admin/posts/delete/'.$posts->idPost;?>" onclick="return confirmDialog();">Delete</a></li>
                  </ul>
                </div></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>

        </div>
      </div> <!-- row body -->
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<script type="text/javascript">
function confirmDialog() {
 return confirm('Apakah anda yakin?')

}

</script>

<?php $this->load->view('templates/backend/footer'); ?>      