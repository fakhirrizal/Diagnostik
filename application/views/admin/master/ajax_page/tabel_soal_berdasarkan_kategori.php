<div class="portlet box yellow">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-list"></i>Daftar Soal </div>
        <div class="tools">
            <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body" style="display: none;">
        <div class="panel-group accordion" id="accordion3">
            <?php
            foreach ($soal as $key => $value) {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?= $value->id_soal; ?>" aria-expanded="false"> <?= $value->pertanyaan; ?> </a>
                    </h4>
                </div>
                <div id="collapse_3_<?= $value->id_soal; ?>" class="panel-collapse collapse" aria-expanded="false">
                    <div class="panel-body">
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
</div>