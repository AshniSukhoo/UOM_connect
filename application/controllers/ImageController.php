<?php

use App\Services\ImageHandler;

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
	 * Create a new instance of ImageController
	 */
	public function __construct()
	{
		//Execute parent constructor
		parent::__construct();
		//Inject image handler service in the controller
		$this->imageHandler = new ImageHandler();
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
			//Return image as data-url encoded string
			echo json_encode([
				'error' => false,
				'data'  => $this->imageHandler->previewUploaded($_FILES['profile-picture']['tmp_name'], $width, $height),
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
		dd($_FILES);
	}
}