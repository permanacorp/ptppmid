<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Services</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">services</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
        <a href="<?php echo base_url('admin/services/add') ?>">
          <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i>  Tambah Service Baru</button>
        </a> 
        
        <h4 align="center"><?php echo $this->session->userdata('message');?></h4>
        <table id="table-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center">No.</th>
              <th data-sortable="false" style="text-align: center">Nama</th>
              <th data-sortable="false" style="text-align: center">Icon</th>
              <th data-sortable="false" style="text-align: center">Gambar</th>
              <th data-sortable="false" style="text-align: center">Author</th>
              <th data-sortable="false" style="text-align: center">Modified</th>
              <th data-sortable="false" style="text-align: center">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php $start = 0; foreach ($services_data as $services):?>
            <tr>
              <td width="10" style="text-align:center"><?php echo ++$start ?></td>  
              <td width="400"><?php echo $services->namaService ?></td>
              <td style="text-align: center" width="10"><?php echo '<i class="fa '.$services->icon.'" aria-hidden="true"></i>' ?></td>
              <td style="text-align:center"><?php if (empty($services->img)) { echo '(no image)'; } else { echo '<img height=30 src="'.base_url().'assets/img/'.$services->img.'"'; } ?></td>
              <td style="text-align:center"><?php echo $services->createdBy ?></td>
              <td style="text-align:center"><?php if($services->updatedTime=='0000-00-00 00:00:00'){ echo '(no updated data)';}else{echo $services->updatedTime; } ?></td>
              <td width="100" style="text-align:center"><div class="btn-group">
                  <button type="button" class="btn btn-default btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span> 
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url().'admin/services/edit/'.$services->idService;?>">Edit</a></li>
                    <li><a href="<?php echo base_url().'admin/services/delete/'.$services->idService;?>" onclick="return confirmDialog();">Delete</a></li>
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