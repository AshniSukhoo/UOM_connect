<?php


namespace App\ModelFunctions;

use Coduo\PHPHumanizer\Collection as CollectionHumanizer;

/**
 * Class PostFunctions
 * @package App\ModelFunctions
 */
trait PostFunctions
{
	/**
	 * Checks if a post contains any comments
	 *
	 * @return bool
	 */
	public function hasComments()
	{
		//return true if post contains comments
		return $this->comments()->count() > 0;
	}

	/**
	 * Return human readable format for likes Post
	 *
	 * @param \App\Eloquent\User $viewer
	 * @return string
	 */
	public function getLikesAsHumanReadable($viewer)
	{
		try {
			//Get the total number of likes
			$likesCount = $this->likes()->count();

			//No likes
			if($likesCount == 0) {
				//We return blank
				return '';
			}

			//Only one like
			if($likesCount == 1) {
				//Get the likeable model
				$like = $this->likes()->first();
				//Check if I am the liker and return the string to display
				return ($like->user->is($viewer))?'You like this':'<a href="'.$like->user->profile_uri.'">'.$like->user->full_name.'</a> likes this';
			}

			//Less than 3 likes
			if($likesCount <= 3) {
				//Prepare array to present
				$likers = [];
				//Check if viewer has like
				if($viewer != null && $viewer->liked($this)) {
					//Push viewer in array
					array_push($likers, 'You');
				}
				//Loop through the rest of likers and add to array
				foreach($this->likes()->where('user_id', '!=', ($viewer != null)?$viewer->id:null)->get()->all() as $like) {
					//Push in array
					array_push($likers, '<a class="commenter-name" href="'.$like->user->profile_uri.'">'.$like->user->full_name.'</a>');
				}
				//return string to display
				return CollectionHumanizer::oxford($likers, null, 'en').' likes this';
			}

			//Greater than 3 likes
			if($likesCount > 3) {
				//Prepare array to present
				$likers = [];
				//Check if viewer has like
				if($viewer != null && $viewer->liked($this)) {
					//Push viewer in array
					array_push($likers, 'You');
					//remove one to count
					$likesCount--;
				}
				//Get two random liker and push in the array
				foreach($this->likes()->where('user_id', '!=', ($viewer != null)?$viewer->id:null)->orderBy('created_at', 'desc')->limit(2)->get() as $like) {
					//Push in array
					array_push($likers, '<a class="commenter-name" href="'.$like->user->profile_uri.'">'.$like->user->full_name.'</a>');
					//remove one to count
					$likesCount--;
				}
				//Push remainder in array
				array_push($likers, '<a href="javascript:;" class="show-all-likers commenter-name">'.$likesCount.' others</a>');
				//return string to display
				return CollectionHumanizer::oxford($likers, null, 'en').' likes this';
			}
		} catch (\Exception $e) {
			//Unexpected error
			return null;
		}
	}
}