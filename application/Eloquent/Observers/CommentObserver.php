<?php

namespace App\Eloquent\Observers;

use Carbon\Carbon;

/**
 * Class CommentObserver
 * @package App\Eloquent\Observers
 */
trait CommentObserver
{
    /**
     * Notify a owner someone commented on his post
     *
     * @param \App\Eloquent\Comment $comment
     */
    public static function notificationToOwner($comment)
    {
        //Commenter is not owner of post
        if($comment->user->isNot($comment->post->user)) {
            //Create notification for resource owner
            $comment->post->user->receivedNotifications()->create([
                'notifier' => $comment->user->id,
                'content' => 'commented on your post',
                'url' => $comment->post->base_uri,
                'notified' => false,
                'type' => 'comment'
            ]);
        }
    }

    /**
     * Notify other commenters on this post of comment
     *
     * @param \App\Eloquent\Comment $comment
     */
    public function notifyOtherCommenters($comment)
    {
        //User to exclude
        $excluded = $comment->user->is($comment->post->user) ? [$comment->user->id] : [$comment->user->id, $comment->post->user->id];
        //Get post commenters except owner and commenter
        $comments = $comment->post->comments()->with(['user'])
                            ->whereNotIn('comments.user_id', $excluded)
                            ->groupBy('comments.user_id')
                            ->get();
        //Some commenters found
        if($comments->count() > 0) {
            //Loop on each comment
            foreach($comments as $someComment) {
                //Make notif for each commenter
                $someComment->user->receivedNotifications()->create([
                    'notifier' => $comment->user->id,
                    'content' => $comment->user->is($comment->post->user) ? 'commented on his post' : 'commented on a post you commented on',
                    'url' => $comment->post->base_uri,
                    'notified' => false,
                    'type' => 'comment'
                ]);
            }
        }
    }

    /**
     * Boot The model
     */
    public static function boot()
    {
        parent::boot();

        //When a new comment is created
        static::creating(function ($comment) {
            //Notify owner of comment
            static::notificationToOwner($comment);
            //Notify other commenters
            static::notifyOtherCommenters($comment);
        });
    }
}
