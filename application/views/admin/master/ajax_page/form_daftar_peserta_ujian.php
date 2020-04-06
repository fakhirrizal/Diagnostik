<div class="row">
<div class="form-group form-md-checkboxes">
    <!-- <label><h4>Daftar Soal</h4></label> -->
    <form role="form" class="form-horizontal" action="<?=base_url('admin_side/tambah_siswa_modul');?>" method="post" enctype='multipart/form-data'>
    <input type='hidden' name='id_mod' value='<?= $id_mod; ?>'/>
    <div class="md-checkbox-list">
        <?php
        foreach ($daftar_siswa as $key => $value) {
            $datacek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_modul)'=>$id_mod,'a.id_siswa'=>$value->id_siswa))->result();
        ?>
        <div class="form-group form-md-line-input has-danger">
            <div class="col-md-2">
               
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