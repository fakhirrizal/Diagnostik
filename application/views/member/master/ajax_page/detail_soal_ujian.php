<form role="form" class="form-horizontal" action="<?=base_url('member_side/simpan_jawaban');?>" method="post" enctype='multipart/form-data'>
    <?php
    $urut = 1;
    foreach ($soal as $key => $value) {
        if($urut=='1'){
            $gambar_soal = '';
            if($value->image==NULL){
                echo'';
            }else{
            $gambar_soal = '
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1"></label>
                <div class="col-md-10">
                    <img src="'.base_url().'data_upload/soal/'.$value->image.'" width="100%" />
                </div>
            </div>
            ';
            }
            $get_jawaban_soal = $this->Main_model->getSelectedData('detail_ujian c', 'c.jawaban AS pilihan_jawaban,c.keyakinan_1,c.alasan,c.keyakinan_2,c.jawaban_matching_1,c.jawaban_matching_2,c.jawaban_matching_3,c.jawaban_matching_4,c.jawaban_matching_5', array('c.id_siswa_to_modul'=>$identity,'c.id_soal_to_modul'=>$value->id_soal_to_modul))->row();
            echo '
            <input type="hidden" name="last_indek" value="'.$no_soal.'" />
            <input type="hidden" name="identity" value="'.$identity.'" />
            <input type="hidden" name="modul" value="'.$value->id_modul.'" />
            <input type="hidden" name="soal_to_modul" value="'.$value->id_soal_to_modul.'" />
            <input type="hidden" name="soal" value="'.$value->id_soal.'" />
            <input type="hidden" name="jawaban" value="'.$value->jawaban.'" />
            <input type="hidden" name="alasan_benar" value="'.$value->alasan_benar.'" />
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1">Pertanyaan</label>
                <div class="col-md-10">
                    '.$value->pertanyaan.'
                </div>
            </div>
            '.$gambar_soal.'
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1"></label>
                <div class="col-md-10">';
                    if($value->id_kategori_soal=='0'){
                        echo'<input type="hidden" name="id_kategori_soal" value="'.$value->id_kategori_soal.'">';
                        echo'<div class="form-group form-md-radios">
                            <div class="md-radio-list">
                                <div class="md-radio has-success">
                                    <input type="radio" id="radio_a" name="jwb" value="A" class="md-radiobtn" '; if($get_jawaban_soal->pilihan_jawaban=="A"){echo'checked';}else{echo'';} echo'>
                                    <label for="radio_a">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> A. '.$value->pilihan_1.' </label>
                                </div>
                                <div class="md-radio has-success">
                                    <input type="radio" id="radio_b" name="jwb" value="B" class="md-radiobtn" '; if($get_jawaban_soal->pilihan_jawaban=="B"){echo'checked';}else{echo'';} echo'>
                                    <label for="radio_b">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> B. '.$value->pilihan_2.' </label>
                                </div>
                            ';
                            if($value->pilihan_3==NULL){
                                echo'';
                            }else{
                                if($get_jawaban_soal->pilihan_jawaban=="C"){
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_c" name="jwb" value="C" class="md-radiobtn" checked>
                                        <label for="radio_c">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> C. '.$value->pilihan_3.' </label>
                                    </div>';
                                }else{
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_c" name="jwb" value="C" class="md-radiobtn">
                                        <label for="radio_c">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> C. '.$value->pilihan_3.' </label>
                                    </div>';
                                }
                            }
                            if($value->pilihan_4==NULL){
                                echo'';
                            }else{
                                if($get_jawaban_soal->pilihan_jawaban=="D"){
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_d" name="jwb" value="D" class="md-radiobtn" checked>
                                        <label for="radio_d">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> D. '.$value->pilihan_4.' </label>
                                    </div>';
                                }else{
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_d" name="jwb" value="D" class="md-radiobtn">
                                        <label for="radio_d">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> D. '.$value->pilihan_4.' </label>
                                    </div>';
                                }
                            }    
                            if($value->pilihan_5==NULL){
                                echo'';
                            }else{
                                if($get_jawaban_soal->pilihan_jawaban=="E"){
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_e" name="jwb" value="E" class="md-radiobtn" checked>
                                        <label for="radio_e">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> E. '.$value->pilihan_5.' </label>
                                    </div>';
                                }else{
                                    echo'<div class="md-radio has-success">
                                        <input type="radio" id="radio_e" name="jwb" value="E" class="md-radiobtn">
                                        <label for="radio_e">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> E. '.$value->pilihan_5.' </label>
                                    </div>';
                                }
                            }    
                        echo'</div>
                        </div>';
                    }else{
                        echo'<input type="hidden" name="id_kategori_soal" value="'.$value->id_kategori_soal.'">';
                        echo'<input type="hidden" name="jawaban_1" value="'.$value->jawaban_1.'">';
                        echo'<input type="hidden" name="jawaban_2" value="'.$value->jawaban_2.'">';
                        echo'<input type="hidden" name="jawaban_3" value="'.$value->jawaban_3.'">';
                        echo'<input type="hidden" name="jawaban_4" value="'.$value->jawaban_4.'">';
                        echo'<input type="hidden" name="jawaban_5" value="'.$value->jawaban_5.'">';
                        echo'<div class="col-md-10">'.$value->pilihan_1.'</div>
                        <div class="col-md-2"><input type="text" maxlength="1" name="jawaban_matching_1" class="form-control" value="'.$get_jawaban_soal->jawaban_matching_1.'"></div>';
                        echo'<div class="col-md-10">'.$value->pilihan_2.'</div>
                        <div class="col-md-2"><input type="text" maxlength="1" name="jawaban_matching_2" class="form-control" value="'.$get_jawaban_soal->jawaban_matching_2.'"></div>';
                        if($value->pilihan_3==NULL){
                            echo'';
                        }else{
                            echo'<div class="col-md-10">'.$value->pilihan_3.'</div>
                            <div class="col-md-2"><input type="text" maxlength="1" name="jawaban_matching_3" class="form-control" value="'.$get_jawaban_soal->jawaban_matching_3.'"></div>';
                        }
                        if($value->pilihan_4==NULL){
                            echo'';
                        }else{
                            echo'<div class="col-md-10">'.$value->pilihan_4.'</div>
                            <div class="col-md-2"><input type="text" maxlength="1" name="jawaban_matching_4" class="form-control" value="'.$get_jawaban_soal->jawaban_matching_4.'"></div>';
                        }
                        if($value->pilihan_5==NULL){
                            echo'';
                        }else{
                            echo'<div class="col-md-10">'.$value->pilihan_5.'</div>
                            <div class="col-md-2"><input type="text" maxlength="1" name="jawaban_matching_5" class="form-control" value="'.$get_jawaban_soal->jawaban_matching_5.'"></div>';
                        }
                        echo'<div class="col-md-12"><u>Pilihan Jawaban</u><br>
                        A. '.$value->random_pilihan_1.'<br>
                        B. '.$value->random_pilihan_2.'<br>
                        ';
                        if($value->random_pilihan_3==NULL){
                            echo'';
                        }else{
                            echo'
                            C. '.$value->random_pilihan_3.'<br>';
                        }
                        if($value->random_pilihan_4==NULL){
                            echo'';
                        }else{
                            echo'
                            D. '.$value->random_pilihan_4.'<br>';
                        }
                        if($value->random_pilihan_5==NULL){
                            echo'';
                        }else{
                            echo'
                            E. '.$value->random_pilihan_5.'<br>';
                        }
                        echo'</div>';
                    }
                    echo'
                </div>
            </div>
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1">Keyakinan Jawaban</label>
                <div class="col-md-10">
                    <div class="form-group form-md-radios">
                        <div class="md-radio-list">
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_yakin_jawaban_1" name="radio_yakin_jawaban" value="1" class="md-radiobtn" '; if($get_jawaban_soal->keyakinan_1=="1"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_yakin_jawaban_1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> Yakin </label>
                            </div>
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_yakin_jawaban_0" name="radio_yakin_jawaban" value="0" class="md-radiobtn" '; if($get_jawaban_soal->keyakinan_1=="0"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_yakin_jawaban_0">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> Tidak Yakin </label>
                            </div>
                        ';   
                    echo'</div>
                    </div>
                </div>
            </div>
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1">Alasan</label>
                <div class="col-md-10">
                    <div class="form-group form-md-radios">
                        <div class="md-radio-list">
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_a1" name="alasan" value="A" class="md-radiobtn" '; if($get_jawaban_soal->alasan=="A"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_a1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> A. '.$value->alasan_1.' </label>
                            </div>
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_b2" name="alasan" value="B" class="md-radiobtn" '; if($get_jawaban_soal->alasan=="B"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_b2">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> B. '.$value->alasan_2.' </label>
                            </div>
                        ';
                        if($value->alasan_3==NULL){
                            echo'';
                        }else{
                            if($get_jawaban_soal->alasan=="C"){
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_c3" name="alasan" value="C" class="md-radiobtn" checked>
                                    <label for="radio_c3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> C. '.$value->alasan_3.' </label>
                                </div>';
                            }else{
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_c3" name="alasan" value="C" class="md-radiobtn">
                                    <label for="radio_c3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> C. '.$value->alasan_3.' </label>
                                </div>';
                            }
                        }
                        if($value->alasan_4==NULL){
                            echo'';
                        }else{
                            if($get_jawaban_soal->alasan=="D"){
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_d4" name="alasan" value="D" class="md-radiobtn" checked>
                                    <label for="radio_d4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> D. '.$value->alasan_4.' </label>
                                </div>';
                            }else{
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_d4" name="alasan" value="D" class="md-radiobtn">
                                    <label for="radio_d4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> D. '.$value->alasan_4.' </label>
                                </div>';
                            }
                        }    
                        if($value->alasan_5==NULL){
                            echo'';
                        }else{
                            if($get_jawaban_soal->alasan=="E"){
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_e5" name="alasan" value="E" class="md-radiobtn" checked>
                                    <label for="radio_e5">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> E. '.$value->alasan_5.' </label>
                                </div>';
                            }else{
                                echo'<div class="md-radio has-success">
                                    <input type="radio" id="radio_e5" name="alasan" value="E" class="md-radiobtn">
                                    <label for="radio_e5">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> E. '.$value->alasan_5.' </label>
                                </div>';
                            }
                        }    
                    echo'</div>
                    </div>
                </div>
            </div>
            <div class="form-group form-md-line-input has-danger">
                <label class="col-md-2 control-label" for="form_control_1">Keyakinan Alasan</label>
                <div class="col-md-10">
                    <div class="form-group form-md-radios">
                        <div class="md-radio-list">
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_yakin_jawaban_1a" name="radio_yakin_alasan" value="1" class="md-radiobtn" '; if($get_jawaban_soal->keyakinan_2=="1"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_yakin_jawaban_1a">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> Yakin </label>
                            </div>
                            <div class="md-radio has-success">
                                <input type="radio" id="radio_yakin_jawaban_0a" name="radio_yakin_alasan" value="0" class="md-radiobtn" '; if($get_jawaban_soal->keyakinan_2=="0"){echo'checked';}else{echo'';} echo'>
                                <label for="radio_yakin_jawaban_0a">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> Tidak Yakin </label>
                            </div>
                        ';   
                    echo'</div>
                    </div>
                </div>
            </div>
            ';
        }else{echo'';}
        $urut++;
    }
    ?>
    <br>
    <div class="form-group form-md-line-input has-danger">
        <label class="col-md-2 control-label" for="form_control_1"></label>
        <div class="col-md-10">
            <button type="submit" class="btn blue">Simpan Jawaban</button>
        </div>
    </div>
<form>