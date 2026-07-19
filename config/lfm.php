<?php

return [

    'use_package_routes' => env('LFM_USE_PACKAGE_ROUTES', false),

    'middleware' => 'web',

    'use_translations' => true,

    'allow_multi_user' => true,

    'private_folder_name' => 'users',

    'images_folder_name' => 'photos',

    'files_folder_name' => 'files',

    'shared_folder_name' => 'share',

    'create_folder_by_date' => false,

    'disk' => 'public',

    'image_driver' => 'gd',

    'folder_categories' => [
        'image' => 'images_folder_name',
        'file' => 'files_folder_name',
    ],

    'should_create_thumbnails' => true,

    'thumb_img_width' => 200,
    'thumb_img_height' => 150,

    'rename_file_when_duplicate' => true,

    'max_image_resize_width' => 1920,
    'max_image_resize_height' => 1080,

    'max_image_resize_quality' => 90,

    'paginate' => [
        'image_count' => 200,
        'file_count' => 200,
    ],

    'alphabetical_order' => true,

    'show_only_thumbnails' => false,

    'set_default_mimetypes' => 'web_images',

    'allow_files_without_extension' => false,

    'helper' => [
        'class' => null,
        'route_prefix' => null,
    ],

];
