<?php

namespace App\Eloquent\Observers;

use Carbon\Carbon;

/**
 * Class LikeObserver
 * @package App\Eloquent\Observers
 */
trait LikeObserver
{
    /**
     * Notify a user when his post is liked
     *
     * @param \App\Eloquent\Like $like
     */
    public static function notificationToUser($like)
    {
        //This is a like not from the owner of the resource
        if ($like->user->isNot($like->resourceable->user)) {
            //Create notification for resource owner
            $like->resourceable->user->receivedNotifications()->create([
                'notifier' => $like->user->id,
                'content' => 'likes your '.$like->resourceable->object_name_lc,
                'url' => $like->resourceable->base_uri,
                'notified' => false,
                'type' => 'like',
            ]);
        }
    }

    /**
     * Boot The model
     */
    public static function boot()
    {
        parent::boot();

        //When a new like is created
        static::creating(function ($like) {
            //Notify user
            static::notificationToUser($like);
        });
    }

}
