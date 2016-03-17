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
 * Home page route and other pages
 */
$route['default_controller'] = "IndexController";
$route['contact-us'] = "IndexController/getContactUs";
$route['passwords/reset'] = 'IndexController/getResetPasswords';

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
$route['student-profile/(:any)/add-education'] = 'Student/IndexController/showAddEducation/$1';
$route['student-profile/(:any)/add-work'] = 'Student/IndexController/showAddWork/$1';
$route['student-profile/(:any)/edit-education/(:any)'] = 'Student/IndexController/showEditEducation/$1/$2';
$route['student-profile/(:any)/edit-work/(:any)'] = 'Student/IndexController/showEditWork/$1/$2';
$route['student-profile/(:any)/add-edit-details'] = 'Student/IndexController/addEditDetails/$1';
$route['student-profile/(:any)'] = 'Student/IndexController/profile/$1';

/*
 * Lecturer Profile routes
 */
$route['lecturer-profile/(:any)/timeline'] = 'Lecturer/IndexController/profile/$1';
$route['lecturer-profile/(:any)/about'] = 'Lecturer/IndexController/about/$1';
$route['lecturer-profile/(:any)/friends'] = 'Lecturer/IndexController/friends/$1';
$route['lecturer-profile/(:any)/edit-basic-info'] = 'Lecturer/IndexController/showEditBasicInfo/$1';
$route['lecturer-profile/(:any)/add-education'] = 'Lecturer/IndexController/showAddEducation/$1';
$route['lecturer-profile/(:any)/add-work'] = 'Lecturer/IndexController/showAddWork/$1';
$route['lecturer-profile/(:any)/edit-education/(:any)'] = 'Lecturer/IndexController/showEditEducation/$1/$2';
$route['lecturer-profile/(:any)/edit-work/(:any)'] = 'Lecturer/IndexController/showEditWork/$1/$2';
$route['lecturer-profile/(:any)/add-edit-details'] = 'Lecturer/IndexController/addEditDetails/$1';
$route['lecturer-profile/(:any)'] = 'Lecturer/IndexController/profile/$1';

/*
 * User actions routes
 */
$route['user-actions/save-basic-info'] = 'UserActionsController/saveBasicInfo';
$route['user-actions/save-new-education'] = 'UserActionsController/saveNewEducation';
$route['user-actions/save-new-work'] = 'UserActionsController/saveNewWork';
$route['user-actions/save-edit-education/(:any)'] = 'UserActionsController/saveEditedEducation/$1';
$route['user-actions/delete-education/(:any)'] = 'UserActionsController/deleteEducation/$1';
$route['user-actions/save-edit-work/(:any)'] = 'UserActionsController/saveEditedWork/$1';
$route['user-actions/delete-work/(:any)'] = 'UserActionsController/deleteWork/$1';
$route['user-actions/save-details'] = 'UserActionsController/saveDetails';
$route['user-actions/add-friend'] = 'UserActionsController/postAddFriend';
$route['user-actions/cancel-friend-request'] = 'UserActionsController/postCancelFriendRequest';
$route['user-actions/accept-friend-request'] = 'UserActionsController/postAcceptFriendRequest';
$route['user-actions/ignore-friend-request'] = 'UserActionsController/deleteIgnoreFriendRequest';
$route['user-actions/unfriend'] = 'UserActionsController/deleteUnfriend';

/*
 * Post actions and comments actions
 */
$route['posts/create-new'] = 'PostsActionsController/postCreateNewPost';
$route['posts/(:num)/comments'] = 'PostsActionsController/getComments/$1';
$route['posts/like'] = 'PostsActionsController/postLike';
$route['posts/unlike'] = 'PostsActionsController/deleteUnlike';
$route['posts/comment'] = 'PostsActionsController/postComment';
$route['comments/like'] = 'PostsActionsController/postLikeComment';
$route['comments/unlike'] = 'PostsActionsController/deleteUnlikeComment';

/*
 * Image manip routes
 */
$route['preview/(:num)/(:num)'] = 'ImageController/previewImage/$1/$2';
$route['save-user-profile-picture'] = 'ImageController/postSaveUserProfilePicture';

/*
 * Search
 */
$route['search-users'] = 'IndexController/getSearchUsers';

/*
 * Errors
 */
$route['404_override'] = 'IndexController/error404';

/*
 * Notifications
 */
$route['notifications'] = 'NotificationsController';
$route['notifications-count-unseen'] = 'NotificationsController/getCountUnseen';

/*
 * Invitations
 */
$route['invitations'] = 'InvitationsController';
$route['invitations-count-unseen'] = 'InvitationsController/getCountUnseen';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
