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
		<span><a href='<?= site_url('/admin_side/data_anggota'); ?>'>Data Pengguna</a></span>
		<!-- <i class="fa fa-circle"></i> -->
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
												<td> Nama </td>
												<td> : </td>
												<td><?php if($row->nama==NULL){echo'-';}else{echo $row->nama;} ?></td>
											</tr>
                                            <tr>
												<td> Alamat </td>
												<td> : </td>
												<td><?php if($row->alamat==NULL){echo'-';}else{echo $row->alamat;} ?></td>
                                            </tr>
                                            <tr>
												<td> Nomer HP </td>
												<td> : </td>
												<td><?php if($row->no_hp==NULL){echo'-';}else{echo $row->no_hp;} ?></td>
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
								</div>
						<?php }} ?>
					</div>
					<div class='row'>
						<div class="col-md-12" >
							<div class="tabbable-line">
								<!-- <div class="table-toolbar">
									<div class="row">
										<div class="col-md-6">
											<a href="<?php echo site_url('admin_side/tambah_soal'); ?>" class="btn green uppercase">Tambah Data Soal <i class="fa fa-plus"></i> </a>
										</div>
									</div>
								</div> -->
								<script type="text/javascript">
									function getPage() {
										$('#tabel_daftar_ujian_tiap_pengguna').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" />');
										var modul = 'tabel_daftar_ujian_tiap_pengguna';
										var data = '<?= $this->uri->segment(3); ?>';
										jQuery.ajax({
											url: "<?php echo site_url(); ?>admin/Report/ajax_page",
											data: {modul:modul,data:data},
											type: "POST",
											success:function(data){
												$('#tabel_daftar_ujian_tiap_pengguna').html(data);
												$("#loading-image").hide();
											}
										});
									}
									getPage();
								</script>
								<img id="loading-image" src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" width='100%'/>
								<div id="tabel_daftar_ujian_tiap_pengguna">
								</div>  
							</div>
						</div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/data_anggota"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>