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
                    <h3 style="font-weight: 100;"><?php echo $web_config->sloganWebID;?></h3></div>
                <div class="col-md-3"><a type="button" class="btn btn-default">Lihat Produk!</a> </div>
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
                        <img src="<?php echo base_url().'assets/img/'.$srvcs3->img; ?>" class="img-responsive m-b-20">
                        <h4><?php echo $srvcs3->namaService; ?></h4>
                        <p><?php echo $srvcs3->deskripsiID; ?></p>
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
                            <div class="counter text-large"> <span data-speed="3000" data-refresh-interval="50" data-to="12416" data-from="600" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>LINES OF CODE</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="4500" data-refresh-interval="23" data-to="365" data-from="100" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>CUPS OF COFFEE</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="3000" data-refresh-interval="12" data-to="114" data-from="50" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>FINISHED PROJECTS</p>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="text-center">
                            <div class="counter text-large"> <span data-speed="4550" data-refresh-interval="50" data-to="14825" data-from="48" data-seperator="true"></span> </div>
                            <div class="seperator seperator-small"></div>
                            <p>SATISFIED CLIENTS</p>
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
                        <h4><i class="fa <?php echo $srvcs->icon; ?>"></i> <?php echo $srvcs->namaService; ?></h4>
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
                            <a href="#"><img alt="" src="<?php base_url().'assets/img/'.$brnds->img;?>"> </a>
                        </li>
                        <?php endforeach ?>
                        
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/2.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/3.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/4.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/5.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/6.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/7.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/8.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/9.png"> </a>
                        </li>
                        <li>
                            <a href="#"><img alt="" src="http://www.inspirothemes.com/polo-v4/images/clients/10.png"> </a>
                        </li>
                    </ul>
                </div>
                <hr class="space">
                <!--Image Carousel -->
            </div>
        </section>
        <!-- end: brands -->

        <!-- Subscribe form -->
        <section class="background-colored text-center p-t-80  p-b-30">
            <div class="container">
                <div class="widget clearfix widget-newsletter">
                    <form id="widget-subscribe-form" action="include/subscribe-form.php" role="form" method="post" class="form-inline">
                        <h3 class="text-light">Subscribe to our Newsletter</h3>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                            <input type="email" aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                            <span class="input-group-btn">
                      <button type="submit" id="widget-subscribe-submit-button" class="btn btn-white">Subscribe</button>
                    </span>
                        </div>
                        <small class="text-light">Stay informed on our latest news!</small>
                    </form>
                    <script type="text/javascript">
                        jQuery("#widget-subscribe-form").validate({
                            submitHandler: function(form) {
                                jQuery(form).ajaxSubmit({
                                    dataType: 'json',
                                    success: function(text) {
                                        if (text.response == 'success') {
                                            $.notify({
                                                message: "You have successfully subscribed to our mailing list."
                                            }, {
                                                type: 'success'
                                            });
                                            $(form)[0].reset();

                                        } else {
                                            $.notify({
                                                message: text.message
                                            }, {
                                                type: 'warning'
                                            });
                                        }
                                    }
                                });
                            }
                        });

                    </script>
                </div>
            </div>
        </section>
        <!-- End: Subscribe form -->

<?php $this->load->view('templates/frontend/footer'); ?>
