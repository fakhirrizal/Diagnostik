<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="<?=base_url('assets/pages/scripts/components-editors.min.js');?>" type="text/javascript"></script> -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span><a href='<?= site_url('/admin_side/soal'); ?>'>Soal</a></span>
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
		<p> 2. Jika tidak mengganti gambar maka field <b>Image</b> harap dihiraukan.</p>
		<p> 3. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b>, <b>.bmp</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_soal');?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<input type="hidden" name="id" value="<?= md5($data_utama->id_soal); ?>">
						<input type="hidden" name="id_kategori_soal" value="<?= $data_utama->id_kategori_soal; ?>">
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Pertanyaan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<textarea rows='3' class="form-control" name="isi" placeholder="Type something" required><?= $data_utama->pertanyaan; ?></textarea>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Image </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="file" class="form-control" name="gambar" >
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<?php
							if($data_utama->image==NULL){
								echo'';
							}else{
							?>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"> </label>
								<div class="col-md-10">
									<img src='<?= base_url().'data_upload/soal/'.$data_utama->image; ?>' width='100%' />
								</div>
							</div>
							<?php } ?>
							<hr>
							<?php
							if($data_utama->id_kategori_soal=='0'){
							?>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Pilihan 1 <span class="required"> * </span></label>
									<div class="col-md-10">
										<div class="input-icon">
											<input type="text" class="form-control" name="1" placeholder="Type something" value='<?= $data_utama->pilihan_1; ?>' required>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Pilihan 2 <span class="required"> * </span></label>
									<div class="col-md-10">
										<div class="input-icon">
											<input type="text" class="form-control" name="2" placeholder="Type something" value='<?= $data_utama->pilihan_2; ?>' required>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Pilihan 3 </label>
									<div class="col-md-10">
										<div class="input-icon">
											<input type="text" class="form-control" name="3" placeholder="Type something" value='<?= $data_utama->pilihan_3; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Pilihan 4 </label>
									<div class="col-md-10">
										<div class="input-icon">
											<input type="text" class="form-control" name="4" placeholder="Type something" value='<?= $data_utama->pilihan_4; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Pilihan 5 </label>
									<div class="col-md-10">
										<div class="input-icon">
											<input type="text" class="form-control" name="5" placeholder="Type something" value='<?= $data_utama->pilihan_5; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-2 control-label" for="form_control_1">Jawaban <span class="required"> * </span></label>
									<div class="col-md-10">
										<div class="input-icon">
											<select class="form-control" name="answer" required>
												<option value=''>-- Pilih --</option>
												<option value='A' <?php if($data_utama->jawaban=='A'){echo'selected';}else{echo'';} ?>>A</option>
												<option value='B' <?php if($data_utama->jawaban=='B'){echo'selected';}else{echo'';} ?>>B</option>
												<option value='C' <?php if($data_utama->jawaban=='C'){echo'selected';}else{echo'';} ?>>C</option>
												<option value='D' <?php if($data_utama->jawaban=='D'){echo'selected';}else{echo'';} ?>>D</option>
												<option value='E' <?php if($data_utama->jawaban=='E'){echo'selected';}else{echo'';} ?>>E</option>
											</select>
											<div class="form-control-focus"> </div>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
							<?php }else{ ?>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-1 control-label" for="form_control_1">Soal 1 <span class="required"> * </span></label>
									<div class="col-md-5">
										<div class="input-icon">
											<textarea rows='3' class="form-control" name="1" placeholder="Type something" required><?= $data_utama->pilihan_1; ?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
									<label class="col-md-2 control-label" for="form_control_1">Jawaban 1 <span class="required"> * </span></label>
									<div class="col-md-4">
										<div class="input-icon">
											<input type="text" class="form-control" name="jawaban_1" placeholder="Type something" value='<?= $data_utama->jawaban_1; ?>' required>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-1 control-label" for="form_control_1">Soal 2 <span class="required"> * </span></label>
									<div class="col-md-5">
										<div class="input-icon">
											<textarea rows='3' class="form-control" name="2" placeholder="Type something" required><?= $data_utama->pilihan_2; ?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
									<label class="col-md-2 control-label" for="form_control_1">Jawaban 2 <span class="required"> * </span></label>
									<div class="col-md-4">
										<div class="input-icon">
											<input type="text" class="form-control" name="jawaban_2" placeholder="Type something" value='<?= $data_utama->jawaban_2; ?>' required>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-1 control-label" for="form_control_1">Soal 3 </label>
									<div class="col-md-5">
										<div class="input-icon">
											<textarea rows='3' class="form-control" name="3" placeholder="Type something" ><?= $data_utama->pilihan_3; ?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
									<label class="col-md-2 control-label" for="form_control_1">Jawaban 3 </label>
									<div class="col-md-4">
										<div class="input-icon">
											<input type="text" class="form-control" name="jawaban_3" placeholder="Type something" value='<?= $data_utama->jawaban_3; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-1 control-label" for="form_control_1">Soal 4 </label>
									<div class="col-md-5">
										<div class="input-icon">
											<textarea rows='3' class="form-control" name="4" placeholder="Type something" ><?= $data_utama->pilihan_4; ?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
									<label class="col-md-2 control-label" for="form_control_1">Jawaban 4 </label>
									<div class="col-md-4">
										<div class="input-icon">
											<input type="text" class="form-control" name="jawaban_4" placeholder="Type something" value='<?= $data_utama->jawaban_4; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
								<div class="form-group form-md-line-input has-danger">
									<label class="col-md-1 control-label" for="form_control_1">Soal 5 </label>
									<div class="col-md-5">
										<div class="input-icon">
											<textarea rows='3' class="form-control" name="5" placeholder="Type something" ><?= $data_utama->pilihan_5; ?></textarea>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
									<label class="col-md-2 control-label" for="form_control_1">Jawaban 5 </label>
									<div class="col-md-4">
										<div class="input-icon">
											<input type="text" class="form-control" name="jawaban_5" placeholder="Type something" value='<?= $data_utama->jawaban_5; ?>'>
											<div class="form-control-focus"> </div>
											<span class="help-block">Some help goes here...</span>
											<i class="icon-pin"></i>
										</div>
									</div>
								</div>
							<?php } ?>
							<hr>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Menjawab 1 <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="a" placeholder="Type something" value='<?= $data_utama->alasan_1; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Menjawab 2 <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="b" placeholder="Type something" value='<?= $data_utama->alasan_2; ?>' required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Menjawab 3 </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="c" placeholder="Type something" value='<?= $data_utama->alasan_3; ?>'>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Menjawab 4 </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="d" placeholder="Type something" value='<?= $data_utama->alasan_4; ?>'>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Menjawab 5 </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="e" placeholder="Type something" value='<?= $data_utama->alasan_5; ?>'>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Alasan Benar <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select class="form-control" name="alesan" required>
											<option value=''>-- Pilih --</option>
											<option value='A' <?php if($data_utama->alasan_benar=='A'){echo'selected';}else{echo'';} ?>>A</option>
											<option value='B' <?php if($data_utama->alasan_benar=='B'){echo'selected';}else{echo'';} ?>>B</option>
											<option value='C' <?php if($data_utama->alasan_benar=='C'){echo'selected';}else{echo'';} ?>>C</option>
											<option value='D' <?php if($data_utama->alasan_benar=='D'){echo'selected';}else{echo'';} ?>>D</option>
											<option value='E' <?php if($data_utama->alasan_benar=='E'){echo'selected';}else{echo'';} ?>>E</option>
										</select>
										<div class="form-control-focus"> </div>
										<i class="icon-pin"></i>
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
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>