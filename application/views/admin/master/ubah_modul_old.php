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
		<p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
		<p> 2. Pastikan <b>Soal</b> dan <b>Peserta</b> telah terisi sebelum data di-<b>lock</b>.</p>
		<p> 3. Ketika data belum di-<b>lock</b>, peserta yang terdaftar belum bisa melakukan ujian.</p>
		<!-- <p> 2. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#tab_15_1" data-toggle="tab"> Master Modul </a>
							</li>
							<li>
								<a href="#tab_15_2" data-toggle="tab"> Daftar Soal </a>
							</li>
							<li>
								<a href="#tab_15_3" data-toggle="tab"> Daftar Peserta </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_15_1">
								<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_modul_ujian');?>" method="post" enctype='multipart/form-data'>
									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
									<input type="hidden" name="id" value="<?= md5($data_utama->id_modul); ?>">
									<div class="form-body">
										<div class="form-group form-md-line-input has-danger">
											<label class="col-md-2 control-label" for="form_control_1">Judul <span class="required"> * </span></label>
											<div class="col-md-10">
												<div class="input-icon">
													<input type="text" class="form-control" name="1" placeholder="Type something" value='<?= $data_utama->judul; ?>' required>
													<div class="form-control-focus"> </div>
													<!-- <span class="help-block">Some help goes here...</span> -->
													<i class="icon-pin"></i>
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input has-danger">
											<label class="col-md-2 control-label" for="form_control_1">Instruksi Ujian <span class="required"> * </span></label>
											<div class="col-md-10">
												<textarea id="summernote" name='instruksi' required><?= $data_utama->instruksi; ?></textarea>
												<script>
													$(document).ready(function() {
														$('#summernote').summernote();
													});
												</script>
											</div>
										</div>
										<div class="form-group form-md-line-input has-danger">
											<label class="col-md-2 control-label" for="form_control_1">Durasi <span class="required"> * </span></label>
											<div class="col-md-10">
												<div class="input-icon">
													<input type="number" class="form-control" name="2" placeholder="Type something" value='<?= $data_utama->durasi; ?>' required>
													<div class="form-control-focus"> </div>
													<span class="help-block">Dalam menit</span>
													<i class="icon-pin"></i>
												</div>
											</div>
										</div>
										<div class="form-group form-md-line-input has-danger">
											<label class="col-md-2 control-label" for="form_control_1">Waktu Pelaksanaan <span class="required"> * </span></label>
											<div class="col-md-10">
												<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
													<?php
													$from = date('m/d/Y', strtotime(substr($data_utama->waktu_pelaksanaan,0,10)));
													$to = date('m/d/Y', strtotime(substr($data_utama->waktu_pelaksanaan,18,10)));
													?>
													<input type="text" class="form-control" name="from" value='<?= $from; ?>'>
													<span class="input-group-addon"> to </span>
													<input type="text" class="form-control" name="to" value='<?= $to; ?>'>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="form-actions margin-top-10">
										<div class="row">
											<div class="col-md-offset-2 col-md-10">
												<button type="reset" class="btn default">Batal</button>
												<button type="submit" class="btn blue">Perbarui</button>
												|
												<a class="btn red" href='<?= base_url(); ?>admin_side/modul_locked/<?= $this->uri->segment(3); ?>'>Locked</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="tab_15_2">
								<script type="text/javascript">
									function getPageSoal() {
										$('#daftar_soal_dalam_modul').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
										var modul = 'daftar_soal_dalam_modul';
										var data = '<?= $this->uri->segment(3); ?>';
										jQuery.ajax({
											url: "<?php echo site_url(); ?>admin/Master/ajax_page",
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
											url: "<?php echo site_url(); ?>admin/Master/ajax_page",
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
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>