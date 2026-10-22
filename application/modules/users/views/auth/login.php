<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from big-bang-studio.com/cosmos/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2017 07:27:10 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <title>Login Page</title>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.html">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="manifest.html">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/backend/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/backend/css/cosmos.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/backend/css/application.min.css">
  </head>
  <body class="authentication-body">
    <div class="container-fluid">
      <div class="authentication-header m-b-30">
        <div class="clearfix">
          <div class="pull-left">
            <a class="authentication-logo" href="index.html">
              <img src="<?php echo base_url();?>assets/template/backend/img/logo.png" alt="" height="25">
              <span>ptppm.id</span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="authentication-content m-b-30">
            <h3 class="m-t-0 m-b-30 text-center">Login Page</h3>
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("login");?>
              <div class="form-group has-feedback">
                <?php echo form_input(array('name' => 'username', 'value' => set_value('username'), 'class' => 'form-control')); ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <?php echo form_password(array('name' => 'password', 'value' => set_value('password'), 'class' => 'form-control')); ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
              <label class="custom-control custom-control-info custom-checkbox active">
              <?php echo form_checkbox('remember', '1', FALSE, array('class'=>'custom-control-input','id'=>'remember'));?>
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-label">Remember Me</span>
                </label>
              </div>
              <button type="submit" class="btn btn-info btn-block">Submit</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
    <script src="<?php echo base_url();?>assets/template/backend/js/vendor.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/cosmos.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/application.min.js"></script>
  </body>

<!-- Mirrored from big-bang-studio.com/cosmos/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2017 07:27:10 GMT -->
</html>