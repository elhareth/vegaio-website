<?php

return [

    /*
    |--------------------------------------------------------------------------
    |
    |--------------------------------------------------------------------------
    |
    |
    |
    |--------------------------------------------------------------------------
    */

    'User' => "",
    'Memeber' => "",
    'Account' => "الحساب",
    'Profile' => "الملف الشخصي",
    'Options' => "الخيارات",
    'Settings' => "الإعدادات",
    'Prefrences' => "التفضيلات",

    /**
     *
     */
    'sets' => [
        'account_info' => [
            'label' => "معلومات الحساب",
            'title' => "",
            'description' => "",
        ],
        'profile_info' => [
            'label' => "معلومات الملف الشخصي",
            'title' => "",
            'description' => "",
        ],
        'contact_info' => [
            'label' => "معلومات الاتصال",
            'title' => "",
            'description' => "",
        ],
        'account_settings' => [
            'label' => "إعدادات الحساب",
            'title' => "",
            'description' => "",
        ],
        'profile_settings' => [
            'label' => "إعدادات الملف الشخصي",
            'title' => "",
            'description' => "",
        ],
    ],


    /**
     * Fields
     */
    'field' => [
        'name' => [
            'label' => "الاسم",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'email' => [
            'label' => "البريد الإلكتروني",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'username' => [
            'label' => "اسم المستخدم",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'password' => [
            'label' => "كلمة السر",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'first_name' => [
            'label' => "الإسم الأول",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'last_name' => [
            'label' => "اسم العائلة",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'display_name' => [
            'label' => "اسم العرض",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'gender' => [
            'label' => "الجنس",
            'title' => "",
            'hint' => "",
            'description' => "",
            'options' => [
                'male' => [
                    'label' => "ذكر",
                ],
                'female' => [
                    'label' => "أنثى",
                ],
                'other' => [
                    'label' => "غير ذلك",
                ],
            ],
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'birthdate' => [
            'label' => "تاريخ الميلاد",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'cover' => [
            'label' => "صورة الغلاف",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
        'avatar' => [
            'label' => "صورة الملف الشخصي",
            'title' => "",
            'hint' => "",
            'description' => "",
            'actions' => [],
            'messages' => [],
            'validation' => [],
        ],
    ],



    /**
     * Alerts
     */
    'alerts' => [
        'alert' => [
            'type' => null,
            'title'  => null,
            'message'  => null,
            'args' => [],
        ],
    ],



    /**
     * Events
     */
    'events' => [
        'event' => [
            'name'  => "",
            'label' => "",
            'title'  => null,
            'desc'  => null,
        ],
    ],



    /**
     * Actions
     */
    'actions' => [
        'action' => [
            'name'  => "",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'edit-profile' => [
            'name'  => "",
            'label' => "تعديل الملف الشخصي",
            'line'  => null,
            'desc'  => null,
        ],
    ],


    /**
     * Notificiations
     */
    'notifications' => [
        'notification' => [
            'type' => null,
            'name'  => "",
            'label' => "",
            'alert' => null,
            'title'  => null,
            'message'  => null,
            'args' => [],
        ],
    ],
];
