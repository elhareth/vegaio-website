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

    'id'    => "model",
    'name'  => "Model",
    'class' => "",


    /**
     * Label Markers
     */
    'label' => [
        'model' => "ملف",
        'Model' => "الملف",
        'models' => "وسائط",
        'Models' => "الوسائط",
        'count' => "{0} None |{1} One |{2} Two |[3,10] :count Few |[11, *] :count More",
        'Count' => "",
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
        'type' => [
            'name'  => "Type",
            'label' => "النوع",
            'line'  => null,
            'desc'  => null,
        ],
        'size' => [
            'name'  => "Size",
            'label' => "حجم الملف",
            'line'  => null,
            'desc'  => null,
        ],
        'disk' => [
            'name'  => "Disk",
            'label' => "القرص",
            'line'  => null,
            'desc'  => null,
        ],
        'directory' => [
            'name'  => "Directory",
            'label' => "الحافظة",
            'line'  => null,
            'desc'  => null,
        ],
        'filename' => [
            'name'  => "File Name",
            'label' => "اسم الملف",
            'line'  => null,
            'desc'  => null,
        ],
        'aggregate_type' => [
            'name'  => "Aggregate Type",
            'label' => "نوع الملف",
            'line'  => null,
            'desc'  => null,
        ],
        'extension' => [
            'name'  => "Extension",
            'label' => "امتداد الملف",
            'line'  => null,
            'desc'  => null,
        ],
        'mime_type' => [
            'name'  => "Mime Type",
            'label' => "صيغة الملف",
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
