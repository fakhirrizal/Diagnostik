<?php
// print_r($siswa);
?>
<div class="row">
<!-- <div class="form-group form-md-checkboxes"> -->
    <!-- <label><h4>Daftar Soal</h4></label> -->
    <!-- <div class="md-checkbox-list"> -->
        <?php
        // foreach ($siswa as $key => $value) {
            // $datacek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_siswa'=>$value->id_siswa))->row();
            // if($datacek==NULL){
            //     echo'';
            // }else{
        ?>
        <!-- <div class="form-group form-md-line-input has-danger"> -->
            <!-- <div class="col-md-1">
               
            </div> -->
            <div class="col-md-12">
                
                <div class="panel-group accordion" id="accordion2">
                    <?php
                    foreach ($siswa as $key => $value) {
                    ?>
                    <h4><?= $value->nama; ?></h4>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_<?= $value->id_siswa; ?>" aria-expanded="false"> Detail Ujian </a>
                            </h4>
                        </div>
                        <div id="collapse_2_<?= $value->id_siswa; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <?php
                                if($value->status=='2'){
                                    $get_jumlah_soal_paham_konsep = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'5'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $get_jumlah_soal_kurang_paham_konsep = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'4'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $get_jumlah_soal_false_positive = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'3'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $get_jumlah_soal_false_negative = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'2'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $get_jumlah_soal_miskonsepsi = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'1'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $get_jumlah_soal_tidak_paham_konsep = $this->Main_model->getSelectedData('detail_ujian a', 'a.*,b.nomor_soal', array('a.id_siswa_to_modul'=>$value->id_siswa_to_modul,'a.nilai'=>'0'), 'b.nomor_soal ASC', '', '', '', array(
                                        'table' => 'soal_to_modul b',
                                        'on' => 'a.id_soal_to_modul=b.id_soal_to_modul',
                                        'pos' => 'LEFT'
                                    ))->result();
                                    $tampil_soal_paham_konsep = '';
                                    $tampung_soal_paham_konsep = array();
                                    foreach ($get_jumlah_soal_paham_konsep as $key => $row) {
                                        $tampung_soal_paham_konsep[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_paham_konsep==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_paham_konsep = ' ('.implode(',',$tampung_soal_paham_konsep).')';
                                    }
                                    $tampil_soal_kurang_paham_konsep = '';
                                    $tampung_soal_kurang_paham_konsep = array();
                                    foreach ($get_jumlah_soal_kurang_paham_konsep as $key => $row) {
                                        $tampung_soal_kurang_paham_konsep[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_kurang_paham_konsep==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_kurang_paham_konsep = ' ('.implode(',',$tampung_soal_kurang_paham_konsep).')';
                                    }
                                    $tampil_soal_false_positive = '';
                                    $tampung_soal_false_positive = array();
                                    foreach ($get_jumlah_soal_false_positive as $key => $row) {
                                        $tampung_soal_false_positive[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_false_positive==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_false_positive = ' ('.implode(',',$tampung_soal_false_positive).')';
                                    }
                                    $tampil_soal_false_negative = '';
                                    $tampung_soal_false_negative = array();
                                    foreach ($get_jumlah_soal_false_negative as $key => $row) {
                                        $tampung_soal_false_negative[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_false_negative==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_false_negative = ' ('.implode(',',$tampung_soal_false_negative).')';
                                    }
                                    $tampil_soal_miskonsepsi = '';
                                    $tampung_soal_miskonsepsi = array();
                                    foreach ($get_jumlah_soal_miskonsepsi as $key => $row) {
                                        $tampung_soal_miskonsepsi[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_miskonsepsi==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_miskonsepsi = ' ('.implode(',',$tampung_soal_miskonsepsi).')';
                                    }
                                    $tampil_soal_tidak_paham_konsep = '';
                                    $tampung_soal_tidak_paham_konsep = array();
                                    foreach ($get_jumlah_soal_tidak_paham_konsep as $key => $row) {
                                        $tampung_soal_tidak_paham_konsep[] = $row->nomor_soal;
                                    }
                                    if($get_jumlah_soal_tidak_paham_konsep==NULL){
                                        echo'';
                                    }else{
                                        $tampil_soal_tidak_paham_konsep = ' ('.implode(',',$tampung_soal_tidak_paham_konsep).')';
                                    }
                                    $pecah_waktu_mulai = explode(' ',$value->waktu_pelaksanaan);
                                    $pecah_waktu_selesai = explode(' ',$value->waktu_selesai);
                                    echo'
                                    Waktu mulai: '.$this->Main_model->convert_tanggal($pecah_waktu_mulai[0]).' '.substr($pecah_waktu_mulai[1],0,5).'<br>
                                    Waktu selesai: '.$this->Main_model->convert_tanggal($pecah_waktu_selesai[0]).' '.substr($pecah_waktu_selesai[1],0,5).'<hr>
                                    Paham konsep: '.number_format($value->paham_konsep,0).' Soal'.$tampil_soal_paham_konsep.'<br>
                                    Kurang paham konsep: '.number_format($value->kurang_paham_konsep,0).' Soal'.$tampil_soal_kurang_paham_konsep.'<br>
                                    False positive: '.number_format($value->false_positive,0).' Soal'.$tampil_soal_false_positive.'<br>
                                    False negative: '.number_format($value->false_negative,0).' Soal'.$tampil_soal_false_negative.'<br>
                                    Miskonsepsi: '.number_format($value->miskonsepsi,0).' Soal'.$tampil_soal_miskonsepsi.'<br>
                                    Tidak paham konsep: '.number_format($value->tidak_paham_konsep,0).' Soal'.$tampil_soal_tidak_paham_konsep.'<hr>
                                    Soal terjawab: '.number_format($value->soal_terjawab,0).' Soal<br>
                                    Soal kosong: '.number_format($value->soal_kosong,0).' Soal<hr>
                                    Total skor: '.number_format($value->total_skor,0).'<br><br><a class="btn green btn-xs" href="'.base_url().'admin_side/detail_jawaban_ujian/'.md5($value->id_siswa_to_modul).'/2">Detail jawaban peserta</a>
                                    ';
                                }else{
                                    echo'Belum menyelesaikan ujian';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <!-- </div> -->
        <?php // }
        // } ?>
    <!-- </div> -->
<!-- </div> -->