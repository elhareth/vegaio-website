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

    'id'    => "contact_message",
    'name'  => "Contact Message",
    'class' => "",


    /**
     * Label Markers
     */
    'label' => [
        'model' => "رسالة بريد",
        'Model' => "رسالة البريد",
        'models' => "رسائل بريد",
        'Models' => "رسائل البريد",
        'count' => "{0} لا بريد |{1} رسالة بريد |{2} رسالتان |[3,10] :count رسائل بريد |[11, *] :count رسالة بريد",
        'Count' => "رسائل البريد (:count)",
    ],



    /**
     * Collection
     */
    'collection' => [
        'name' => "",
        'label' => "",
        'title' => "بريد الزوار",
        'desc' => "",
    ],



    /**
     * Attributes
     */
    'attribute' => [
        'read' => [
            'name'  => "Read",
            'label' => "مقروءة",
            'line'  => null,
            'desc'  => null,
        ],
        'added' => [
            'name'  => "Added",
            'label' => "تاريخ الرسالة",
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
        'message-sent' => [
            'type' => "success",
            'title'  => null,
            'message'  => "تم إرسال الرسالة! شكرا لتواصلك معنا.",
            'args' => [],
        ],
        'send-failed' => [
            'type' => "warning",
            'title'  => null,
            'message'  => "عذرا! لم يتم إرسال الرسالة، قم بإعادة تحميل الصفحة و المحاولة مجددا!",
            'args' => [],
        ],
        'send-error' => [
            'type' => "danger",
            'title'  => null,
            'message'  => "لقد حدث خطأ ما أثناء معالجة طلبك، قم بالمحاولة لاحقاً!",
            'args' => [],
        ],
    ],
];
