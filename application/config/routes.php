<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['posts/user_post'] = 'posts/user_post';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'register/userRegister';
$route['api/register'] = 'api/register';
$route['login'] = 'login';

$route['posts/vote_answer/(:num)/(:any)'] = 'posts/vote_answer/$1/$2';
$route['posts/vote_question/(:num)/(:any)'] = 'posts/vote_question/$1/$2';

$route['posts/search'] = 'posts/search';
