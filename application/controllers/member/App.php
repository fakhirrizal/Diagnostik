<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
	}
    public function home()
	{
		$data['parent'] = 'home';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('member/template/header',$data);
		$this->load->view('member/app/home',$data);
		$this->load->view('member/template/footer');
	}
	public function log_activity()
	{
		$data['parent'] = 'log_activity';
		$data['child'] = '';
		$data['grand_child'] = '';
		$data['data_tabel'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('a.user_id'=>$this->session->userdata('id')), "a.activity_time DESC",'','','',array(
			'table' => 'user_profile b',
			'on' => 'a.user_id=b.user_id',
			'pos' => 'LEFT'
		))->result();
		$this->load->view('member/template/header',$data);
		$this->load->view('member/app/log_activity',$data);
		$this->load->view('member/template/footer');
	}
	public function cleaning_log(){
		$this->db->trans_start();
		$this->Main_model->cleanData('activity_logs');
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/log_activity/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."member_side/log_activity/'</script>";
		}
	}
	public function about()
	{
		$data['parent'] = 'about';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('member/template/header',$data);
		$this->load->view('member/app/about',$data);
		$this->load->view('member/template/footer');
	}
	public function helper()
	{
		$data['parent'] = 'helper';
		$data['child'] = '';
		$data['grand_child'] = '';
		$this->load->view('member/template/header',$data);
		$this->load->view('member/app/helper',$data);
		$this->load->view('member/template/footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		echo "<script>window.location='".base_url('member_side/login')."'</script>";
	}
	/* Menu setting and user's permission */
	public function ajax_function(){
		if($this->input->post('modul')=='modul_detail_log_aktifitas'){
			$data['data_utama'] = $this->Main_model->getSelectedData('activity_logs a', 'a.*,b.fullname', array('md5(a.activity_id)'=>$this->input->post('id')), "",'','','',array(
				'table' => 'user_profile b',
				'on' => 'a.user_id=b.user_id',
				'pos' => 'LEFT'
			))->result();
			$this->load->view('member/app/ajax_detail_log_aktifitas',$data);
		}
	}
	public function ajax_page(){
		if($this->input->post('modul')=='beranda'){
			$data['berita'] = $this->Main_model->getSelectedData('berita a', 'a.*', '', "a.created_at DESC",'2')->result();
			$data['potensi_desa'] = $this->Main_model->getSelectedData('potensi_desa a', 'a.*', '', "a.created_at DESC",'1')->result();
			$this->load->view('member/app/ajax_page/beranda',$data);
		}elseif($this->input->post('modul')=='administrasi'){
			$this->load->view('member/app/ajax_page/administrasi');
		}elseif($this->input->post('modul')=='ekonomi'){
			$this->load->view('member/app/ajax_page/ekonomi');
		}elseif($this->input->post('modul')=='kependudukan'){
			$this->load->view('member/app/ajax_page/kependudukan');
		}
	}
}