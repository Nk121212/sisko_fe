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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login_page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'auth/register_page';
$route['login/action'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'home/dashboard';


$route['guru/page'] = 'master/guru_page';
$route['getGuruAll'] = 'table_json/get_guru_all';
$route['get_guru_all'] = 'master/get_guru_all'; //dipakai untuk global ex : select option
$route['guru/add'] = 'master/add_guru';
$route['guru/get/nip'] = 'master/get_guru_by_nip';
$route['guru/update/nip'] = 'master/update_guru_by_nip';
$route['guru/delete/nip'] = 'master/delete_guru_by_nip';

$route['pelajaran/page'] = 'master/pelajaran_page';
$route['getPelajaranAll'] = 'table_json/get_pelajaran_all'; //datatable
$route['get_pelajaran_all'] = 'master/get_pelajaran_all'; //dipakai untuk global ex : select option
$route['pelajaran/add'] = 'master/add_pelajaran';
$route['pelajaran/get/id'] = 'master/get_pelajaran_by_id';
$route['pelajaran/update/id'] = 'master/update_pelajaran_by_id';
$route['pelajaran/delete/id'] = 'master/delete_pelajaran_by_id';

$route['users/page'] = 'master/users_page';
$route['getUserAll'] = 'table_json/get_user_all'; //datatable
$route['get_user_all'] = 'master/get_user_all'; //dipakai untuk global ex : select option
$route['user/add'] = 'master/add_user';
$route['user/get/id'] = 'master/get_user_by_id';
$route['user/update/id'] = 'master/update_user_by_id';
$route['user/delete/id'] = 'master/delete_user_by_id';

$route['jenis_nilai/page'] = 'master/jnilai_page';
$route['getJenisNilaiAll'] = 'table_json/get_jenisnilai_all'; //datatable
$route['get_jenisnilai_all'] = 'master/get_jenisnilai_all'; //dipakai untuk global ex : select option
$route['jenisnilai/add'] = 'master/add_jenisnilai';
$route['jenisnilai/get/id'] = 'master/get_jenisnilai_by_id';
$route['jenisnilai/update/id'] = 'master/update_jenisnilai_by_id';
$route['jenisnilai/delete/id'] = 'master/delete_jenisnilai_by_id';

$route['murid/page'] = 'master/murid_page';
$route['getMuridAll'] = 'table_json/get_murid_all'; //datatable
$route['get_murid_all'] = 'master/get_murid_all'; //dipakai untuk global ex : select option
$route['murid/add'] = 'master/add_murid';
$route['murid/get/id'] = 'master/get_murid_by_id';
$route['murid/update/id'] = 'master/update_murid_by_id';
$route['murid/delete/id'] = 'master/delete_murid_by_id';
$route['murid/get/class'] = 'master/get_murid_by_class';

$route['option/page'] = 'master/option_page';
$route['getOptionAll'] = 'table_json/get_option_all'; //datatable
$route['get_option_all'] = 'master/get_option_all'; //dipakai untuk global ex : select option
$route['option/add'] = 'master/add_option';
$route['option/get/id'] = 'master/get_option_by_id';
$route['option/update/id'] = 'master/update_option_by_id';
$route['option/delete/id'] = 'master/delete_option_by_id';

$route['role/page'] = 'master/role_page';
$route['getRoleAll'] = 'table_json/get_role_all'; //datatable
$route['get_role_all'] = 'master/get_role_all'; //dipakai untuk global ex : select option
$route['role/add'] = 'master/add_role';
$route['role/get/id'] = 'master/get_role_by_id';
$route['role/update/id'] = 'master/update_role_by_id';
$route['role/delete/id'] = 'master/delete_role_by_id';

$route['tingkat/page'] = 'master/tingkat_page';
$route['getTingkatAll'] = 'table_json/get_tingkat_all'; //datatable
$route['get_tingkat_all'] = 'master/get_tingkat_all'; //dipakai untuk global ex : select option
$route['tingkat/add'] = 'master/add_tingkat';
$route['tingkat/get/id'] = 'master/get_tingkat_by_id';
$route['tingkat/update/id'] = 'master/update_tingkat_by_id';
$route['tingkat/delete/id'] = 'master/delete_tingkat_by_id';

$route['kelas/page'] = 'master/kelas_page';
$route['getKelasAll'] = 'table_json/get_kelas_all'; //datatable
$route['get_kelas_all'] = 'master/get_kelas_all'; //dipakai untuk global ex : select option
$route['kelas/add'] = 'master/add_kelas';
$route['kelas/get/id'] = 'master/get_kelas_by_id';
$route['kelas/update/id'] = 'master/update_kelas_by_id';
$route['kelas/delete/id'] = 'master/delete_kelas_by_id';

$route['getNilaiByNis'] = 'table_json/get_nilai_by_nis';

$route['absen/page'] = 'transaksi/absen_page';
$route['absen/add'] = 'transaksi/add_absen';

$route['nilai/page'] = 'transaksi/nilai_page';