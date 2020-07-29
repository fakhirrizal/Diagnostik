<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_model extends CI_Model{
	function getSelectedData($tbl_name, $select = '', $where = '', $order = '', $limit = '', $start = '0', $group = '', $join = '')
	{
		if (!empty($select))
			$this->db->select($select, false);
		if (!empty($where))
			$this->db->where($where);
		if (!empty($order))
			$this->db->order_by($order);
		if (!empty($limit))
			$this->db->limit($limit, $start);
		if (!empty($group))
			$this->db->group_by($group);
		if (!empty($join) && is_array($join)) {
			if (!empty($join['table']) && !empty($join['on'])) {
				$join = array($join);
			}

			foreach ($join as $item) {
				if (!empty($item['table']) && !empty($item['on'])) {
					if (!empty($item['pos'])) {
						$this->db->join($item['table'], $item['on'], $item['pos']);
					} else {
						$this->db->join($item['table'], $item['on']);
					}
				}
			}
		}

		return $this->db->get($tbl_name);
	}
	function cek_jawaban_matching($id_soal,$poin_matching,$jawaban)
	{
		$balikan = '';
		$get_soal = $this->getSelectedData('soal a','a.*',array('a.id_soal'=>$id_soal))->row();
		$jawaban_benar = '';
		if($poin_matching=='1'){
			$jawaban_benar = $get_soal->jawaban_1;
		}elseif($poin_matching=='2'){
			$jawaban_benar = $get_soal->jawaban_2;
		}elseif($poin_matching=='3'){
			$jawaban_benar = $get_soal->jawaban_3;
		}elseif($poin_matching=='4'){
			$jawaban_benar = $get_soal->jawaban_4;
		}elseif($poin_matching=='5'){
			$jawaban_benar = $get_soal->jawaban_5;
		}else{
			echo'';
		}
		$value_jawaban = '';
		if($jawaban=='A' OR $jawaban=='a'){
			$value_jawaban = $get_soal->random_pilihan_1;
		}elseif($jawaban=='B' OR $jawaban=='b'){
			$value_jawaban = $get_soal->random_pilihan_2;
		}elseif($jawaban=='C' OR $jawaban=='c'){
			$value_jawaban = $get_soal->random_pilihan_3;
		}elseif($jawaban=='D' OR $jawaban=='d'){
			$value_jawaban = $get_soal->random_pilihan_4;
		}elseif($jawaban=='E' OR $jawaban=='e'){
			$value_jawaban = $get_soal->random_pilihan_5;
		}else{
			echo'';
		}
		if($value_jawaban==$jawaban_benar){
			$balikan = '(<b>Benar</b>)';
		}else{
			if($poin_matching=='1'){
				if($get_soal->jawaban_1==$get_soal->random_pilihan_1){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>A</b>)';
				}elseif($get_soal->jawaban_1==$get_soal->random_pilihan_2){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>B</b>)';
				}elseif($get_soal->jawaban_1==$get_soal->random_pilihan_3){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>C</b>)';
				}elseif($get_soal->jawaban_1==$get_soal->random_pilihan_4){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>D</b>)';
				}elseif($get_soal->jawaban_1==$get_soal->random_pilihan_5){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>E</b>)';
				}else{
					echo'';
				}
			}elseif($poin_matching=='2'){
				if($get_soal->jawaban_2==$get_soal->random_pilihan_1){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>A</b>)';
				}elseif($get_soal->jawaban_2==$get_soal->random_pilihan_2){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>B</b>)';
				}elseif($get_soal->jawaban_2==$get_soal->random_pilihan_3){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>C</b>)';
				}elseif($get_soal->jawaban_2==$get_soal->random_pilihan_4){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>D</b>)';
				}elseif($get_soal->jawaban_2==$get_soal->random_pilihan_5){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>E</b>)';
				}else{
					echo'';
				}
			}elseif($poin_matching=='3'){
				if($get_soal->jawaban_3==$get_soal->random_pilihan_1){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>A</b>)';
				}elseif($get_soal->jawaban_3==$get_soal->random_pilihan_2){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>B</b>)';
				}elseif($get_soal->jawaban_3==$get_soal->random_pilihan_3){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>C</b>)';
				}elseif($get_soal->jawaban_3==$get_soal->random_pilihan_4){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>D</b>)';
				}elseif($get_soal->jawaban_3==$get_soal->random_pilihan_5){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>E</b>)';
				}else{
					echo'';
				}
			}elseif($poin_matching=='4'){
				if($get_soal->jawaban_4==$get_soal->random_pilihan_1){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>A</b>)';
				}elseif($get_soal->jawaban_4==$get_soal->random_pilihan_2){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>B</b>)';
				}elseif($get_soal->jawaban_4==$get_soal->random_pilihan_3){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>C</b>)';
				}elseif($get_soal->jawaban_4==$get_soal->random_pilihan_4){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>D</b>)';
				}elseif($get_soal->jawaban_4==$get_soal->random_pilihan_5){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>E</b>)';
				}else{
					echo'';
				}
			}elseif($poin_matching=='5'){
				if($get_soal->jawaban_5==$get_soal->random_pilihan_1){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>A</b>)';
				}elseif($get_soal->jawaban_5==$get_soal->random_pilihan_2){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>B</b>)';
				}elseif($get_soal->jawaban_5==$get_soal->random_pilihan_3){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>C</b>)';
				}elseif($get_soal->jawaban_5==$get_soal->random_pilihan_4){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>D</b>)';
				}elseif($get_soal->jawaban_5==$get_soal->random_pilihan_5){
					$balikan = '(<b>Salah</b>, jawaban benar adalah <b>E</b>)';
				}else{
					echo'';
				}
			}else{
				echo'';
			}
		}
		return $balikan;
	}
	function insertData($table,$data)
	{
		$res = $this->db->insert($table,$data);
		return $res;
		}
	function cleanData($table)
	{
		$q = $this->db->query("TRUNCATE TABLE $table");
		return $q;
	}
	function getAlldata($table)
	{
		return $this->db->get($table)->result();
	}
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	function log_activity($user_id,$activity_type,$activity_data,$location = '')
	{
		$device = '';
		if ($this->agent->is_mobile()){
			$device = $this->agent->mobile();
		}else{
			if ($this->agent->is_browser()){
				$device = 'PC';
			}else{
				echo'';
			}
		}
		$activity_log = array(
			'user_id' => $user_id,
			'activity_type' => $activity_type,
			'activity_data' => $activity_data,
			'activity_time' => date('Y-m-d H-i-s'),
			'activity_ip_address' => $this->input->ip_address(),
			'activity_device' => $device,
			'activity_os' => $this->agent->platform(),
			'activity_browser' => $this->agent->browser().' '.$this->agent->version(),
			'activity_location' => $location
		);
		$this->insertData('activity_logs',$activity_log);
	}
	function getLastID($table,$column)
	{
		return $this->db->query('SELECT '.$column.' FROM '.$table.' ORDER BY '.$column.' DESC LIMIT 1')->row_array();
	}
	function convert_tanggal($tanggalan)
	{
		$tanggal_tampil = '';
		$waktu = explode('-', $tanggalan);
		if ($waktu[1]=="01") {
			$tanggal_tampil = $waktu[2]." Januari ".$waktu[0];
		}elseif ($waktu[1]=="02") {
			$tanggal_tampil = $waktu[2]." Februari ".$waktu[0];
		}elseif ($waktu[1]=="03") {
			$tanggal_tampil = $waktu[2]." Maret ".$waktu[0];
		}elseif ($waktu[1]=="04") {
			$tanggal_tampil = $waktu[2]." April ".$waktu[0];
		}elseif ($waktu[1]=="05") {
			$tanggal_tampil = $waktu[2]." Mei ".$waktu[0];
		}elseif ($waktu[1]=="06") {
			$tanggal_tampil = $waktu[2]." Juni ".$waktu[0];
		}elseif ($waktu[1]=="07") {
			$tanggal_tampil = $waktu[2]." Juli ".$waktu[0];
		}elseif ($waktu[1]=="08") {
			$tanggal_tampil = $waktu[2]." Agustus ".$waktu[0];
		}elseif ($waktu[1]=="09") {
			$tanggal_tampil = $waktu[2]." September ".$waktu[0];
		}elseif ($waktu[1]=="10") {
			$tanggal_tampil = $waktu[2]." Oktober ".$waktu[0];
		}elseif ($waktu[1]=="11") {
			$tanggal_tampil = $waktu[2]." November ".$waktu[0];
		}elseif ($waktu[1]=="12") {
			$tanggal_tampil = $waktu[2]." Desember ".$waktu[0];
		}
		return $tanggal_tampil;
	}
	public function convert_hari($date)
	{
		$daftar_hari = array(
			'Sunday' => 'Minggu',
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jumat',
			'Saturday' => 'Sabtu'
		);
		$namahari = date('l', strtotime($date));
		return $daftar_hari[$namahari];
	}
}