<!-- PAGE TITLE -->
<section id="page-title" class="page-title-pattern" style="background-color: #eceaed; padding: 0;">
    <div class="container" style="background: url('<?php echo base_url();?>assets/img/bg-lkpp-ptppm-id.jpg')no-repeat;">
        <div class="page-title col-md-8">
        <div class="breadcrumb" style="text-align:left; margin-top:150px; margin-bottom: 10px;">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i></a>
                </li>
                <?php
if ($this->uri->segment(3)==null) {
echo "<li><a href='#'>".strtoupper($this->uri->segment(2))."</a></li>";
} else if ($this->uri->segment(4)==null){
echo "<li><a href='#'>".strtoupper($this->uri->segment(2))."</a></li><li class='active'><a href='#'>".strtoupper(page_title($this->uri->segment(3)))."</a></li>";
} else if ($this->uri->segment(5)==null){
echo "<li><a href='#'>".strtoupper($this->uri->segment(2))."</a></li><li><a href='#'>".strtoupper($this->uri->segment(3))."</a></li><li class='active'><a href='#'>".strtoupper(page_title($this->uri->segment(4)))."</a></li>";
}
?>
            </ul>
        </div>
        </div>
        
    </div>
</section>
<!-- END: PAGE TITLE -->
