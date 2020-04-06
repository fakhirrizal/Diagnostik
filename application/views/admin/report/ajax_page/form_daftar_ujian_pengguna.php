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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_<?= $value->id_modul; ?>" aria-expanded="false"> <?= $value->judul; ?> </a>
                            </h4>
                        </div>
                        <div id="collapse_2_<?= $value->id_modul; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <?php
                                if($value->status=='2'){
                                    $pecah_waktu_mulai = explode(' ',$value->waktu_pelaksanaan);
                                    $pecah_waktu_selesai = explode(' ',$value->waktu_selesai);
                                    echo'
                                    Waktu mulai: '.$this->Main_model->convert_tanggal($pecah_waktu_mulai[0]).' '.substr($pecah_waktu_mulai[1],0,5).'<br>
                                    Waktu selesai: '.$this->Main_model->convert_tanggal($pecah_waktu_selesai[0]).' '.substr($pecah_waktu_selesai[1],0,5).'<hr>
                                    Paham konsep: '.number_format($value->paham_konsep,0).' Soal<br>
                                    Kurang paham konsep: '.number_format($value->kurang_paham_konsep,0).' Soal<br>
                                    False positive: '.number_format($value->false_positive,0).' Soal<br>
                                    False negative: '.number_format($value->false_negative,0).' Soal<br>
                                    Miskonsepsi: '.number_format($value->miskonsepsi,0).' Soal<hr>
                                    Tidak paham konsep: '.number_format($value->tidak_paham_konsep,0).' Soal<br>
                                    Soal terjawab: '.number_format($value->soal_terjawab,0).' Soal<br>
                                    Soal kosong: '.number_format($value->soal_kosong,0).' Soal<hr>
                                    Total skor: '.number_format($value->total_skor,0).'<br><br><a class="btn green btn-xs" href="'.base_url().'admin_side/detail_jawaban_ujian/'.md5($value->id_siswa_to_modul).'/1">Detail jawaban peserta</a>
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