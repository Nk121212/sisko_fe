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

//$route['login'] = 'auth/login_page';
$route['register'] = 'auth/register_page';

$route['login/action'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'home/dashboard';

$route['users/page'] = 'master/users_page';

$route['jenis_nilai/page'] = 'master/jnilai_page';
$route['murid/page'] = 'master/murid_page';
$route['option/page'] = 'master/option_page';


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

$route['user/page'] = 'master/user_page';
$route['getUserAll'] = 'table_json/get_user_all'; //datatable
$route['get_user_all'] = 'master/get_user_all'; //dipakai untuk global ex : select option
$route['user/add'] = 'master/add_user';
$route['user/get/id'] = 'master/get_user_by_id';
$route['user/update/id'] = 'master/update_user_by_id';
$route['user/delete/id'] = 'master/delete_user_by_id';

$route['getNilaiByNis'] = 'table_json/get_nilai_by_nis';