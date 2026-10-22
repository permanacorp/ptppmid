<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PostS -->
<section>
    <div class="container">
        <div class="row">
            <!-- Post content-->
            <div class="post-content post-thumbnail float-left col-md-9">
<?php
    foreach ($posts as $blg)
    {
    $this->load->helper('text');
    $content_limit = strip_tags($blg->contentEN);
    $content_limit = character_limiter($content_limit, 200);
    
?>
        <div class="post-item">
                <div class="post-image">
                    <a href="#">
                        <img alt="<?php echo html_escape($blg->namaPost);?>" src="<?php echo base_url().'assets/img/'.$blg->imgResizex340;?>">
                    </a>
                </div>
                <div class="post-content-details">
                    <div class="post-title">
                        <h3><a href="<?php echo base_url().'en/blog/'.$blg->slug;?>"><?php echo html_escape(ucwords($blg->namaPost));?></a></h3>
                    </div>
                    <div class="post-description">
                        <p><?php echo html_escape($content_limit);?></p>

                        <div class="post-read-more">
                            <a class="read-more" href="<?php echo base_url().'en/blog/'.$blg->slug;?>">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="post-meta">
                    <div class="post-date">
                        <?php $date = date_create($blg->publishDate);?>
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
