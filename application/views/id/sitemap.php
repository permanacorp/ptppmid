<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<?php $this->load->view('templates/frontend/page-title'); ?>

<!-- FULL WIDTH PAGE -->
<section>
    <div class="container">
    	<div class="row">
			<div class="col-md-12">
			<h2>SITEMAP</h2>
			<ul>
				<li><a href="<?php echo base_url().$lang;?>/">Beranda</a></li>
				<li>Tentang Kami
					<ul>
						<li><a href="<?php echo base_url().$lang.'/about-us/';?>">Info Perusahaan</a></li>
						<li><a href="<?php echo base_url().$lang.'/events/';?>">Event</a></li>
					</ul>
				</li>
				<li><a href="<?php echo base_url().$lang.'/services/';?>">Pelayanan Jasa</a></li>
				<li><a href="<?php echo base_url().$lang.'/products/';?>">Produk</a>
					<ul>
						<?php
						foreach ($categories as $p) {
						echo"<li>".ucwords($p->namaCategory);
						$child = $this->db->order_by('namaProduct','asc')->get_where('products', array('status'=>1,'idCategory' => $p->idCategory));
						if ($child->num_rows() > 0) {
						echo"<ul>";
						foreach ($child->result() as $c) {
						echo "<li>".anchor(base_url().$lang.'/product/'.$c->slug, strtoupper($c->namaProduct))."</li>";
						}
						echo "</ul></li>";
						} 
						}
						?>
					</ul>
				</li>
				<li>Brands
					<ul>
						<?php
						foreach ($brands as $p) {
						echo"<li>".anchor(base_url().$lang.'/brand/'.$p->slug,strtoupper($p->namaBrand))."</li>";
						}
						?>
					</ul>
				</li>
				<li><a href="<?php echo base_url().$lang.'/blog/';?>/">Artikel</a></li>
				<li><a href="<?php echo base_url().$lang.'/contact/';?>/">Kontak</a></li>
			</ul>
			</div>
    	</div>
        
    </div>
</section>
<!-- END: FULL WIDTH PAGE -->



<?php $this->load->view('templates/frontend/footer'); ?>
