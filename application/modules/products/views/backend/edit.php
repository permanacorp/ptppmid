<?php $this->load->view('templates/backend/head'); ?>
<?php $this->load->view('templates/backend/header'); ?>
<?php $this->load->view('templates/backend/sidebar'); ?>

<div class="site-content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="m-y-0">Products</h3>
      <div class="pull-left">
        Last Update : <?php echo $products->updatedTime;?>, by: <?php echo $products->updatedBy;?> 
      </div>
      <div class="pull-right">
        <ol class="breadcrumb hidden-xs">
          <li><a href="<?php echo $base_url_admin;?>dashboard">Dashboard</a></li>
          <li><a href="<?php echo $base_url_admin;?>products/view">Products</a></li>
          <li class="active">Edit</li>
        </ol>
      </div> <!-- breadcrumb pull right -->
    </div> <!-- panel heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-12">
          <?php
            echo form_open_multipart('admin/products/edit/'.$products->idProduct,array('onchange'=>'loadFile(event)'));
            ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Brands</label>
                            <select name="idBrand" id="idBrand" class="form-control" data-plugin="select2" value="<?php echo $products->idBrand ?>">
                              <?php
                              foreach ($brands as $row)
                                {
                                echo "<option value='$row->idBrand' ";
                                echo $row->idBrand==$products->idBrand?'selected':'';
                                echo ">".strtoupper($row->namaBrand)."</option>";
                               }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Categories</label>
                            <select name="idCategory" id="idCategory" class="form-control" data-plugin="select2" value="<?php echo $products->idCategory ?>">
                              <?php
                              foreach ($categories as $row)
                                {
                                echo "<option value='$row->idCategory' ";
                                echo $row->idCategory==$products->idCategory?'selected':'';
                                echo ">".strtoupper($row->namaCategory)."</option>";
                               }
                              ?>
                            </select>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="form-group <?php echo form_error('namaProduct','has-error ',''); ?>">
                            <label>Nama Product</label>
                          <?php echo form_input($namaProduct,$products->namaProduct);?>
                          <?php echo form_error('namaProduct','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="form-group <?php echo form_error('deskripsiID','has-error ',''); ?>">
                            <label>Deskripsi ID</label>
                          <?php echo form_input($deskripsiID,$products->deskripsiID);?>
                          <?php echo form_error('deskripsiID','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-sm-6">
                        <div class="form-group <?php echo form_error('deskripsiEN','has-error ',''); ?>">
                          <label>Deskripsi EN</label>
                          <?php echo form_input($deskripsiEN,$products->deskripsiEN);?>
                          <?php echo form_error('deskripsiEN','<span class="help-block">','</span>'); ?>
                        </div> 
                    </div>
                    <div class="col-xs-12 col-md-3 col-sm-3">
                        <div class="form-group">
                        <label>Status</label>
                          <?php echo form_dropdown('', $status, $products->status, $status_css); ?>
                        </div>
                    </div> 
                    <div class="col-xs-12 col-md-3 col-sm-3">
                        <div class="form-group">
                        <label>Video Youtube(Embed)</label>
                          <?php echo form_input($embedYT,$products->embedYT);?>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-sm-2 col-xs-12">
                        <div class="form-group">
                        <label>Category</label><br/>
                          <label><?php echo form_radio(array('onclick'=>'show1()','name'=>'category','value'=>'retail','checked'=>($products->category === 'retail' ? TRUE : FALSE))); ?> Retail</label>
                          <label style="float:right;"><?php echo form_radio(array('onclick'=>'show2()','name'=>'category','value'=>'ecatalogue','checked'=>($products->category === 'ecatalogue' ? TRUE : FALSE))); ?> Ecatalogue</label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <div id="urlPembelian" class="form-group" <?php if ($products->category===null | $products->category==='retail') { echo'style="display: none;"';}?>>
                            <label>URL Pembelian</label>
                          <?php echo form_input($urlPembelian,$products->urlPembelian);?>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group <?php echo form_error('download','has-error ',''); ?>">
                            <label>PDF Spesifikasi</label>
                          <?php echo form_input($download,$products->download);?>
                          <?php echo form_error('download','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                    <div class="col-sm-3 col-xs-12">
                        <div class="form-group <?php echo form_error('price','has-error ',''); ?>">
                            <label>Harga</label>
                          <?php echo form_input($price,$products->price);?>
                          <?php echo form_error('price','<span class="help-block">','</span>'); ?>
                        </div>
                    </div>    
                </div>
                <div class="row">
                  <div class="col-xs-12">
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content ID</label>
                    <?php echo form_textarea($contentID,$products->contentID);?>
                    <?php echo form_error('contentID','<span class="help-block">','</span>'); ?>

                </div>
                <div class="form-group <?php echo form_error('contentID','has-error ',''); ?>">
                  <label>Content EN</label>
                    <?php echo form_textarea($contentEN,$products->contentEN);?>
                    <?php echo form_error('contentEN','<span class="help-block">','</span>'); ?>

                </div>
              </div>
            </div>
                <?php if(empty($products->img)) {
                  echo "
                  <div class='form-group'>
                  <label>Upload Gambar Produk</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' id='output'/>
                    </div>
                  </div>
                  <input type='file' accept='image/*' name='userfile' id='userfile' class='form-control'>
                  <input type='hidden' name='resize' class='form-control' value='yes'>
                </div>";
                } else {
                  echo"
                  <div class='form-group'>
                  <label>Gambar Produk</label>
                  <div class='row'>
                    <div class='col-md-4'>
                      <img class='img-responsive' src='".base_url().'assets/img/'.$products->img."'>
                      <input type='checkbox' name='removeImg' value='".$products->img."'> Hapus Foto ketika disimpan
                      <input type='hidden' name='delete_imgResizex260' value='".$products->imgResizex260."'>
                      <input type='hidden' name='delete_imgResizex160' value='".$products->imgResizex160."'>
                      <input type='hidden' name='delete_imgResizex111' value='".$products->imgResizex111."'>
                      <input type='hidden' name='delete_imgResizex56' value='".$products->imgResizex56."'>
                    </div>
                  </div>
                </div>
                <div class='form-group'>
                  <label>Upload Gambar Produk baru</label>
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
                    echo anchor('admin/products/view','Kembali',array('class'=>'btn btn-default btn-flat'));
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
function show1(){
  document.getElementById('urlPembelian').style.display ='none';
}
function show2(){
  document.getElementById('urlPembelian').style.display = 'block';
}
</script>

<script type="text/javascript">
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

</script>


<?php $this->load->view('templates/backend/footer'); ?>      