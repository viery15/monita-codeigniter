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
$route['logout'] = 'site/logout';
