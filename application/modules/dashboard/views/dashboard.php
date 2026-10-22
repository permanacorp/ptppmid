<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>      

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Dashboard</h3>
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success alert-icon-bg alert-dismissable" role="alert">
            <div class="alert-icon">
              <i class="zmdi zmdi-check"></i>
            </div>
            <div class="alert-message">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                  <i class="zmdi zmdi-close"></i>
                </span>
              </button>
              <strong>Hello! </strong><?php echo ucwords($name);?>. 
            </div>
          </div>
        </div>
      </div> <!-- row body -->
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<?php $this->load->view('templates/backend/footer'); ?>      