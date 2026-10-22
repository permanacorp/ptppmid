<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

 <!-- SHOP PostS -->
<section>
    <div class="container">
        <div class="row">
            <!-- Post content-->
            <div class="post-content post-thumbnail float-left col-xs-12">
    <!-- Colored Timeline -->
    <div class="hr-title hr-long center"><abbr>Events</abbr> </div>
    <div class="timeline timeline-colored">
                    <ul class="timeline-circles">
                        <li class="timeline-date">Latest Events</li>
                        <?php 
                        foreach ($events as $vnts): 
                        ?>
                        <li>
                            <div class="timeline-block">
                                <!-- Blog image post-->
                                <div class="post-item">
                                    <div class="post-image">
                                        <a href="<?php echo base_url().'assets/img/'.$vnts->img;?>" data-lightbox-type="image" title="<?php echo html_escape($vnts->namaEvent);?>">
                                            <img alt="" src="<?php echo base_url().'assets/img/'.$vnts->img;?>">
                                        </a>
                                    </div>
                                    <div class="post-content-details">
                                        <div class="post-title">
                                            <h3><a href="<?php echo base_url().$lang.'/blog/'.$vnts->eventTargetURL;?>" target="_blank"><?php echo html_escape(strtoupper($vnts->namaEvent));?></a></h3>
                                        </div>
                                        <div class="post-description">
                                            <p><?php echo clean_wysiwyg($vnts->contentEN);?></p>

                                            <div class="post-info">
                                                <a class="read-more" href="<?php echo base_url().$lang.'/blog/'.$vnts->eventTargetURL;?>" target="_blank">baca selengkapnya <i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post-meta">
                                        <div class="post-date">
                                            <div class="post-date">
                                                <?php $date = date_create($vnts->startDate);?>
                                                <span class="post-date-day"><?php echo date_format($date, 'd'); ?></span>
                                                <span class="post-date-month"><?php echo date_format($date, 'M'); ?></span>
                                                <span class="post-date-year"><?php echo date_format($date, 'Y'); ?></span> 
                                                <?php $date2 = date_create($vnts->endDate); 
                                                if ($vnts->endDate!='0000-00-00'){ ?>
                                                -
                                                <span class="post-date-day"><?php echo date_format($date2, 'd'); ?></span>
                                                <span class="post-date-month"><?php echo date_format($date2, 'M'); ?></span>
                                                <span class="post-date-year"><?php echo date_format($date2, 'Y'); ?></span>
                                                <?php } ?>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
    <!-- END: Colored Timeline -->
   

<?php
// end looping post
// }
echo $links;
?>
    </div>  
    </div>
</section>
<!-- END: SHOP PostS -->


<?php $this->load->view('templates/frontend/footer'); ?>
