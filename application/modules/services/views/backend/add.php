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
          <li><a href="<?php echo $base_url_admin;?>services/view">services</a></li>
          <li class="active">Input</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
          <?php
            echo form_open_multipart('admin/services/add',array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('namaService','has-error ',''); ?>">
                            <label>Nama Service</label>
                          <?php echo form_input($namaService);?>
                          <?php echo form_error('namaService','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('deskripsiID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_input($deskripsiID);?>
                          <?php echo form_error('deskripsiID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('deskripsiEN','has-error ',''); ?>">
                          <label>Deskripsi EN</label>
                          <?php echo form_input($deskripsiEN);?>
                          <?php echo form_error('deskripsiEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                        <label>Icon</label>
                      <select name="icon" id="icon" class="form-control" data-plugin="select2">
                        <?php
                        foreach ($icons as $row)
                          {
                          echo "<option value=\"$row\"><i class='fa ".$row."'></i>".$row."</option>";
                         }
                        ?>
                      </select>
                        </div>
                    </div>    
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                        <label>Position</label>
                          <div class="checkbox">
                            <label class="custom-control custom-control-primary custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="position">
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Primary</span>
                            </label>
                          </div>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label>Gambar</label>
                        <div class="row">
                          <div class="col-md-4">
                            <img class="img-responsive" id="output"/>
                          </div>
                        </div>
                        <input type="file" accept="image/*" name="userfile" id="userfile" class="form-control">
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/services/view','Kembali',array('class'=>'btn btn-default btn-flat'));
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