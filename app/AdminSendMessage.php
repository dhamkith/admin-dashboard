<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSendMessage extends Model
{
        /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_send_messages';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */  
    public $fillable = ['name','email', 'subject','message'];

    /*
     *  Get the entity's AdminSendMessage. . 
     */   
    public function AdminSendMsgTrait()
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
     * Mark the massage as read.
     *
     * @return void
     */
    public function markAsAdminRead()
    {
        if (is_null($this->admin_read_at)) {
            $this->forceFill(['admin_read_at' => $this->freshTimestamp()])->save();
        }
    }

    /*
     * Mark the massage as delete.
     *
     * @return void
     */
    public function markAsDelete()
    {
        if (is_null($this->user_delete_at)) {
            $this->forceFill(['user_delete_at' => $this->freshTimestamp()])->save();
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
}
