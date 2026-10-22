<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Brands</h3>
      <div class="pull-left">
        Last Update : <?php echo $brands->updatedTime;?>, by: <?php echo $brands->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>products">Products</a></li>
          <li><a href="<?php echo $base_url_admin;?>brands/view">Brands</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?php
            echo form_open_multipart('admin/brands/edit/'.$brands->idBrand,array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('namaBrand','has-error ',''); ?>">
                            <label>Nama Brands</label>
                          <?php echo form_input($namaBrand,$brands->namaBrand);?>
                          <?php echo form_error('namaBrand','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('deskripsiID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_input($deskripsiID,$brands->deskripsiID);?>
                          <?php echo form_error('deskripsiID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('deskripsiEN','has-error ',''); ?>">
                          <label>Deskripsi EN</label>
                          <?php echo form_input($deskripsiEN,$brands->deskripsiEN);?>
                          <?php echo form_error('deskripsiEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status, $brands->status, $status_css); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                  <div class="col-xs-12">
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content ID</label>
                    <?php echo form_textarea($contentID,$brands->contentID);?>
                    <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>

                </div>
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content EN</label>
                    <?php echo form_textarea($contentEN,$brands->contentEN);?>
                    <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>

                </div>
              </div>
            </div>
                <?php if(empty($brands->img)) {
                  echo "
                  <div class='form-group'>
                  <label>Upload Logo</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' id='output'/>
                    </div>
                  </div>
                  <input type='file' accept='image/*' name='userfile' id='userfile' class='form-control'>
                </div>";
                } else {
                  echo"
                  <div class='form-group'>
                  <label>Logo</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' src='".base_url().'assets/img/'.$brands->img."'>
                      <input type='checkbox' name='removeImg' value='".$brands->img."'> Hapus Foto ketika disimpan
                    </div>
                  </div>
                </div>
                <div class='form-group'>
                  <label>Upload Logo baru</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' id='output'/>
                    </div>
                  </div>
                  <input type='file' accept='image/*' name='userfile' id='userfile' class='form-control'>
                </div>";
                }  ?>
                  </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/brands/view','Kembali',array('class'=>'btn btn-default btn-flat'));
                ?>
              </div>
            </form>
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

<script type="text/javascript">
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

</script>


<?php $this->load->view('templates/backend/footer'); ?>      
