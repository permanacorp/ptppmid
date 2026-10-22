<body class="wide">

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- Topbar -->
        <div id="topbar" class="hidden-xs hidden-sm">



            <div class="container">
                <div class="topbar-dropdown hidden-xs">
                    <div class="title">
                        <?php if($this->uri->segment(1)==='en') { echo "Contact US : ";} else { echo "Hubungi Kami : "; } ?><i
                            class="fa fa-envelope"></i><?php echo $web_config->email;?><i class="fa fa-phone"></i>
                        <?php echo $web_config->telp;?></div>
                </div>
                <div class="topbar-dropdown hidden-xs float-right">
                    <div class="title"><i class="fa fa-globe"></i> <a
                            href="<?php echo base_url().'id/';?>">Indonesia</a> | <a
                            href="<?php echo base_url().'en/';?>">English</a></div>
                </div>

            </div>

        </div>
        <!-- END: Topbar -->

        <!-- Header -->
        <header id="header" class="">
            <div id="header-wrap">
                <div class="container">

                    <!--LOGO-->
                    <div id="logo">
                        <a href="<?php echo base_url().$lang.'/';?>" class="logo">
                            <img src="<?php echo base_url().'assets/img/'.$web_config->img;?>"
                                alt="<?php echo $web_config->namaWeb;?>">
                        </a>
                    </div>
                    <!--END: LOGO-->

                    <!--MOBILE MENU -->
                    <div class="nav-main-menu-responsive">
                        <!--  <button class="lines-button x">
<span class="lines"></span>
</button>-->
                        <button type="button" class="lines-button x">
                            <span class="lines"></span>
                        </button>

                    </div>
                    <!--END: MOBILE MENU -->


                    <!--NAVIGATION MENU-->
                    <div class="navigation-wrap">
                        <nav id="mainMenu" class="style-1 main-menu mega-menu">
                            <ul class="main-menu nav nav-pills">
                                <li<?php if($this->uri->segment(2)===null): echo' class="active"'; endif ?>><a
                                        href="<?php echo base_url().$lang.'/';?>"><?php if($this->uri->segment(1)==='en') { echo "HOME";} else { echo "BERANDA"; } ?></a>
                                    </li>
                                    <li
                                        class="dropdown<?php if($this->uri->segment(2)==='about-us' | $this->uri->segment(2)==='events' | $this->uri->segment(2)==='services'): echo' active"'; endif ?>">
                                        <a href="<?php echo base_url().$lang.'/about-us/';?>"><?php if($this->uri->segment(1)==='en') { echo "ABOUT US";} else { echo "TENTANG KAMI"; } ?>
                                            <i class="fa fa-angle-down"></i> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url().$lang.'/about-us/';?>"><?php if($this->uri->segment(1)==='en') { echo "About Company";} else { echo "Info Perusahaan"; } ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().$lang.'/events/';?>"><?php if($this->uri->segment(1)==='en') { echo "Events";} else { echo "Info Acara"; } ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().$lang.'/services/';?>"><?php if($this->uri->segment(1)==='en') { echo "Services";} else { echo "Pelayanan Jasa"; } ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="dropdown mega-menu-item <?php if($this->uri->segment(2)==='product' | $this->uri->segment(2)==='products' ): echo'active'; endif ?>">
                                        <a href="#"><?php if($this->uri->segment(1)==='en') { echo "PRODUCTS";} else { echo "PRODUK"; } ?><i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="mega-menu-content" style="background-image: url('<?php echo base_url();?>assets/img/bgmenu.png');">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <ul>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/anesthesia-machine/';?>">Anesthesia Machine</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/blood-bank/';?>">Blood Bank</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/blood-plasma/';?>">Blood Plasma</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/bubble-cpap/';?>">Bubble CPAP</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/couter/';?>">Couter</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/ctg/';?>">CTG</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/defibrilator/';?>">Defibrilator</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/deep-freezer/';?>">Deep Freezer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/ecg/';?>">ECG</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/eeg/';?>">EEG</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <ul>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/emg/';?>">EMG</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/h2o2-plasma-sterilizer/';?>">H202 Plasma Sterilizer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/hepa-filter/';?>">Hepa Filter</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/hot-air-sterilizer/';?>">Hot Air Sterilizer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/infant-incubator/';?>">Infant Incubator</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/infant-warmer/';?>">Infant Warmer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/infusion-pump/';?>">Infusion Pump</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/medical-beds/';?>">Medical Beds</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/medical-waste-shredder/';?>">Medical Waste Shredder</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/operating-lamp/';?>">Operating Lamp</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <ul>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/operating-table/';?>">Operating Table</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/oxygen-concentrator/';?>">Oxygen Concentrator</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/patient-monitor/';?>">Patient Monitor</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/pharmaceutical-refrigerator/';?>">Pharmaceutical Refrigerator</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/protective-coverall/';?>">Protective Coverall (APD)</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/pulse-oximeter/';?>">Pulse Oximeter</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/spirometer/';?>">Spirometer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/steam-sterilizer/';?>">Steam Sterilizer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/suction-pump/';?>">Suction Pump</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/surgical-masks';?>">Surgical Masks</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <ul>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/syringe-pump/';?>">Syringe Pump</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/tensimeter/';?>">Tensimeter</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/thermometer/';?>">Thermometer</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/treadmill/';?>">Treadmill</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/usg/';?>">USG</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/ventilator/';?>">Ventilator</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/ventilator-compressor/';?>">Ventilator Compressor</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/wheel-chair/';?>">Wheel Chair</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/x-ray/';?>">X Ray</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url().$lang.'/product/category/x-ray-protection/';?>">X Ray Protection (APRON)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <a href="<?php echo base_url().$lang.'/products/';?>"
                                                    class="read-more hidden-xs hidden-sm"><i
                                                        class="fa fa-search"></i><?php if($this->uri->segment(1)==='en') { echo "See All Products!";} else { echo "Lihat Semua Produk!"; } ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li<?php if($this->uri->segment(2)==='ecatalogue-lkpp'): echo' class="active"'; endif ?>>
                                        <a
                                            href="<?php echo base_url().$lang.'/ecatalogue-lkpp/';?>"><?php if($this->uri->segment(1)==='en') { echo "ECATALOGUE LKPP";} else { echo "ECATALOGUE LKPP"; } ?></a>
                                        </li>
                                        <li class="dropdown"> <a href="#">Brands <i class="fa fa-angle-down"></i> </a>
                                            <ul class="dropdown-menu">
                                                <?php
                                                foreach ($bran_menu as $b) {
                                                    echo "<li><a href='".base_url().$lang."/brand/".$b->slug."'>".strtoupper($b->namaBrand)."</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <li<?php if($this->uri->segment(2)==='blog'): echo' class="active"'; endif ?>><a
                                                href="<?php echo base_url().$lang.'/blog/';?>"><?php if($this->uri->segment(1)==='en') { echo "ARTICLES";} else { echo "ARTIKEL"; } ?></a>
                                            </li>
                                            <li<?php if($this->uri->segment(2)==='contact-us'): echo' class="active"'; endif ?>>
                                                <a href="<?php echo base_url().$lang.'/contact-us/';?>"><?php if($this->uri->segment(1)==='en') { echo "CONTACT US";} else { echo "KONTAK"; } ?></a>
                                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!--END: NAVIGATION-->

                </div>
            </div>
        </header>
        <!-- END: Header -->