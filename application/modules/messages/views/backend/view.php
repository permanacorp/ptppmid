<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Messages</h3>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li class="active">Messages</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="box">
            <div class="box-header">
            <?php echo $message;?>
            <!-- /.box-header -->           
            </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover table-striped">
                <thead>
                <tr>
                  <th>Subject</th>
                  <th>Message</th>
                  <th width='30'>Status</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($messages_data as $r) {
                  echo"
                <tr>
                  <td>".anchor("admin/messages/read/".$r->id,$r->subject)."</td>
                  <td>$r->content</td>
                  <td>"; if($r->status=="unread") {
                    echo "<span class='label label-outline-success'>new</span>";
                  } else {
                    echo "<span class='label label-outline-primary'>read</span>";
                  }?>
                   <?php
                  echo "</td>
                  <td width='10'>".anchor("admin/messages/delete/".$r->id,"<span class='fa fa-trash' style='color:#777'></span>",array('title'=>'delete data','onclick' => "return confirm('Message akan dihapus, Anda Yakin?')"))."</td>
                </tr>";
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div> <!-- panel body -->
  </div> <!-- panel default -->
</div> <!-- sitecontent  -->      

<script type="text/javascript">
function confirmDialog() {
 return confirm('Apakah anda yakin?')

}

</script>

<?php $this->load->view('templates/backend/footer'); ?>      