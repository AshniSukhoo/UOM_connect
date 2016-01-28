<?php

/**
 * Class ImageController
 */
class ImageController extends MY_Controller
{
	/**
	 * Create a new instance of ImageController
	 */
	public function __construct()
	{
		//Execute parent constructor
		parent::__construct();
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
		dd($_FILES);
	}
}