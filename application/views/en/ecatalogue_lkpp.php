<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<!-- SHOP PRODUCTS -->
<!-- SECTION -->
<section>
    <div class="container">
        <div class="row">
            <h1>Ecatalogue LKPP</h1>
            <p>Ecatalogue is a government program to overcome corruption in Indonesia, because ecatalogue is carried out transparently and protected by cooperation agreements (SPK). With the presence of PPM in ecatalogue also to support the procurement of state / government or private hospitals that have ecatalogue accounts, the process is very easy where all the prices of the tools are listed along with the shipping costs to all regions of Indonesia and stay adjusted to the budget.</p>
            <h3>Ecatalogue Product List:</h3>
            <?php foreach ($ecatalogue_lkpp as $list_catalogue) { ?>
                <div class="col-md-6 col-xs-12">
                    <a href="<?=$list_catalogue->urlPembelian; ?>" target="_blank"><li><?=strtoupper(get_databranbyID($list_catalogue->idBrand)).' '.strtoupper(get_datacatbyID($list_catalogue->idCategory)).' '.strtoupper($list_catalogue->namaProduct); ?></li></a>
                </div>
            <?php } ?>
        </div>
        <!--Portfolio Filter-->
        <!-- <div class="filter-active-title">Lihat Semua</div> -->
        <ul class="portfolio-filter" id="portfolio-filter" data-isotope-nav="isotope">
            <li class="ptf-active" data-filter="*">Lihat Semua</li>
            <li data-filter=".anesthesia-machine">Anesthesia Machine</li>
            <li data-filter=".bubble-cpap">Bubble CPAP</li>
            <li data-filter=".couter">Couter</li>
            <li data-filter=".ctg">CTG</li>
            <li data-filter=".deep-freezer">Deep Freezer</li>
            <li data-filter=".steam-sterilizer">Steam Sterilizer</li>
            <li data-filter=".hot-air-sterilizer">Hot Air Sterilizer</li>
            <li data-filter=".defibrilator">Defibrilator</li>
            <li data-filter=".ecg">ECG</li>
            <li data-filter=".infusion-pump">Infusion Pump</li>
            <li data-filter=".operating-lamp">Operating Lamp</li>
            <li data-filter=".operating-table">Operating Table</li>
            <li data-filter=".oxygen-concentrator">Oxygen Concentrator</li>
            <li data-filter=".patient-monitor">Patient Monitor</li>
            <li data-filter=".pulse-oximeter">Pulse Oximeter</li>
            <li data-filter=".syringe-pump">Syringe Pump</li>
            <li data-filter=".usg">USG</li>
            <li data-filter=".ventilator">Ventilator</li>
            <li data-filter=".wheel-chair">Wheel Chair</li>
        </ul>
        <!-- END: Portfolio Filter -->

        <!-- Portfolio Items -->
        <div id="isotope" class="isotope portfolio-items" data-isotope-item-space="2" data-isotope-mode="masonry" data-isotope-col="3" data-isotope-item=".portfolio-item">
            <?php
            foreach ($ecatalogue_lkpp as $prdcts)
            {
                ?>
                <div class="portfolio-item <?php echo get_dataslugcatbyID($prdcts->idCategory);?>">
                    <div class="portfolio-image effect social-links">
                        <img src="<?php echo base_url().'assets/img/'.$prdcts->img;?>" alt="">
                        <div class="image-box-content">
                            <p>
                                <a href="<?php echo base_url().'assets/img/'.$prdcts->img;?>" data-lightbox-type="image" title="<?php echo html_escape(strtoupper(get_datacatbyID($prdcts->idCategory)).' '.strtoupper($prdcts->namaProduct));?>"><i class="fa fa-expand"></i></a>
                                <a href="<?php echo base_url().$lang.'/product/'.$prdcts->slug;?>"><i class="fa fa-link"></i></a>
                                <a href="<?php echo html_escape($prdcts->urlPembelian);?>" rel="noopener noreferrer" target="_blank"><i class="fa fa-shopping-cart"></i></a>
                            </p>
                        </div>
                    </div>
                    <div class="portfolio-description" style="width:100%">
                        <h4 class="title"><a href="<?php echo base_url().$lang.'/product/'.$prdcts->slug;?>"><?php echo html_escape(strtoupper(get_datacatbyID($prdcts->idCategory)).' '.strtoupper($prdcts->namaProduct));?></a></h4>
                        <p><i class="fa fa-tag"></i><?php echo html_escape(strtoupper(get_databranbyID($prdcts->idBrand)));?></p>
                        <p><?php echo html_escape($prdcts->deskripsiEN);?></p>
                    </div>
                </div>
            <?php } ?>


        </div>
        <!-- END: Portfolio Items -->
    </div>
    <!-- END: SHOP PRODUCTS -->
</section>

<?php $this->load->view('templates/frontend/footer'); ?>
