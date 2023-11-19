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

    'id'    => "user",
    'name'  => "User",
    'class' => "",


    /**
     * Label Markers
     */
    'label' => [
        'model' => "مستخدم",
        'Model' => "المستخدم",
        'models' => "ممستخدمين",
        'Models' => "المستخدمين",
        'count' => "{0} لا مستخدمين |{1} مستخدم واحد |{2} مستخدمان |[3,10] :count مستخدمين |[11, *] :count مستخدم",
        'Count' => "المستخدمين (:count)",
    ],



    /**
     * Collection
     */
    'collection' => [
        'name' => "",
        'label' => "",
        'title' => "",
        'desc' => "",
    ],



    /**
     * Attributes
     */
    'attribute' => [
        'id' => [
            'name'  => "ID",
            'label' => "المعرف",
            'line'  => null,
            'desc'  => null,
        ],
        'name' => [
            'name'  => "Name",
            'label' => "الإسم",
            'line'  => null,
            'desc'  => null,
        ],
        'email' => [
            'name'  => "Email",
            'label' => "البريد",
            'line'  => null,
            'desc'  => null,
        ],
        'username' => [
            'name'  => "Username",
            'label' => "اسم المستخدم",
            'line'  => null,
            'desc'  => null,
        ],
        'password' => [
            'name'  => "Password",
            'label' => "كلمة السر",
            'line'  => null,
            'desc'  => null,
        ],
        'status' => [
            'name'  => "Status",
            'label' => "الحالة",
            'line'  => null,
            'desc'  => null,
        ],
        'role' => [
            'name'  => "Role",
            'label' => "الدور",
            'line'  => null,
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
     * Notifications
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
];
