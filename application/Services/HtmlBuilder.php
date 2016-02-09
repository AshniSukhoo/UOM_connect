<?php

namespace App\Services;

/**
 * Class HtmlBuilder
 * @package App\Services
 */
class HtmlBuilder
{
	/**
	 * Get a loader string when more comments loading
	 *
	 * @return string
	 */
	public function moreCommentsLoader()
	{
		//Get CI super object
		$ci = & get_instance();
		//Return loader
		return remove_carriage_return($ci->load->view('partials/_more-comments-loader', [], true));
	}

}