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

    'id'    => "article",
    'name'  => "Article",
    'class' => "",


    /**
     * Label Markers
     */
    'label' => [
        'model' => "مقال",
        'Model' => "المقال",
        'models' => "مقالات",
        'Models' => "المقالات",
        'count' => "{0} لا مقالات |{1} مقال واحد |{2} مقالان |[3,10] :count مقالات |[11, *] :count مقال",
        'Count' => "المقالات (:count)",
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
        'attribute' => [
            'name'  => "",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
    ],



    /**
     * Actions
     */
    'actions' => [
        'close' => [
            'name'  => "",
            'label' => "إغلاق",
            'line'  => null,
            'desc'  => null,
        ],
        'strict' => [
            'name'  => "",
            'label' => "تقييد",
            'line'  => null,
            'desc'  => null,
        ],
        'publish' => [
            'name'  => "",
            'label' => "نشر",
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
        'published' => [
            'type' => 'success',
            'title'  => "تم نشر المقال",
            'message'  => null,
            'args' => [],
        ],
    ],
];
