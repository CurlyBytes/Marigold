<?php
defined('BASEPATH') or exit('No direct script access allowed');
$guidRegexWithCurlyBrackets = "/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/";
$guidRegex = "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}";
//TASK: UUI ID TO BIN in mysql? and multiple supporting language
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
// TASK http verbs $route['products']['put'] = 'product/insert';

$route['default_controller'] = 'welcome';
$route['404_override'] = 'PageNotFound';
$route['translate_uri_dashes'] = false;


// URI like '/en/about' -> use controller 'about'
$route['^(en|fil)/(.+)$'] = "$2";

// '/en', '/fil', '/fr'  URIs -> use default controller
$route['^(en|fil)$'] = $route['default_controller'];


$route['locationtype'] = 'locationtype/page/list';
$route['locationtype/create'] = "locationtype/page/create";
$route['locationtype/modify/(:any)'] = "locationtype/page/modify/$1";
$route['locationtype/remove/(:any)'] = "locationtype/page/remove/$1";
$route['locationtype/(:num)'] = 'locationtype/page/list/$1';
// $route['locationtype/add']['post'] = "locationtype/page/add";
// $route['locationtype/edit/(:any)']['put'] = "locationtype/page/edit/$1";
// $route['locationtype/delete/(:any)']['delete'] = "locationtype/page/delete/$1";

$route['api/locationtype/(:any)'] = 'locationtype/api/$1';


$route['region'] = 'region/page/list';
$route['region/create'] = "region/page/create";
$route['region/modify/(:any)'] = "region/page/modify/$1";
$route['region/remove/(:any)'] = "region/page/remove/$1";
$route['region/(:num)'] = 'region/page/list/$1';

$route['district'] = 'district/page/list';
$route['district/create'] = "district/page/create";
$route['district/modify/(:any)'] = "district/page/modify/$1";
$route['district/remove/(:any)'] = "district/page/remove/$1";
$route['district/(:num)'] = 'district/page/list/$1';


$route['area'] = 'area/page/list';
$route['area/create'] = "area/page/create";
$route['area/modify/(:any)'] = "area/page/modify/$1";
$route['area/remove/(:any)'] = "area/page/remove/$1";
$route['area/(:num)'] = 'area/page/list/$1';
//$route['(:any)'] = 'page/view/$1';
//$route['(:any)/add'] = 'page/add/$1';
//$route['(:any)/edit/(:any)'] = 'page/edit/$1/$2';

//TASK review remap
// $controllers=array('admin', 'user', 'blog', 'api');
// if(array_search($this->uri->segment(1), $controllers)){
//     $route['.*'] = "polica/ogled/$1";
// }