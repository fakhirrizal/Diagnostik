<div class="row">
<!-- <div class="form-group form-md-checkboxes"> -->
    <!-- <label><h4>Daftar Soal</h4></label> -->
    <!-- <div class="md-checkbox-list"> -->
		<?php
		// print_r($soal);
        // foreach ($daftar_soal as $key => $value) {
        //     $datacek = $this->Main_model->getSelectedData('soal_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_soal'=>$value->id_soal))->result();
		// 	if($datacek==NULL){
		// 		echo'';
		// 	}else{
		?>
        <!-- <div class="form-group form-md-line-input has-danger"> -->
            <!-- <div class="col-md-1" style='text-align:right'>
			
            </div> -->
            <div class="col-md-12">
                <div class="panel-group accordion" id="accordion3">
					<?php
					foreach ($soal as $key => $value) {
					?>
					
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?= $value->id_soal; ?>" aria-expanded="false"> KS-<?= $value->id_soal; ?>   |   Lihat Detail Soal </a>
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
					<?php } ?>
                </div>
            </div>
        <!-- </div> -->
        <?php // }} ?>
    <!-- </div> -->
<!-- </div> -->