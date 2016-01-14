<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
 * Home page route
 */
$route['default_controller'] = "IndexController";

/*
 * Sign-up route
 */
$route['sign-up'] = "AuthController/signUp";

/*
 * Login route
 */
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    //Get Method use AuthController and getLogin function
    $route['login'] = "AuthController/getLogin";
} elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Post Method use AuthController and postLogin function
    $route['login'] = "AuthController/postLogin";
}

/*
 * Logout route
 */
$route['logout'] = "AuthController/getLogout";

/*
 * Confirm account route
 */
$route['verify-account'] = 'AuthController/confirmAccount';

/*
 * Student Profile routes
 */
$route['student-profile/(:any)/timeline'] = 'Student/IndexController/profile/$1';
$route['student-profile/(:any)/about'] = 'Student/IndexController/about/$1';
$route['student-profile/(:any)/friends'] = 'Student/IndexController/friends/$1';
$route['student-profile/(:any)/edit-basic-info'] = 'Student/IndexController/showEditBasicInfo/$1';
$route['student-profile/(:any)'] = 'Student/IndexController/profile/$1';

/*
 * User actions routes
 */
$route['user-actions/save-basic-info'] = 'UserActionsController/saveBasicInfo';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */