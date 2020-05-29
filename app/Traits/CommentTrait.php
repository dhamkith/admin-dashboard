<?php

namespace App\Traits;

trait CommentTrait
{
     /*
     * Get the entity's comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')
                            ->orderBy('created_at', 'desc');
    }

     /*
     * Get the entity's read massages.
     */
    public function readComments()
    {
        return $this->comments()
                        ->whereNotNull('read_at');
    }

    /*
     * Get the entity's unread massages.
     */
    public function unreadComments()
    {
        return $this->comments()
                        ->whereNull('read_at');
    }
}