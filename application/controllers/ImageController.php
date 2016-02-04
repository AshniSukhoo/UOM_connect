<?php

use App\Services\ImageHandler;
use Ramsey\Uuid\Uuid;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use App\Repositories\UserRepository;

/**
 * Class ImageController
 */
class ImageController extends MY_Controller
{
	/**
	 * The image handler service
	 *
	 * @var \App\Services\ImageHandler
	 */
	protected $imageHandler;

	/**
	 * The filesystem object
	 *
	 * @var \League\Flysystem\Filesystem
	 */
	protected $filesystem;

	/**
	 * The user repo service
	 *
	 * @var \App\Repositories\UserRepository
	 */
	protected $userRepo;

	/**
	 * Create a new instance of ImageController
	 */
	public function __construct()
	{
		//Execute parent constructor
		parent::__construct();
		//Inject image handler service in the controller
		$this->imageHandler = new ImageHandler();
		//Create filesystem object and pass it to controller
		$this->filesystem = new Filesystem(new Local(__DIR__.'/../..'));
		//Inject user repo in controller
		$this->userRepo = new UserRepository();
	}

	/**
	 * Previews an image
	 *
	 * @param string $width
	 * @param string $height
	 * @return string
	 */
	public function previewImage($width = '', $height = '')
	{
		try {
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must login', 401);
			}
			//Return image as data-url encoded string
			echo json_encode([
				'error' => false,
				'data'  => $this->imageHandler->previewUploaded($_FILES['profile_picture']['tmp_name'], $width, $height),
			]);
		} catch (Exception $e) {
			//Unexpected error
			echo json_encode([
				'error'     => true,
				'data'      => null,
				'message'   => $e->getMessage()
			]);
		}
	}

	/**
	 * Saves the user profile picture
	 *
	 * @return string
	 */
	public function postSaveUserProfilePicture()
	{
		try {
			//User must be logged in
			if(!$this->auth->check()) {
				//Raise error
				throw new Exception('You must login', 401);
			}

			//Generate filename
			$filename = Uuid::uuid4()->toString();

			//Resize to 100x100
			$image = $this->imageHandler->resizeImage(
				$this->imageHandler->makeImage($_FILES['profile_picture']['tmp_name'])->encode('png'),
				200,
				200
			);
			//Save the image
			$results = $this->imageHandler->saveImage($image, public_path('img/profile-pictures'), $filename.'.png');
			//Could not save image
			if($results == false) {
				//Raise error
				throw new Exception('Unable to save image', 422);
			}
			//Delete old picture
			if($this->auth->user()->hasProfilePic()) {
				//Delete the old profile picture
				$this->filesystem->delete('public/img/profile-pictures/'.$this->auth->user()->detail->getOriginal('profile_picture').'.png');
			}
			//Save the new profile picture of the user
			$saved = $this->userRepo->saveUserDetails($this->auth->user(), [
				'profile_picture' => $filename
			]);

			//Could not save picture
			if($saved == null) {
				//Raise error
				throw new Exception('Could not save image', 422);
			}

			//Go back to previous page
			redirect($this->agent->referrer(), 'location');
		} catch (Exception $e) {
			//Unexpected error
			show_error($e->getMessage(), 500);
		}
	}
}