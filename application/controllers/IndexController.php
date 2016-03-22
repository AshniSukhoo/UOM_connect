<?php

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Repositories\ContentRepository;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * The content repo service
     *
     * @var \App\Repositories\ContentRepository
     */
    protected $contentRepo;

    /**
     * The contact repo service
     *
     * @var \App\Repositories\ContactRepository
     */
    protected $contactMessageRepo;

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
            //Create new content repo
            $this->contentRepo = new ContentRepository();
            //Create new contact repo service
            $this->contactMessageRepo = new ContactRepository();
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

    /**
     * Loads contact us page
     *
     * @return string
     */
    public function getContactUs()
    {
        //Load Contact page
        $this->load->view('pages/contact-us');
    }

    /**
     * Send contact message
     *
     * @return string
     */
    public function postSendContactMessage()
    {
        try {
            //Set validation rules
            $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'required|min_length[300]|xss_clean');

            //Run validation
            if($this->form_validation->run() == false) {
                //Our form is not valid, so sad!!
                //Define list of fields
                $fieldNames = [
                    'first_name',
                    'last_name',
                    'email',
                    'message'
                ];
                //Set error delimiter
                $this->form_validation->set_error_delimiters('<small class="help-block server-error">', '</small>');
                //Loop through all fields and put error
                foreach($fieldNames as $fieldName) {
                    //We have value for the field
                    if(isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) {
                        //Put value in keeper
                        $this->keeper->put($fieldName.'_value', $_POST[$fieldName]);
                    }
                    //There is an error on the field
                    if(form_error($fieldName) != '') {
                        //Keep error in the keeper
                        $this->keeper->put($fieldName.'_error', form_error($fieldName));
                    }
                }
                //Redirect on login-register page
                redirect('/contact-us', 'location');
            }

            //Create new contact message
            $message = $this->contactMessageRepo->saveMessage($this->input->post());

            //Send email
            $this->email->from($this->input->post('email'), $message->first_name.' '.$message->last_name.' via UOM-Connect contact');
            $this->email->to('contact@uom-connect.mu');
            $this->email->subject('Help Needed');
            $this->email->message($this->load->view('emails/contact-email', ['contact' => $message], true));
            $this->email->send();

            //Alert success
            $notif = 'Your message has been sent successfully. We will get back to you as soon as possible.';
            $this->keeper->put('notificationSuccess', $notif);

            //Redirect to contact page
            redirect('/contact-us', 'location');
        } catch (Exception $e) {
            //Unexpected error
            show_error($e->getCode());
        }
    }

    /**
     * Show content page
     *
     * @param string $id
     * @return string
     */
    public function getShowContents($id = '')
    {
        try {
            //Get the content from the data base
            $content = $this->contentRepo->getContent($id);
            //Load view with content
            $this->load->view('pages/content-pages', ['content' => $content]);
        } catch (ModelNotFoundException $e) {
            //Unexpected error
            show_error(404);
        }
    }

    /**
     * 404 Error Page
     *
     * @return string
     */
    public function error404()
    {
        //Show 404 Page
        $this->load->view('errors/404');
    }
}
