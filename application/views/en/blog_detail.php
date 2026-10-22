<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PostS -->
<section>
    <div class="container">
        <div class="row">
            <!-- Post content-->
<div class="post-content post-content-single col-md-9">
                <!-- Post item-->
                <div class="post-item">
                    <div class="text-center">
                         <a href="<?php echo base_url().'assets/img/'.$post->img;?>" data-lightbox-type="image" title="<?php echo html_escape($post->namaPost);?>">
                            <img alt="" src="<?php echo base_url().'assets/img/'.$post->img;?>">
                         </a>
                    </div>
                    <div class="post-content-details">
                        <div class="post-title">
                            <h2><?php echo html_escape(ucwords($post->namaPost));?></h2>
                        </div>
                        <div class="post-description">
                            <?php echo clean_wysiwyg($post->contentEN);?>
                        </div>
                    </div>
                    <div class="post-meta">
                        <div class="post-date">
                            <?php $date = date_create($post->publishDate);?>
                            <span class="post-date-day"><?php echo date_format($date, 'd'); ?></span>
                            <span class="post-date-month"><?php echo date_format($date, 'M'); ?></span>
                            <span class="post-date-year"><?php echo date_format($date, 'Y'); ?></span>
                        </div>

                        <div class="post-comments">
                            <a href="#">
                                <i class="fa fa-comments-o"></i>
                                <span class="post-comments-number">disabled comment</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

<?php $this->load->view('templates/frontend/sidebar-blog'); ?>

    </div>  
    </div>
</section>
<!-- END: SHOP PostS -->


<?php $this->load->view('templates/frontend/footer'); ?>
