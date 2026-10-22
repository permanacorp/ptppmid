<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">posts</h3>
      <div class="pull-left">
        Last Update : <?php echo $posts->updatedTime;?>, by: <?php echo $posts->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>posts/view">posts</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?php
            echo form_open_multipart('admin/posts/edit/'.$posts->idPost,array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('namaPost','has-error ',''); ?>">
                            <label>Nama posts</label>
                          <?php echo form_input($namaPost,$posts->namaPost);?>
                          <?php echo form_error('namaPost','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('deskripsiID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_input($deskripsiID,$posts->deskripsiID);?>
                          <?php echo form_error('deskripsiID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php echo form_error('deskripsiEN','has-error ',''); ?>">
                          <label>Deskripsi EN</label>
                          <?php echo form_input($deskripsiEN,$posts->deskripsiEN);?>
                          <?php echo form_error('deskripsiEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Tanggal Publish</label>
                          <?php echo form_input($publishDate,$posts->publishDate);?>
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status, $posts->status, $status_css); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                  <div class="col-xs-12">
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content ID</label>
                    <?php echo form_textarea($contentID,$posts->contentID);?>
                    <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>

                </div>
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content EN</label>
                    <?php echo form_textarea($contentEN,$posts->contentEN);?>
                    <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>

                </div>
              </div>
            </div>
                <?php if(empty($posts->img)) {
                  echo "
                  <div class='form-group'>
                  <label>Upload Logo</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' id='output'/>
                    </div>
                  </div>
                  <input type='hidden' name='resize' class='form-control' value='yes'>
                  <input type='file' accept='image/*' name='userfile' id='userfile' class='form-control'>
                </div>";
                } else {
                  echo"
                  <div class='form-group'>
                  <label>Logo</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' src='".base_url().'assets/img/'.$posts->img."'>
                      <input type='checkbox' name='removeImg' value='".$posts->img."'> Hapus Foto ketika disimpan
                      <input type='hidden' name='delete_imgResizex340' value='".$posts->imgResizex340."'>
                      <input type='hidden' name='delete_imgResizex80' value='".$posts->imgResizex80."'>
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
                  <input type='hidden' name='resize' class='form-control' value='yes'>
                </div>";
                }  ?>
                  </div>
                  
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary btn-flat">Submit</button>
                <button type="reset" name="reset" class="btn btn-danger btn-flat">Reset</button>
                <?php
                    echo anchor('admin/posts/view','Kembali',array('class'=>'btn btn-default btn-flat'));
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
