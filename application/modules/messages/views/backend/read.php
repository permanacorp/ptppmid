<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Message</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>message/view">Message</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?php
            echo form_open('admin/messages/read');
            ?>
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <input type="hidden" name="id" value="<?php echo $messages->id;?>">
                <h3><?php echo $messages->subject;?></h3>
                <h5>From: <?php echo $messages->email;?>
                <h5>Nama: <?php echo $messages->nama;?>
                <h5>Telp: <?php echo $messages->noWA;?>
                  <span class="mailbox-read-time pull-right"><?php $date = date_create($messages->dateTime);?><?php echo date_format($date, 'd M. Y H:i A'); ?></span></h5>
              </div>
              <div class="mailbox-read-message">
                <?php echo $messages->content;?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <hr />
            <!-- /.box-footer -->
              <div class="box-footer">
                <input type="hidden" name="status" value="read">
                <button type="submit" name="submit" class="btn btn-default btn-flat">Kembali</button>
              </div>
            <!-- /.box-footer -->
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
