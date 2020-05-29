<?php

namespace App\Traits;

trait ContactUsTrait
{
    public function massages()
    {
        return $this->morphMany('App\ContactUs', 'massagable')
                            ->orderBy('created_at', 'desc');
    }


     /*
     * Get the entity's read massages.
     */
    public function readMassages()
    {
        return $this->massages()
                            ->whereNotNull('read_at');
    }

    /*
     * Get the entity's unread massages.
     */
    public function unreadMassages()
    {
        return $this->massages()
                            ->whereNull('read_at');
    }
}