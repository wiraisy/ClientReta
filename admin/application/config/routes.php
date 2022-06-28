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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Pemesanan
$route['pemesanan'] = 'pemesanan';

// Order By Admin
$route['ordey-by-admin'] = 'pemesanan/orderByAdmin';
$route['checkout-by-admin'] = 'pemesanan/checkout';
$route['payment-by-admin/(:num)'] = 'pemesanan/payment/$1';
$route['payment-expired'] = 'pemesanan/expired';

// Chat
$route['chat'] = 'chat';

// Produk Link
$route['produk-link'] = 'produklink';

// Order by Admin
$route['order-by-admin'] = 'pemesanan/orderByAdmin';
$route['order-by-admin/checkout/(:num)/(:any)'] = 'pemesanan/checkout/$1/$2';

// Produk Umum
$route['produk-umum'] = 'produkumum';
$route['produk-umum/(:num)'] = 'produkumum/index_page/$1';
$route['update-produk-umum/(:num)'] = 'produkumum/update_produk/$1';
$route['produk-umum/search'] = 'produkumum/search';

// Produk Andalan
$route['produk-andalan'] = 'produkandalan';
$route['produk-andalan/(:num)'] = 'produkandalan/index_page/$1';
$route['update-produk-andalan/(:num)'] = 'produkandalan/update_produk/$1';
$route['produk-andalan/search'] = 'produkandalan/search';

// Import Data
$route['import-data'] = 'import';

// Export Data
$route['export-data'] = 'export';
$route['export-master'] = 'export/export_rule_admin';

// Auth
$route['login'] = 'auth/login';

// Pasien
$route['pasien-pageable'] = 'pasien/index_page';
$route['search-pasien'] = 'pasien/search_pasien';