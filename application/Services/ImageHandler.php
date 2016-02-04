<?php

namespace App\Services;

use Intervention\Image\ImageManager as Image;
use Exception;

/**
 * Class ImageHandler
 * @package App\Services
 */
class ImageHandler
{
	/**
	 * Intervention image manager
	 *
	 * @var \Intervention\Image\ImageManager
	 */
	protected $image;

	/**
	 * Create a new instance of the Image handler class
	 */
	public function __construct()
	{
		//Create a new image manager
		$this->image = new Image();
	}

	/**
	 * Returns a string encoded preview of the uploaded image
	 *
	 * @param string $image
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function previewUploaded($image = '', $width = 100, $height = 100)
	{
		// read image from temporary file and resize then encode
		return $this->image->make($image)->fit($width, $height, function($constraint) {
			$constraint->upsize();
		})->encode('png')->encode('data-url')->encoded;
	}

	/**
	 * Make an image object from uploaded image
	 *
	 * @param string $image
	 * @return \Intervention\Image\ImageManager|null
	 */
	public function makeImage($image = '')
	{
		try {
			//Make image object and return
			return $this->image->make($image);
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Resize an image
	 *
	 * @param \Intervention\Image\ImageManager $image
	 * @param string $width
	 * @param string $height
	 * @return \Intervention\Image\ImageManager|null
	 */
	public function resizeImage($image = null, $width = '', $height = '')
	{
		try {
			//Resize image and return
			return $image->fit($width, $height, function($constraint) {
				$constraint->upsize();
			});
		} catch (Exception $e) {
			//Unexpected error
			return null;
		}
	}

	/**
	 * Saves an image on the filesystem
	 *
	 * @param \Intervention\Image\ImageManager $image
	 * @param string $path
	 * @pram string $filename
	 * @return bool
	 */
	public function saveImage($image = null, $path = '', $filename = '')
	{
		try {
			//Save the image
			$image->save($path.'/'.$filename);
			//return ok
			return true;
		} catch (Exception $e) {
			//Unexpected error
			return false;
		}
	}
}