<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Web Configuration</h3>
      <div class="pull-left">
        Last Update : <?php echo $web_app->updatedTime;?>, by: <?php echo $web_app->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">Web Configuration</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
          <?php
            echo form_open_multipart('admin/web_app/configuration/',array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('namaWeb','has-error ',''); ?>">
                            <label>Nama Service</label>
                          <?php echo form_input($namaWeb,$web_app->namaWeb);?>
                          <?php echo form_error('namaWeb','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('maps','has-error ',''); ?>">
                            <label>Maps Koordinator</label>
                          <?php echo form_input($maps,$web_app->maps);?>
                          <?php echo form_error('maps','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('sloganWebID','has-error ',''); ?>">
                          <label>Slogan dalam bahasa Indonesia</label>
                          <?php echo form_textarea($sloganWebID,$web_app->sloganWebID);?>
                          <?php echo form_error('sloganWebID','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('sloganWebEN','has-error ',''); ?>">
                          <label>Slogan dalam bahasa Inggris</label>
                          <?php echo form_textarea($sloganWebEN,$web_app->sloganWebEN);?>
                          <?php echo form_error('sloganWebEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('alamat','has-error ',''); ?>">
                          <label>Alamat dalam bahasa Indonesia</label>
                          <?php echo form_textarea($alamat,$web_app->alamat);?>
                          <?php echo form_error('alamat','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('address','has-error ',''); ?>">
                          <label>Alamat dalam Bahasa Inggris</label>
                          <?php echo form_textarea($address,$web_app->address);?>
                          <?php echo form_error('address','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('telp','has-error ',''); ?>">
                            <label>Telephone</label>
                          <?php echo form_input($telp,$web_app->telp);?>
                          <?php echo form_error('telp','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('fax','has-error ',''); ?>">
                            <label>Fax</label>
                          <?php echo form_input($fax,$web_app->fax);?>
                          <?php echo form_error('fax','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('email','has-error ',''); ?>">
                            <label>Email</label>
                          <?php echo form_input($email,$web_app->email);?>
                          <?php echo form_error('email','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <?php if(empty($web_app->img)) { ?>
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
                          <img class="img-responsive" src="<?php echo base_url().'assets/img/'.$web_app->img; ?>"/>
                          <input type="checkbox" name="removeImg" value="<?php echo $web_app->img; ?>"> Hapus Foto ketika disimpan
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
                    echo anchor('admin/web_app/view','Kembali',array('class'=>'btn btn-default btn-flat'));
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