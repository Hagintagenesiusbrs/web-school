<div class="main-page left">
	<div class="double-block">
		<div class="content-block main right utama">					
			<div class="block">
				<div class="featured-block">
					<?php
						$cekslide = $this->model_utama->view_single('berita',array('headline' => 'Y','status' => 'Y'),'id_berita','DESC');
						if ($cekslide->num_rows() > 0){
						  include "slide.php";
						}
					?>	
				</div>
			</div>
			<hr>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
				<img src="asset/logo/80645922Guru.jpg" class="d-block w-100" alt="...">
				</div>
				<div class="carousel-item">
				<img src="asset/logo/56794533GedungDalam3.jpg" class="d-block w-100" alt="...">
				</div>
				<div class="carousel-item">
				<img src="..." class="d-block w-100" alt="...">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</button>
			</div>
			<div class="block">
				<div class="block-title">
					<a href="<?php echo base_url(); ?>pengumuman" class="right">Lihat Semua Pengumuman</a>
					<h2>Pengumuman</h2>
				</div>
				<div class="block-content">
				<?php
					$no = 1; 
					$pengumuman = $this->model_app->view_ordering_limit('pengumuman','id_pengumuman','DESC',0,5);
					foreach ($pengumuman->result_array() as $row) {
						if ($row['file_download']==''){ $file = 'Tidak Ada File yang Di sertakan/lampirkan'; $color = 'red'; $ket = ''; }else{ $file = $row['file_download']; $color = 'blue'; $ket = 'Download Lampiran file :'; }
						echo "<div style='margin-top:-10px' class='article'>
							<p>$no. $row[judul] <br>
								<span style='margin-left:15px; color:#dd8229'> $ket
									<a style='color:$color; font-style:italic' href='".base_url()."download/file/$file'>$file</a>
								</span>
							</p>
						</div>";
						$no++;
					}
				?>
				

				</div>

			</div>

			<div class="block">
				<div class="block-title">
					<h2>Artikel Terbaru</h2>
				</div>
				<div class="block-content">
					<?php 
						$terbaru = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.status' => 'Y'),'id_berita','DESC',0,5);
						foreach ($terbaru->result_array() as $r1) {
							$tglr = tgl_indo($r1['tanggal']);
							$isi_berita = strip_tags($r1['isi_berita']); 
							$isi = substr($isi_berita,0,130); 
							$isi = substr($isi_berita,0,strrpos($isi," "));
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r1['id_berita']))->num_rows();
							echo "<div class='wide-article'>
								<div class='article-photo'>";
									if ($r1['gambar'] ==''){
										echo "<a class='hover-effect' href='".base_url()."berita/detail/$r1[judul_seo]'><img class='img-content' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
									}else{
										echo "<a class='hover-effect' href='".base_url()."berita/detail/$r1[judul_seo]'><img class='img-content' src='".base_url()."asset/foto_berita/$r1[gambar]' alt='' /></a>";
									}
							echo "</div>
							
								<div class='article-content'>
									<h2 style='font-size:16px'><a href='".base_url()."berita/detail/$r1[judul_seo]'>$r1[judul]</a></h2>
									<span class='meta'>
										<a href='".base_url()."berita/detail/$r1[judul_seo]'><span class='icon-text'>&#128340;</span>$r1[jam], $tglr - Oleh : $r1[nama_lengkap]</a>
									</span>
									<p>$isi . . . <a href='".base_url()."berita/detail/$r1[judul_seo]' class='h-comment'>$total_komentar</a></p>
								</div>
							</div>";
						}
					?>
					<a href="<?php echo base_url(); ?>berita/index" class="more">Tampilkan lebih banyak</a>
				</div>
				<?php
					$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',2,1)->row_array();
					echo "<a href='$ia[url]' target='_blank'>";
						$string = $ia['gambar'];
						if ($ia['gambar'] != ''){
							if(preg_match("/swf\z/i", $string)) {
								echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
							} else {
								echo "<img style='margin-top:-10px; margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' title='$ia[judul]' />";
							}
						}
					echo "</a>";
				?>

			</div>

		</div>	
		<div class="content-block left">
			<?php include "sidebar_kiri.php"; ?>
		</div>			
	</div>
</div>

<div class="main-sidebar right mobile">
	<?php include "sidebar_kanan.php"; ?>
</div>

<div class="main-sidebar right desktop" style='width:230px'>
	<?php include "sidebar_kanan.php"; ?>
</div>
