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
$route['default_controller'] = 'App';
$route['404_override'] = '';
$route['login'] = 'App/myLogin';
$route['logout'] = 'App/logout';
$route['profile'] = 'App/MyProfile';
$route['des/(.+)'] = 'App/desBooking/$1';
$route['book'] = 'App/home';
$route['booking_detail'] = 'App/yourmoves';
$route['mycard'] = 'App/Cards';
$route['promocancel'] = 'App/cancelpromocode';
$route['free_moves'] = 'App/freeMove';
$route['feedback'] = 'App/feedback';
$route['refercode'] = 'App/ApplyreferCode';
$route['applyrefer'] = 'App/apply_refre_code';
$route['datapro'] = 'App/prodata';
$route['promoretry'] = 'App/retrypromo';
$route['add_card'] = 'App/AddCard';
$route['create'] = 'App/create';
$route['card_del/(.+)'] = 'App/deleteCard/$1';
$route['movelist'] = 'App/yourMoveListData';
$route['movedetail/(.+)'] = 'App/MoveDetails/$1';
$route['location'] = 'App/page1';
$route['vehcile'] = 'App/page3';
$route['pickup'] = 'App/page4';
$route['recipt'] = 'App/page5';
$route['moving'] = 'App/page9';
$route['book_order'] = 'App/page2';
$route['promo'] = 'App/promocode';
$route['find/(.+)'] = 'App/page6/$1';
$route['mover/(.+)'] = 'App/MoverFound/$1';
$route['book_cancel/(.+)'] = 'App/cancelbook/$1';
$route['editmove/(.+)'] = 'App/Edit_Move/$1';
$route['receipt/(.+)'] = 'App/recipt/$1';
$route['translate_uri_dashes'] = FALSE;
