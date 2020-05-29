<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
        /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_us';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    public $fillable = ['name','email', 'subject','message'];

    /*
     * Get the entity's ContactUs. 
     */
    public function ContactUsTrait()
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

}
