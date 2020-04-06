<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Modul Ujian */
	public function modul(){
		$data['parent'] = 'modul_ujian';
        $data['child'] = 'master_modul';
        $data['grand_child'] = '';
        $this->load->view('member/template/header',$data);
        $this->load->view('member/master/modul',$data);
        $this->load->view('member/template/footer');
	}
	public function json_modul_ujian(){
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*,b.status,b.id_siswa_to_modul', array('b.user_id'=>$this->session->userdata('id')), '', '', '', '', array(
			'table' => 'siswa_to_modul b',
			'on' => 'a.id_modul=b.id_modul',
			'pos' => 'RIGHT'
		))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$isi['soal'] = $value->jumlah_soal.' Soal';
			$dari = $this->Main_model->convert_tanggal(substr($value->waktu_pelaksanaan,0,10));
			$sampai = $this->Main_model->convert_tanggal(substr($value->waktu_pelaksanaan,18,10));
			$isi['waktu'] = $dari.' - '.$sampai;
			$st = '';
			$btn = '';
			if($value->status=='0'){
				$st = 'Belum Ujian';
				$btn = '
				<a class="btn btn-xs green" type="button" href="'.base_url('member_side/detail_modul/'.md5($value->id_siswa_to_modul)).'"> Mulai ujian
				</a>
				';
			}elseif($value->status=='1'){
				$st = 'Sedang Ujian';
				$btn = '
				<a class="btn btn-xs red" type="button" href="'.base_url('member_side/detail_modul/'.md5($value->id_siswa_to_modul)).'"> Lanjut ujian
				</a>
				';
			}else{
				$st = 'Sudah Ujian';
				$btn = '
				<a class="btn btn-xs grey" type="button" href="'.base_url('member_side/detail_modul/'.md5($value->id_siswa_to_modul)).'"> Detail ujian
				</a>
				';
			}
			$isi['status'] = $st;
			$isi['action'] = $btn;
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function mulai_ujian(){
		$cek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.locked,b.waktu_pelaksanaan,b.durasi,b.judul', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'modul b',
			'on' => 'a.id_modul=b.id_modul',
			'pos' => 'LEFT'
		))->row();
		if($cek->locked=='0'){
			$this->session->set_flashdata('gagal','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Ups! </strong>Belum bisa melakukan ujian.
			</div>' );
			echo "<script>window.location='".base_url('member_side/master_modul')."'</script>";
		}else{
			$dari = substr($cek->waktu_pelaksanaan,0,10);
			$sampai = substr($cek->waktu_pelaksanaan,18,10);
			if ((date('Y-m-d') >= $dari && date('Y-m-d') <= $sampai)){
				if($cek->status=='2'){
					echo "<script>window.location='".base_url('member_side/detail_modul/'.$this->uri->segment(3))."'</script>";
				}else{
					if($cek->status=='0'){
						$this->db->trans_start();
						$startTime = date('Y-m-d H:i:s');
						$tambah = '+'.$cek->durasi.' minutes';
						$convertedTime = date('Y-m-d H:i:s',strtotime($tambah,strtotime($startTime)));
						$this->Main_model->updateData('siswa_to_modul',array('waktu_pelaksanaan'=>date('Y-m-d H:i:s'),'waktu_normal_selesai'=>$convertedTime,'status'=>'1'),array('md5(id_siswa_to_modul)'=>$this->uri->segment(3)));
						$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Memulai ujian (".$cek->judul.")",$this->session->userdata('location'));
						$this->db->trans_complete();
						if($this->db->trans_status() === false){
							$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>harap ulangi lagi.<br /></div>' );
							echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->uri->segment(3)."'</script>";
						}
						else{
							echo "<script>window.location='".base_url('member_side/detail_modul/'.$this->uri->segment(3))."'</script>";
						}
					}else{
						echo "<script>window.location='".base_url('member_side/detail_modul/'.$this->uri->segment(3))."'</script>";
					}
				}
			}else{
				// echo "<script>window.location='".base_url('member_side/selesai_ujian/'.$this->uri->segment(3))."'</script>";
				$this->session->set_flashdata('gagal','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Ups! </strong>Tidak bisa melakukan ujian.
				</div>' );
				echo "<script>window.location='".base_url('member_side/master_modul')."'</script>";
			}
		}
	}
	public function detail_modul(){
		$data['parent'] = 'modul_ujian';
        $data['child'] = 'master_modul';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.judul,b.jumlah_soal,b.durasi,b.instruksi', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'modul b',
			'on' => 'a.id_modul=b.id_modul',
			'pos' => 'LEFT'
		))->result();
		$cek = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.locked,b.waktu_pelaksanaan,b.durasi', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'modul b',
			'on' => 'a.id_modul=b.id_modul',
			'pos' => 'LEFT'
		))->row();
		if($cek->locked=='0'){
			$this->session->set_flashdata('gagal','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Ups! </strong>Belum bisa melakukan ujian.
			</div>' );
			echo "<script>window.location='".base_url('member_side/master_modul')."'</script>";
		}else{
			$dari = substr($cek->waktu_pelaksanaan,0,10);
			$sampai = substr($cek->waktu_pelaksanaan,18,10);
			if ((date('Y-m-d') >= $dari && date('Y-m-d') <= $sampai)){
				$this->load->view('member/template/header',$data);
				if($cek->status=='2'){
					$this->load->view('member/report/detail_ujian',$data);
				}else{
					if($cek->status=='0'){
						$this->load->view('member/master/instruksi_ujian',$data);
					}else{
						$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*,b.id_soal_to_modul', array('b.id_modul'=>$cek->id_modul), '', '', '', '', array(
							'table' => 'soal_to_modul b',
							'on' => 'a.id_soal=b.id_soal',
							'pos' => 'RIGHT'
						))->result();
						$this->load->view('member/master/halaman_ujian',$data);
					}
				}
				$this->load->view('member/template/footer');
			}else{
				// echo "<script>window.location='".base_url('member_side/selesai_ujian/'.$this->uri->segment(3))."'</script>";
				$this->session->set_flashdata('gagal','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Ups! </strong>Tidak bisa melakukan ujian.
				</div>' );
				echo "<script>window.location='".base_url('member_side/master_modul')."'</script>";
			}
		}
	}
	public function simpan_jawaban(){
		$get_data_ujian = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.nama,bb.judul', array('a.id_siswa_to_modul'=>$this->input->post('identity')), '', '', '', '', array(
			array(
				'table' => 'siswa b',
				'on' => 'a.id_siswa=b.id_siswa',
				'pos' => 'LEFT'
			),array(
				'table' => 'modul bb',
				'on' => 'a.id_modul=bb.id_modul',
				'pos' => 'LEFT'
			)
		))->row();
		// $paham_konsep = 0;
		// $kurang_paham_konsep = 0;
		// $false_positive = 0;
		// $false_negative = 0;
		// $miskonsepsi = 0;
		// $total_skor = 0;
		$soal_kosong = 0;
		$soal_terjawab = 0;
		$nilai = 0;
		$string_param = '';
		$param1 = '';
		if($this->input->post('jwb')==$this->input->post('jawaban')){
			$param1 = '1';
		}else{
			$param1 = '0';
		}
		$param2 = '';
		if($this->input->post('alasan')==$this->input->post('alasan_benar')){
			$param2 = '1';
		}else{
			$param2 = '0';
		}
		$string_param = $param1.$this->input->post('radio_yakin_jawaban').$param2.$this->input->post('radio_yakin_alasan');
		// echo $string_param;
		if($string_param=='1111'){
			$nilai = 5;
		}elseif($string_param=='1110' OR $string_param=='1011' OR $string_param=='1010' OR $string_param=='1100' OR $string_param=='1001' OR $string_param=='1000' OR $string_param=='0110' OR $string_param=='0011' OR $string_param=='0010' OR $string_param=='0100' OR $string_param=='0001'){
			$nilai = 4;
		}elseif($string_param=='1101'){
			$nilai = 3;
		}elseif($string_param=='0111'){
			$nilai = 2;
		}elseif($string_param=='0101'){
			$nilai = 1;
		}elseif($string_param=='0000'){
			$nilai = 0;
		}else{
			echo'';
		}
		$cek_ = $this->Main_model->getSelectedData('detail_ujian a', 'a.*', array('a.id_siswa_to_modul'=>$this->input->post('identity'),'a.id_modul'=>$this->input->post('modul'),'a.id_soal_to_modul'=>$this->input->post('soal_to_modul'),'a.id_soal'=>$this->input->post('soal')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('detail_ujian','id_detail_ujian');

			$data_insert1 = array(
				'id_detail_ujian' => $get_user_id['id_detail_ujian']+1,
				'id_siswa_to_modul' => $this->input->post('identity'),
				'id_modul' => $this->input->post('modul'),
				'id_soal_to_modul' => $this->input->post('soal_to_modul'),
				'id_soal' => $this->input->post('soal'),
				'jawaban' => $this->input->post('jwb'),
				'keyakinan_1' => $this->input->post('radio_yakin_jawaban'),
				'alasan' => $this->input->post('alasan'),
				'keyakinan_2' => $this->input->post('radio_yakin_alasan'),
				'nilai' => $nilai
			);
			$this->Main_model->insertData('detail_ujian',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'last_id_soal' => $this->input->post('soal'),
				'last_index' => $this->input->post('last_indek')
			);
			$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));

			// if($this->input->post('jwb')!=NULL){
			// 	$data_insert2 = array(
			// 		'paham_konsep' => $paham_konsep,
			// 		'kurang_paham_konsep' => $kurang_paham_konsep,
			// 		'false_positive' => $false_positive,
			// 		'false_negative' => $false_negative,
			// 		'miskonsepsi' => $miskonsepsi,
			// 		'total_skor' => $total_skor,
			// 		'soal_terjawab' => $soal_terjawab
			// 	);
			// 	$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));
			// }else{
			// 	$data_insert2 = array(
			// 		'paham_konsep' => $paham_konsep,
			// 		'kurang_paham_konsep' => $kurang_paham_konsep,
			// 		'false_positive' => $false_positive,
			// 		'false_negative' => $false_negative,
			// 		'miskonsepsi' => $miskonsepsi,
			// 		'total_skor' => $total_skor,
			// 		'soal_kosong' => $soal_kosong
			// 	);
			// 	$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));
			// }

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menjawab soal ujian (".$get_data_ujian->nama." dalam ".$get_data_ujian->judul.")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>jawaban gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."member_side/detail_modul/".md5($this->input->post('identity'))."'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>jawaban telah berhasil disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."member_side/detail_modul/".md5($this->input->post('identity'))."'</script>";
			}
		}else{
			$this->db->trans_start();
			$data_insert1 = array(
				'id_siswa_to_modul' => $this->input->post('identity'),
				'id_modul' => $this->input->post('modul'),
				'id_soal_to_modul' => $this->input->post('soal_to_modul'),
				'id_soal' => $this->input->post('soal'),
				'jawaban' => $this->input->post('jwb'),
				'keyakinan_1' => $this->input->post('radio_yakin_jawaban'),
				'alasan' => $this->input->post('alasan'),
				'keyakinan_2' => $this->input->post('radio_yakin_alasan'),
				'nilai' => $nilai
			);
			$this->Main_model->updateData('detail_ujian',$data_insert1,array('id_detail_ujian'=>$cek_->id_detail_ujian));
			// print_r($data_insert1);

			$data_insert2 = array(
				'last_id_soal' => $this->input->post('soal'),
				'last_index' => $this->input->post('last_indek')
			);
			$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));

			// if($this->input->post('jwb')!=NULL){
			// 	$data_insert2 = array(
			// 		'paham_konsep' => $paham_konsep,
			// 		'kurang_paham_konsep' => $kurang_paham_konsep,
			// 		'false_positive' => $false_positive,
			// 		'false_negative' => $false_negative,
			// 		'miskonsepsi' => $miskonsepsi,
			// 		'total_skor' => $total_skor,
			// 		'soal_terjawab' => $soal_terjawab
			// 	);
			// 	$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));
			// }else{
			// 	$data_insert2 = array(
			// 		'paham_konsep' => $paham_konsep,
			// 		'kurang_paham_konsep' => $kurang_paham_konsep,
			// 		'false_positive' => $false_positive,
			// 		'false_negative' => $false_negative,
			// 		'miskonsepsi' => $miskonsepsi,
			// 		'total_skor' => $total_skor,
			// 		'soal_kosong' => $soal_kosong
			// 	);
			// 	$this->Main_model->updateData('siswa_to_modul',$data_insert2,array('id_siswa_to_modul'=>$this->input->post('identity')));
			// }

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menjawab soal ujian (".$get_data_ujian->nama." dalam ".$get_data_ujian->judul.")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>jawaban gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."member_side/detail_modul/".md5($this->input->post('identity'))."'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>jawaban telah berhasil disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."member_side/detail_modul/".md5($this->input->post('identity'))."'</script>";
			}
		}
	}
	public function selesai_ujian(){
		$this->db->trans_start();
		$get_data_ujian = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.nama,bb.judul', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'siswa b',
				'on' => 'a.id_siswa=b.id_siswa',
				'pos' => 'LEFT'
			),array(
				'table' => 'modul bb',
				'on' => 'a.id_modul=bb.id_modul',
				'pos' => 'LEFT'
			)
		))->row();
		$get_data_soal = $this->Main_model->getSelectedData('soal_to_modul a', 'b.*,a.id_soal_to_modul', array('a.id_modul'=>$get_data_ujian->id_modul), '', '', '', '', array(
			'table' => 'soal b',
			'on' => 'a.id_soal=b.id_soal',
			'pos' => 'LEFT'
		))->result();
		$paham_konsep = 0;
		$kurang_paham_konsep = 0;
		$false_positive = 0;
		$false_negative = 0;
		$miskonsepsi = 0;
		$tidak_paham_konsep = 0;
		$total_skor = 0;
		$soal_kosong = 0;
		$soal_terjawab = 0;

		foreach ($get_data_soal as $key => $value) {
			$get_data_jawaban = $this->Main_model->getSelectedData('detail_ujian bb', 'bb.jawaban AS pilihan_jawaban,bb.keyakinan_1,bb.alasan,bb.keyakinan_2,bb.nilai', array('md5(bb.id_siswa_to_modul)'=>$this->uri->segment(3),'bb.id_soal_to_modul'=>$value->id_soal_to_modul))->row();
			$total_skor += $get_data_jawaban->nilai;
			if($get_data_jawaban->pilihan_jawaban==NULL){
				$soal_kosong++;
			}else{
				$soal_terjawab++;
			}
			$string_param = '';
			$param1 = '';
			if($get_data_jawaban->pilihan_jawaban==$value->jawaban){
				$param1 = '1';
			}else{
				$param1 = '0';
			}
			$param2 = '';
			if($get_data_jawaban->alasan==$value->alasan_benar){
				$param2 = '1';
			}else{
				$param2 = '0';
			}
			$string_param = $param1.$get_data_jawaban->keyakinan_1.$param2.$get_data_jawaban->keyakinan_2;
			// echo $string_param;
			if($string_param=='1111'){
				$paham_konsep++;
			}elseif($string_param=='1110' OR $string_param=='1011' OR $string_param=='1010' OR $string_param=='1100' OR $string_param=='1001' OR $string_param=='1000' OR $string_param=='0110' OR $string_param=='0011' OR $string_param=='0010' OR $string_param=='0100' OR $string_param=='0001'){
				$kurang_paham_konsep++;
			}elseif($string_param=='1101'){
				$false_positive++;
			}elseif($string_param=='0111'){
				$false_negative++;
			}elseif($string_param=='0101'){
				$miskonsepsi++;
			}elseif($string_param=='0000'){
				$tidak_paham_konsep++;
			}else{
				echo'';
			}
		}
		
		$data_insert1 = array(
			'waktu_selesai' => date('Y-m-d H:i:s'),
			'paham_konsep' => $paham_konsep,
			'kurang_paham_konsep' => $kurang_paham_konsep,
			'false_positive' => $false_positive,
			'false_negative' => $false_negative,
			'miskonsepsi' => $miskonsepsi,
			'tidak_paham_konsep' => $tidak_paham_konsep,
			'total_skor' => $total_skor,
			'soal_kosong' => $soal_kosong,
			'soal_terjawab' => $soal_terjawab,
			'status' => '2'
		);
		// print_r($data_insert1);
		$this->Main_model->updateData('siswa_to_modul',$data_insert1,array('md5(id_siswa_to_modul)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"".$get_data_ujian->nama." menyelesaikan ".$get_data_ujian->judul,$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>jawaban gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/detail_modul/".$this->uri->segment(3)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>Anda telah menyelesaikan ujian.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/detail_modul/".$this->uri->segment(3)."'</script>";
		}
	}
	/* Other Function */
	public function ajax_page(){
		if($this->input->post('modul')=='tabel_soal_berdasarkan_kategori'){
			$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*',array('md5(a.id_kategori_soal)'=>$this->input->post('data'),'a.deleted'=>'0'))->result();
			$this->load->view('member/master/ajax_page/tabel_soal_berdasarkan_kategori',$data);
		}elseif($this->input->post('modul')=='daftar_soal_dalam_modul'){
			$data['soal'] = $this->Main_model->getSelectedData('soal_to_modul a', 'b.*,a.id_soal_to_modul', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'soal b',
				'on' => 'a.id_soal=b.id_soal',
				'pos' => 'LEFT'
			))->result();
			$data['id_mod'] = $this->input->post('data');
			$data['daftar_soal'] = $this->Main_model->getSelectedData('soal a', 'a.*', array('a.deleted'=>'0'))->result();
			$this->load->view('member/master/ajax_page/form_daftar_soal_dalam_modul',$data);
		}elseif($this->input->post('modul')=='daftar_peserta_dalam_suatu_ujian'){
			$data['siswa'] = $this->Main_model->getSelectedData('siswa_to_modul a', 'b.*,a.id_siswa_to_modul', array('md5(a.id_modul)'=>$this->input->post('data')), '', '', '', '', array(
				'table' => 'siswa b',
				'on' => 'a.id_siswa=b.id_siswa',
				'pos' => 'LEFT'
			))->result();
			$data['id_mod'] = $this->input->post('data');
			$data['daftar_siswa'] = $this->Main_model->getSelectedData('siswa a', 'a.*')->result();
			$this->load->view('member/master/ajax_page/form_daftar_peserta_ujian',$data);
		}
	}
	public function ajax_function(){
		if($this->input->post('modul')=='detail_soal_ujian'){
			$pisah = explode('_',$this->input->post('id'));
			// echo 'id_siswa_to_modul '.$pisah[0];
			// echo '<br>id_soal_to_modul '.$pisah[1];
			$data['identity'] = $pisah[0];
			$data['no_soal'] = $pisah[2];
			$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*,b.id_soal_to_modul,b.id_modul', array('md5(b.id_soal_to_modul)'=>$pisah[1]), '', '', '', '', array(
				'table' => 'soal_to_modul b',
				'on' => 'a.id_soal=b.id_soal',
				'pos' => 'RIGHT'
			))->result();
			$this->load->view('member/master/ajax_page/detail_soal_ujian',$data);
		}
	}
}