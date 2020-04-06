<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Administrator */
	public function administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_admin(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '1'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['username'] = $value->username;
			$isi['total_login'] = number_format($value->total_login,0).'x';
			$pecah_tanggal = explode(' ',$value->last_activity);
			$isi['last_activity'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_admin/'.md5($value->id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_admin/'.md5($value->id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_admin/'.md5($value->id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$data['prov'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_administrator_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'fullname' => $this->input->post('nama')
			);
			$this->Main_model->insertData('user_profile',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '1'
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Admin (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
		}
	}
	public function detail_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		// $data['data_utama'] =  $this->Main_model->getSelectedData('kube a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_pembayaran'] = $this->Main_model->getSelectedData('purchasing a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_kehadiran'] = $this->Main_model->getSelectedData('presence a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result_array();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function edit_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.*', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_administrator_data(){
		if($this->input->post('un')!=NULL){
			$cek_ = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$this->input->post('un')."' AND md5(a.id) NOT IN ('".$this->input->post('user_id')."')")->row();
			if($cek_==NULL){
				$this->db->trans_start();
				if($this->input->post('ps')!=NULL){
					$data_insert1 = array(
						'username' => $this->input->post('un'),
						'pass' => $this->input->post('ps')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				else{
					$data_insert1 = array(
						'username' => $this->input->post('un')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}

				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
				}
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
		}elseif($this->input->post('ps')!=NULL){
			$this->db->trans_start();

			$data_insert1 = array(
				'pass' => $this->input->post('ps')
			);
			$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
			// print_r($data_insert1);

			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function reset_password_administrator_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update admin's data","Reset password admin's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function download_admin_data(){
		$this->load->view('admin/master/cetak_data_admin');
	}
	public function delete_administrator_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_profile',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting admin's data","Delete admin's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	/* Member */
	public function member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_member(){
		$get_data1 = $this->Main_model->getSelectedData('siswa a', 'a.*,b.is_active',array('b.deleted' => '0'),'','','','',array(
			array(
				'table' => 'user b',
				'on' => 'a.user_id=b.id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->user_id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->nama;
			$isi['role'] = 'Siswa';
			if($value->is_active=='1'){
				$isi['status'] = '<span class="label label-success"> Aktif </span>';
			}else{
				$isi['status'] = '<span class="label label-danger"> Tidak Aktif </span>';
			}
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_data_anggota/'.md5($value->user_id)).'">
												<i class="icon-eye"></i> Detail Data </a>
										</li>
										<li>
											<a href="'.site_url('admin_side/ubah_data_anggota/'.md5($value->user_id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_anggota/'.md5($value->user_id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_anggota/'.md5($value->user_id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$get_data2 = $this->Main_model->getSelectedData('guru a', 'a.*,b.is_active',array('b.deleted' => '0'),'','','','',array(
			array(
				'table' => 'user b',
				'on' => 'a.user_id=b.id',
				'pos' => 'LEFT'
			)
		))->result();
		foreach ($get_data2 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->user_id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->nama;
			$isi['role'] = 'Guru';
			if($value->is_active=='1'){
				$isi['status'] = '<span class="label label-success"> Aktif </span>';
			}else{
				$isi['status'] = '<span class="label label-danger"> Tidak Aktif </span>';
			}
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_anggota/'.md5($value->user_id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_anggota/'.md5($value->user_id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_anggota/'.md5($value->user_id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_member_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'fullname' => $this->input->post('nama'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			if($this->input->post('role')=='2'){
				$data_insert2 = array(
					'user_id' => $get_user_id['id']+1,
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat')
				);
				$this->Main_model->insertData('guru',$data_insert2);
				// print_r($data_insert2);
			}else{
				$data_insert2 = array(
					'user_id' => $get_user_id['id']+1,
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat')
				);
				$this->Main_model->insertData('siswa',$data_insert2);
				// print_r($data_insert2);
			}
			
			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => $this->input->post('role')
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Pengguna (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
		}
		
	}
	public function detail_member_data(){
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$cek_role = $this->Main_model->getSelectedData('user_to_role a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		if($cek_role->role_id=='3'){
			$data['data_utama'] = $this->Main_model->getSelectedData('siswa a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result();
		}else{
			// guru
			echo'';
		}
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function edit_member_data(){
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$cek_role = $this->Main_model->getSelectedData('user_to_role a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		if($cek_role->role_id=='3'){
			$data['data_utama'] = $this->Main_model->getSelectedData('siswa a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result();
		}else{
			$data['data_utama'] = $this->Main_model->getSelectedData('guru a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result();
		}
		$data['role'] = $cek_role->role_id;
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function reset_password_member_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user a', 'a.*',array('md5(a.id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update member's data","Reset password member's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	public function delete_member_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_to_role a', 'a.*,b.fullname', array('md5(a.user_id)'=>$this->uri->segment(3)), '', '', '', '', array(
			'table' => 'user b',
			'on' => 'a.user_id=b.id',
			'pos' => 'LEFT'
		))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		if($get_data->role_id=='2'){
			$this->Main_model->deleteData('guru',array('user_id'=>$user_id));
		}else{
			$this->Main_model->deleteData('siswa',array('user_id'=>$user_id));
		}
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting member's data","Delete member's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	/* Master Kategori Soal*/
	public function kategori_soal(){
		$data['parent'] = 'master';
        $data['child'] = 'kategori_soal';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/kategori_soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_kategori_soal(){
		$get_data = $this->Main_model->getSelectedData('kategori_soal a', 'a.*', array('a.deleted'=>'0'))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->kategori_soal;
			$get_jumlah_soal = $this->Main_model->getSelectedData('soal a', 'a.*', array('a.id_kategori_soal'=>$value->id_kategori_soal,'a.deleted'=>'0'))->result();
			$isi['isi'] = count($get_jumlah_soal).' Soal';
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_kategori_soal/'.md5($value->id_kategori_soal)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_kategori_soal/'.md5($value->id_kategori_soal)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_kategori_soal(){
		$data['parent'] = 'master';
        $data['child'] = 'kategori_soal';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_kategori_soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_kategori_soal(){
		$this->db->trans_start();
		$get_last_id = $this->Main_model->getLastID('kategori_soal','id_kategori_soal');
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/kategori_soal/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_ = array(
					'id_kategori_soal' => $get_last_id['id_kategori_soal']+1,
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi'),
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->Main_model->insertData("kategori_soal",$data_insert_);
			}
		}else{echo'';}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data kategori_soal",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal/'</script>";
		}
	}
	public function detail_kategori_soal(){
		$data['parent'] = 'master';
        $data['child'] = 'kategori_soal';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('kategori_soal a', 'a.*',array('md5(a.id_kategori_soal)'=>$this->uri->segment(3)))->result();
		$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*',array('md5(a.id_kategori_soal)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/detail_kategori_soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_kategori_soal(){
		$this->db->trans_start();
		$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/kategori_soal/'; // path folder
		$config['allowed_types'] = 'jpg|jpeg|png|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['file_name'] = $nmfile; // nama yang terupload nantinya

		$this->upload->initialize($config);
		if(isset($_FILES['file']['name']))
		{
			if(!$this->upload->do_upload('file'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$data_insert_1 = array(
					'judul' => $this->input->post('judul'),
					'foto' => $gbr['file_name'],
					'isi' => $this->input->post('isi')
				);
				$this->Main_model->updateData('kategori_soal',$data_insert_1,array('md5(id_kategori_soal)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert_2 = array(
			'judul' => $this->input->post('judul'),
			'isi' => $this->input->post('isi')
		);
		$this->Main_model->updateData('kategori_soal',$data_insert_2,array('md5(id_kategori_soal)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data kategori_soal (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal/'</script>";
		}
	}
	public function hapus_kategori_soal(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('kategori_soal a', 'a.*',array('md5(a.id_kategori_soal)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_kategori_soal;
		$nama = $get_data->kategori_soal;

		// $this->Main_model->deleteData('kategori_soal',array('id_kategori_soal'=>$id));
		$this->Main_model->updateData('kategori_soal',array('deleted'=>'1'),array('md5(id_kategori_soal)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data kategori soal (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/kategori_soal/'</script>";
		}
	}
	/* Data Soal */
	public function soal(){
		$data['parent'] = 'master';
        $data['child'] = 'soal';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_soal(){
		$get_data = $this->Main_model->getSelectedData('soal a', 'a.*,b.kategori_soal', array('a.deleted'=>'0'), '', '', '', '', array(
			'table' => 'kategori_soal b',
			'on' => 'a.id_kategori_soal=b.id_kategori_soal',
			'pos' => 'LEFT'
		))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->pertanyaan;
			$isi['isi'] = $value->kategori_soal;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_soal/'.md5($value->id_soal)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_soal/'.md5($value->id_soal)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_soal(){
		$data['parent'] = 'master';
        $data['child'] = 'soal';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_soal(){
		$this->db->trans_start();
		$img = '';
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/soal/';
		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['max_width']  = '5000'; // lebar maksimum 5000 px
		$config['max_height']  = '5000'; // tinggi maksimu 5000 px
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['gambar']['name']))
		{
			if(!$this->upload->do_upload('gambar'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$img = $gbr['file_name'];
			}
		}else{echo'';}
		$data_insert_1 = array(
			'image' => $img,
			'pertanyaan' => $this->input->post('isi'),
			'pilihan_1' => $this->input->post('1'),
			'pilihan_2' => $this->input->post('2'),
			'pilihan_3' => $this->input->post('3'),
			'pilihan_4' => $this->input->post('4'),
			'pilihan_5' => $this->input->post('5'),
			'jawaban' => $this->input->post('answer'),
			'alasan_1' => $this->input->post('a'),
			'alasan_2' => $this->input->post('b'),
			'alasan_3' => $this->input->post('c'),
			'alasan_4' => $this->input->post('d'),
			'alasan_5' => $this->input->post('e'),
			'alasan_benar' => $this->input->post('alesan')
		);
		$this->Main_model->insertData('soal',$data_insert_1);
		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data soal",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal/'</script>";
		}
	}
	public function detail_soal(){
		$data['parent'] = 'master';
        $data['child'] = 'soal';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('soal a', 'a.*',array('md5(a.id_soal)'=>$this->uri->segment(3)))->row();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/ubah_soal',$data);
        $this->load->view('admin/template/footer');
	}
	public function perbarui_soal(){
		$this->db->trans_start();
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/soal/';
		$config['allowed_types'] = 'jpg|png|jpeg|bmp'; // type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; // maksimum besar file 3M
		$config['max_width']  = '5000'; // lebar maksimum 5000 px
		$config['max_height']  = '5000'; // tinggi maksimu 5000 px
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['gambar']['name']))
		{
			if(!$this->upload->do_upload('gambar'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$this->Main_model->updateData('soal',array('image'=>$gbr['file_name']),array('md5(id_soal)'=>$this->input->post('id')));
			}
		}else{echo'';}
		$data_insert_1 = array(
			'pertanyaan' => $this->input->post('isi'),
			'pilihan_1' => $this->input->post('1'),
			'pilihan_2' => $this->input->post('2'),
			'pilihan_3' => $this->input->post('3'),
			'pilihan_4' => $this->input->post('4'),
			'pilihan_5' => $this->input->post('5'),
			'jawaban' => $this->input->post('answer'),
			'alasan_1' => $this->input->post('a'),
			'alasan_2' => $this->input->post('b'),
			'alasan_3' => $this->input->post('c'),
			'alasan_4' => $this->input->post('d'),
			'alasan_5' => $this->input->post('e'),
			'alasan_benar' => $this->input->post('alesan')
		);
		$this->Main_model->updateData('soal',$data_insert_1,array('md5(id_soal)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data soal (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal/'</script>";
		}
	}
	public function hapus_soal(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('soal a', 'a.*',array('md5(a.id_soal)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_soal;
		$nama = $get_data->pertanyaan;

		// $this->Main_model->deleteData('soal',array('id_soal'=>$id));
		$this->Main_model->updateData('soal',array('deleted'=>'1'),array('md5(id_soal)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data soal (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/soal/'</script>";
		}
	}
	/* Modul Ujian */
	public function modul(){
		$data['parent'] = 'modul_ujian';
        $data['child'] = 'master_modul';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/modul',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_modul_ujian(){
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*', array('a.deleted'=>'0'))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['judul'] = $value->judul;
			$soal = 0;
			if($value->jumlah_soal==NULL){
				echo'';
			}else{
				$soal = $value->jumlah_soal;
			}
			$peserta = 0;
			if($value->jumlah_peserta==NULL){
				echo'';
			}else{
				$peserta = $value->jumlah_peserta;
			}
			$isi['soal'] = $soal.' Soal';
			$isi['isi'] = $peserta.' Siswa';
			$isi['durasi'] = $value->durasi.' Menit';
			$dari = $this->Main_model->convert_tanggal(substr($value->waktu_pelaksanaan,0,10));
			$sampai = $this->Main_model->convert_tanggal(substr($value->waktu_pelaksanaan,18,10));
			$isi['waktu'] = $dari.' - '.$sampai;
			$return_on_click = "return confirm('Anda yakin?')";
			$if_hapus = '';
			if($value->locked=='1'){
				$if_hapus = '<a href="#">';
			}else{
				$if_hapus = '<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_modul/'.md5($value->id_modul)).'">';
			}
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/detail_modul/'.md5($value->id_modul)).'">
												<i class="icon-action-redo"></i> Detail Data </a>
										</li>
										<li>
											'.$if_hapus.'
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_modul(){
		$data['parent'] = 'modul_ujian';
        $data['child'] = 'master_modul';
		$data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_modul',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_modul(){
		$this->db->trans_start();
		$data_insert = array(
			'judul' => $this->input->post('nama'),
			'instruksi' => $this->input->post('instruksi'),
			'durasi' => $this->input->post('durasi'),
			'waktu_pelaksanaan' => date('Y-m-d', strtotime($this->input->post('from'))).' sampai '.date('Y-m-d', strtotime($this->input->post('to')))
		);
		$this->Main_model->insertData('modul',$data_insert);
		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data modul",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_modul_ujian'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/master_modul/'</script>";
		}
	}
	public function detail_modul(){
		$data['parent'] = 'modul_ujian';
        $data['child'] = 'master_modul';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->uri->segment(3)))->row();
		$cek = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		if($cek->locked=='0'){
			$this->load->view('admin/master/ubah_modul',$data);
		}else{
			$this->load->view('admin/master/detail_modul',$data);
		}
        $this->load->view('admin/template/footer');
	}
	public function perbarui_modul(){
		$this->db->trans_start();
		$data_insert = array(
			'judul' => $this->input->post('1'),
			'instruksi' => $this->input->post('instruksi'),
			'durasi' => $this->input->post('2'),
			'waktu_pelaksanaan' => date('Y-m-d', strtotime($this->input->post('from'))).' sampai '.date('Y-m-d', strtotime($this->input->post('to')))
		);
		$this->Main_model->updateData('modul',$data_insert,array('md5(id_modul)'=>$this->input->post('id')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data modul (".$this->input->post('judul').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id')."'</script>";
		}
	}
	public function tambah_soal_modul(){
		$this->db->trans_start();
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->input->post('id_mod')))->row();
		$jumlah_soal = 0;
		for ($i=0; $i < count($this->input->post('soalku')); $i++) { 
			$jumlah_soal++;
			$data_insert = array(
				'id_modul' => $get_data->id_modul,
				'id_soal' => $this->input->post('soalku')[$i]
			);
			// print_r($data_insert);
			$this->Main_model->insertData('soal_to_modul',$data_insert);
		}
		$total_soal = ($get_data->jumlah_soal)+$jumlah_soal;
		// echo $total_soal;
		$this->Main_model->updateData('modul',array('jumlah_soal'=>$total_soal),array('md5(id_modul)'=>$this->input->post('id_mod')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data modul (".$get_data->judul.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id_mod')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id_mod')."'</script>";
		}
	}
	public function tambah_siswa_modul(){
		$this->db->trans_start();
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->input->post('id_mod')))->row();
		$jumlah_siswa = 0;
		for ($i=0; $i < count($this->input->post('siswa')); $i++) { 
			$jumlah_siswa++;
			$get_data_user = $this->Main_model->getSelectedData('siswa a', 'a.*',array('a.id_siswa'=>$this->input->post('siswa')[$i]))->row();
			$data_insert = array(
				'id_modul' => $get_data->id_modul,
				'id_siswa' => $this->input->post('siswa')[$i],
				'user_id' => $get_data_user->user_id
			);
			// print_r($data_insert);
			$this->Main_model->insertData('siswa_to_modul',$data_insert);
		}
		$total_siswa = ($get_data->jumlah_peserta)+$jumlah_siswa;
		// echo $total_siswa;
		$this->Main_model->updateData('modul',array('jumlah_peserta'=>$total_siswa),array('md5(id_modul)'=>$this->input->post('id_mod')));
		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Memperbarui data modul (".$get_data->judul.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id_mod')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$this->input->post('id_mod')."'</script>";
		}
	}
	public function hapus_soal_dalam_modul(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$soal = '';
		$get_data = $this->Main_model->getSelectedData('soal_to_modul a', 'a.*,b.judul,b.jumlah_soal,c.pertanyaan', array('md5(a.id_soal_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'modul b',
				'on' => 'a.id_modul=b.id_modul',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'soal c',
				'on' => 'a.id_soal=c.id_soal',
				'pos' => 'LEFT'
			)
		))->row();
		$id = $get_data->id_modul;
		$nama = $get_data->judul;
		$soal = $get_data->pertanyaan;
		$total_soal = ($get_data->jumlah_soal)-1;

		$this->Main_model->deleteData('soal_to_modul',array('id_soal_to_modul'=>$get_data->id_soal_to_modul));
		$this->Main_model->updateData('modul',array('jumlah_soal'=>$total_soal),array('id_modul'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data soal (".$soal.") dalam sebuah modul (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".md5($id)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".md5($id)."'</script>";
		}
	}
	public function hapus_siswa_dalam_modul(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$siswa = '';
		$get_data = $this->Main_model->getSelectedData('siswa_to_modul a', 'a.*,b.judul,b.jumlah_peserta,c.nama', array('md5(a.id_siswa_to_modul)'=>$this->uri->segment(3)), '', '', '', '', array(
			array(
				'table' => 'modul b',
				'on' => 'a.id_modul=b.id_modul',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'siswa c',
				'on' => 'a.id_siswa=c.id_siswa',
				'pos' => 'LEFT'
			)
		))->row();
		$id = $get_data->id_modul;
		$nama = $get_data->judul;
		$siswa = $get_data->nama;
		$total_siswa = ($get_data->jumlah_peserta)-1;

		$this->Main_model->deleteData('siswa_to_modul',array('id_siswa_to_modul'=>$get_data->id_siswa_to_modul));
		$this->Main_model->updateData('modul',array('jumlah_peserta'=>$total_siswa),array('id_modul'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data peserta (".$siswa.") dalam sebuah ujian (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".md5($id)."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".md5($id)."'</script>";
		}
	}
	public function modul_locked(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->uri->segment(3)))->row();
		$id = md5($get_data->id_modul);
		$nama = $get_data->judul;

		$this->Main_model->updateData('modul',array('locked'=>'1'),array('md5(id_modul)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Updating data","Memperbarui data modul (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$id."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detail_modul/".$id."'</script>";
		}
	}
	public function hapus_modul(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$get_data = $this->Main_model->getSelectedData('modul a', 'a.*',array('md5(a.id_modul)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_modul;
		$nama = $get_data->judul;

		$this->Main_model->deleteData('modul',array('id_modul'=>$id));
		$this->Main_model->deleteData('siswa_to_modul',array('id_modul'=>$id));
		$this->Main_model->deleteData('soal_to_modul',array('id_modul'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data modul (".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/master_modul/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/master_modul/'</script>";
		}
	}
	/* Other Function */
	public function ajax_page(){
		if($this->input->post('modul')=='tabel_soal_berdasarkan_kategori'){
			$data['soal'] = $this->Main_model->getSelectedData('soal a', 'a.*',array('md5(a.id_kategori_soal)'=>$this->input->post('data'),'a.deleted'=>'0'))->result();
			$this->load->view('admin/master/ajax_page/tabel_soal_berdasarkan_kategori',$data);
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
	public function ajax_function(){
		if($this->input->post('modul')=='username_check'){
			$data = $this->Main_model->getSelectedData('user a', 'a.*', array('a.username'=>$this->input->post('username')))->result();
			if($data==NULL){
				echo 'Username tersedia';
			}else{
				echo '<font color="red">Username tidak tersedia</font>';
			}
		}
		elseif($this->input->post('modul')=='get_kabupaten_by_id_provinsi'){
			$data = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('a.id_provinsi'=>$this->input->post('id')))->result();
			echo'<option value="">-- Pilih Kabupaten/ Kota --</option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kabupaten.'">'.$value->nm_kabupaten.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_kecamatan_by_id_kabupaten'){
			$data = $this->Main_model->getSelectedData('kecamatan a', 'a.*', array('a.id_kabupaten'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kecamatan.'">'.$value->nm_kecamatan.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_desa_by_id_kecamatan'){
			$data = $this->Main_model->getSelectedData('desa a', 'a.*', array('a.id_kecamatan'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_desa.'">'.$value->nm_desa.'</option>';
			}
		}
	}
}