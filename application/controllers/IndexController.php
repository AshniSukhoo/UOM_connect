<?php

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

/**
 * Class IndexController
 */
class IndexController extends MY_Controller
{
    /**
     * The post repository service
     *
     * @var \App\Repositories\PostRepository
     */
    protected $postRepo;

    /**
     * The user repo service
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepo;

    /**
     * Create Index controller
     * instance
     */
    public function __construct()
    {
        try {
            //Execute parent constructor
            parent::__construct();
            //Create post repo
            $this->postRepo = new PostRepository();
            //Create user repo service
            $this->userRepo = new UserRepository();
        } catch (Exception $e) {
            //Unexpected error or unknown error
        }
    }

    /**
     * Load the Home page or Login/Registration page
     */
    public function index()
    {
        //User is logged in
        if ($this->auth->check()) {
            //Get the feeds for the user
            $feeds = $this->postRepo->feeds($this->auth->user());
            //Get next page url
            $nextPageUrl = generate_next_page_url($feeds);
            //This is a normal request
            if(!$this->input->is_ajax_request()) {
                //Load feeds view
                $this->load->view('pages/feeds', [
                    'title' => 'Uom-Connect',
                    'feeds' => $feeds,
                    'nextPageUrl' => $nextPageUrl
                ]);
            } else {
                //Return json encoded data
                echo json_encode([
                    'error' => false,
                    'grid'  => $this->load->view('partials/_posts-grid', ['posts' => $feeds], true),
                    'nextPageUrl' => $nextPageUrl
                ]);
            }
        } else {
            //Load login/Registration page
            $this->load->view('auth/login');
        }
    }

    /**
     * Search for users
     *
     * @return string
     */
    public function getSearchUsers()
    {
        try {
            //Get search results
            $results = $this->userRepo->searchUsers($this->input->get('srch-term'));
        } catch (Exception $e) {
            //Unexpected error
            $results = null;
        }
        //Get next page url
        $nextPageUrl = generate_next_page_url($results);

        //This is a normal request
        if(!$this->input->is_ajax_request()) {
            //Load view with results
            $this->load->view('pages/search-users-results', [
                'results' => $results,
                'nextPageUrl' => $nextPageUrl
            ]);
        } else {
            //Return json encoded data
            echo json_encode([
                'error' => false,
                'grid'  => $this->load->view('partials/_users-grid', ['users' => $results], true),
                'nextPageUrl' => $nextPageUrl
            ]);
        }
    }
}
