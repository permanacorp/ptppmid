<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP BrandS -->
<section>
    <div class="container">
        <div class="row">
            <!-- Post content-->
            <div class="post-content post-content-single col-md-9">
                <div class="row">
                    <div class="post-slider">
                        <div class="carousel" data-carousel-col="1">
                        <?php $data = get_data_ransli($brand->idBrand);
                            foreach ($data as $s): ?>
                            <img src="<?php echo base_url().'assets/img/'.$s->img;?>">
                        <?php endforeach; ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="tabs-10" class="tabs tabs-vertical border">
                        <ul class="tabs-navigation">
                            <li class="active"><a href='#Product'>Semua Produk</a></li>
                            <?php 
                            $record = get_data_probran($brand->idBrand);
                            foreach ($record as $r): ?>
                            <li><a style="font-size:11px;" href="#<?php echo $r->slug; ?>"><i class="fa fa-chevron-right"></i><?php echo strtoupper($r->namaProduct); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tabs-content">
                            <div class="tab-pane active" id="Product">
                                <h3><?php echo html_escape(strtoupper($brand->namaBrand));?></h3>
                                <div style="text-align:justify">
                                <?php echo clean_wysiwyg($brand->contentID);?>
                                </div>
                                <p><strong>Produk dari <?php echo html_escape(strtoupper($brand->namaBrand));?>:</strong></p>
                                <div class="col-xs-12">
                                    <?php $data = get_data_probran($brand->idBrand);
                                    foreach ($data as $p): ?>
                                    <div class="col-md-6">
                                        <a href="<?php echo base_url().$lang.'/product/'.$p->slug; ?>">
                                            <img class='img-responsive' alt='<?php echo html_escape($p->namaProduct); ?>' src="<?php echo base_url().'assets/img/'.$p->imgResizex260; ?>"></a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php $data = get_data_probran($brand->idBrand);
                                foreach ($data as $p): ?>
                            <div class="tab-pane" id="<?php echo $p->slug; ?>">
                                <h4><a href="<?php echo base_url().$lang.'/product/'.$p->slug; ?>"><?php echo strtoupper(get_datacatbyID($p->idCategory)); ?> <?php echo strtoupper($p->namaProduct); ?></a></h4>
                                <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo base_url().'assets/img/'.$p->imgResizex111; ?>" class="img-responsive">
                                </div>
                                <div class="col-md-9" style="text-align:justify;">
                                    <?php echo $p->deskripsiID; ?>
                                </div>
                                </div>
                                <span>Informasi Tambahan:</span>
                                <table class="table">
                                <?php $data = get_data_ductspec($p->idProduct);
                                foreach ($data as $r):?>
                                    <tr>
                                        <th><?php echo $r->name;?></th>
                                        <td><?php echo $r->value;?></td>
                                    </tr>
                                
                                <?php endforeach; ?>
                                </table>
                                <a href="<?php echo base_url().$lang.'/product/'.$p->slug; ?>">Lihat Detail</a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div><!-- END: Post content-->      
<?php $this->load->view('templates/frontend/sidebar'); ?>
        </div>
    </div>
</section>
<!-- END: SHOP BrandS -->


<?php $this->load->view('templates/frontend/footer'); ?>
