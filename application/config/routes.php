<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['overview'] = 'overview/index';
$route['users'] = 'users/index';
$route['login'] = 'site/index';
$route['dashboard'] = 'site/dashboard';
$route['myrequest'] = 'myrequest/index';
$route['mytask'] = 'mytask/index';
$route['logout'] = 'site/logout';
$route['task/(:num)'] = 'mytask/task/$1';
$route['monitoring'] = 'monitoring/index';
$route['mycalendar'] = 'mycalendar';
$route['category'] = 'category';
$route['notification'] = 'site/notification';
$route['manage_task'] = 'manage/index';
