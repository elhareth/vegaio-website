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
    'class' => null,


    /**
     * Label
     */
    'label' => [
        'model' => "كائن",
        'Model' => "الكائن",
        'models' => "كائنات",
        'Models' => "الكائنات",
        'count' => "{0} لا يوجد كائنات |{1} كائن واحد |{2} كائنان |[3,10] :count كائنات |[11, *] :count كائن",
        'Count' => "النماذج (:count)",
    ],



    /**
     * Collection
     */
    'collection' => [
        'name' => "",
        'label' => "الكائنات",
        'title' => "",
        'description' => "",
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
        'uuid' => [
            'name'  => "UUID",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'ulid' => [
            'name'  => "ULID",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'hash' => [
            'name'  => "Hash",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'name' => [
            'name'  => "Name",
            'label' => "الاسم",
            'line'  => null,
            'desc'  => null,
        ],
        'slug' => [
            'name'  => "Slug",
            'label' => "الرابط",
            'line'  => null,
            'desc'  => null,
        ],
        'group' => [
            'name'  => "Group",
            'label' => "المجموعة",
            'line'  => null,
            'desc'  => null,
        ],
        'key' => [
            'name'  => "Key",
            'label' => "المفتاج",
            'line'  => null,
            'desc'  => null,
        ],
        'tag' => [
            'name'  => "Tag",
            'label' => "الوسم",
            'line'  => null,
            'desc'  => null,
        ],
        'logo' => [
            'name'  => "Logo",
            'label' => "الشعار",
            'line'  => null,
            'desc'  => null,
        ],
        'icon' => [
            'name'  => "Icon",
            'label' => "الأيقونة",
            'line'  => null,
            'desc'  => null,
        ],
        'type' => [
            'name'  => "Type",
            'label' => "النوع",
            'line'  => null,
            'desc'  => null,
        ],
        'disk' => [
            'name'  => "Disk",
            'label' => "القرص",
            'line'  => null,
            'desc'  => null,
        ],
        'size' => [
            'name'  => "Size",
            'label' => "الحجم",
            'line'  => null,
            'desc'  => null,
        ],
        'value' => [
            'name'  => "Value",
            'label' => "القيمة",
            'line'  => null,
            'desc'  => null,
        ],
        'label' => [
            'name'  => "Label",
            'label' => "التسمية",
            'line'  => null,
            'desc'  => null,
        ],
        'title' => [
            'name'  => "Title",
            'label' => "العنوان",
            'line'  => null,
            'desc'  => null,
        ],
        'image' => [
            'name'  => "Image",
            'label' => "الصورة",
            'line'  => null,
            'desc'  => null,
        ],
        'cover' => [
            'name'  => "Cover",
            'label' => "صورة الغلاف",
            'line'  => null,
            'desc'  => null,
        ],
        'tile' => [
            'name'  => "Tile",
            'label' => "Tile",
            'line'  => null,
            'desc'  => null,
        ],
        'tiles' => [
            'name'  => "Tiles",
            'label' => "Tiles",
            'line'  => null,
            'desc'  => null,
        ],
        'slider' => [
            'name'  => "Slider",
            'label' => "Slider",
            'line'  => null,
            'desc'  => null,
        ],
        'thumbnail' => [
            'name'  => "Thumbnail",
            'label' => "الصورة",
            'line'  => null,
            'desc'  => null,
        ],
        'content' => [
            'name'  => "Content",
            'label' => "المحنوى",
            'line'  => null,
            'desc'  => null,
        ],
        'comment' => [
            'name'  => "Comment",
            'label' => "التعليق",
            'line'  => null,
            'desc'  => null,
        ],
        'message' => [
            'name'  => "Message",
            'label' => "الرسالة",
            'line'  => null,
            'desc'  => null,
        ],
        'subject' => [
            'name'  => "Subject",
            'label' => "الموضوع",
            'line'  => null,
            'desc'  => null,
        ],
        'tagline' => [
            'name'  => "Tagline",
            'label' => "نص الشعار/سطر الوصف",
            'line'  => null,
            'desc'  => null,
        ],
        'description' => [
            'name'  => "Description",
            'label' => "الوصف",
            'line'  => null,
            'desc'  => null,
        ],
        'connection' => [
            'name'  => "Connection",
            'label' => "الاتصال",
            'line'  => null,
            'desc'  => null,
        ],
        'queue' => [
            'name'  => "Queue",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'payload' => [
            'name'  => "Payload",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'data' => [
            'name'  => "Data",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'info' => [
            'name'  => "Info",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'options' => [
            'name'  => "Options",
            'label' => "الخيارات",
            'line'  => null,
            'desc'  => null,
        ],
        'token' => [
            'name'  => "Token",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'status' => [
            'name'  => "Status",
            'label' => "الحالة",
            'line'  => null,
            'desc'  => null,
        ],
        'autoload' => [
            'name'  => "Autoload",
            'label' => "تحميل تلقائي",
            'line'  => null,
            'desc'  => null,
        ],

        /**
         * Ownshippers
         */
        'pivot' => [
            'name'  => "Pivot",
            'label' => "الوسبط",
            'line'  => null,
            'desc'  => null,
        ],
        'user' => [
            'name'  => "User",
            'label' => "المستخدم",
            'line'  => null,
            'desc'  => null,
        ],
        'author' => [
            'name'  => "Author",
            'label' => "الكاتب",
            'line'  => null,
            'desc'  => null,
        ],
        'owner' => [
            'name'  => "Owner",
            'label' => "المالك",
            'line'  => null,
            'desc'  => null,
        ],
        'parent' => [
            'name'  => "Parent",
            'label' => "الأب",
            'line'  => null,
            'desc'  => null,
        ],
        'children' => [
            'name'  => "Children",
            'label' => "الفروع",
            'line'  => null,
            'desc'  => null,
        ],
        'metalist' => [
            'name'  => "MetaList",
            'label' => "البيانات المرفقة",
            'line'  => null,
            'desc'  => null,
        ],

        /**
         * DateTime Attributes
         */
        'read_at' => [
            'name'  => "Read at",
            'label' => "تاريخ القراءة",
            'line'  => "",
            'desc'  => "",
        ],
        'added_at' => [
            'name'  => "Added at",
            'label' => "تاريخ الإضافة",
            'line'  => "",
            'desc'  => "",
        ],
        'email_verified_at' => [
            'name'  => "Email verfied at",
            'label' => "تاريخ التأكيد",
            'line'  => "",
            'desc'  => "",
        ],
        'approved_at' => [
            'name'  => "Approved at",
            'label' => "تاريخ التحقق",
            'line'  => "",
            'desc'  => "",
        ],
        'published_at' => [
            'name'  => "Published at",
            'label' => "تاريخ النشر",
            'line'  => "",
            'desc'  => "",
        ],
        'activated_at' => [
            'name'  => "Activation Date",
            'label' => "تاريخ التفعيل",
            'line'  => "",
            'desc'  => "",
        ],
        'last_used_at' => [
            'name'  => "Last used at",
            'label' => "اخر استخدام",
            'line'  => "",
            'desc'  => "",
        ],
        'expires_at' => [
            'name'  => "Expiration Date",
            'label' => "تاريخ الصلاحية",
            'line'  => "",
            'desc'  => "",
        ],
        'cancelled_at' => [
            'name'  => "Cancelled at",
            'label' => "تاريخ الإلغاء",
            'line'  => "",
            'desc'  => "",
        ],
        'finished_at' => [
            'name'  => "Finished at",
            'label' => "تاريخ الإنتهاء",
            'line'  => "",
            'desc'  => "",
        ],
        'reserved_at' => [
            'name'  => "Reserved at",
            'label' => "تاريخ الحجز",
            'line'  => "",
            'desc'  => "",
        ],
        'available_at' => [
            'name'  => "Available at",
            'label' => "متاح في",
            'line'  => "",
            'desc'  => "",
        ],
        'failed_at' => [
            'name'  => "Failed at",
            'label' => "تاريخ الفشل",
            'line'  => "",
            'desc'  => "",
        ],
        'created_at' => [
            'name'  => "Create at",
            'label' => "تاريخ الإضافة",
            'line'  => "",
            'desc'  => "",
        ],
        'updated_at' => [
            'name'  => "Updated at",
            'label' => "آخر تحديث",
            'line'  => "",
            'desc'  => "",
        ],
        'deleted_at' => [
            'name'  => "Deleted at",
            'label' => "تاريخ الحذف",
            'line'  => "",
            'desc'  => "",
        ],
        'desctroyed_at' => [
            'name' => "Permentally deleted at",
            'label' => "تاريخ الإزالة",
            'line' => "",
            'desc' => "",
        ],
    ],



    /**
     * Actions
     */
    'actions' => [
        'show' => [
            'name'  => "Show",
            'label' => "عرض",
            'line'  => null,
            'desc'  => null,
        ],
        'view' => [
            'name'  => "View",
            'label' => "عرض",
            'line'  => null,
            'desc'  => null,
        ],
        'list' => [
            'name'  => "List",
            'label' => "",
            'line'  => null,
            'desc'  => null,
        ],
        'edit' => [
            'name'  => "Edit",
            'label' => "تعديل",
            'line'  => null,
            'desc'  => null,
        ],
        'create' => [
            'name'  => "Create",
            'label' => "إنشاء",
            'line'  => null,
            'desc'  => null,
        ],
        'update' => [
            'name'  => "Update",
            'label' => "تحديث",
            'line'  => null,
            'desc'  => null,
        ],
        'delete' => [
            'name'  => "Delete",
            'label' => "حذف",
            'line'  => null,
            'desc'  => null,
        ],
        'destroy' => [
            'name'  => "Destroy",
            'label' => "إزالة",
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
