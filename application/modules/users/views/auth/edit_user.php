<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>      

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Profile Edit</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>profile/view">Profile</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
      <div id="infoMessage"></div>
      <?php echo form_open(uri_string());?>
        <!-- left column -->
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-body">
              <?php echo $message;?>
              <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6"><label>Nama</label>
                  <?php echo form_input($nama);?>
                </div>
                <div class="col-xs-12 col-md-6 col-sm-6"><label>Username</label>
                  <?php echo form_input($username);?>
                </div>
              </div><br>
              <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6"><label>Email</label>
                  <?php echo form_input($email);?>
                </div>
                <div class="col-xs-12 col-md-6 col-sm-6"><label>No. HP</label>
                  <?php echo form_input($phone);?>
                </div>
              </div><br>
              <div class="form-group"><label>Alamat</label>
                <?php echo form_textarea($alamat);?>
              </div>
              <?php if ($this->ion_auth->is_superadmin()): ?>
              <div class="form-group"><label>Tipe user</label>
              <?php 
              echo form_dropdown('usertype',$users_group,$user->usertype,$usertype);?>
              </div>
              <?php endif ?>
              <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6"><label>Password</label>
                  <?php echo form_input($password);?>
                </div>
                <div class="col-xs-12 col-md-6 col-sm-6"><label>Konfirmasi Password</label>
                  <?php echo form_input($password_confirm);?>
                </div>
              </div>
              <?php echo form_hidden('id', $user->id);?>
              <?php echo form_hidden($csrf); ?>
            </div><!-- /.box-body -->
            <br>
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
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

