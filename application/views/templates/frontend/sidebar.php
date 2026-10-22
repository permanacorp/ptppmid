<!-- Sidebar-->
            <div class="sidebar col-md-3">
                <div class="widget clearfix widget-tags">
                    <h4 class="widget-title">BRANDS</h4>
                    <div class="tags">
                        <?php 
                        foreach ($brands as $brnds): ?>
                        <a href="<?php echo base_url().$lang.'/brand/'.$brnds->slug;?>"><?php echo strtoupper($brnds->namaBrand); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title"><?php if($this->uri->segment(1)==='en'){ echo 'PRODUCT CATEGORIES'; }else{ echo 'KATEGORI PRODUK'; }?></h4>
                    <ul class="list list-lines">
                        <?php 
                        foreach ($categories as $ctgry): ?>
                        <li><a href="<?php echo base_url().$lang.'/product/category/'.$ctgry->slug; ?>"><?php echo strtoupper($ctgry->namaCategory); ?></a></li>
                        <?php endforeach ;?>
                    </ul>
                </div>


            </div>
            <!-- END: Sidebar-->