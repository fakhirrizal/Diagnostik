<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    /* Modul */
    public function detail_jawaban_ujian()
    {
        $getdata = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)))->row();
        if($this->uri->segment(4)=='1'){
            $data['parent'] = 'master';
            $data['child'] = 'member';
            $data['tanda'] = 'detail_data_anggota/'.md5($getdata->user_id);
        }else{
            $data['parent'] = 'modul_ujian';
            $data['child'] = 'master_modul';
            $data['tanda'] = 'detail_modul/'.md5($getdata->id_modul);
        }
		
        $data['grand_child'] = '';
        $data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*,c.jawaban AS pilihan_jawaban,c.keyakinan_1,c.alasan,c.keyakinan_2,c.jawaban_matching_1,c.jawaban_matching_2,c.jawaban_matching_3,c.jawaban_matching_4,c.jawaban_matching_5', array('b.id_modul'=>$getdata->id_modul,'md5(c.id_siswa_to_modul)'=>$this->uri->segment(3)), 'b.nomor_soal ASC', '', '', '', array(
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
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/report/detail_jawaban_ujian',$data);
		$this->load->view('admin/template/footer');
    }
    public function cetak_hasil_ujian()
    {
        $data['data_utama'] = $this->Main_model->getSelectedData('modul a', 'a.*', array('md5(a.id_modul)'=>$this->uri->segment(3)))->row();
        $data['data_ujian'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'b.nama,a.*', array('md5(a.id_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
            'table' => 'siswa b',
            'on' => 'a.id_siswa=b.id_siswa',
            'pos' => 'LEFT'
        ))->result();
        $this->load->view('admin/report/excel_hasil_ujian',$data);
    }
    /* Other Function */
    public function ajax_page()
    {
		if($this->input->post('modul')=='daftar_soal_dalam_modul'){
			$data['soal'] = $this->Main_model->getSelectedData('soal_to_modul a', 'b.*,a.id_soal_to_modul', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'soal b',
				'on' => 'a.id_soal=b.id_soal',
				'pos' => 'LEFT'
			))->result();
			// $data['id_mod'] = $this->input->post('data');
			// $data['daftar_soal'] = $this->Main_model->getSelectedData('soal a', 'a.*', array('a.deleted'=>'0'))->result();
			$this->load->view('admin/report/ajax_page/form_daftar_soal_dalam_modul',$data);
		}elseif($this->input->post('modul')=='daftar_peserta_dalam_suatu_ujian'){
			$data['siswa'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'b.nama,a.*', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'siswa b',
				'on' => 'a.id_siswa=b.id_siswa',
				'pos' => 'LEFT'
			))->result();
			// $data['id_mod'] = $this->input->post('data');
			// $data['daftar_siswa'] = $this->Main_model->getSelectedData('siswa a', 'a.*')->result();
			$this->load->view('admin/report/ajax_page/form_daftar_peserta_ujian',$data);
		}elseif($this->input->post('modul')=='tabel_daftar_ujian_tiap_pengguna'){
            $data['siswa'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'b.judul,a.*', array('md5(a.user_id)'=>$this->input->post('data'),'b.locked'=>'1'), '', '', '', '', array(
				'table' => 'modul b',
				'on' => 'a.id_modul=b.id_modul',
				'pos' => 'LEFT'
            ))->result();
            $this->load->view('admin/report/ajax_page/form_daftar_ujian_pengguna',$data);
        }
	}
    public function ajax_function()
    {
		
	}
}