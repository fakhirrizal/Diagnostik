<link href="<?=base_url('assets/global/plugins/select2/css/select2.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
        <div class='row'>
            <div class="form-group form-md-checkboxes">
                <div class="form-group form-md-line-input has-danger">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-11">
                        <b>*</b>Kedua form dibawah ini memiliki fungsi yang sama, silahkan gunakan yang menurut Anda lebih mudah.
                    </div>
                </div>
                <hr>
                <form role="form" class="form-horizontal" action="<?=base_url('admin_side/tambah_soal_modul');?>" method="post" enctype='multipart/form-data'>
                    <input type='hidden' name='id_mod' value='<?= $id_mod; ?>'/>
                    <div class="form-group form-md-line-input has-danger">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-9">
                            <select name='soalku[]' class="form-control select2-allow-clear" multiple required>
                                <option value=''>-- Pilih --</option>
                                <?php
                                foreach ($daftar_soal as $key => $value) {
                                    $datacek = $this->Main_model->getSelectedData('soal_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_soal'=>$value->id_soal))->result();
                                    if($datacek==NULL){
                                        echo"<option value='".$value->id_soal."'>(KS-".$value->id_soal.")       ".$value->pertanyaan."</option>";
                                    }else{
                                        echo'';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form role="form" class="form-horizontal" action="<?=base_url('admin_side/tambah_soal_modul');?>" method="post" enctype='multipart/form-data'>
                    <input type='hidden' name='id_mod' value='<?= $id_mod; ?>'/>
                    <div class="md-checkbox-list">
                        <?php
                        foreach ($daftar_soal as $key => $value) {
                            $datacek = $this->Main_model->getSelectedData('soal_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_soal'=>$value->id_soal))->result();
                        ?>
                        <div class="form-group form-md-line-input has-danger">
                            <div class="col-md-1">
                            
                            </div>
                            <div class="col-md-1">
                                <div class="md-checkbox" >
                                    <?php
                                    if($datacek==NULL){
                                        echo'<input type="checkbox" name="soalku[]" id="checkbox'.$value->id_soal.'" class="md-check" value="'.$value->id_soal.'">';
                                    }else{
                                        echo'<input type="checkbox" id="checkbox'.$value->id_soal.'" disabled checked class="md-check">';
                                    }
                                    ?>
                                    
                                    <label for="checkbox<?= $value->id_soal; ?>">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> KS-<?= $value->id_soal; ?> </label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="panel-group accordion" id="accordion3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?= $value->id_soal; ?>" aria-expanded="false"> Lihat Detail Soal </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_3_<?= $value->id_soal; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                <p><?= $value->pertanyaan; ?></p>
                                                <?php
                                                if($value->image==NULL){
                                                    echo'';
                                                }else{
                                                ?>
                                                <img src='<?= base_url().'data_upload/soal/'.$value->image; ?>' width='100%' />
                                                <br>
                                                <br>
                                                <?php }
                                                if($value->id_kategori_soal=='1'){
                                                    if($value->pilihan_1!=NULL){
                                                        echo'<p>'.$value->pilihan_1.' &rarr; '.$value->jawaban_1.'</p>';
                                                    }
                                                    if($value->pilihan_2!=NULL){
                                                        echo'<p>'.$value->pilihan_2.' &rarr; '.$value->jawaban_2.'</p>';
                                                    }
                                                    if($value->pilihan_3!=NULL){
                                                        echo'<p>'.$value->pilihan_3.' &rarr; '.$value->jawaban_3.'</p>';
                                                    }
                                                    if($value->pilihan_4!=NULL){
                                                        echo'<p>'.$value->pilihan_4.' &rarr; '.$value->jawaban_4.'</p>';
                                                    }
                                                    if($value->pilihan_5!=NULL){
                                                        echo'<p>'.$value->pilihan_5.' &rarr; '.$value->jawaban_5.'</p>';
                                                    }
                                                }elseif($value->id_kategori_soal=='0'){
                                                    if($value->pilihan_1!=NULL){
                                                        echo'<p><b>A</b>           '.$value->pilihan_1.'</p>';
                                                    }
                                                    if($value->pilihan_2!=NULL){
                                                        echo'<p><b>B</b>           '.$value->pilihan_2.'</p>';
                                                    }
                                                    if($value->pilihan_3!=NULL){
                                                        echo'<p><b>C</b>           '.$value->pilihan_3.'</p>';
                                                    }
                                                    if($value->pilihan_4!=NULL){
                                                        echo'<p><b>D</b>           '.$value->pilihan_4.'</p>';
                                                    }
                                                    if($value->pilihan_5!=NULL){
                                                        echo'<p><b>E</b>           '.$value->pilihan_5.'</p>';
                                                    }
                                                ?>
                                                <hr>
                                                <p>Jawaban : <b><?= $value->jawaban; ?></b></p>
                                                <?php }else{echo'';} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-actions margin-top-10">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="reset" class="btn default">Batal</button>
                                <button type="submit" class="btn blue">Perbarui</button>
                                |
                                <a class="btn red" href='<?= base_url(); ?>admin_side/modul_locked/<?= $id_mod; ?>'>Locked</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <table class="table table-striped table-bordered">
                    <caption>Berikut daftar soal yang telah dipilih</caption>
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="1%"> # </th>
                            <th style="text-align: center;"> Kode Soal </th>
                            <th style="text-align: center;" width="1%"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($soal as $key => $value) {
                            $return_on_click = "return confirm('Anda yakin?')";
                            $if_hapus = '<a class="btn btn-xs red" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_soal_dalam_modul/'.md5($value->id_soal_to_modul)).'">Hapus</a>';
                            echo'
                            <tr>
                                <td style="text-align: center;">'.$no++.'.</td>
                                <td style="text-align: center;">KS-'.$value->id_soal.'</td>
                                <td style="text-align: center;">'.$if_hapus.'</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tab_15_3">
        <div class="row">
            <div class="form-group form-md-checkboxes">
                <div class="form-group form-md-line-input has-danger">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-11">
                        <b>*</b>Kedua form dibawah ini memiliki fungsi yang sama, silahkan gunakan yang menurut Anda lebih mudah.
                    </div>
                </div>
                <hr>
                <form role="form" class="form-horizontal" action="<?=base_url('admin_side/tambah_siswa_modul');?>" method="post" enctype='multipart/form-data'>
                    <input type='hidden' name='id_mod' value='<?= $id_mod; ?>'/>
                    <div class="form-group form-md-line-input has-danger">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-9">
                            <select name='siswa[]' class="form-control select2-allow-clear" multiple required>
                                <option value=''>-- Pilih --</option>
                                <?php
                                foreach ($daftar_siswa as $key => $value) {
                                    $datacek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_siswa'=>$value->id_siswa))->result();
                                    if($datacek==NULL){
                                        echo"<option value='".$value->id_siswa."'>".$value->nama."</option>";
                                    }else{
                                        echo'';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </form>
                <hr>
                <form role="form" class="form-horizontal" action="<?=base_url('admin_side/tambah_siswa_modul');?>" method="post" enctype='multipart/form-data'>
                    <input type='hidden' name='id_mod' value='<?= $id_mod; ?>'/>
                    <div class="md-checkbox-list">
                        <?php
                        foreach ($daftar_siswa as $key => $value) {
                            $datacek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_siswa'=>$value->id_siswa))->result();
                        ?>
                        <div class="form-group form-md-line-input has-danger">
                            <div class="col-md-1">
                            
                            </div>
                            <div class="col-md-10">
                                <div class="md-checkbox" >
                                    <?php
                                    if($datacek==NULL){
                                        echo'<input type="checkbox" name="siswa[]" id="check'.$value->id_siswa.'" class="md-check" value="'.$value->id_siswa.'">';
                                    }else{
                                        echo'<input type="checkbox" id="checkbox'.$value->id_siswa.'" disabled checked class="md-check">';
                                    }
                                    ?>
                                    
                                    <label for="check<?= $value->id_siswa; ?>">
                                        <span class="inc"></span>
                                        <span class="check"></span>
                                        <span class="box"></span> <?= $value->nama; ?> </label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-actions margin-top-10">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <button type="reset" class="btn default">Batal</button>
                                <button type="submit" class="btn blue">Perbarui</button>
                                |
                                <a class="btn red" href='<?= base_url(); ?>admin_side/modul_locked/<?= $id_mod; ?>'>Locked</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <table class="table table-striped table-bordered">
                    <caption>Berikut daftar siswa yang telah dipilih</caption>
                    <thead>
                        <tr>
                            <th style="text-align: center;" width="1%"> # </th>
                            <th style="text-align: center;"> Nama </th>
                            <th style="text-align: center;" width="1%"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswa as $key => $value) {
                            $return_on_click = "return confirm('Anda yakin?')";
                            $if_hapus = '<a class="btn btn-xs red" onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_siswa_dalam_modul/'.md5($value->id_siswa_to_modul)).'">Hapus</a>';
                            echo'
                            <tr>
                                <td style="text-align: center;">'.$no++.'.</td>
                                <td style="text-align: center;">'.$value->nama.'</td>
                                <td style="text-align: center;">'.$if_hapus.'</td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('assets/global/plugins/select2/js/select2.full.min.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/pages/scripts/components-select2.min.js');?>" type="text/javascript"></script>