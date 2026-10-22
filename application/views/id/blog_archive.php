<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PostS -->
<section>
    <div class="container">
        <div class="row">
            <!-- Post content-->
            <div class="post-content post-thumbnail float-left col-md-9">
                <div class="hr-title hr-long center">
                    <abbr>Archive Blog <?php echo $this->uri->segment(4);?></abbr>
                </div>
<?php
    foreach ($blogArchive as $blg_rchv)
    {
    $this->load->helper('text');
    $content_limit = strip_tags($blg_rchv->contentID);
    $content_limit = character_limiter($content_limit, 200);
    
?>
        <div class="post-item">
                <div class="post-image">
                    <a href="#">
                        <img alt="<?php echo html_escape($blg_rchv->namaPost);?>" src="<?php echo base_url().'assets/img/'.$blg_rchv->imgResizex340;?>">
                    </a>
                </div>
                <div class="post-content-details">
                    <div class="post-title">
                        <h3><a href="<?php echo base_url().'id/blog/'.$blg_rchv->slug;?>"><?php echo html_escape(ucwords($blg_rchv->namaPost));?></a></h3>
                    </div>
                    <div class="post-description">
                        <p><?php echo html_escape($content_limit);?></p>

                        <div class="post-read-more">
                            <a class="read-more" href="<?php echo base_url().'id/blog/'.$blg_rchv->slug;?>">Baca selengkapnya <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="post-meta">
                    <div class="post-date">
                        <?php $date = date_create($blg_rchv->publishDate);?>
                        <span class="post-date-day"><?php echo date_format($date, 'd'); ?></span>
                        <span class="post-date-month"><?php echo date_format($date, 'M'); ?></span>
                        <span class="post-date-year"><?php echo date_format($date, 'Y'); ?></span>
                    </div>
                </div>
        </div>
<?php
// end looping post
}
echo $links;
?>
    </div>  
<?php $this->load->view('templates/frontend/sidebar-blog'); ?>
    </div>
</section>
<!-- END: SHOP PostS -->


<?php $this->load->view('templates/frontend/footer'); ?>
