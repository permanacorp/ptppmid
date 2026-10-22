<!-- Sidebar-->
            <div class="sidebar sidebar-modern col-md-3">

                <!--widget archive-->
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title"><?php if($this->uri->segment(1)==='en') { echo "Archive Blog";} else { echo "Arsip Blog"; } ?></h4>
                        <ul class="list list-lines">
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2017';?>">2017</li>
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2016';?>">2016</li>
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2015';?>">2015</li>
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2014';?>">2014</li>
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2013';?>">2013</li>
                            <li><a href="<?php echo base_url().$lang.'/blog/archive/2012';?>">2012</li>
                        </ul>
                </div>
                <!--end: widget archive-->

                <!--widget blog articles-->
                <div class="widget clearfix widget-blog-articles">
                    <h4 class="widget-title"><?php if($this->uri->segment(1)==='en') { echo "From Our Blog";} else { echo "Artikel Terakhir"; } ?></h4>
                    <ul class="list-posts list-medium">
                        <?php 
                            foreach ($blogs as $blog):
                                $date= date_create($blog->publishDate);
                        ?>
                        </li>
                        <li><a href="#"><?php echo ucwords($blog->namaPost);?></a><small><?php echo date_format($date, 'd M Y'); ?></small>
                        </li> 
                        <?php                            
                            endforeach;
                        ?>
                    </ul>
                </div>
                <!--end: widget blog articles-->

                <!--widget categories-->
                <div class="widget clearfix widget-categories">
                    <h4 class="widget-title">Services</h4>
                    <ul class="list list-arrow-icons">
                        <?php 
                            foreach ($services as $srvcs):
                        ?>
                        <li> <a title="<?php echo ucwords($srvcs->namaService);?>" href="#"><?php echo ucwords($srvcs->namaService);?> </a> </li>                
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                <!--end: widget categories-->

            </div>
            <!-- END: Sidebar-->
