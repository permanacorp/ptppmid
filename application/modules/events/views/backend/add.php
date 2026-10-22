<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">events</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>events/view">events</a></li>
          <li class="active">Input</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?php
            echo form_open_multipart('admin/events/add',array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('namaEvent','has-error ',''); ?>">
                            <label>Nama events</label>
                          <?php echo form_input($namaEvent);?>
                          <?php echo form_error('namaEvent','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('eventTargetURL','has-error ',''); ?>">
                            <label>Postingan URL</label>
                          <?php echo form_input($eventTargetURL);?>
                          <?php echo form_error('eventTargetURL','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_textarea($contentID);?>
                          <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('contentEN','has-error ',''); ?>">
                            <label>Deskripsi EN</label>
                          <?php echo form_textarea($contentEN);?>
                          <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo form_error('startDate','has-error ',''); ?>">
                        <label>Tanggal Mulai</label>
                          <?php echo form_input($startDate);?>
                          <?php echo form_error('startDate','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Tanggal Selesai</label>
                          <?php echo form_input($endDate);?>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status, '', $status_css); ?>
                        </div>
                    </div>    
                </div>
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
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/events/view','Kembali',array('class'=>'btn btn-default btn-flat'));
                ?>
              </div>
            </form>
                  <?php echo form_close();?>
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

  //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd',
      setDate: new Date()
    });



</script>


<?php $this->load->view('templates/backend/footer'); ?>      