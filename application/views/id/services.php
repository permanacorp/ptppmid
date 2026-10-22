<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<section>
	<div class="container">
		<div class="heading heading-center">
			<h2>Apa yang kami berikan?</h2>
			<p>Kami selaku perusahaan distributor alat kesehatan, memprioritaskan kepuasan pelanggan dengan memberikan pelayanan terbaik.</p>
		</div>

		<div class="row">
            <?php foreach ($services as $srvcs): ?>
			<div class="col-md-4">
				<div class="icon-box effect medium border center">
					<div class="icon">
						<a href="#"><i class="fa <?php echo $srvcs->icon;?>"></i></a>
					</div>
					<h3><?php echo html_escape($srvcs->namaService);?></h3>
					<p><?php echo html_escape($srvcs->deskripsiID);?></p>
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
                    <h3>Pelanggan Kami</h3> Pelanggan kami terdiri dari 80% Rumah Sakit Swasta dan Rumah Sakit Pemerintah sedangkan 20$ merupakan perorangan.
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
		<h3>Lihat juga produk-produk terbaik kami!</h3>
		<p>Dengan services yang kami berikan, kami juga menjual produk-produk terbaik dari berbagai negara dan lokal.</p>
		<a class="button transparent icon-right" href="<?php echo base_url().$lang.'/products/';?>"><span>Lihat Produk</span></a>
	</div>
</div>

        <section>
            <div class="container">
            	<div class="heading heading-center">
            			<h2>BRANDS</h2>
            			<p>Brand-brand resmi PT. Permana Putra Mandiri dengan aftersales terbaik!</p>
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
