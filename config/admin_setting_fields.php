<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Settings #23df42
    |--------------------------------------------------------------------------
    |
    */
    'app' => [
        'title' => 'General Settings',
        'desc' => 'All the general setting for application',
        'icon' => 'fa fa-cogs',
        'elements' => [ 
            [
                'type' => 'text', // input feilds type
                'data' => 'string', // data type, string, int, boolean 
                'name' => 'site_name', // unique name for feild
                'label' => '*Site Name', // label
                'rules' => 'required|min:2|max:50', // validation rule for laraval
                'class' => 'is-desktop-6 is-size-8-9', // any class for input
                'element_desc' => null,
            ],
            [
                'type' => 'file', 
                'data' => 'string',
                'name' => 'site_brand',
                'label' => '*Site brand',
                'rules' => 'image|max:1999',
                'class' => ' is-size-8-9',
                'element_desc' => null,
            ],
            [
                'type' => 'textarea', 
                'data' => 'string',
                'name' => 'about_us',
                'label' => '*About Us',
                'rules' => 'required|string',
                'class' => 'textarea is-size-8-9',
                'element_desc' => null,
            ],
            [
                'type' => 'file', 
                'data' => 'string',
                'name' => 'admin_picture',
                'label' => '*Picture',
                'rules' => 'image|max:1999',
                'class' => ' is-size-8-9',
                'element_desc' => null,
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'contact_number',
                'label' => '*Contact Number',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => null,
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'copyright',
                'label' => '*Copyright',
                'rules' => 'required|string',
                'class' => 'is-size-8-9',
                'element_desc' => null,
            ],

        ]
    ],
    'notification' => [    
        'title' => 'Notification Settings',
        'desc' => 'Notification setting for admin',
        'icon' => 'fa fa-bell',
        'elements' => [ 
            [
                'type' => 'checkbox',
                'data' => 'string',
                'name' => 'new_user_notifi',
                'label' => '- New User Register Notifications',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' send Notifications when new user Registed',
            ],
        ]
    ],
    'email notification' => [    
        'title' => 'Email Notification Settings',
        'desc' => 'Email Notification setting for admin',
        'icon' => 'fa fa-bell',
        'elements' => [ 
            [
                'type' => 'checkbox',
                'data' => 'string',
                'name' => 'new_user_email',
                'label' => '- New User Register email Notifications',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' send email Notifications when new user Registed',
            ],
            [
                'type' => 'checkbox',
                'data' => 'string',
                'name' => 'contact_us_email',
                'label' => '- Contact us email Notifications',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' send email Notifications when user or guest Contacting us',
            ],
        ]
    ],
    'social' => [ 
        'title' => 'Social Media',
        'desc' => 'All the social media links for application',
        'icon' => 'fa fa-link',
        'elements' => [ 
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'facebook',
                'label' => '*facebook',
                'rules' =>  '',
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.facebook.com/yourpage/',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'twitter',
                'label' => '*twitter',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.twitter.com/#!/ddcred/',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram',
                'label' => '*instagram',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.instagram.com/name/',
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'youtube',
                'label' => '*youtube',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' Ex: https://www.youtube.com/ddcred/',
            ],
        ]
    ],
    'theme' => [ 
        'title' => 'Theme',
        'desc' => 'Theme color for application',
        'icon' => 'fa fa-magic',
        'elements' => [
            [
                'type' => 'checkbox',
                'data' => 'string',
                'name' => 'is_app_logo',
                'label' => '- Show animate logo',
                'rules' => '',
                'class' => 'is-size-8-9',
                'element_desc' => ' Show animation logo, if this active Site brand logo not dispaly',
            ],  
            [
                'type' => 'select', 
                'data' => 'string',
                'name' => 'theme_color',
                'label' => '* Dashboard Theme color',
                'rules' => 'required',
                'class' => 'is-size-8-9 is-rounded',
                'element_desc' => 'Dashboard Theme color lighter or darker',
                'options' => [ 
                    'theme_color_dark' => 'darker color',
                    'theme_color_light' => 'lighter color',
                ]
            ],

        ]
    ],
];