<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<section class="p-b-10">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="heading heading text-left">
					<h2>Tentang Perusahaan</h2>
					<span class="lead"><?php echo clean_wysiwyg($about_us->contentID);?></span>
				</div>
			</div>
			<div class="col-md-3 text-center"> <span class="pie-chart" data-percent="<?php echo $about_us->percent;?>" data-width="20"> <span class="percent" style="width: 160px; height: 160px; line-height: 160px;">75</span> <canvas height="160" width="160"></canvas></span>
		        <h4>Pelanggan</h4>
		        <p>Terdiri dari Rumah Sakit Swasta dan Rumah Sakit Pemerintah, dan 20% nya perorangan.</p>
		    </div>
		</div>
	</div>
</section>

<section class="background-grey">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<blockquote class="blockquote-color text-light">
					<small><cite>VISION</cite></small>
					<br />
					<p><?php echo html_escape($about_us->visionID);?></p>
				</blockquote>
			</div>
			<div class="col-md-6">
				<blockquote class="blockquote-dark text-light">
					<small><cite>MISSION</cite></small>
					<br />
					<p><?php echo html_escape($about_us->missionID);?></p>
				</blockquote>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="heading heading-center">
			<h2>APA YANG KAMI BERIKAN?</h2>
			<span class="lead">Kami selaku perusahaan distributor alat kesehatan, memprioritaskan kepuasan pelanggan dengan memberikan pelayanan terbaik.</span>
		</div>
		<div class="row">
			<?php foreach ($services as $srvcs):?>
                    <div class="col-md-4">
						<div class="text-box">
							<h4><?php echo html_escape($srvcs->namaService); ?></h4>
							<p><?php echo html_escape($srvcs->deskripsiID); ?></p>
						</div>
					</div>
                    <?php endforeach;?>
		</div>
	</div>
</section>

<div class="seperator"><i class="fa fa-chevron-down"></i></div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="lead">Pelanggan Kami</p>
			</div>
		</div>
		<ul class="grid grid-5-columns">
			<?php foreach ($clients as $clnts):?>
			<li>
				<a href="#"><img src="<?php echo base_url().'assets/img/'.$clnts->img; ?>" alt="<?php echo $clnts->namaClient; ?>"></a>
			</li>
            <?php endforeach;?>
		</ul>
	</div>
</section>

<?php $this->load->view('templates/frontend/footer'); ?>
