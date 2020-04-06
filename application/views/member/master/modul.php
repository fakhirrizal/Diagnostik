<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<!-- <li>
		<span>Data Antrean</span>
		<i class="fa fa-circle"></i>
	</li> -->
	<li>
		<span>Modul Ujian</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<!-- <p> 1. Modul yang sudah di-<b>lock</b> tidak bisa dihapus.</p> -->
		<!-- <p> 2. Data ekspor berupa file excel (<b>.xls</b>)</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="1%"> # </th>
								<th style="text-align: center;"> Modul </th>
								<th style="text-align: center;"> Waktu </th>
								<th style="text-align: center;"> Jumlah Soal </th>
								<th style="text-align: center;"> Status </th>
								<th style="text-align: center;" width="1%"> Aksi </th>
							</tr>
						</thead>
					</table>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 0, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									url:"<?= site_url('member/Master/json_modul_ujian'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'judul', sClass: "alignCenter" },
											{ mData: 'waktu', sClass: "alignCenter" },
											{ mData: 'soal', sClass: "alignCenter" },
											{ mData: 'status', sClass: "alignCenter" },
											{ mData: 'action', sClass: "alignCenter" }
										]
							});

						});
					</script>
					<script type="text/javascript">
					function deleteConfirm(){
						var result = confirm("Yakin akan menghapus data ini?");
						if(result){
							return true;
						}else{
							return false;
						}
					}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>