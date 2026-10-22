<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Events</h3>
      <div class="pull-left">
        Last Update : <?php echo $events->updatedTime;?>, by: <?php echo $events->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>events/view">Events</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?php
            echo form_open_multipart('admin/events/edit/'.$events->idEvent,array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('namaEvent','has-error ',''); ?>">
                            <label>Nama events</label>
                          <?php echo form_input($namaEvent,$events->namaEvent);?>
                          <?php echo form_error('namaEvent','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('eventTargetURL','has-error ',''); ?>">
                            <label>Postingan URL</label>
                          <?php echo form_input($eventTargetURL,$events->eventTargetURL);?>
                          <?php echo form_error('eventTargetURL','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_textarea($contentID,$events->contentID);?>
                          <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('contentEN','has-error ',''); ?>">
                            <label>Deskripsi EN</label>
                          <?php echo form_textarea($contentEN,$events->contentEN);?>
                          <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo form_error('startDate','has-error ',''); ?>">
                        <label>Tanggal Mulai</label>
                          <?php echo form_input($startDate,$events->startDate);?>
                          <?php echo form_error('startDate','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Tanggal Selesai</label>
                          <?php echo form_input($endDate,$events->endDate);?>
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status, $events->status, $status_css); ?>
                        </div>
                    </div>    
                </div>
                <?php if(empty($events->img)) {
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
                      <img class='img-responsive' src='".base_url().'assets/img/'.$events->img."'>
                      <input type='checkbox' name='removeImg' value='".$events->img."'> Hapus Foto ketika disimpan
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

</script>


<?php $this->load->view('templates/backend/footer'); ?>      
