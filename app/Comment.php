<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
         /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    public $fillable = ['comment ','user_id'];

    /*
     * Get the entity's Comment. 
     */ 
    public function CommentTrait()
    {
        return $this->morphTo();
    }
 
    /*
     * Mark the massage as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }

    /*
     * Mark the massage as unread.
     *
     * @return void
     */
    public function markAsUnread()
    {
        if (! is_null($this->read_at)) {
            $this->forceFill(['read_at' => null])->save();
        }
    }

    /*
     * Determine if a massage has been read.
     *
     * @return bool
     */
    public function read()
    {
        return $this->read_at !== null;
    }

    /*
     * Determine if a massage has not been read.
     *
     * @return bool
     */
    public function unread()
    {
        return $this->read_at === null;
    }

    /*
     * Mark the massage as user read.
     *
     * @return void
     */
    public function markAsUserRead()
    {
        if (is_null($this->user_read_at)) {
            $this->forceFill(['user_read_at' => $this->freshTimestamp()])->save();
        }
    }

    /*
     * Mark the massage as unread.
     *
     * @return void
     */
    public function markAsUserUnread()
    {
        if (! is_null($this->user_read_at)) {
            $this->forceFill(['user_read_at' => null])->save();
        }
    }

    /*
     * Determine if a massage has been read user.
     *
     * @return bool
     */
    public function userRead()
    {
        return $this->user_read_at !== null;
    }

    /*
     * Determine if a massage has not been read user.
     *
     * @return bool
     */
    public function userUnread()
    {
        return $this->user_read_at === null;
    }
}
