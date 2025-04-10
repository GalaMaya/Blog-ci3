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





$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';


// Dashboard
$route['dashboard'] = 'Dashboard/Home/index';

// user
$route['dashboard/user'] = 'Dashboard/Users/index';
$route['dashboard/user/add'] = 'Dashboard/Users/add';
$route['dashboard/user/save'] = 'Dashboard/Users/save';
$route['dashboard/user/edit/(:num)'] = 'Dashboard/Users/edit/$1';
$route['dashboard/user/update/(:num)'] = 'Dashboard/Users/update/$1';
$route['dashboard/user/delete/(:num)'] = 'Dashboard/Users/delete/$1';


// article
$route['dashboard/article'] = 'Dashboard/Article/index';
$route['dashboard/article/add'] = 'Dashboard/Article/add';
$route['dashboard/article/save'] = 'Dashboard/Article/save';
$route['dashboard/article/edit/(:num)'] = 'Dashboard/Article/edit/$1';
$route['dashboard/article/update/(:num)'] = 'Dashboard/Article/update/$1';
$route['dashboard/article/delete/(:num)'] = 'Dashboard/Article/delete/$1';
$route['dashboard/article/(:num)'] = 'Dashboard/Article/detail/$1';


$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// API routes
$route['api-v1/login']['post'] = 'API/Auth/login';

// users
$route['api-v1/user']['post'] = 'API/Users/add';
$route['api-v1/user']['get'] = 'API/Users/get';
$route['api-v1/user/(:num)']['get'] = 'API/Users/getById/$1';
$route['api-v1/user/(:num)']['put'] = 'API/Users/update/$1';
$route['api-v1/user/(:num)']['delete'] = 'API/Users/delete/$1';

// Articles
$route['api-v1/article']['post'] = 'API/Articles/add';
$route['api-v1/article']['get'] = 'API/Articles/get';
$route['api-v1/article/(:num)']['get'] = 'API/Articles/getById/$1';
$route['api-v1/article/(:num)']['post'] = 'API/Articles/update/$1';
$route['api-v1/article/(:num)']['delete'] = 'API/Articles/delete/$1';

// END API routes
