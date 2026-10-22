<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PRODUCTS -->
<section>
    <div class="container">
        <div class="row">
<?php $this->load->view('templates/frontend/sidebar'); ?>
            <!-- Post content-->
            <div class="post-content post-content-single float-right col-md-9">
                <div class="post-item">
                    <div class="featured-box">
                      <div class="effect social-links"> <img src="<?php echo base_url().'assets/img/'.$product->img;?>" alt="image">
                        <div class="image-box-content">
                          <p> <a href="<?php echo base_url().'assets/img/'.$product->img;?>" data-lightbox-type="image" title="<?php echo html_escape($product->namaProduct);?>"><i class="fa fa-expand"></i></a> </p>
                        </div>
                      </div>
                    </div>
                    <div class="post-content-details">
                        <div class="post-title">
                            <h3><?php echo html_escape(strtoupper(get_datacatbyID($product->idCategory).' '.$product->namaProduct));?></h3>
                            <?php
                                if ($product->price==0) {
                                    echo "<p></p>";
                                } else {
                                    echo "<p>".rupiah($product->price)."  *Harga Ecatalogue";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="post-description">
                        <div id="tabs-05" class="tabs justified border">
                            <ul class="tabs-navigation">
                                <li class="active"><a href="#Description">Deskripsi</a> </li>
                                <li><a href="#Information">Informasi Tambahan</a> </li>
                                <li><a style="background-color:#d82731;color:#fff;" href="<?php echo base_url().'assets/uploads/pdf/'. html_escape($product->download); ?>" rel="noopener noreferrer" target="_blank">Download</a></li>
                                <?php if ($product->category==='ecatalogue') { ?>
                                    <li><a style="background-color:#d82731;color:#fff;" href="<?php echo html_escape($product->urlPembelian); ?>" rel="noopener noreferrer" target="_blank"><i class="fa fa-shopping-cart"></i>Beli via Ecatalogue</a></li>
                                 <?php }
                                ?>
                            </ul>
                            <div class="tabs-content">
                                <div class="tab-pane active" id="Description">
                                    <?php 
                                    echo clean_wysiwyg($product->contentID); 
                                    if ($product->embedYT!="") { ?>
                                        <hr>
                                        <iframe width=700 height=400 src="<?=$product->embedYT;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <?php } ?>
                                </div>
                                <div class="tab-pane" id="Information">
                                    <table class="table">
                                         <tbody>
                                            <?php $data = get_data_ductspec($product->idProduct);
                                            foreach ($data as $r): ?>
                                            <tr>
                                                <th><?php echo html_escape($r->name);?></th>
                                                <td><?php echo html_escape($r->value);?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end: tabs content -->
                        </div> <!-- end: tabs  -->
                    </div> <!-- end: post description -->
                </div> <!-- end: post item -->
                <?php 
                $data = count_data('products',array('idCategory'=>$product->idCategory,'status'=>1));
                if ($data>1) { ?>
                <div class="col-md-12">
                    <div class="heading-fancy heading-line text-center">
                        <h5>Produk Lainnya</h5>
                    </div>
                    <div class="carousel" data-carousel-col="4">
                        <?php 
                        $data = get_data_catpro($product->idCategory,$product->idProduct);
                        foreach ($data as $p): ?>
                        <div>
                            <a href="<?php echo base_url().$lang.'/product/'.$p->slug;?>"><img alt="" src="<?php echo base_url().'assets/img/'.$p->imgResizex260;?>"><?php echo strtoupper(get_datacatbyID($p->idCategory).' '.$p->namaProduct);?>
                            </a>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>   
                <?php } ?>
                
                
            </div>
            <!-- END: Post content-->      
        </div>
    </div>
</section>
<!-- END: SHOP PRODUCTS -->


<?php $this->load->view('templates/frontend/footer'); ?>
