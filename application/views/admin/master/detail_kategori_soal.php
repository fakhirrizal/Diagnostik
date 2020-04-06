<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/admin_side/kategori_soal'); ?>'>Kategori Soal</a></span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detil Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<!-- <p> 1. Jika laporan telah "<b>disetujui</b>" ataupun "<b>ditolak</b>" maka data tidak dapat diubah kembali.</p> -->
		<!-- <p> 2. Jika menghapus data barang maka stok di master barang akan bertambah.</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
						<?php
						if(isset($data_utama)){
							foreach($data_utama as $row)
							{
						?>
								<div class="col-md-6">
									<table class="table">
										<tbody>
                                            <tr>
												<td> Kategori Soal </td>
												<td> : </td>
												<td><?php echo $row->kategori_soal; ?></td>
											</tr>
                                            <tr>
												<td> Jumlah Soal </td>
												<td> : </td>
												<td><?php echo count($soal).' Soal'; ?></td>
											</tr>
											<tr>
												<td> </td>
												<td> </td>
												<td> </td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table">
									</table>
								</div>
						<?php }} ?>
					</div>
					<div class='row'>
						<div class="col-md-12" >
							<div class="tabbable-line">
								<div class="table-toolbar">
									<div class="row">
										<div class="col-md-6">
											<a href="<?php echo site_url('admin_side/tambah_soal'); ?>" class="btn green uppercase">Tambah Data Soal <i class="fa fa-plus"></i> </a>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									function getPageWO() {
										$('#tabel_soal_berdasarkan_kategori').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
										var modul = 'tabel_soal_berdasarkan_kategori';
										var data = '<?= $this->uri->segment(3); ?>';
										jQuery.ajax({
											url: "<?php echo site_url(); ?>admin/Master/ajax_page",
											data: {modul:modul,data:data},
											type: "POST",
											success:function(data){
												$('#tabel_soal_berdasarkan_kategori').html(data);
												$("#loading-image").hide();
											}
										});
									}
									getPageWO();
								</script>
								<img id="loading-image" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
								<div id="tabel_soal_berdasarkan_kategori">
								</div>  
							</div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/kategori_soal"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>