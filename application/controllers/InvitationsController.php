<?php

use App\Repositories\UserRepository;

/**
 * Class InvitationsController
 */
class InvitationsController extends MY_Controller
{
    /**
     * The user repository service
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepo;

    /**
     * Create a new instance of the InvitationsController
     */
    public function __construct()
    {
        //Call parent construct
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
     * The functions to load invitations page
     *
     * @return string
     */
    public function index()
    {
        try {
            //Get the invitations for the currently logged in user
            $invitations = $this->userRepo->paginateInvitations($this->auth->user());
            //Get next Page url
            $nextPageUrl = generate_next_page_url($invitations);
            //This is not an ajax request
            if(! $this->input->is_ajax_request()) {
                //Load view with data
                $this->load->view('pages/invitations', compact('invitations', 'nextPageUrl'));
            } else {
                //Is an ajax request
                echo json_encode([
                    'error' => false,
                    'grid' => $this->load->view('pages/partials/_invitations-grid', compact('invitations'), true),
                    'nextPageUrl' => $nextPageUrl
                ]);
            }
        } catch (Exception $e) {
            //Unexpected error
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
     * Get count of unseen invitations for user
     *
     * @return string
     */
    public function getCountUnseen()
    {
        //Return notif count
        echo json_encode([
            'count' => '<i class="fa fa-user-plus"></i> '.($this->auth->user()->hasPendingFriendRequests() ? '<span class="label label-danger">'.$this->auth->user()->pendingFriendRequests().'</span>' : ''),
            'hint' => $this->auth->user()->hasPendingFriendRequests() ? $this->auth->user()->pendingFriendRequests().' pending Friend Requests' : 'No Friend Request',
        ]);
    }
}
