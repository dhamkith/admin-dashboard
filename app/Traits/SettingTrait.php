<?php

namespace App\Traits;

trait SettingTrait
{
    /*
     * Get the entity's settings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function settings() 
    {
        return $this->morphMany('App\Setting', 'settable')
                            ->orderBy('created_at', 'desc');
    }

    /*
     * Get the entity's settable_id === user ID settings.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function userSetting()
    {
        return $this->settings();
    }
    
    /*
     * Get the general() Setting social media links from data column.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function socialMediaLinks() 
    {
        if ( count($this->userSetting) > 0) { 
            $setting = json_decode($this->userSetting[0]->data, true);
            return $setting['general'];
        }
        return false;
    }
}