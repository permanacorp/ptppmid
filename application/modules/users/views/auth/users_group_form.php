<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>      

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Edit User Group</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
          <li><a href="<?php echo base_url();?>admin/users/users_group">Users Group</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
      <div id="infoMessage"></div>
      <?php echo form_open("admin/users/edit_group_action");?>
        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-body"><?php echo form_error('name') ?>
              <div class="form-group"><label>Nama</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
              </div>
            <input type="hidden" name="id_group" value="<?php echo $id_group; ?>" /> 

            </div><!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
              <button type="reset" name="reset" class="btn btn-danger">Reset</button>
            </div>
          </div><!-- /.box -->
          <!-- left column -->
      <?php echo form_close(); ?>
        </div>
      </div> <!-- row body -->
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<?php $this->load->view('templates/backend/footer'); ?>      