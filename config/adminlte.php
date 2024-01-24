<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SEMAFORIZACION', //change title the aplications
    'title_prefix' => 'ALMACEN |',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => 'Sistema de Almacén para Semaforizacíon',
    'logo_img' => '/img/admin/logogamc.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => '/img/admin/cocha-logo.png',
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AlmacenGAMC',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-secondary bg-gradient',
    'usermenu_image' => true, //show image user
    'usermenu_desc' => true, //show text role user
    'usermenu_profile_url' => true, //show user profile view

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => false,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => false, //change mode themer

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-warning',
    'classes_auth_header' => '',
    'classes_auth_body' => 'bg-gradient-light',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-fw text-light',
    'classes_auth_btn' => 'btn-flat btn-light',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-info', //change color the icon
    'classes_brand_text' => '', //change color text
    'classes_content_wrapper' => '', //change color body
    'classes_content_header' => 'bg-white',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-info navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-sidebar_scrollbar_theme',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */


    'use_route_url' => false,
    'dashboard_url' => 'profile', // /home
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register/home',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => true,
    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Itemsºººººº
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],

        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'type'         => 'navbar-notification',
            'id'           => 'my-notification',      // An ID attribute (required).
            'icon'         => 'fas fa-bell',          // A font awesome icon (required).
            'icon_color'   => 'warning',              // The initial icon color (optional).
            'label'        => 0,                      // The initial label for the badge (optional).
            'label_color'  => 'danger',               // The initial badge color (optional).
            'url'          => 'notifications/show',   // The url to access all notifications/elements (required).
            'topnav_right' => true,                   // Or "topnav => true" to place on the left (required).
            'dropdown_mode'   => true,                // Enables the dropdown mode (optional).
            'dropdown_flabel' => 'Ver Notificaciones', // The label for the dropdown footer link (optional).
            // 'update_cfg'   => [
            //     'url' => 'notifications/get',         // The url to periodically fetch new data (optional).
            //     'period' => 30,                       // The update period for get new data (in seconds, optional).
            // ],
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],
        [
            'text' => 'Menu Principal',
            'url'  => 'home',
            'icon_color' => 'cyan',
            'icon'        => ' fas fa-fw fa-home ',
            // 'can'  => 'manage-blog',
        ],
        [
            'text'    => 'Configuración',
            'icon'    => ' fas fa-fw fa-tools',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'url'  => '#',
                    'icon_color' => 'cyan',
                    'icon'        => ' fas fa-fw fa-check',
                ],
                [
                    'text' => 'Responsable',
                    'url'  => 'responsable/index',
                    'icon_color' => 'cyan',
                    'icon'        => ' fas fa-fw fa-check',
                ],
                // [
                //     'text' => 'Personal',
                //     'url'  => '#',
                //     'icon_color' => 'cyan',
                //     'icon'        => ' fas fa-fw fa-check',
                // ],
                // [
                //     'text' => 'Roles',
                //     'url'  => '#',
                //     'icon_color' => 'cyan',
                //     'icon'        => ' fas fa-fw fa-check',
                // ],
                [
                    'text' => 'Ítem',
                    'url'  => 'catalogo.index',
                    'icon_color' => 'cyan',
                    'icon'        => ' fas fa-fw fa-check',
                ],
                [
                    'text' => 'Unidad Medida',
                    'url'  => '#',
                    'icon_color' => 'cyan',
                    'icon'        => ' fas fa-fw fa-check',
                ],
                [
                    'text' => 'Categoria',
                    'url'  => '#',
                    'icon_color' => 'cyan',
                    'icon'        => ' fas fa-fw fa-check',
                ],
                // [
                //     'text' => 'Proveedor',
                //     'url'  => '#',
                //     'icon_color' => 'cyan',
                //     'icon'        => ' fas fa-fw fa-check',
                // ],
            ],
        ],
        [
            'text' => 'Ingreso Ítem',
            'url'  => 'ingreso',
            'icon_color' => 'cyan',
            'icon'        => ' fas fa-fw fa-download',
            // 'can'  => 'manage-blog',
        ],
        [
            'text' => 'Salida Ítem',
            'url'  => 'egreso',
            'icon_color' => 'cyan',
            'icon'        => ' fas fa-fw fa-upload',
            // 'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Reportes',
            'url'         => 'reporte',
            'icon_color' => 'cyan',
            'icon'        => ' fas fa-fw fa-file',
            // 'label'       => 2,
            // 'label_color' => 'success',
        ],




    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */


    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/datatable/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/datatable/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/datatable/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/datatable/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/datatable/css/responsive.dataTables.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/datatable/js/dataTables.dateTime.min.js',
                ], [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/datatable/js/moment.min.js',
                ], [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/datatable/css/dataTables.dateTime.min.css',
                ],
            ],
        ],
        'dropzone' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/dropzone/css/dropzone.css'
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/dropzone/js/dropzone-min.js'
                ],
            ]
        ],
        'Animation' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/animation/css/animate.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/select2/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/select2/css/select2.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/chartjs/js/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/sweetalert2/js/sweetalert2@11.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/toastr/js/toastr.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/toastr/css/toastr.min.css',
                ],
            ],
        ],
        'leaflet' => [
            'active' => false,
            'files' => [

                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/leaflet/css/leaflet.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/leaflet/css/leaflet-routing-machine.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/leaflet/js/leaflet.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/leaflet/js/leaflet.wms.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/leaflet/js/proj4.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/leaflet/js/proj4leaflet.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/leaflet/js/leaflet-routing-machine.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/libreries/pace/css/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/libreries/pace/js/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
