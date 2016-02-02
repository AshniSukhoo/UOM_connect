<?php

namespace App\Services;

use Intervention\Image\ImageManager as Image;

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
}