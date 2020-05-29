<?php

return [

    /*
    |--------------------------------------------------------------------------
    | user Settings
    |--------------------------------------------------------------------------
    |
    |  
    |
    */
    'general' => [
        'title' => 'social media',
        'desc' => 'social media links',
        'icon' => 'fa fa-link',
        'elements' => [ 
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'facebook',
                'label' => 'facebook',
                'rules' =>  ['required', new \App\Rules\ValidFacebook],
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.facebook.com/yourpage/',
            ], 
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'twitter',
                'label' => '*twitter',
                'rules' => ['required', new \App\Rules\ValidTwitter],
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.twitter.com/#!/ddcred/',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram',
                'label' => '*instagram',
                'rules' => ['required', new \App\Rules\ValidInstagram],
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.instagram.com/name/',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'youtube',
                'label' => '*youtube',
                'rules' => ['required', new \App\Rules\ValidYoutube],
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.youtube.com/ddcred/',
            ],

        ]
    ], 
];