<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">clients</h3>
      <div class="pull-left">
        Last Update : <?php echo $clients->updatedTime;?>, by: <?php echo $clients->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>clients/view">clients</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
          <?php
            echo form_open_multipart('admin/clients/edit/'.$clients->idClient,array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('namaClient','has-error ',''); ?>">
                            <label>Nama Client</label>
                          <?php echo form_input($namaClient,$clients->namaClient);?>
                          <?php echo form_error('namaClient','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status,$clients->status, $status_css); ?>
                        </div>
                    </div>  
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <?php if(empty($clients->img)) { ?>
                    <div class="form-group">
                      <label>Gambar</label>
                      <div class="row">
                        <div class="col-md-4">
                          <img class="img-responsive" id="output"/>
                        </div>
                      </div>
                      <input type="file" accept="image/*" name="userfile" id="userfile" class="form-control">
                    </div>
                    <?php }else{ ?>
                    <div class="form-group">
                      <label>Gambar Lama</label>
                      <div class="row">
                        <div class="col-md-4">
                          <img class="img-responsive" src="<?php echo base_url().'assets/img/'.$clients->img; ?>"/>
                          <input type="checkbox" name="removeImg" value="<?php echo $clients->img; ?>"> Hapus Foto ketika disimpan
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Upload Gambar Baru</label>
                      <div class="row">
                        <div class="col-md-4">
                          <img class="img-responsive" id="output"/>
                        </div>
                      </div>
                      <input type="file" accept="image/*" name="userfile" id="userfile" class="form-control">
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/clients/view','Kembali',array('class'=>'btn btn-default btn-flat'));
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