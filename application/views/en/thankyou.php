<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>

<section class="m-t-80 p-b-150">
	<div class="container">
		<div class="row">
			<div class="col-md-1211">
				<div class="text-center">
					<h1 class="text-medium"><?php echo $title;?></h1>
					<p class="lead"><?php echo $text;?></p><div class="seperator m-t-20 m-b-20"></div><a href="<?php echo base_url().$lang.'/';?>" class="btn btn-primary" type="button"><?php echo $button;?></a> 

				</div>
			</div>
		</div>
	</div>
</section>
<script>
setTimeout("window.location.assign('<?=base_url('en/')?>');",5000);
</script>
<?php $this->load->view('templates/frontend/footer'); ?>
