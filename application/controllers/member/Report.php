<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    /* Other Function */
    public function ajax_page(){
		if($this->input->post('modul')=='tabel_soal_dalam_ujian'){
            $getdata = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_siswa_to_modul)'=>$this->input->post('data')))->row();
			$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*,c.jawaban AS pilihan_jawaban,c.keyakinan_1,c.alasan,c.keyakinan_2,c.jawaban_matching_1,c.jawaban_matching_2,c.jawaban_matching_3,c.jawaban_matching_4,c.jawaban_matching_5', array('b.id_modul'=>$getdata->id_modul,'md5(c.id_siswa_to_modul)'=>$this->input->post('data')), 'b.nomor_soal ASC', '', '', '', array(
                array(
                    'table' => 'soal_to_modul b',
                    'on' => 'a.id_soal=b.id_soal',
                    'pos' => 'RIGHT'
                ),array(
                    'table' => 'detail_ujian c',
                    'on' => 'b.id_soal_to_modul=c.id_soal_to_modul',
                    'pos' => 'LEFT'
                )
            ))->result();
			$this->load->view('member/report/ajax_page/tabel_soal_dalam_ujian',$data);
		}elseif($this->input->post('modul')=='daftar_soal_dalam_modul'){
			$data['soal'] = $this->Main_model->getSelectedData('soal_to_modul a', 'b.*,a.id_soal_to_modul', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'soal b',
				'on' => 'a.id_soal=b.id_soal',
				'pos' => 'LEFT'
			))->result();
			$data['id_mod'] = $this->input->post('data');
			$data['daftar_soal'] = $this->Main_model->getSelectedData('soal a', 'a.*', array('a.deleted'=>'0'))->result();
			$this->load->view('admin/master/ajax_page/form_daftar_soal_dalam_modul',$data);
		}elseif($this->input->post('modul')=='daftar_peserta_dalam_suatu_ujian'){
			$data['siswa'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'b.*,a.id_siswa_to_modul', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'siswa b',
				'on' => 'a.id_siswa=b.id_siswa',
				'pos' => 'LEFT'
			))->result();
			$data['id_mod'] = $this->input->post('data');
			$data['daftar_siswa'] = $this->Main_model->getSelectedData('siswa a', 'a.*')->result();
			$this->load->view('admin/master/ajax_page/form_daftar_peserta_ujian',$data);
		}
	}
    public function countdown(){
        // mengatur time zone untuk WIB.
        // date_default_timezone_set("Asia/Jakarta");
        
        // mencari mktime untuk tanggal 1 Januari 2011 00:00:00 WIB
        $selisih1 =  mktime(19, 5, 0, 03, 24, 2020);
        
        // mencari mktime untuk current time
        $selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
        
        // mencari selisih detik antara kedua waktu
        $delta = $selisih1 - $selisih2;
        
        // proses mencari jumlah hari
        $a = floor($delta / 86400);
        
        // proses mencari jumlah jam
        $sisa = $delta % 86400;
        $b  = floor($sisa / 3600);
        
        // proses mencari jumlah menit
        $sisa = $sisa % 3600;
        $c = floor($sisa / 60);
        
        // proses mencari jumlah detik
        $sisa = $sisa % 60;
        $d = floor($sisa / 1);
        
        echo "Waktu saat ini: ".date("d-m-Y H:i:s")."<br>";
        echo "Masih: ".$a." hari ".$b." jam ".$c." menit ".$d." detik lagi, menuju tahun baru 1 Januari 2011";
    }
}