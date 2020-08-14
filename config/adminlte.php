<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Admin panel Unipage',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>StudyPage</b>net',

    'logo_mini' => '<b>S</b>P',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => '/',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'МЕНЮ АДМИНИСТРАТОРА',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Пользователи',
            'url'         => 'admin/user',
            'icon'        => 'users',
            'icon_color' => 'red',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Колледжи',
            'url'         => 'admin/college',
            'icon'        => 'building',
            'icon_color' => 'yellow',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Страницы Колледжей',
            'url'         => 'admin/list/college',
            'icon'        => 'building',
            'icon_color' => 'green',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'ВУЗы',
            'url'         => 'admin/university',
            'icon'        => 'university',
            'icon_color' => 'yellow',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Страницы ВУЗОВ',
            'url'         => 'admin/list',
            'icon'        => 'university',
            'icon_color' => 'green',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Области образования',
            'url'         => 'admin/direction',
            'icon'        => 'share',
            'icon_color' => 'aqua',
        ],
        [
            'text'        => 'Направления подготовки',
            'url'         => 'admin/subdirection',
            'icon'        => 'share',
            'icon_color' => 'green',
        ],
        [
            'text'        => 'Профильные предметы',
            'url'         => 'admin/subject',
            'icon'        => 'user',
            'icon_color' => 'blue',
        ],
        [
            'text'        => 'Специальности',
            'url'         => 'admin/specialty',
            'icon'        => 'book',
            'icon_color' => 'yellow',
        ],
//        [
//            'text'        => 'Рейтинг ВУЗов',
//            'icon'        => 'share',
//            'icon_color' => 'aqua',
//            'submenu' => [
////                [
////                    'text'       => 'Направления',
////                    'icon' => 'bars',
////                    'url'         => 'admin/category',
////                    'icon_color' => 'yellow',
////                ],
//                [
//                    'text'       => 'Рейтинг ВУЗов',
//                    'icon'    => 'globe',
//                    'url'         => 'admin/rating',
//                    'icon_color' => 'yellow',
//                ],
//            ]
//        ],
        [
            'text'       => 'Рейтинг ВУЗов',
            'icon'    => 'globe',
            'url'         => 'admin/rating',
            'icon_color' => 'yellow',
        ],
        [
            'text'        => 'Языки обучения',
            'url'         => 'admin/language',
            'icon'        => 'language',
            'icon_color' => 'green',
        ],
        [
            'text'        => 'Специальности в ВУЗе',
            'url'         => 'admin/cost',
            'icon'        => 'dollar',
            'icon_color' => 'blue',
        ],
        [
            'text'        => 'FAQs',
            'url'         => 'admin/faq',
            'icon'        => 'comments',
            'icon_color' => 'aqua',
        ],
        [
            'text'        => 'Требования к поступлению',
            'url'         => 'admin/requirement',
            'icon'        => 'file',
            'icon_color' => 'yellow',
        ],
        [
            'text'        => 'Города (Слайдер)',
            'url'         => 'admin/cityslider',
            'icon'        => 'globe',
            'icon_color' => 'green',
        ],
        [
            'text'        => 'Статьи',
            'url'         => 'admin/article',
            'icon_color' => 'blue',
        ],
        [
            'text'        => 'Навигатор',
            'url'         => 'admin/navigator',
            'icon_color' => 'red',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ],
        [
            'text'        => 'Обратная связь',
            'url'         => 'admin/callback',
            'icon_color' => 'aqua',
        ],
        [
            'text'        => 'Добавить ВУЗ',
            'url'         => 'admin/proposal',
            'icon_color' => 'yellow',
        ],
        [
            'text'        => 'Соц. сети и доп. настройки',
            'url'         => 'admin/social',
            'icon_color' => 'pink',
        ],
        [
            'text'        => 'SEO параметры',
            'url'         => 'admin/meta',
            'icon_color' => 'yellow',
            /*'label'       => 4,
            'label_color' => 'success',*/
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
