<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<!-- FULL WIDTH PAGE -->
<section>
    <div class="container">
        <h2><?php echo html_escape($page->namaPage);?></h2>
        <?php echo clean_wysiwyg($page->contentEN);?>
    </div>
</section>
<!-- END: FULL WIDTH PAGE -->



<?php $this->load->view('templates/frontend/footer'); ?>
