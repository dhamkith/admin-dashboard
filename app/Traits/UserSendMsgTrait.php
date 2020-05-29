<?php

namespace App\Traits;

trait UserSendMsgTrait
{
    /*
     * Get the entity's user_send_messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function usersendmessages() 
    {
        return $this->morphMany('App\UserSendMessage', 'sendable')
                            ->orderBy('created_at', 'desc');
    }

    /*
     * Get the entity's read massages.
     */
    public function readMassagesFormUser()
    {
        return $this->usersendmessages()
                        ->whereNotNull('read_at');
    }

    /*
     * Get the entity's unread massages.
     */
    public function unreadMassagesFormUser()
    {
        return $this->usersendmessages()
                        ->whereNull('read_at');
    }
}