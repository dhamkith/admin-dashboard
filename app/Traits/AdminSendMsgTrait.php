<?php

namespace App\Traits;

trait AdminSendMsgTrait
{
    /*
     * Get the entity's admin_send_messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function adminsendmessages() 
    {
        return $this->morphMany('App\AdminSendMessage', 'sendable')
                            ->orderBy('created_at', 'desc');
    }

    /*
     * Get the entity's read massages.
     */
    public function readMassagesFormAdmin()
    {
        return $this->adminsendmessages()
                        ->whereNotNull('read_at')
                        ->whereNull('user_delete_at');
    }

    /*
     * Get the entity's unread massages.
     */
    public function unreadMassagesFormAdmin()
    {
        return $this->adminsendmessages()
                        ->whereNull('read_at')
                        ->whereNull('user_delete_at');
    }
}