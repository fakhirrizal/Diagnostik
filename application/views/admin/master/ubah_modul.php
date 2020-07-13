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
                        <script type="text/javascript">
                            function getdetailmodul() {
                                $('#detail_modul').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
                                var modul = 'detail_modul';
                                var data = '<?= $this->uri->segment(3); ?>';
                                jQuery.ajax({
                                    url: "<?php echo site_url(); ?>admin/Master/ajax_page",
                                    data: {modul:modul,data:data},
                                    type: "POST",
                                    success:function(data){
                                        $('#detail_modul').html(data);
                                        $("#loading-image").hide();
                                    }
                                });
                            }
                            getdetailmodul();
                        </script>
                        <img id="loading-image" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
                        <div id="detail_modul">
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>