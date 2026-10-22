<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Categories</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>products">Products</a></li>
          <li class="active">Categories</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
        <a href="<?php echo base_url('admin/categories/add') ?>">
          <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>  Tambah Kategori Baru</button>
        </a> 
        
        <h4 align="center"><?php echo $this->session->userdata('message');?></h4>
        <table id="table-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center">No.</th>
              <th style="text-align: center">Nama</th>
              <th style="text-align: center">Gambar</th>
              <th style="text-align: center">Author</th>
              <th style="text-align: center">Modified</th>
              <th style="text-align: center">Status</th>
              <th style="text-align: center">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php $start = 0; foreach ($categories_data as $categories):?>
            <tr>
              <td width="10" style="text-align:center"><?php echo ++$start ?></td>  
              <td width="400"><?php echo $categories->namaCategory ?></td>
              <td style="text-align:center"><?php if (empty($categories->img)) { echo '(no image)'; } else { echo '<img height=30 src="'.base_url().'assets/img/'.$categories->img.'"'; } ?></td>
              <td style="text-align:center"><?php echo $categories->createdBy ?></td>
              <td style="text-align:center"><?php if($categories->updatedTime=='0000-00-00 00:00:00'){ echo '(no updated data)';}else{echo $categories->updatedTime; } ?></td>
              <td width="100" style="text-align:center"><?php if($categories->status==1) { echo "<span class='label label-outline-success m-w-60'>Publish</span>"; } else { echo "<span class='label label-outline-warning m-w-60'>Draft</span>"; }?></td>
              <td width="100" style="text-align:center"><div class="btn-group">
                  <button type="button" class="btn btn-default btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span> 
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'admin/categories/edit/'.$categories->idCategory;?>">Edit</a></li>
                    <li><a href="<?php echo base_url().'admin/categories/delete/'.$categories->idCategory;?>" onclick="return confirmDialog();">Delete</a></li>
                  </ul>
                </div>
              </td>
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