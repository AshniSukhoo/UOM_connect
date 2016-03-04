<?php

use App\Repositories\PostRepository;

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

            //Load feeds view
            $this->load->view('pages/feeds', [
                'title' => 'Uom-Connect',
                'feeds' => $feeds,
                'nextPageUrl' => $nextPageUrl
            ]);
        } else {
            //Load login/Registration page
            $this->load->view('auth/login');
        }
    }
}
