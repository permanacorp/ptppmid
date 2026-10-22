<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>

        <!-- INSPIRO SLIDER -->
        <div id="slider" class="inspiro-slider hidden-xs" data-height-xs="360">
            <!-- Slide 1 -->
        <?php foreach ($slides as $slds):?>
            <div class="slide" style="background-image:url('<?php echo base_url().'assets/img/'.$slds->img ?>');">
                <div class="container">
                    <div class="slide-captions text-dark">
                        <!-- Captions -->
                        <!-- <h1 data-caption-animation="rotateInUpLeft">Beautiful Websites</h1>
                        <h3 data-caption-animation="rotateInUpLeft" data-caption-delay="300">Are now easy to made!</h3> -->
                        <!-- End: Captions -->
                    </div>
                </div>
            </div>
            <!-- END: Slide 1 -->
        <?php endforeach;?>
            
        </div>
        <!-- END: INSPIRO SLIDER -->

        <!-- Call to action -->
        <section class="background-grey text-center p-t-60  p-b-40">
            <div class="container">
                <div class="col-md-9">
                    <h3><?php echo $web_config->sloganWebID;?></h3>
                </div>
                <div class="col-md-3"><a href="<?php echo base_url().$lang.'/ecatalogue-lkpp/';?>" type="button" class="btn btn-default">Lihat Produk Ecatalogue!</a> </div>
            </div>
        </section>
        <!-- END: Call to action -->

        <!-- Services -->
        <section class="p-b-20">
            <div class="container">
                <div class="row">
                    <?php foreach ($services_3 as $srvcs3):?>
                        <!-- features box -->
                    <div class="col-md-4">
                        <div class="icon-box effect medium border center">
                            <div class="icon">
                                <a href="#"><i class="fa <?php echo $srvcs3->icon; ?>"></i></a>
                            </div>
                            <h3><?php echo strtoupper($srvcs3->namaService); ?></h3>
                            <p><?php echo $srvcs3->deskripsiID; ?></p>
                        </div>
                    </div>
                    <!-- End: features box -->               
                    <?php endforeach;?>
                </div>
                <!-- end features box -->
            </div>
        </section>
        <!-- End: Services -->

        <!-- Our numbers -->
        <section class="parallax background-grey p-t-100 p-b-80">
            <div class="container xs-text-center sm-text-center">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="3000" data-refresh-interval="50" data-to="<?php echo $ecatalogue_count;?>" data-from="0" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>Produk e-catalogue</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="4500" data-refresh-interval="23" data-to="<?php echo $retail_count;?>" data-from="0" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>Produk Retail</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="3000" data-refresh-interval="12" data-to="<?php echo $brands_count;?>" data-from="0" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>Brands</p>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="4550" data-refresh-interval="50" data-to="<?php echo $categories_count;?>" data-from="0" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>Kategori</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Our numbers -->

        <!-- Services -->
        <section class="p-b-40">
            <div class="container">
                <div class="row">
                    <?php foreach ($services as $srvcs):?>
                    <!-- features box -->
                    <div class="col-md-4">
                        <h4><i class="fa <?php echo $srvcs->icon; ?>"></i> <?php echo ucwords($srvcs->namaService); ?></h4>
                        <p><?php echo $srvcs->deskripsiID; ?></p>
                    </div>
                    <!-- End: features box -->
                    <?php endforeach;?>

                </div>

            </div>
        </section>
        <!-- End: Services -->

        <!-- start: brands -->
        <section>
            <div class="container">
            <!--Image Carousel -->
                <div class="hr-title hr-long center"><abbr>Brands Kami</abbr> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="lead">Brand-brand resmi PT. Permana Putra Mandiri dengan aftersales terbaik!</p>
                        </div>
                    </div>
                    <ul class="grid grid-5-columns">
                        <?php foreach ($brands as $brnds): ?>
                        <li>
                            <a href="#"><img alt="" src="<?php echo base_url().'assets/img/'.$brnds->img;?>"> </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <hr class="space">
                <!--Image Carousel -->
            </div>
        </section>
        <!-- end: brands -->

<?php $this->load->view('templates/frontend/footer'); ?>
