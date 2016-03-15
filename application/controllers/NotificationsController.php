<?php

use App\Repositories\UserRepository;

/**
 * Class NotificationsController
 */
class NotificationsController extends MY_Controller
{
    /**
     * The user repository service
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepo;

    /**
     * Create new instance of notifications
     * controller
     */
    public function __construct()
    {
        //Execute parent constructor
        parent::__construct();
        //User must be logged in
        if (!$this->auth->check()) {
            //Notify error
            $this->keeper->put('notificationError', 'You must log in to continue');
            //Return to login
            redirect('/login', 'location');
        }
        //Inject user repository in the controller
        $this->userRepo = new UserRepository;
    }

    /**
     * Show all notifications
     *
     * @return string
     */
    public function index()
    {
        try {
            //Get the notifications for the currently logged in user
            $notifications = $this->userRepo->paginateNotifications($this->auth->user());
            //Get next Page url
            $nextPageUrl = generate_next_page_url($notifications);
            //This is not an ajax request
            if(! $this->input->is_ajax_request()) {
                //Load view with data
                $this->load->view('pages/notifications', compact('notifications', 'nextPageUrl'));
            } else {
                //Is an ajax request
                echo json_encode([
                    'error' => false,
                    'grid' => $this->load->view('pages/partials/_notifications-grid', compact('notifications'), true),
                    'nextPageUrl' => $nextPageUrl
                ]);
            }
        } catch (Exception $e) {
            //This is not an ajax request
            if(! $this->input->is_ajax_request()) {
                //Show error page
                show_404();
            } else {
                //Is an ajax request
                echo json_encode([
                    'error' => true,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    /**
     * Get count of unseen notification for user
     *
     * @return string
     */
    public function getCountUnseen()
    {
        //Return notif count
        echo json_encode([
            'count' => '<i class="fa fa-bell"></i> '.($this->auth->user()->hasPendingNotifications() ? '<span class="label label-danger">'.$this->auth->user()->pendingNotifications().'</span>' : ''),
            'hint' => $this->auth->user()->hasPendingNotifications() ? $this->auth->user()->pendingNotifications().' pending notifications' : 'No new notifications',
        ]);
    }
}
