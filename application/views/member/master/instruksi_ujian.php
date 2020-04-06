<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Instruksi Ujian</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<!-- <h3>Catatan</h3>
		<p> 1. Soal yang sudah terjawab berwarna biru.</p>
		<p> 2. Jika merasa telah selesai silahkan klik tombol <b>Selesai Ujian</b>.</p> -->
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
								<div class="col-md-12">
									<table class="table">
                                        <tr>
                                            <td> Instruksi untuk ujian <?= $row->judul; ?> (<?php echo $row->jumlah_soal.' soal'; ?>) dengan durasi pengerjaan selama <?php echo $row->durasi.' menit, sebagai berikut:<hr>'.$row->instruksi.'<hr>'; ?><a class="btn red" onclick="return confirm('Anda yakin?')" href='<?= base_url('member_side/mulai_ujian/'.md5($row->id_siswa_to_modul)); ?>'>Mulai Ujian</a> </td>
                                        </tr>
                                    </table>
								</div>
						<?php }} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>