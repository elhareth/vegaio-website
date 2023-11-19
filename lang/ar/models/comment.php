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

    'id'    => "comment",
    'name'  => "Comment",
    'class' => "",


    /**
     * Label Markers
     */
    'label' => [
        'model' => "تعليق",
        'Model' => "التعليق",
        'models' => "تعليقات",
        'Models' => "التعليقات",
        'comments_count' => "{0} لا تعليقات |{1} تعليق واحد |{2} تعليقان |[3,10] :count تعليقات |[11, *] :count تعليق",
        'Count' => "التعليقات (:count)",
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
        'commentable_id' => [
            'name'  => "Commentable ID",
            'label' => "رقم الكائن",
            'line'  => null,
            'desc'  => null,
        ],
        'commentable_type' => [
            'name'  => "Commentable Type",
            'label' => "نوع الكائن",
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
