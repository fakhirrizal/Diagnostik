<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'Auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/* Auth */
$route['login'] = 'Auth/login';
$route['login_process'] = 'Auth/login_process';
$route['registrasi'] = 'Auth/registration';
$route['register_process'] = 'Auth/register_process';

/* Admin */
$route['admin_side/launcher'] = 'admin/App/launcher';
$route['admin_side/beranda'] = 'admin/App/home';
$route['admin_side/menu'] = 'admin/App/menu';
$route['admin_side/log_activity'] = 'admin/App/log_activity';
$route['admin_side/cleaning_log'] = 'admin/App/cleaning_log';
$route['admin_side/tentang_aplikasi'] = 'admin/App/about';
$route['admin_side/bantuan'] = 'admin/App/helper';

$route['admin_side/dasbor_peta'] = 'admin/Dashboard';
$route['admin_side/peta_provinsi/(:any)'] = 'admin/Dashboard/province/$1';
$route['admin_side/peta_kabupaten/(:any)'] = 'admin/Dashboard/city/$1';
$route['admin_side/peta_kecamatan/(:any)'] = 'admin/Dashboard/sub_district/$1';

$route['admin_side/dasbor_grafik'] = 'admin/Dashboard/main_graph';
$route['admin_side/dasbor_grafik_provinsi/(:any)/(:any)'] = 'admin/Dashboard/graph_province/$1/$2';
$route['admin_side/dasbor_grafik_kabupaten/(:any)/(:any)'] = 'admin/Dashboard/graph_region/$1/$2';
$route['admin_side/dasbor_grafik_kecamatan/(:any)/(:any)'] = 'admin/Dashboard/graph_district/$1/$2';

$route['admin_side/administrator'] = 'admin/Master/administrator_data';
$route['admin_side/tambah_data_admin'] = 'admin/Master/add_administrator_data';
$route['admin_side/simpan_data_admin'] = 'admin/Master/save_administrator_data';
$route['admin_side/detail_data_admin/(:any)'] = 'admin/Master/detail_administrator_data/$1';
$route['admin_side/ubah_data_admin/(:any)'] = 'admin/Master/edit_administrator_data/$1';
$route['admin_side/perbarui_data_admin'] = 'admin/Master/update_administrator_data';
$route['admin_side/atur_ulang_kata_sandi_admin/(:any)'] = 'admin/Master/reset_password_administrator_account/$1';
$route['admin_side/hapus_data_admin/(:any)'] = 'admin/Master/delete_administrator_data/$1';

$route['admin_side/data_anggota'] = 'admin/Master/member_data';
$route['admin_side/tambah_data_anggota'] = 'admin/Master/add_member_data';
$route['admin_side/simpan_data_anggota'] = 'admin/Master/save_member_data';
$route['admin_side/detail_data_anggota/(:any)'] = 'admin/Master/detail_member_data/$1';
$route['admin_side/ubah_data_anggota/(:any)'] = 'admin/Master/edit_member_data/$1';
$route['admin_side/atur_ulang_kata_sandi_anggota/(:any)'] = 'admin/Master/reset_password_member_account/$1';
$route['admin_side/hapus_data_anggota/(:any)'] = 'admin/Master/delete_member_data/$1';

$route['admin_side/kategori_soal'] = 'admin/Master/kategori_soal';
$route['admin_side/tambah_kategori_soal'] = 'admin/Master/tambah_kategori_soal';
$route['admin_side/simpan_kategori_soal'] = 'admin/Master/simpan_kategori_soal';
$route['admin_side/detail_kategori_soal/(:any)'] = 'admin/Master/detail_kategori_soal/$1';
$route['admin_side/perbarui_kategori_soal'] = 'admin/Master/perbarui_kategori_soal';
$route['admin_side/hapus_kategori_soal/(:any)'] = 'admin/Master/hapus_kategori_soal/$1';

$route['admin_side/soal'] = 'admin/Master/soal';
$route['admin_side/tambah_soal'] = 'admin/Master/tambah_soal';
$route['admin_side/simpan_soal'] = 'admin/Master/simpan_soal';
$route['admin_side/detail_soal/(:any)'] = 'admin/Master/detail_soal/$1';
$route['admin_side/perbarui_soal'] = 'admin/Master/perbarui_soal';
$route['admin_side/hapus_soal/(:any)'] = 'admin/Master/hapus_soal/$1';

$route['admin_side/master_modul'] = 'admin/Master/modul';
$route['admin_side/tambah_modul_ujian'] = 'admin/Master/tambah_modul';
$route['admin_side/simpan_data_modul'] = 'admin/Master/simpan_modul';
$route['admin_side/detail_modul/(:any)'] = 'admin/Master/detail_modul/$1';
$route['admin_side/perbarui_modul_ujian'] = 'admin/Master/perbarui_modul';
$route['admin_side/tambah_soal_modul'] = 'admin/Master/tambah_soal_modul';
$route['admin_side/tambah_siswa_modul'] = 'admin/Master/tambah_siswa_modul';
$route['admin_side/hapus_soal_dalam_modul/(:any)'] = 'admin/Master/hapus_soal_dalam_modul/$1';
$route['admin_side/hapus_siswa_dalam_modul/(:any)'] = 'admin/Master/hapus_siswa_dalam_modul/$1';
$route['admin_side/modul_locked/(:any)'] = 'admin/Master/modul_locked/$1';
$route['admin_side/hapus_modul/(:any)'] = 'admin/Master/hapus_modul/$1';

$route['admin_side/detail_jawaban_ujian/(:any)/(:any)'] = 'admin/Report/detail_jawaban_ujian/$1/$2';

$route['admin_side/cetak_hasil_ujian/(:any)'] = 'admin/Report/cetak_hasil_ujian/$1';

/* Siswa */
$route['member_side/beranda'] = 'member/App/home';
$route['member_side/tentang_aplikasi'] = 'member/App/about';

$route['member_side/master_modul'] = 'member/Master/modul';
$route['member_side/mulai_ujian/(:any)'] = 'member/Master/mulai_ujian/$1';
$route['member_side/detail_modul/(:any)'] = 'member/Master/detail_modul/$1';
$route['member_side/simpan_jawaban'] = 'member/Master/simpan_jawaban';
$route['member_side/selesai_ujian/(:any)'] = 'member/Master/selesai_ujian/$1';

/* REST API */
$route['api'] = 'Rest_server/documentation';

$route['api/login'] = 'api/auth/Login';
$route['api/change_password'] = 'api/auth/Change_password';

$route['api/indikator'] = 'api/master/Indikator';
$route['api/user_data'] = 'api/master/User_data';
$route['api/device'] = 'api/master/Device';
$route['api/provinsi'] = 'api/master/Provinsi';
$route['api/kabupaten'] = 'api/master/Kabupaten';
$route['api/kecamatan'] = 'api/master/Kecamatan';
$route['api/desa'] = 'api/master/Desa';

$route['api/hapus_laporan'] = 'api/Other/delete_report';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8