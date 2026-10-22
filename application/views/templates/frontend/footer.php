        <!-- Footer -->
        <footer id="footer" class="footer-light">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Footer widget area 1 -->
                            <div class="widget" id="text-2">
                                <h4><?php echo $web_config->namaWeb;?></h4>
                                <div><?php if($this->uri->segment(1)==='en'){ echo $web_config->address; }else{ echo $web_config->alamat; }?>
                                    <br>
                                    <br> Telephone:
                                    <br>(021) 8415976
                                    <br>(021) 87793819
                                    <br>(021) 29835218
                                    <br> Fax: <?php echo $web_config->fax;?>
                                    <br> Email: <?php echo $web_config->email;?>
                                  </div>
                            </div>
                            <!-- End: Footer widget area 1 -->
                        </div>
                        <div class="col-md-3">
                            <!-- Footer widget area 2 -->
                            <div class="widget">
                                <h4>Links</h4>
                                <ul>
                                    <li><a href="<?php echo base_url().$lang.'/about-us/'; ?>">About</a></li>
                                    <li><a href="<?php echo base_url().$lang.'/services/'; ?>">Services</a></li>
                                    <li><a href="<?php echo base_url().$lang.'/products/'; ?>">Products</a></li>
                                    <li><a href="<?php echo base_url().$lang.'/events/'; ?>">Events</a></li>
                                    <li><a href="<?php echo base_url().$lang.'/blog/'; ?>">Blog</a></li>
                                    <li><a href="<?php echo base_url().$lang.'/sitemap/'; ?>">Sitemap</a></li>
                                </ul>
                            </div>
                            <!-- End: Footer widget area 2 -->
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="copyright-text">&copy; 2017 PTPPM.ID - PERMANA PUTRA MANDIRI
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- Go to top button -->
                            <a href="#header" class="to-top"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End: Footer -->
    </div>
    <!-- End: Wrapper -->

    <!-- Theme Base, Components and Settings -->
    <script src="<?php echo base_url();?>assets/template/frontend/js/theme-functions.js"></script>

    <!-- Custom js file -->
    <script src="<?php echo base_url();?>assets/template/frontend/js/custom.js"></script>

</body>

</html>
