<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PRODUCTS -->
<section>
    <div class="container">
        <div class="row">
<?php $this->load->view('templates/frontend/sidebar'); ?>
            <!-- Post content-->
            <div class="post-content float-right col-md-9">
                <div class="col-xs-12">
                <?php
    foreach ($products as $prdcts)
    {
        ?>
                <div class="portfolio-item col-md-6 col-sm-6 col-xs-12">
                    <div class="image-box effect bleron">
                        <img src="<?php echo base_url().'assets/img/'.$prdcts->img;?>" alt=<?php echo $prdcts->namaProduct;?>">
                        <div class="image-box-content">
                            <p class="image-box-links"><a href="<?php echo base_url().$lang.'/product/'.$prdcts->slug;?>">Produk Detail</a></p>
                        </div>
                    </div>
                    <div class="portfolio-description">
                        <h4 class="title"><a href="<?php echo base_url().$lang.'/product/'.$prdcts->slug;?>"><?php echo strtoupper(get_datacatbyID($prdcts->idCategory)).' '.strtoupper($prdcts->namaProduct);?></a></h4>
                        <p><i class="fa fa-tag"></i><?php echo html_escape(strtoupper(get_databranbyID($prdcts->idBrand)));?></p>
                    </div>
                </div>
                <?php } ?>
</div>
<div class="col-xs-12">
    

                    <nav class="text-center">
                        <?php echo $links; ?>
                    </nav>
</div>
            </div>

            <!-- END: Post content-->

            

        </div>
    </div>
</section>
<!-- END: SHOP PRODUCTS -->


<?php $this->load->view('templates/frontend/footer'); ?>
