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
$route['default_controller'] = 'id';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)/view'] = $route['404_override'];
$route['(:any)/add'] = $route['404_override'];
$route['(:any)/edit'] = $route['404_override'];
$route['(:any)/delete'] = $route['404_override'];
$route['categories'] = $route['404_override'];
$route['slides'] = $route['404_override'];
$route['posts'] = $route['404_override'];
$route['clients'] = $route['404_override'];
$route['pages'] = $route['404_override'];
$route['services'] = $route['404_override'];
$route['web_app'] = $route['404_override'];
$route['brands'] = $route['404_override'];
$route['products'] = $route['404_override'];
$route['about_us'] = $route['404_override'];
$route['dashboard'] = $route['404_override'];
$route['events'] = $route['404_override'];
$route['en/product/category/(:any)'] ="en/category";
$route['id/product/category/(:any)'] ="id/category";
$route['en/products/(:num)'] ="en/products/$1";
$route['id/products/(:num)'] ="id/products/$1";
$route['en/product/(:any)'] ="en/product_detail";
$route['id/product/(:any)'] ="id/product_detail";
$route['en/blog/(:num)'] ="en/blog/$1";
$route['id/blog/(:num)'] ="id/blog/$1";
$route['en/events/(:num)'] ="en/events/$1";
$route['id/events/(:num)'] ="id/events/$1";
$route['en/blog/(:any)'] ="en/blog_detail";
$route['id/blog/(:any)'] ="id/blog_detail";
$route['en/blog/archive/(:num)'] ="en/blog_archive";
$route['id/blog/archive/(:num)'] ="id/blog_archive";
$route['en/p/(:any)'] ="en/page_detail";
$route['id/p/(:any)'] ="id/page_detail";
$route['en/brand/(:any)'] ="en/brand_detail";
$route['id/brand/(:any)'] ="id/brand_detail";
$route['en/about-us'] ="en/about_us";
$route['id/about-us'] ="id/about_us";
$route['en/services'] ="en/services";
$route['id/services'] ="id/services";
$route['id/contact-us'] ="id/contact_us";
$route['en/contact-us'] ="en/contact_us";
$route['id/thank-you'] ="id/thankyou";
$route['en/thank-you'] ="en/thankyou";
$route['id/ecatalogue-lkpp'] ="id/ecatalogue_lkpp";
$route['en/ecatalogue-lkpp'] ="en/ecatalogue_lkpp";

$route['admin/users/(.*)'] = 'users/auth/$1';
$route['admin/profile/edit/(:num)'] = 'users/auth/edit_user/$1';
$route['admin/profile/edit/user'] = 'admin/profile/edit/$1';
$route['login'] = 'users/auth/login';
$route['logout'] = 'users/auth/logout';
$route['admin/dashboard'] = 'dashboard/dashboard';
$route['admin/brands'] = 'brands/index';
$route['admin/brands/(.*)'] = 'brands/$1';
$route['admin/categories'] = 'categories/index';
$route['admin/categories/(.*)'] = 'categories/$1';
$route['admin/products/(.*)'] = 'products/$1';
$route['admin/products'] = 'products/index';
$route['admin/pages'] = 'pages/index';
$route['admin/pages/(.*)'] = 'pages/$1';
$route['admin/posts'] = 'posts/index';
$route['admin/posts/(.*)'] = 'posts/$1';
$route['admin/slides'] = 'slides/index';
$route['admin/slides/(.*)'] = 'slides/$1';
$route['admin/services'] = 'services/index';
$route['admin/services/(.*)'] = 'services/$1';
$route['admin/clients'] = 'clients/index';
$route['admin/clients/(.*)'] = 'clients/$1';
$route['admin/events'] = 'events/index';
$route['admin/events/(.*)'] = 'events/$1';
$route['admin/web_app'] = 'web_app/index';
$route['admin/web_app/(.*)'] = 'web_app/$1';
$route['admin/about-us'] = 'about_us/index';
$route['admin/messages'] = 'messages/index';
$route['admin/messages/(.*)'] = 'messages/$1';

// $route['(:any)'] = $route['404_override'];
