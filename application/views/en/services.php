<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<section>
    <div class="container">
        <div class="heading heading-center">
            <h2>What we do?</h2>
            <p>We as a medical equipment distributor company, prioritize customer satisfaction by providing the best service.</p>
        </div>

        <div class="row">
            <?php foreach ($services as $srvcs): ?>
            <div class="col-md-4">
                <div class="icon-box effect medium border center">
                    <div class="icon">
                        <a href="#"><i class="fa <?php echo $srvcs->icon;?>"></i></a>
                    </div>
                    <h3><?php echo html_escape($srvcs->namaService);?></h3>
                    <p><?php echo html_escape($srvcs->deskripsiEN);?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>



<section class="background-grey">
    <div class="container">
        <div class="row clients-carousel carousel-description-clients carousel-description-style ">
            <div class="col-md-4">
                <div class="description">
                    <h2>Our Clients</h2> Our customers consist of 80% Private Hospital and Government Hospital while 20 $ is an individual.
                </div>
            </div>
            <div class="col-md-8">
                <div class="carousel" data-carousel-col="4">
                    <?php foreach ($clients as $clnts):?>
                    <div>
                        <a href="#"><img src="<?php echo base_url().'assets/img/'.$clnts->img; ?>" alt="<?php echo $clnts->namaClient; ?>"></a>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>

        </div>

    </div>
</section>


<div class="jumbotron jumbotron-fullwidth background-colored text-light m-b-0">
    <div class="container">
        <h3>See also our best products!</h3>
        <p>With the services we provide, we also sell the best products from various countries and locally.</p>
        <a class="button transparent icon-right" href="<?php echo base_url().$lang.'/products/';?>"><span>See Products!</span></a>
    </div>
</div>

        <section>
            <div class="container">
                <div class="heading heading-center">
                        <h2>BRANDS</h2>
                        <p>Official brands of PT. Permana Putra Mandiri with the best aftersales!</p>
                </div>
                    <ul class="grid grid-5-columns">
                        <?php foreach ($brands as $brnds): ?>
                        <li>
                            <a href="#"><img alt="" src="<?php echo base_url().'assets/img/'.$brnds->img;?>"> </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
            </div>
        </section>


<?php $this->load->view('templates/frontend/footer'); ?>
