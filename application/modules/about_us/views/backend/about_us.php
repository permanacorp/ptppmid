<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">About Us</h3>
      <div class="pull-left">
        Last Update : <?php echo $about_us->updatedTime;?>, by: <?php echo $about_us->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">About Us</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
          <?php
            echo form_open('admin/about-us/');
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('namaID','has-error ',''); ?>">
                            <label>Nama dalam bahasa Indonesia</label>
                          <?php echo form_input($namaID,$about_us->namaID);?>
                          <?php echo form_error('namaID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('namaEN','has-error ',''); ?>">
                            <label>Nama dalam bahasa Inggris</label>
                          <?php echo form_input($namaEN,$about_us->namaEN);?>
                          <?php echo form_error('namaEN','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group <?php echo form_error('percent','has-error ',''); ?>">
                            <label>Percent</label>
                          <?php echo form_input($percent,$about_us->percent);?>
                          <?php echo form_error('percent','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('deskripsiID','has-error ',''); ?>">
                          <label>Deskripsi dalam bahasa Indonesia</label>
                          <?php echo form_textarea($deskripsiID,$about_us->deskripsiID);?>
                          <?php echo form_error('deskripsiID','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('deskripsiEN','has-error ',''); ?>">
                          <label>Deskripsi dalam bahasa Inggris</label>
                          <?php echo form_textarea($deskripsiEN,$about_us->deskripsiEN);?>
                          <?php echo form_error('deskripsiEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                          <label>content dalam bahasa Indonesia</label>
                          <?php echo form_textarea($contentID,$about_us->contentID);?>
                          <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('contentEN','has-error ',''); ?>">
                          <label>content dalam bahasa Inggris</label>
                          <?php echo form_textarea($contentEN,$about_us->contentEN);?>
                          <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
                 <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('visionID','has-error ',''); ?>">
                          <label>vision dalam bahasa Indonesia</label>
                          <?php echo form_textarea($visionID,$about_us->visionID);?>
                          <?php echo form_error('visionID','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('visionEN','has-error ',''); ?>">
                          <label>vision dalam bahasa Inggris</label>
                          <?php echo form_textarea($visionEN,$about_us->visionEN);?>
                          <?php echo form_error('visionEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
                 <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('missionID','has-error ',''); ?>">
                          <label>mission dalam bahasa Indonesia</label>
                          <?php echo form_textarea($missionID,$about_us->missionID);?>
                          <?php echo form_error('missionID','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group <?php echo form_error('missionEN','has-error ',''); ?>">
                          <label>mission dalam bahasa Inggris</label>
                          <?php echo form_textarea($missionEN,$about_us->missionEN);?>
                          <?php echo form_error('missionEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>       
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/dashboard','Kembali',array('class'=>'btn btn-default btn-flat'));
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