<?php
date_default_timezone_set('Asia/Jakarta');
echo'
<table class="table table-striped table-bordered" id="tbl" border="1">
    <thead>
        <tr style="font-weight:bold">
            <th style="text-align: center;" colspan="13"> '.$data_utama->judul.' </th>
        </tr>
        <tr>
            <th style="text-align: center;">No.</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Waktu mulai</th>
            <th style="text-align: center;">Waktu selesai</th>
            <th style="text-align: center;">Paham konsep</th>
            <th style="text-align: center;">Kurang paham konsep</th>
            <th style="text-align: center;">False positive</th>
            <th style="text-align: center;">False negative</th>
            <th style="text-align: center;">Miskonsepsi</th>
            <th style="text-align: center;">Tidak paham konsep</th>
            <th style="text-align: center;">Soal terjawab</th>
            <th style="text-align: center;">Soal kosong</th>
            <th style="text-align: center;">Total skor</th>
        </tr>
    </thead>
    <tbody>';
    $no = 1;
    foreach ($data_ujian as $key => $value) {
        echo'<tr>
                <td style="text-align: center;">'.$no++.'.</td>
                <td style="text-align: center;">'.$value->nama.'</td>';
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
                    <td style="text-align: center;">'.$this->Main_model->convert_tanggal($pecah_waktu_mulai[0]).' '.substr($pecah_waktu_mulai[1],0,5).'</td>
                    <td style="text-align: center;">'.$this->Main_model->convert_tanggal($pecah_waktu_selesai[0]).' '.substr($pecah_waktu_selesai[1],0,5).'</td>
                    <td style="text-align: center;">'.number_format($value->paham_konsep,0).' Soal'.$tampil_soal_paham_konsep.'</td>
                    <td style="text-align: center;">'.number_format($value->kurang_paham_konsep,0).' Soal'.$tampil_soal_kurang_paham_konsep.'</td>
                    <td style="text-align: center;">'.number_format($value->false_positive,0).' Soal'.$tampil_soal_false_positive.'</td>
                    <td style="text-align: center;">'.number_format($value->false_negative,0).' Soal'.$tampil_soal_false_negative.'</td>
                    <td style="text-align: center;">'.number_format($value->miskonsepsi,0).' Soal'.$tampil_soal_miskonsepsi.'</td>
                    <td style="text-align: center;">'.number_format($value->tidak_paham_konsep,0).' Soal'.$tampil_soal_tidak_paham_konsep.'</td>
                    <td style="text-align: center;">'.number_format($value->soal_terjawab,0).' Soal</td>
                    <td style="text-align: center;">'.number_format($value->soal_kosong,0).' Soal</td>
                    <td style="text-align: center;">'.number_format($value->total_skor,0).'</td>
                    ';
                }else{
                    echo'
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                        <td style="text-align: center;">-</td>
                    ';
                }
        echo'</tr>';
    }
    echo'</tbody>';
echo'</table>
';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=rekap_data.xls");
?>