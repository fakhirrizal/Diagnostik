<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="<?=base_url('assets/pages/scripts/components-editors.min.js');?>" type="text/javascript"></script> -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/admin_side/master_modul'); ?>'>Modul Ujian</a></span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> 1. Soal dipandang tidak terjawab ketika peserta tidak menjawab soal, meskipun menjawab alasan dan keyakinan.</p>
		<!-- <p> 2. Pastikan <b>Soal</b> dan <b>Peserta</b> telah terisi sebelum data di-<b>lock</b>.</p> -->
		<!-- <p> 2. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
                    <div class='row'>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> Modul </td>
                                        <td> : </td>
                                        <td><?php echo $data_utama->judul; ?></td>
                                    </tr>
                                    <tr>
                                        <td> Jumlah Soal </td>
                                        <td> : </td>
                                        <td><?= $data_utama->jumlah_soal; ?> Soal</td>
                                    </tr>
                                    <tr>
                                        <td> Jumlah Peserta </td>
                                        <td> : </td>
                                        <td><?= $data_utama->jumlah_peserta; ?> Siswa</td>
                                    </tr>
                                    <tr>
                                        <td> Durasi </td>
                                        <td> : </td>
                                        <td><?= number_format($data_utama->durasi,0); ?> Menit</td>
                                    </tr>
                                    <tr>
                                        <td> Waktu Pelaksanaan </td>
                                        <td> : </td>
                                        <td>
                                            <?php
                                            $dari = $this->Main_model->convert_tanggal(substr($data_utama->waktu_pelaksanaan,0,10));
                                            $sampai = $this->Main_model->convert_tanggal(substr($data_utama->waktu_pelaksanaan,18,10));
                                            $isi = $dari.' - '.$sampai;
                                            echo $isi;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url().'admin_side/cetak_hasil_ujian/'.$this->uri->segment(3); ?>" class="btn btn-info" role="button"><i class="fa fa-print"></i> Cetak Hasil Ujian</a></td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="col-md-6">
                            <table class="table">
                            </table>
                        </div> -->
					</div>
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li>
								<a href="#tab_15_2" data-toggle="tab"> Daftar Soal </a>
							</li>
							<li>
								<a href="#tab_15_3" data-toggle="tab"> Daftar Peserta </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="tab_15_2">
								<script type="text/javascript">
									function getPageSoal() {
										$('#daftar_soal_dalam_modul').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
										var modul = 'daftar_soal_dalam_modul';
										var data = '<?= $this->uri->segment(3); ?>';
										jQuery.ajax({
											url: "<?php echo site_url(); ?>admin/Report/ajax_page",
											data: {modul:modul,data:data},
											type: "POST",
											success:function(data){
												$('#daftar_soal_dalam_modul').html(data);
												$("#loading-image").hide();
											}
										});
									}
									getPageSoal();
								</script>
								<img id="loading-image" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
								<div id="daftar_soal_dalam_modul">
								</div>
							</div>
							<div class="tab-pane" id="tab_15_3">
								<script type="text/javascript">
									function getPagePeserta() {
										$('#daftar_peserta_dalam_suatu_ujian').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
										var modul = 'daftar_peserta_dalam_suatu_ujian';
										var data = '<?= $this->uri->segment(3); ?>';
										jQuery.ajax({
											url: "<?php echo site_url(); ?>admin/Report/ajax_page",
											data: {modul:modul,data:data},
											type: "POST",
											success:function(data){
												$('#daftar_peserta_dalam_suatu_ujian').html(data);
												$("#loading-").hide();
											}
										});
									}
									getPagePeserta();
								</script>
								<img id="loading-" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
								<div id="daftar_peserta_dalam_suatu_ujian">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>